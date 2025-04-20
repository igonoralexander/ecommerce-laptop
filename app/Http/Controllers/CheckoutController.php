<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{

    public function placeOrder(Request $request)
    {
        $isGuest = !Auth::check();

        $rules = [
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'email'         => 'required|email',
            'phone_number'  => 'required|string|max:20',
            'address'       => 'required|string|max:255',
        ];

        $request->validate($rules);

        try {
            DB::beginTransaction();

            // Create the order
            $order = new Order();

            if ($isGuest) {
                $order->guest_name  = $request->first_name . ' ' . $request->last_name;
                $order->guest_email = $request->email;
                $order->guest_phone_number = $request->phone_number;
                $order->address = $request->address;
            } else {
                $order->user_id = Auth::id();
                $order->address = $request->address;
            }

            $order->order_notes = $request->order_notes ?? null;
            $order->status = 'pending';

            // Get cart items
            $cartItems = $isGuest
            ? session('cart', [])
            : $this->getUserCartArray(Auth::id());
           
            $order->total_price = str_replace(',', '', $request->total_price);


            $order->save();

            // Save each item into order_items table
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'laptop_id' => $item['laptop_id'], // assuming this exists in the cart session
                    'quantity' => $item['quantity'],
                    'price' => $item['sale_price'],
                    'subtotal' => $request->subtotal
                ]);
            }

            // Clear cart
            if ($isGuest) {
                session()->forget('cart');
            } else {
                // Delete cart items and cart from DB
                $cart = Cart::where('user_id', Auth::id())->where('status', 'active')->first();
                if ($cart) {
                    CartItem::where('cart_id', $cart->id)->delete();
                    $cart->delete();
                }
            }

            DB::commit();

            // Store the thank you name in the session
            if (Auth::check()) {
                session(['thankyou_name' => Auth::user()->first_name . ' ' . Auth::user()->last_name]);
            } else {
                session(['thankyou_name' => $request->first_name . ' ' . $request->last_name]);
            }

            return response()->json([
                'message' => 'Order placed successfully!',
                'redirect_url' => route('thank.you'),
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Something went wrong: ' . $e->getMessage(),
            ], 500);
        }
    }


    public function thankYou()
    {
        $thankyou_name = session('thankyou_name'); // pull name from session
        // $contact = Contact::first(); // optional contact details

        return view('frontend.pages.thankyou', compact('thankyou_name'));
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
                        'laptop_id' => $item->laptop_id,
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
