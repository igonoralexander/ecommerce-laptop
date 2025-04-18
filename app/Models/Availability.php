<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    use HasFactory;

    protected $fillable = ['photographer_id', 'date', 'start_time', 'end_time'];

    public function user()
    {
        return $this->belongsTo(User::class, 'photographer_id', 'id');
    }
}
