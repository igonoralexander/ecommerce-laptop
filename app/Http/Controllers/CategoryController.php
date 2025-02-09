<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array();

        if (session::has('AdmLogId'))
        {
            $data = Admin::where('id', '=', session::get('AdmLogId'))->first();
            return view('admin.addcategory', compact('data'));
        }

        else
        {
            return redirect('/admin.php');
        }

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
            'name'     => 'required|unique:categories',   
            'image'   =>  'required',
            ]);

        if (request()->hasFile('image'))
        {
            $extension = $request->file('image')->getClientOriginalExtension();
            $folder = 'categories_img';
            
            if( $extension == 'jpeg' || $extension == 'png' || $extension == 'jpg')
            {
            $imageName = time() . "." . $extension;
            $file = $request->file('image')->storeAs($folder, $imageName, 'public');

            $category = new Category ();
        
            $category ->name            = $request ->name;
            $category->image            = 'storage/' . $file;
            
            $category -> save();

            return back()->with (['message' => 'Category added Successfully!']);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
        $data = array();

        if (session::has('AdmLogId'))
        {
            $data = Admin::where('id', '=', session::get('AdmLogId'))->first();
            $category = Category::All();
            return view('admin.viewallcategories', compact(['data', 'category']));
        }
        
        else
        {
            return redirect('/admin.php');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
        $category = Category::find($category->id);
        return view('admin.editcategory', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
        $category = Category::find($category->id);    
        
        if (request()->hasFile('image'))
        {
            $path = 'storage/categories_img/'.$category->image;

            if (File::exists($path))
            {
                File::delete($path);
            }

            $extension = $request->file('image')->getClientOriginalExtension();
            $folder = 'categories_img';
            $imageName      = time() . "." . $extension;

            $file = $request->file('image')->storeAs($folder, $imageName, 'public');
           
            $category->image             = 'storage/' . $file;
        }
            $category ->name                    = $request ->name;
            $category->slug                     = $request ->slug;
            
            $category -> update();
            return back()->with (['message' => 'Category updated Successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
        $category = Category::find($category->id);
        
        $path = 'storage/categories_img/'.$category->image;

        if (File::exists($path))
        {
            File::delete($path);
        }
        $category->delete();

        return redirect('/addcategory.php')->with('success', 'Deleted!');
    }
}
