<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Laptop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontEndController extends Controller
{
    //
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
}
