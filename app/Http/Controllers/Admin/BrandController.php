<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $brands = Cache::remember('brands.all', now()->addMinutes(60), function () {
            return Brand::all();
        });
    
        return view('admin.brands.index', [
            'brands' => $brands,
            'title' => 'Brands',
            'breadcrumbs' => [
                ['url' => '#', 'label' => 'Brands'],
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
        return view('admin.brands.create', [
            'title' => 'Add Brand',
            'breadcrumbs' => [
                ['url' => '#', 'label' => 'Brands'],
                ['url' => null, 'label' => 'Add Brand'],
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:brands,name',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // 2MB max
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }
    
        try {
            $brand = new Brand();
            $brand->name = $request->name;
            $brand->slug = Str::slug($request->name);
            $brand->description = $request->description;
    
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = Str::slug($request->name) . '-' . time() . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('brands', $filename, 'public');
                $brand->image = 'storage/' . $filePath;

            }
    
            $brand->save();

            Cache::forget('brands.all');

            return response()->json([
                'success' => true,
                'message' => 'Brand created successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create brand. ' . $e->getMessage(),
            ], 500);
        }
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
        $brand = Brand::findOrFail($id);
        return view('admin.brands.edit', [
            'brand' => $brand,
            'title' => 'Edit FAQs',
            'breadcrumbs' => [
                ['url' => '#', 'label' => 'Brands'],
                ['url' => '#', 'label' => 'Edit Brand'],
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
    public function update(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:brands,name,' . $brand->id,
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }

        try {
            $brand->name = $request->name;
            $brand->description = $request->description;

            if ($request->hasFile('image')) {
                // Optional: Delete old image if you want
                if ($brand->image && Storage::disk('public')->exists($brand->image)) {
                    Storage::disk('public')->delete($brand->image);
                }

                $file = $request->file('image');
                $filename = Str::slug($request->name) . '-' . time() . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('brands', $filename, 'public');
                $brand->image = $filePath;
            }

            $brand->save();

            Cache::forget('brands.all');


            return response()->json([
                'success' => true,
                'message' => 'Brand updated successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Update failed: ' . $e->getMessage(),
            ], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $brand = Brand::findOrFail($id);

        try {
            // Optional: Delete image from storage
            if ($brand->image && Storage::disk('public')->exists($brand->image)) {
                Storage::disk('public')->delete($brand->image);
            }
    
            $brand->delete();

            Cache::forget('brands.all');

    
            return response()->json([
                'success' => true,
                'message' => 'Brand deleted successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Delete failed: ' . $e->getMessage(),
            ], 500);
        }
    
    }
}
