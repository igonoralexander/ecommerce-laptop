<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $table = 'brands';

    protected $fillable =
    [
        'name',
        'slug',
        'description',
        'image',
    ];

    public function laptops()
    {
        return $this->hasMany(Laptop::class, 'laptop_id');
    }

}
