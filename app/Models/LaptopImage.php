<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaptopImage extends Model
{
    use HasFactory;

    protected $fillable = ['laptop_id', 'image'];

    public function laptop()
    {
        return $this->belongsTo(Laptop::class, 'laptop_id');
    }

}
