<?php

namespace App\Http\Controllers;

use App\Models\Laptop;
use App\Models\ProductView;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ShopController extends Controller
{
    //
    public function ShopProducts()
    {
        $products = Laptop::with(['brand', 'images'])->latest()->paginate(12);
        return view('frontend.pages.product-shop', compact('products'));
    }

    public function productDetail($slug)
    {
        $product = Laptop::with(['brand', 'images'])->where('slug', $slug)->firstOrFail();

        // Track Product View
        $sessionId = Session::getId();
        $userId = Auth::check() ? Auth::id() : null;

        // Avoid duplicate view (e.g., multiple refreshes in same session)
        $existingView = ProductView::where('laptop_id', $product->id)
            ->where(function ($query) use ($userId, $sessionId) {
                if ($userId) {
                    $query->where('user_id', $userId);
                } else {
                    $query->where('session_id', $sessionId);
                }
            })
            ->first();

        if (!$existingView) {
            ProductView::create([
                'laptop_id' => $product->id,
                'user_id' => $userId,
                'session_id' => $userId ? null : $sessionId,
            ]);
        }

        // Recently viewed
        $recentlyViewed = ProductView::where(function ($query) use ($userId, $sessionId) {
                if ($userId) {
                    $query->where('user_id', $userId);
                } else {
                    $query->where('session_id', $sessionId);
                }
            })
            ->orderByDesc('created_at')
            ->with(['laptop.brand', 'laptop.images'])
            ->limit(6)
            ->get()
            ->map(function ($view) {
                return $view->laptop;
            });

        // Related Products (same brand)
        $relatedProducts = Laptop::where('brand_id', $product->brand_id)
            ->where('id', '!=', $product->id)
            ->with(['images', 'brand'])
            ->latest()
            ->take(4)
            ->get();

        return view('frontend.pages.product-detail', compact('product', 'relatedProducts', 'recentlyViewed'));
    }

}
