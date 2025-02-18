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

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::all();
        $users = User::where('role', 'user')->get();
        return view('admin.media.add-videos', [
            'categories' => $categories,
            'users' => $users,
            'title' => 'Add Videos',
            'breadcrumbs' => [
                ['url' => '#', 'label' => 'Users'],
                ['url' => null, 'label' => 'Add Videos'],
            ],   
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // Validate only videos instead of images
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'videos' => 'required|array',
            'videos.*' => 'mimetypes:video/mp4,video/mpeg,video/quicktime,video/x-msvideo,video/x-matroska|max:5242880', 
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        $user = User::findOrFail($request->user_id);
        $category = Category::find($request->category_id);
        $categoryId = $category ? $category->id : null;
        $folder = "{$user->first_name}_{$user->last_name}"; // Folder under user's full name
    
        $connectionString = config('filesystems.disks.azure.connection_string');
        $containerName = 'videos';
        $blobClient = BlobRestProxy::createBlobService($connectionString);
    
        foreach ($request->file('videos') as $video) {
            $videoName = time() . '_' . uniqid() . '.' . $video->getClientOriginalExtension();
            $filePath = $folder . '/' . $videoName;
            $contentType = $video->getMimeType(); // Video MIME type
    
            // Open File Stream for Video
            $fileStream = fopen($video->getRealPath(), 'rb'); // Use 'rb' for binary files
            if (!$fileStream) {
                throw new \Exception('Failed to open video for reading');
            }
    
            // Set Blob Options (including Content-Type)
            $blobOptions = new CreateBlockBlobOptions();
            $blobOptions->setContentType($contentType);
    
            // Upload Video to Azure Storage
            $blobClient->createBlockBlob($containerName, $filePath, $fileStream, $blobOptions);
    
            // Close File Stream
            if (is_resource($fileStream)) {
                fclose($fileStream);
            }
    
            // Store Video Metadata in Database
            UploadMedia::create([
                'file_url' => env('AZURE_STORAGE_URL') . '/' . $containerName . '/' . $filePath,
                'file_name' => $videoName,
                'media_type' => $contentType, // Video MIME type
                'category_id' => $categoryId,
                'user_id' => $user->id,
            ]);
        }
    
        return back()->with('success', 'Videos uploaded successfully!');
    }    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }
}
