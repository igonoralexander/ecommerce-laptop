<?php

namespace App\Http\Controllers;

// use Auth;
// use Mail;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Models\Blog;
use App\Models\Admin;

class BlogController extends Controller
{
    //
    public function create()
    {
        $data = array();

        if (session::has('AdmLogId'))
        {
            $data = Admin::where('id', '=', session::get('AdmLogId'))->first();
            return view('admin.createblog', compact('data'));
        }

        else
        {
            return redirect('/admin.php');
        }
    }
    
    //

    public function storeBlogPosts(Request $request)
    {
        $request-> validate([
        'title'     => 'required|unique:blogs',   
        'contents'   =>  'required|max:5000'
        ]);

        if (request()->hasFile('imgBlog'))
        {
            $extension = $request->file('imgBlog')->guessClientExtension();
            $folder = 'blogs_img';

            if( $extension == 'jpeg' || $extension == 'png' || $extension == 'jpg' || $extension == 'mp4'  )
            {
                $imageName = time() . "." . $extension;
                $file = $request->file('imgBlog')->storeAs($folder, $imageName, 'public');
        
                $blog = new Blog();
                    
                $blog->imgBlog = 'storage/' . $file;
                $blog ->title     = $request -> title;
                $blog->contents      = $request -> contents;

                $blog-> save();
                return redirect ('/manageblogs.php')->with ('Success', 'Added Successfully');
            }
        }
        else
        {
                $imageName = 'storage/blogs_img/default.jpg';
        
                $blog = new Blog();
                    
                $blog->imgBlog    = $imageName;
                $blog->title      = $request-> title;
                $blog->contents    = $request-> contents;
                
                $blog-> save();
                return redirect ('/manageblogs.php')->with ('Success', 'Added Successfully');

        }
    }

    //
    public function manageBlog()
    {
        $data = array();

        if (session::has('AdmLogId'))
        {
            $data = Admin::where('id', '=', session::get('AdmLogId'))->first();
            $blogs = Blog::orderBy('id', 'DESC')->paginate(10);
            return view('admin.manageblog', compact('blogs'));
        }

        else
        {
            return redirect('/admin.php');
        }
    }
    
    public function displayBlog()
    {
        if (session::has('AdmLogId'))
        {
            Session::pull('AdmLogId');
            $blogs = Blog::latest()->paginate(5);
            return view('pages.blog', compact('blogs') );
        }
        
        { 
            $blogs = Blog::latest()->paginate(5);
            return view('pages.blog', compact('blogs') );
        }
    }

    public function showBlog(Blog $blogs)
    {
        if (session::has('AdmLogId'))
        {
            Session::pull('AdmLogId');
            $blogs = Blog::find($blogs->id);
            return view('pages.singleblog', compact('blogs'));
        }
        else
        {
            $blogs = Blog::find($blogs->id);
            return view('pages.singleblog', compact('blogs'));
        }
    }
    
    public function edit(Blog $blogs)
    {
        $blogs = Blog::find($blogs->id);
        return view('admin.editblog', compact('blogs'));
    }

    public function update(Blog $blogs, Request $request)
    {

        if (request()->hasFile('imgBlog'))
            {
                $extension = $request->file('imgBlog')->guessClientExtension();
                $folder = 'blogs_img';

                if( $extension == 'jpeg' || $extension == 'png' || $extension == 'jpg' || $extension == 'mp4')
                {
                    $imageName = time() . "." . $extension;
                    $file = $request->file('imgBlog')->storeAs($folder, $imageName, 'public');
            
                    $blogs = Blog::find($blogs->id);    

                    $blogs->imgBlog       = 'storage/'.$file;
                    $blogs->title     = $request->title;
                    $blogs->contents   = $request->contents;
                        
                    $blogs->save();
                        
                    return redirect ('/manageblogs.php')->with ('Success', 'Update Successfull');    
                }
        
            }
        else
            {    
                $imageName = 'storage/blogs_img/default.jpg';
                
                $blogs = Blog::find($blogs->id); 

                $blogs->imgBlog    = $imageName;
                $blogs->title      = $request->get('title');
                $blogs->contents    = $request->get('contents');
                    
                $blogs-> save();
                
                return redirect ('/manageblogs.php')->with ('Success', 'Update Successfully');

            }

    }

    public function destroy(Blog $blogs)
    {
        $blogs = Blog::find($blogs->id);

        $blogs->delete();

        return redirect('/manageblogs.php')->with('success', 'Deleted!');
    }
}
