<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Photo;
use App\Models\Image;
use App\Models\Video;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable =
    [
        'name',
        'image',
    ];

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
    public function videos()
    {
        return $this->hasMany(Video::class);
    }
}
