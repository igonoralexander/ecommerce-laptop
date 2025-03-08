<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id', 'testimonial', 'rating'
    ];

    public function client()
    {
        return $this->belongsTo(User::class,  'client_id', 'id');
    }
}
