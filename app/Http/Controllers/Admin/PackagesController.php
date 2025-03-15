<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Package;
use Illuminate\Http\Request;

class PackagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $packages = Package::all();
        return view('admin.packages.index', compact('packages'))->with([
            'title' => 'All Packages',
            'breadcrumbs' => [
                ['url' => route('admin.packages.index'), 'label' => 'Packages'],
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
        $categories = Category::all();
        return view('admin.packages.create', [
            'title' => 'Packages',
            'categories' => $categories,
            'breadcrumbs' => [
                ['url' => route('admin.packages.index'), 'label' => 'Packages'],
                ['url' => null, 'label' => 'Create Packages'],
            ],   
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|string|max:100',
        ]);

        $package = new Package();
        $package->category_id = $request->category_id;
        $package->name = $request->name;
        $package->description = $request->description;
        $package->price = $request->price;
        $package->duration = $request->duration;
        $package->save();

        return response()->json(['success' => true, 'message' => 'Package added successfully!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $package = Package::findOrFail($id);
        $categories = Category::all();

        return view('admin.packages.edit', [
            'package' => $package,
            'categories' => $categories,
            'title' => 'Edit Package',
            'breadcrumbs' => [
                ['url' => '#', 'label' => 'Packages'],
                ['url' => '#', 'label' => 'Edit Package'],
            ],   
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Package $package)
    {
        //
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|string|max:255',
        ]);
    
        $package->update($request->all());
    
        return response()->json(['success' => true, 'message' => 'Package updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $package = Package::findOrFail($id);
        $package->delete();

        return response()->json(['success' => true, 'message' => 'Package has been deleted successfully']);
    }
}
