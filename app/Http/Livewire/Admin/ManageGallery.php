<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Builder;
use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use MicrosoftAzure\Storage\Blob\Models\CreateBlockBlobOptions;
use Livewire\WithPagination;
use App\Models\UploadMedia;



class ManageGallery extends Component
{

    use WithPagination;

    public $search = '';
    public $perPage = 10;

    protected $listeners = ['deleteMedia' => 'delete', 'refreshComponent' => '$refresh'];


    public function confirmDelete($id)
    {
        $this->dispatchBrowserEvent('confirmDelete', ['mediaId' => $id]);
    }

    public function delete($id)
    {
        $media = UploadMedia::findOrFail($id);

        // Get Connection String & Container Name
        $connectionString = env('AZURE_STORAGE_CONNECTION_STRING');
        $imageContainer = env('AZURE_IMAGE_CONTAINER');
        $videoContainer = env('AZURE_VIDEO_CONTAINER');

        // Create Blob Client
        $blobClient = BlobRestProxy::createBlobService($connectionString);

        try {
            if ($media->media_type === 'image') {
                // **Delete from images container**
                $filePath = str_replace(env('AZURE_STORAGE_URL') . '/' . $imageContainer . '/', '', $media->file_url);
                $blobClient->deleteBlob($imageContainer, $filePath);
            } elseif ($media->media_type === 'video') {
                // **Delete from videos container**
                $filePath = str_replace(env('AZURE_STORAGE_URL') . '/' . $videoContainer . '/', '', $media->file_url);
                $blobClient->deleteBlob($videoContainer, $filePath);
            }
        } catch (\Exception $e) {
            // Log the error but proceed with database deletion
            Log::error("Error deleting blob: " . $e->getMessage());
        }
    
        // Delete media record from database
        $media->delete();

         // Refresh the UI
        $this->dispatchBrowserEvent('mediaDeleted');

        session()->flash('message', 'Media deleted successfully.');
        $this->emit('refreshComponent');
    }

    public function render()
    {
        $media = UploadMedia::with(['user', 'category'])
            ->where('media_type', 'image') // Ensure only videos are fetched
            ->whereHas('user', function (Builder $query) {
                $query->where('role', 'user');
            })
            ->when(!empty($this->search), function ($query) {
                $query->whereHas('user', function ($q) {
                    $q->where('first_name', 'like', "%{$this->search}%")
                      ->orWhere('last_name', 'like', "%{$this->search}%")
                      ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$this->search}%"]);
                })
                ->orWhereHas('category', function ($q) {
                    $q->where('name', 'like', "%{$this->search}%");
                });
            })
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.admin.manage-gallery', compact('media'));
    }

    public function updatingSearch()
    {
        $this->resetPage(); // Reset to first page when searching
    }
}