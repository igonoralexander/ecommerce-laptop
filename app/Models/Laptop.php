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
    
    public function scopeTrending($query)
    {
        return $query->where('is_trending', true);
    }

    public function scopeHotDeals($query)
    {
        return $query->where('is_hot_deal', true);
    }

    public function scopeLatest($query)
    {
        return $query->latest()->take(8);
    }

    public function scopeBestSellers($query)
    {
        return $query->withCount('orderItems')->orderByDesc('order_items_count')->take(8);
    }

}
