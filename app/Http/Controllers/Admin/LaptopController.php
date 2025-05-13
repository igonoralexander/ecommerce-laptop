<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

use App\Models\Laptop;
use App\Models\LaptopImage;
use MicrosoftAzure\Storage\Blob\Models\CreateBlockBlobOptions;
use MicrosoftAzure\Storage\Blob\BlobRestProxy;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class LaptopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $laptops = Cache::remember('admin_laptops_index', now()->addMinutes(10), function () {
            return Laptop::with(['brand', 'images'])->get();
        });
    
        return view('admin.laptops.index', [
            'laptops' => $laptops,
            'title' => 'Laptops Available',
            'breadcrumbs' => [
                ['url' => '#', 'label' => 'All Laptops'],
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
        $brands = Brand::all();
        return view('admin.laptops.create', [
            'brands' => $brands,
            'title' => 'Add laptop',
            'breadcrumbs' => [
                ['url' => '#', 'label' => 'Laptops'],
                ['url' => null, 'label' => 'Add Laptop'],
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
        try {
            
                $validator = Validator::make($request->all(), [
                    'name' => 'required|string|max:255',
                    'brand_id' => 'required|exists:brands,id',
                    'price' => 'required|numeric',
                    'sale_price' => 'nullable|numeric',
                    'stock_quantity' => 'required|integer',
                    'description' => 'required|string',
                    'specifications' => 'nullable|string',
                    'images.*' => 'required|image|mimes:jpeg,png,jpg,webp,svg|max:5120',
                ]);
        
                if ($validator->fails()) {
                    return response()->json([
                        'success' => false,
                        'message' => $validator->errors()->first()
                    ], 422);
                }
        
                $laptop = new Laptop();
                $laptop->name = $request->name;
                $laptop->slug = Str::slug($request->name);
                $laptop->brand_id = $request->brand_id;
                $laptop->price = $request->price;
                $laptop->sale_price = $request->sale_price;
                $laptop->stock_quantity = $request->stock_quantity;
                $laptop->description = $request->description;
                $laptop->specifications = $request->specifications;
                $laptop->save();
            
                Cache::forget('admin_laptops_index');


                if ($request->hasFile('images')) {
                    foreach ($request->file('images') as $image) {
                        $path = $image->store('laptops', 'public');
                        LaptopImage::create([
                            'laptop_id' => $laptop->id,
                            'image' => $path
                        ]);
                    }
                }
                
                return response()->json([
                    'success' => true,
                    'message' => 'Laptop added successfully.',
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Server Error: ' . $e->getMessage()
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
        $laptop = Laptop::with(['brand', 'images'])->findOrFail($id);
        $brands = Brand::all();
        return view('admin.laptops.edit', [
            'laptop' => $laptop,
            'brands' => $brands,
            'title' => 'Edit Laptop',
            'breadcrumbs' => [
                ['url' => '#', 'label' => 'laptops'],
                ['url' => '#', 'label' => 'Edit laptop'],
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
        $laptop = Laptop::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'brand_id' => 'required|exists:brands,id',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'specifications' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif,svg|max:10240', // max 10MB
        ]);

        try {
            // Update main fields
            $laptop->update([
                'name' => $request->name,
                'brand_id' => $request->brand_id,
                'price' => $request->price,
                'sale_price' => $request->sale_price,
                'stock_quantity' => $request->stock_quantity,
                'description' => $request->description,
                'specifications' => $request->specifications,
                'slug' => Str::slug($request->name),
            ]);

            // Handle image uploads
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('laptops', 'public');

                    LaptopImage::create([
                        'laptop_id' => $laptop->id,
                        'image' => $path,
                    ]);
                }
            }

            Cache::forget('admin_laptops_index');


            return response()->json([
                'success' => true,
                'message' => 'Laptop updated successfully.',
            ]);

        } catch (\Exception $e) {
            Log::error('Laptop Update Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again.',
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
        $laptop = laptop::findOrFail($id);

        try {
            // Optional: Delete image from storage
            if ($laptop->image && Storage::disk('public')->exists($laptop->image)) {
                Storage::disk('public')->delete($laptop->image);
            }
    
            $laptop->delete();

            Cache::forget('admin_laptops_index');

    
            return response()->json([
                'success' => true,
                'message' => 'laptop deleted successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Delete failed: ' . $e->getMessage(),
            ], 500);
        }
    
    }
}
