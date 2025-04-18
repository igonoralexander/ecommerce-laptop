<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'guest_email', 'guest_name', 'guest_phone_number', 'guest_address', 'total_price',
        'order_notes', 'status'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
