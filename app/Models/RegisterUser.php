<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterUser extends Model
{
    protected $fillable =
    [
        'username',
        'email',
        'password',
        
    ];
    use HasFactory;
}
