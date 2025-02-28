<?php

namespace App\Http\Controllers\Admin;

use MicrosoftAzure\Storage\Blob\Models\CreateBlockBlobOptions;
use MicrosoftAzure\Storage\Blob\BlobRestProxy;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use App\Models\UploadMedia;
use FFMpeg;

class PhotoController extends Controller
{
    
    public function index()
    {
        $categories = Category::all();
        $users = User::where('role', 'user')->get();
        return view('admin.media.add-images', [
            'categories' => $categories,
            'users' => $users,
            'title' => 'Add Images',
            'breadcrumbs' => [
                ['url' => '#', 'label' => 'Users'],
                ['url' => null, 'label' => 'Add Images'],
            ],   
        ]);
    }
    
    public function create()
    {
        
    
    }
    
    public function store(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,webp,png,jpg,gif,svg|max:524288', // Validate each image
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::findOrFail($request->user_id);
        $category = Category::find($request->category_id);
        $categoryId = $category ? $category->id : null;
        $folder = "{$user->first_name}_{$user->last_name}"; // Folder under user's full name

        $connectionString = config('filesystems.disks.azure.connection_string');
        $containerName = env('AZURE_STORAGE_CONTAINER');
        $blobClient = BlobRestProxy::createBlobService($connectionString);

        foreach ($request->file('images') as $image) {
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $filePath = $folder . '/' . $imageName;
            $downloadFilePath = $folder . '/download_' . $imageName; // File for downloading
            $contentType = $image->getMimeType();

            // Open File Stream
            $fileStream = fopen($image->getRealPath(), 'r');
            if (!$fileStream) {
                throw new \Exception('Failed to open file for reading');
            }

            // Set Blob Options (including Content-Type)
            $blobOptions = new CreateBlockBlobOptions();
            $blobOptions->setContentType($contentType);

            // Upload to Azure Storage
            $blobClient->createBlockBlob($containerName, $filePath, $fileStream, $blobOptions);


            // **Upload Downloadable File (Forced Download Content-Type)**
            // Open File Stream
            $fileStream = fopen($image->getRealPath(), 'r');
            if (!$fileStream) {
                throw new \Exception('Failed to open file for reading');
            }

            $downloadBlobOptions = new CreateBlockBlobOptions();
            $downloadBlobOptions->setContentType('application/octet-stream');
            $blobClient->createBlockBlob($containerName, $downloadFilePath, $fileStream, $downloadBlobOptions);
            
            // Close File Stream
            if (is_resource($fileStream)) {
                fclose($fileStream);
            }

            UploadMedia::create([
                'file_url' => env('AZURE_STORAGE_URL') . '/' . $containerName . '/' . $filePath,
                'download_url' => env('AZURE_STORAGE_URL') . '/' . $containerName . '/' . $downloadFilePath,
                'file_name' => $imageName,
                'title' => $request->title,
                'media_type' => 'image',
                'category_id' => $categoryId,
                'user_id' => $user->id, // Selected user
            ]);
        }

        return back();

    }

    public function destroy($id)
    {
            
    }
}