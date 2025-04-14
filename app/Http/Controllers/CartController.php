<?php

namespace App\Http\Controllers;

use App\Models\Laptop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    //
    public function add(Request $request)
    {
        $cart = session()->get('cart', []);
        $product = $request->input('product');

        // Update quantity if exists
        if (isset($cart[$product['laptop_id']])) {
            $cart[$product['laptop_id']]['quantity'] += $product['quantity'];
        } else {
            $cart[$product['laptop_id']] = $product;
        }

        session()->put('cart', $cart);

        // Render just the cart items partial
        $cartHtml = view('layouts.frontend.inc.cart-items', [
            'cartItems' => $cart
        ])->render();

        // Calculate cart subtotal
        $subtotal = collect($cart)->sum(function ($item) {
            return $item['sale_price'] * $item['quantity'];
        });

        return response()->json([
            'cart_html' => $cartHtml,
            'cart_count' => count($cart),
            'cart_subtotal' => number_format($subtotal, 2)
        ]);
    }

    public function quickAdd(Request $request)
    {
        $product = Laptop::with('images')->findOrFail($request->product_id);
        return view('components.quick-add-modal', compact('product'))->render();
    }

    public function updateQuantity(Request $request)
    {
        // Assuming "index" is the product key in the session cart (here, we use laptop_id as key).
        $laptop_id = $request->input('index');
        $newQuantity = $request->input('quantity');

        $cart = session()->get('cart', []);

        // If the product exists, update quantity.
        if(isset($cart[$laptop_id])){
            $cart[$laptop_id]['quantity'] = $newQuantity;
        }

        session()->put('cart', $cart);

        // Re-render the cart partial and recalc totals.
        $cartHtml = view('layouts.frontend.inc.cart-items', ['cartItems' => $cart])->render();
        $subtotal = collect($cart)->sum(function ($item) {
            return $item['sale_price'] * $item['quantity'];
        });

        return response()->json([
            'cart_html' => $cartHtml,
            'cart_count' => count($cart),
            'cart_subtotal' => number_format($subtotal, 2)
        ]);
    }

    public function remove(Request $request)
    {   
        // We'll assume that the product key used in the cart is the laptop_id.
        $laptop_id = $request->input('index'); // "index" here is the laptop_id of the product.
        $cart = session()->get('cart', []);

        if(isset($cart[$laptop_id])){
            unset($cart[$laptop_id]);
        }
        session()->put('cart', $cart);

        $cartHtml = view('layouts.frontend.inc.cart-items', ['cartItems' => $cart])->render();
        $subtotal = collect($cart)->sum(function ($item) {
            return $item['sale_price'] * $item['quantity'];
        });

        return response()->json([
            'cart_html' => $cartHtml,
            'cart_count' => count($cart),
            'cart_subtotal' => number_format($subtotal, 2)
        ]);
    }



}
