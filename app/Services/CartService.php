<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class CartService
{
    public function getOrCreateCart()
    {
        if (Auth::check()) {
            return Cart::firstOrCreate([
                'user_id' => Auth::id(),
                'status' => 'active',
            ]);
        }

        $guestToken = Session::get('guest_token');

        if (!$guestToken) {
            $guestToken = Str::uuid();
            Session::put('guest_token', $guestToken);
        }

        return Cart::firstOrCreate([
            'guest_token' => $guestToken,
            'status' => 'active',
        ]);
    }

    public function addItem($laptopId, $quantity, $price)
    {
        $cart = $this->getOrCreateCart();

        $existingItem = $cart->items()->where('laptop_id', $laptopId)->first();

        if ($existingItem) {
            $existingItem->increment('quantity', $quantity);
        } else {
            $cart->items()->create([
                'laptop_id' => $laptopId,
                'quantity' => $quantity,
                'sale_price' => $price,
            ]);
        }
    }

    public function getCartItems()
    {
        return $this->getOrCreateCart()->items()->with('laptop')->get();
    }

    public function getCartSubtotal()
    {
        return $this->getCartItems()->sum(function ($item) {
            return $item->sale_price * $item->quantity;
        });
    }
}
