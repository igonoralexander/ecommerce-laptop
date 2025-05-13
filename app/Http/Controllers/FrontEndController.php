<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Laptop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class FrontEndController extends Controller
{
    //

    public function homepage()
    {
        $featuredProduct = Cache::remember('homepage.featuredProduct', now()->addMinutes(10), function () {
            return Laptop::with('images')->skip(1)->first();
        });
    
        $trendingLaptops = Cache::remember('homepage.trendingLaptops', now()->addMinutes(10), function () {
            return Laptop::trending()->get();
        });
    
        $hotDeals = Cache::remember('homepage.hotDeals', now()->addMinutes(10), function () {
            return Laptop::hotDeals()->get();
        });
    
        $latestLaptops = Cache::remember('homepage.latestLaptops', now()->addMinutes(10), function () {
            return Laptop::latest()->get();
        });
    
        $bestSellers = Cache::remember('homepage.bestSellers', now()->addMinutes(10), function () {
            return Laptop::bestSellers()->get();
        });

        return view('frontend.index', [
            'featuredProduct' => $featuredProduct,
            'trendingLaptops' => $trendingLaptops,
            'hotDeals' => $hotDeals,
            'latestLaptops' => $latestLaptops,
            'bestSellers' => $bestSellers
        ]);
        
    }

    public function checkout()
    {
        if (Auth::check()) {
            $user = Auth::user();
    
            // Get user cart items
            $cart = Cart::where('user_id', $user->id)->where('status', 'active')->first();
            $cartItems = [];
            if ($cart) {
                $cartItems = CartItem::with('laptop')
                    ->where('cart_id', $cart->id)
                    ->get()
                    ->map(function ($item) {
                        return [
                            'id' => $item->laptop_id,
                            'name' => $item->laptop->title,
                            'image' => $item->laptop->main_image,
                            'quantity' => $item->quantity,
                            'sale_price' => $item->sale_price,
                            'subtotal' => $item->quantity * $item->sale_price,
                        ];
                    });
        }

        return view('frontend.pages.checkout', [
            'cartItems' => $cartItems,
            'user' => $user
        ]);

        } else {
            // Guest cart
            $sessionCart = session()->get('cart', []);
            $cartItems = [];

            foreach ($sessionCart as $item) {
                $cartItems[] = [
                    'id' => $item['laptop_id'], 
                    'name' => $item['name'],
                    'image' => $item['image'],
                    'quantity' => $item['quantity'],
                    'sale_price' => $item['sale_price'],
                    'subtotal' => $item['quantity'] * $item['sale_price'],
                ];
            }

            $cartSubtotal = collect($cartItems)->sum('subtotal');

                return view('frontend.pages.checkout', [
                    'cartItems' => $cartItems,
                    'cartSubtotal' => $cartSubtotal,
                    'user' => null
                ]);
        }
    }

    public function contact()
    {
        return view('frontend.pages.contact');
    }
}
