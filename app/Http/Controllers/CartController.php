<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Laptop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    //
    public function add(Request $request)
    {
    
        try {
            $product = $request->input('product');
            $laptopId = $product['laptop_id'];
            $quantity = $product['quantity'];

            if (Auth::check()) {
                $user = Auth::user();
                

                // Get or create user's cart
                $cart = Cart::firstOrCreate([
                    'user_id' => $user->id,
                    'status' => 'active',
                ]);

                $cartItem = CartItem::where('cart_id', $cart->id)
                    ->where('laptop_id', $laptopId)
                    ->first();

                if ($cartItem) {
                    $cartItem->quantity += $quantity;
                    $cartItem->save();
                } else {
                    CartItem::create([
                        'user_id' => $user->id,
                        'cart_id' => $cart->id,
                        'laptop_id' => $laptopId,
                        'quantity' => $quantity,
                        'sale_price' => $product['sale_price'],
                    ]);
                }

                $cartItems = $this->getUserCartArray($user->id);
            } else {

                $cart = session()->get('cart', []);
                $product = $request->input('product');

                // Update quantity if exists
                if (isset($cart[$product['laptop_id']])) {
                    $cart[$product['laptop_id']]['quantity'] += $product['quantity'];
                } else {
                    $cart[$product['laptop_id']] = $product;
                }

                session()->put('cart', $cart);
                $cartItems = $cart;
            }
                // Render just the cart items partial
                $cartHtml = view('layouts.frontend.inc.cart-items', [
                    'cartItems' => $cartItems
                ])->render();

                // Calculate cart subtotal
                $subtotal = collect($cartItems)->sum(function ($item) {
                    return $item['sale_price'] * $item['quantity'];
                });

                return response()->json([
                    'cart_html' => $cartHtml,
                    'cart_count' => count($cartItems),
                    'cart_subtotal' => number_format($subtotal, 2)
                ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong while adding to cart!'
            ], 500);
        }
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

        $cart = Cart::where('user_id', Auth::id())
            ->where('status', 'active')
            ->first();

        if (Auth::check()) {
            $cartItem = CartItem::where('cart_id', $cart->id)
                ->where('laptop_id', $laptop_id)
                ->first();

            if ($cartItem) {
                $cartItem->quantity = $newQuantity;
                $cartItem->save();
            }

            $cartItems = $this->getUserCartArray(Auth::id());
        } else {

            $cart = session()->get('cart', []);

            // If the product exists, update quantity.
            if(isset($cart[$laptop_id])){
                $cart[$laptop_id]['quantity'] = $newQuantity;
            }

            session()->put('cart', $cart);
            $cartItems = $cart;
        }

        // Re-render the cart partial and recalc totals.
        $cartHtml = view('layouts.frontend.inc.cart-items', [
            'cartItems' => $cartItems
            ])->render();

        $subtotal = collect($cartItems)->sum(function ($item) {
            return $item['sale_price'] * $item['quantity'];
        });

        return response()->json([
            'cart_html' => $cartHtml,
            'cart_count' => count($cartItems),
            'cart_subtotal' => number_format($subtotal, 2)
        ]);
    }

    public function remove(Request $request)
    {   
        try {
            // We'll assume that the product key used in the cart is the laptop_id.
            $laptop_id = $request->input('index');

            if (Auth::check()) {

                $user = Auth::user();

                $cart = Cart::where('user_id', $user->id)
                    ->where('status', 'active')
                    ->first();
                    
                CartItem::where('cart_id', $cart->id)
                    ->where('laptop_id', $laptop_id)
                    ->delete();

                $cartItems = $this->getUserCartArray(Auth::id());
                
            } else {

                $cart = session()->get('cart', []);

                if(isset($cart[$laptop_id])){
                    unset($cart[$laptop_id]);
                }
                session()->put('cart', $cart);
                $cartItems = $cart;

            }

            $cartHtml = view('layouts.frontend.inc.cart-items', [
                'cartItems' => $cartItems
                ])->render();

            $subtotal = collect($cartItems)->sum(function ($item) {
                return $item['sale_price'] * $item['quantity'];
            });

            return response()->json([
                'cart_html' => $cartHtml,
                'cart_count' => count($cartItems),
                'cart_subtotal' => number_format($subtotal, 2)
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong while removing item from cart!'
            ], 500);
        }
    }

    private function getUserCartArray($userId)
    {

        $cart = Cart::where('user_id', $userId)
            ->where('status', 'active')
            ->first();

        if (!$cart) {
            return [];
        }


        return CartItem::with('laptop')
            ->where('cart_id', $cart->id)
            ->get()
            ->mapWithKeys(function ($item) {
                return [
                    $item->laptop_id => [
                        'id' => $item->laptop_id,
                        'name' => $item->laptop->title,
                        'quantity' => $item->quantity,
                        'sale_price' => $item->sale_price,
                        'image' => $item->laptop->main_image,
                    ]
                ];
            })->toArray();
    }

}
