<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = ['cart_id', 'laptop_id', 'quantity', 'sale_price'];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function laptop()
    {
        return $this->belongsTo(Laptop::class);
    }
}
