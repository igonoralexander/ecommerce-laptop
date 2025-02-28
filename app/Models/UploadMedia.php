<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class UploadMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_url',
        'download_url',
        'title',
        'file_name',
        'media_type',
        'user_id',
        'category_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
