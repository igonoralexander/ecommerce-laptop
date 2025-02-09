<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;

class Blog extends Model
{
    protected $fillable =
    [
    'imgBlog',   
    'title',
    'contents',
    ];

    use HasFactory;
}
