<?php

namespace App\Http\Controllers;

use Auth;
use Mail;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

use App\Models\Video;
use App\Models\Photo;
use App\Models\Category;

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
        $request-> validate([
            'vid' => 'required|file|mimetypes:video/mp4',
        ]);   
      
      if ($request->hasFile('vid'))
      {
        $extension = $request->file('vid')->guessClientExtension();
        $folder = 'vids';

        $vidName = time() . "." . $extension;
        $file = $request->file('vid')->storeAs($folder, $vidName, 'public');
        
        $video = new Video;
        $video->cate_id = $request->cate_id;
        $video->vid = 'storage/' . $file;
      }
      
        $video->save();
        return back()->with (['message' => 'Video Uploaded Successfully!']);
      
     }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $videos, $id)
    {
        if (Category::Where('id', $id)->exists())
        {

            $category = Category::All();
            $category1 = Category::Where('id', $id)->first();

            $videos = Video::Where('cate_id', $category1->id)->get();

            return view('gallery.videos', compact(['videos', 'category', 'category1']));
        }
        else
        {
            return redirect ('/')->with('status', "id Does Not Exists");
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
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
    public function update(Request $request, Video $video)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        //
    }
}
