<?php

namespace App\Http\Controllers\Admin;

use MicrosoftAzure\Storage\Blob\Models\CreateBlockBlobOptions;
use MicrosoftAzure\Storage\Blob\Models\BlockList;
use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use App\Models\UploadMedia;

use FFMpeg;

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
            'videos.*' => 'mimetypes:video/mp4,video/mpeg,video/quicktime,video/x-msvideo,video/x-matroska|max:10485760', //Max 10GB
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        try {
            $user = User::findOrFail($request->user_id);
            $category = Category::find($request->category_id);
            $categoryId = $category ? $category->id : null;
            $folder = "{$user->first_name}_{$user->last_name}"; // Folder under user's full name
        
            // Azure storage configuration
            $connectionString = config('filesystems.disks.azure.connection_string');
            $containerName = 'videos';
            $blobClient = BlobRestProxy::createBlobService($connectionString);
        
            foreach ($request->file('videos') as $video) {
                // Generate a unique ID for the file
                $fileId = uniqid(); 
                $fileName = time() . '_' . $fileId . '.' . $video->getClientOriginalExtension();
                $filePath = $folder . '/' . $fileName;
                $downloadFilePath = $folder . '/download_' . $fileName; // File for downloading
                $contentType = $video->getMimeType(); // Video MIME type
        
                // Define the local temporary path correctly
                $finalFilePath = $video->path();

        
                // Save the uploaded file locally
                $video->storeAs('temp_uploads', "{$fileId}_{$fileName}");
        
                // Open file stream
                $fileStream = fopen($video->path(), 'rb'); // Use 'rb' for binary files
                if (!$fileStream) {
                    throw new \Exception('Failed to open video for reading');
                }
        
                // Upload Video to Azure Storage
                $blobOptions = new CreateBlockBlobOptions();
                $blobOptions->setContentType($contentType);
                $blobClient->createBlockBlob($containerName, $filePath, $fileStream, $blobOptions);


                // **Upload Downloadable File (Forced Download Content-Type)**
                // Open File Stream
                $fileStream = fopen($video->getRealPath(), 'r');
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
        
                // Delete local file after upload
                unlink($finalFilePath);          

            // Generate Video Thumbnail (Optional)
            // $thumbnailPath = $this->generateVideoThumbnail($video->getRealPath(), $videoName);


            // Store Video Metadata in Database
            UploadMedia::create([
                'file_url' => env('AZURE_STORAGE_URL') . '/' . $containerName . '/' . $filePath,
                'download_url' => env('AZURE_STORAGE_URL') . '/' . $containerName . '/' . $downloadFilePath,
                'file_name' => $fileName,
                'title' => $request->title,
                'media_type' => 'video', // Video MIME type
                'category_id' => $categoryId,
                'user_id' => $user->id,
            ]);
        }
    
            return back()->with('success', 'Videos uploaded successfully!');

        } catch (\Exception $e) {
            return back()->with('error', 'Video upload failed: ' . $e->getMessage());
        }
    } 


    private function generateVideoThumbnail($videoPath, $videoName)
    {
        try {
            $thumbnailName = pathinfo($videoName, PATHINFO_FILENAME) . '.jpg';
            $thumbnailPath = storage_path('app/public/thumbnails/' . $thumbnailName);

            // Use FFmpeg to generate a thumbnail at 5 seconds mark
            $ffmpegCommand = "ffmpeg -i {$videoPath} -ss 00:00:05 -vframes 1 {$thumbnailPath} 2>&1";
            shell_exec($ffmpegCommand);

            return asset('storage/thumbnails/' . $thumbnailName);
        } catch (\Exception $e) {
            return null; // If thumbnail generation fails, return null
        }
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

    public function uploadChunk(Request $request)
    {
        $request->validate([
            'file' => 'required|file',
            'file_name' => 'required|string',
            'chunk_index' => 'required|integer',
            'total_chunks' => 'required|integer',
            'file_id' => 'required|string'
        ]);

        $fileId = $request->file_id;
        $chunkIndex = $request->chunk_index;
        $totalChunks = $request->total_chunks;
        $fileName = $request->file_name;
        $tempDir = storage_path("app/temp_uploads/{$fileId}");

        // Ensure temp directory exists
        if (!is_dir($tempDir)) {
            mkdir($tempDir, 0777, true);
        }

        // Save chunk to temporary directory
        $chunkPath = "{$tempDir}/chunk_{$chunkIndex}";
        file_put_contents($chunkPath, file_get_contents($request->file('file')->path()));

        // If all chunks are received, merge them
        if ($chunkIndex + 1 == $totalChunks) {
            $finalFilePath = storage_path("app/temp_uploads/{$fileId}_{$fileName}");
            $finalFile = fopen($finalFilePath, 'wb');

            for ($i = 0; $i < $totalChunks; $i++) {
                $chunkPath = "{$tempDir}/chunk_{$i}";
                fwrite($finalFile, file_get_contents($chunkPath));
            }
            fclose($finalFile);

            // Remove temp directory
            array_map('unlink', glob("{$tempDir}/*"));
            rmdir($tempDir);

            return response()->json(['success' => true, 'message' => 'File assembled', 'file_path' => $finalFilePath]);
        }

        return response()->json(['success' => true, 'message' => "Chunk {$chunkIndex} uploaded"]);
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
