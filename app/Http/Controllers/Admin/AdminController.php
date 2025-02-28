<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use MicrosoftAzure\Storage\Blob\Models\CreateBlockBlobOptions;
use App\Models\UploadMedia;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin()
    {
        //
        return view('admin.user.manage-admin');
    }


    public function user()
    {
        //
        return view('admin.user.manage-user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function gallery()
    {
        $media = UploadMedia::latest()->paginate(15);
        return view('admin.media.gallery', [
            'media' => $media,
            'title' => 'Gallery Management',
            'breadcrumbs' => [
                ['url' => '#', 'label' => 'Users'],
                ['url' => null, 'label' => 'All Media'],
            ],   
        ]);
    }

    public function searchGallery(Request $request)
    {
        $search = $request->query('query');
    
        if (empty($search)) {
            // If the search query is empty, return all media (or you could paginate)
            $media = UploadMedia::latest()->get();
        } else {
            $media = UploadMedia::with(['user', 'category'])
                ->where(function ($query) use ($search) {
                    $query->whereHas('user', function ($q) use ($search) {
                        $q->where('first_name', 'like', "%{$search}%")
                          ->orWhere('last_name', 'like', "%{$search}%")
                          ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$search}%"]);
                    })
                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
                })
                ->latest()
                ->get();
        }
    
        return response()->json(['media' => $media]);
    }

    public function loadMoreMedia(Request $request)
    {
        $page = $request->query('page', 1);
        // Paginate media (10 per page)
        $mediaPaginated = UploadMedia::latest()->paginate(15, ['*'], 'page', $page);

        // Return only the media items as JSON
        return response()->json([
            'media' => $mediaPaginated->items(),
            'next_page' => $mediaPaginated->nextPageUrl() ? $page + 1 : null,
        ]);
    }

    public function deleteMedia($id): JsonResponse
    {
        $media = UploadMedia::find($id);

        if (!$media) {
            return response()->json(['success' => false, 'message' => 'Media not found'], 404);
        }

        // Azure Storage Blob Deletion
        $connectionString = env('AZURE_STORAGE_CONNECTION_STRING');
        $imageContainer = env('AZURE_IMAGE_CONTAINER');
        $videoContainer = env('AZURE_VIDEO_CONTAINER');
        $blobClient = BlobRestProxy::createBlobService($connectionString);

        try {
            if ($media->media_type === 'image') {
                $filePath = str_replace(env('AZURE_STORAGE_URL') . '/' . $imageContainer . '/', '', $media->file_url);
                $downloadfilePath = str_replace(env('AZURE_STORAGE_URL') . '/' . $imageContainer . '/', '', $media->download_url);
                $blobClient->deleteBlob($imageContainer, $filePath);
                $blobClient->deleteBlob($imageContainer, $downloadfilePath);
            } elseif ($media->media_type === 'video') {
                $filePath = str_replace(env('AZURE_STORAGE_URL') . '/' . $videoContainer . '/', '', $media->file_url);
                $blobClient->deleteBlob($videoContainer, $filePath);
            }
        } catch (\Exception $e) {
            Log::error("Error deleting blob: " . $e->getMessage());
        }

        // Delete from database
        $media->delete();

        return response()->json(['success' => true, 'message' => 'Media deleted successfully']);
    }
   
}