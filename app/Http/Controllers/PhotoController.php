<?php

namespace App\Http\Controllers;

use Auth;
use Mail;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\Controller;

use App\Models\Photo;

use App\Models\Category;
use App\Models\Admin;
use App\Models\Image;

class PhotoController extends Controller
{
    public function create()
    {
        $data = array();

        if (session::has('AdmLogId'))
        {
            $data = Admin::where('id', '=', session::get('AdmLogId'))->first();

            $category = Category::All();

            return view('admin.imgupload', compact(['data', 'category']));
        }

        else
        {
            return redirect('/admin.php');
        }
        
    }
    
    public function storePhoto(Request $request)
    {
        if($request->has('images'))
        {
            foreach($request->file('images')as $image)
            {
                $extension = strtolower($image->getClientOriginalExtension());
                $folder = 'storage/photos/';
                $imageName = md5(rand(1,1000)). "." . $extension;
                $url = $folder.$imageName;

                $image->move($folder, $imageName);

                Image::create([
                    'image' => $url,
                    'category_id' =>  $request ->category_id,
                ]);
            }
        }
        return back()->with (['message' => 'Images Uploaded Successfully!']);
    }

    public function displayPhoto($id)
    {
            $category1 = Category::find($id);

            $category =  Category::All();

            if (!$category1) abort(404);

            $images = $category1->images;

            return view('gallery.photos', compact(['category', 'images', 'category1']));
    }
}