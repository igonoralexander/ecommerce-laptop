<?php

namespace App\Http\Controllers;

use App\Models\Laptop;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    //
    public function checkout()
    {
        $products = Laptop::with(['brand', 'images'])->latest()->get();
        return view('frontend.pages.checkout', compact('products'));
    }
}
