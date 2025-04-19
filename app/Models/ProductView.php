<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductView extends Model
{
    use HasFactory;

    protected $fillable = [
        'laptop_id', 'user_id', 'session_id'
    ];

    public function laptop()
    {
        return $this->belongsTo(Laptop::class);
    }

}
