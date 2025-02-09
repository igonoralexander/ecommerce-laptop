<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;

use App\Models\Category;

class Photo extends Model
{
    protected $table = 'photos';

    protected $guarded = [];

    protected $fillable =
    [
        'cate_id',
        'img',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'cate_id', 'id');
    }
}
