<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Category;

class Video extends Model
{
    protected $table = 'videos';

    protected $fillable = [
        'cate_id',
        'title',
        'slug',
        'vid',
    ];
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class, 'cate_id', 'id');
    }
}
