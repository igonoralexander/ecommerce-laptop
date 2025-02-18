<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use MicrosoftAzure\Storage\Blob\Models\CreateBlockBlobOptions;

class MediaManageCategory extends Component
{

    use WithFileUploads;
    
    public $name, $category_id, $image;
    
    public $data, $existingImage;

    public $action = 'index'; // Default action is 'index'
    public $title, $breadcrumbs = [];


    protected $rules = [
        'name' => 'required|string|unique:categories,name',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:524288',
    ];

    public function resetForm()
    {
        $this->category_id = null;
        $this->image = null;
        $this->name = '';
    }

    public function setPageData($title, $breadcrumbs)
    {
        $this->title = $title;
        $this->breadcrumbs = $breadcrumbs;
    }

    public function index()
    {
        $this->action = 'index';
    }

    public function mount()
    {
        $this->setPageData('Media Categories', [
            ['url' => '#', 'label' => 'Media'],
            ['url' => null, 'label' => 'All Categories'],    
        ]);
    }

   
    public function save()
    {
        $this->validate();
    
        $slug = Str::slug($this->name);
        $category = new Category();
        $category->name = $this->name;
        $category->slug = $slug;
    
        if ($this->image) {
            $folder = 'media_categories';
            $imageName = time() . '.' . $this->image->getClientOriginalExtension();
            $filePath = $folder . '/' . $imageName;
            $contentType = $this->image->getMimeType();
    
            // Get Connection String & Container Name
            $connectionString = config('filesystems.disks.azure.connection_string');
            $containerName = env('AZURE_STORAGE_CONTAINER');
    
            // Create Blob Client
            $blobClient = BlobRestProxy::createBlobService($connectionString);
    
            // **Ensure the file stream is opened correctly**
            $fileStream = fopen($this->image->getRealPath(), 'r');
            if (!$fileStream) {
                throw new \Exception('Failed to open file for reading');
            }
    
            // Set Blob Options (including Content-Type)
            $blobOptions = new CreateBlockBlobOptions();
            $blobOptions->setContentType($contentType);
    
            // **Upload to Azure**
            $blobClient->createBlockBlob($containerName, $filePath, $fileStream, $blobOptions);
    
            // **Close the file stream only if it's valid**
            if (is_resource($fileStream)) {
                fclose($fileStream);
            }
    
            // Store Image URL in Database
            $category->image = env('AZURE_STORAGE_URL') . '/' . $containerName . '/' . $filePath;
        }
    
        $category->save();
        session()->flash('message', 'Category created successfully.');
        $this->action = 'index';
    }
    
    public function create()
    {
        $this->resetForm();
        $this->setPageData('Add New Category', [
            ['url' => route('admin.media-category-list'), 'label' => 'Categories'],
            ['url' => null, 'label' => 'Add New Category'],
        ]);
        $this->action = 'create';
    }

    public function edit($id)
    {
        $category = category::findOrFail($id);
        $this->category_id = $category->id;
        $this->name = $category->name;
        $this->existingImage = $category->image;

        $this->setPageData('Edit Category', [
            ['url' => route('admin.media-category-list'), 'label' => 'Categories'],
            ['url' => null, 'label' => 'Edit Category'],
        ]);

        $this->action = 'edit';
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|unique:categories,name,' . $this->category_id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:524288',
        ]);

        $category = Category::find($this->category_id);
        $slug = Str::slug($this->name);

        $category->name = $this->name;
        $category->slug = $slug;
        
        if ($this->image) {
            $folder = 'media_categories';
            $imageName = time() . '.' . $this->image->getClientOriginalExtension();
            $filePath = $folder . '/' . $imageName;
            $contentType = $this->image->getMimeType();
    
            // Get Connection String & Container Name
            $connectionString = config('filesystems.disks.azure.connection_string');
            $containerName = env('AZURE_STORAGE_CONTAINER');
    
            // Create Blob Client
            $blobClient = BlobRestProxy::createBlobService($connectionString);
    
            // **Ensure the file stream is opened correctly**
            $fileStream = fopen($this->image->getRealPath(), 'r');
            if (!$fileStream) {
                throw new \Exception('Failed to open file for reading');
            }
    
            // Set Blob Options (including Content-Type)
            $blobOptions = new CreateBlockBlobOptions();
            $blobOptions->setContentType($contentType);
    
            // **Delete the old image from Azure Blob Storage**
            if ($category->image) {
                $oldFilePath = str_replace(env('AZURE_STORAGE_URL') . '/' . $containerName . '/', '', $category->image);
                $blobClient->deleteBlob($containerName, $oldFilePath);
            }

        // **Upload the new image to Azure**
        $blobClient->createBlockBlob($containerName, $filePath, $fileStream, $blobOptions);

        // **Close the file stream**
        if (is_resource($fileStream)) {
            fclose($fileStream);
        }

        // Store Image URL in Database
        $category->image = env('AZURE_STORAGE_URL') . '/' . $containerName . '/' . $filePath;
    }

      
        // if ($this->image) {
        //     if ($this->existingImage && Storage::disk('public')->exists($this->existingImage)) {
        //         Storage::disk('public')->delete($this->existingImage);
        //     }

        //     $folder = 'media_categories';
        //     $imageName = time() . '.' . $this->image->getClientOriginalExtension();
        //     $file = $this->image->storeAs($folder, $imageName, 'public');
        //     $category->image = 'storage/' . $file;
        // }
        
        $category->save();
        session()->flash('message', 'Updated successfull!');
        $this->action = 'index';
        
    } 

    public function view($id)
    {
        $category = Category::findOrFail($id);
        $this->category_id = $category->id;
        $this->name = $category->name;
        $this->action = 'view';
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);

        // Get Connection String & Container Name
        $connectionString = env('AZURE_STORAGE_CONNECTION_STRING');
        $containerName = env('AZURE_STORAGE_CONTAINER');

        // Create Blob Client
        $blobClient = BlobRestProxy::createBlobService($connectionString);

        // **Delete the image from Azure Blob Storage if it exists**
        if ($category->image) {
            $filePath = str_replace(env('AZURE_STORAGE_URL') . '/' . $containerName . '/', '', $category->image);
            try {
                $blobClient->deleteBlob($containerName, $filePath);
            } catch (\Exception $e) {
                // Log the error but proceed with deletion
                Log::error("Error deleting blob: " . $e->getMessage());
            }
        }

        // **Delete the category from the database**
        $category->delete();

        session()->flash('message', 'Category deleted successfully.');
    }



    public function render()
    {
        return view('livewire.admin.media-manage-category', [
            'categories' => Category::paginate(9),
        ]);
    }
}
