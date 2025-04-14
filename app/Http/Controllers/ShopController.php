<?php

namespace App\Http\Controllers;

use App\Models\Laptop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    //
    public function ShopProducts()
    {
        $products = Laptop::with(['brand', 'images'])->latest()->get();
        return view('frontend.pages.product-shop', compact('products'));
    }
}
