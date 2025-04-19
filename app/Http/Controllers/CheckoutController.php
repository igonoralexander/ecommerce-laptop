<?php

namespace App\Http\Controllers;

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

            // Calculate total from cart
            $cartItems = session('cart', []);
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
            session()->forget('cart');

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


}
