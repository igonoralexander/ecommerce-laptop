<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laptop extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id', 'name', 'description', 'specifications', 'price', 'sale_price',
        'stock_quantity'
    ];

    
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function images()
    {
        return $this->hasMany(LaptopImage::class);
    }

}
