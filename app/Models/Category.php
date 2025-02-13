<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\UploadMedia;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable =
    [
        'name',
        'image',
    ];

    public function media()
    {
        return $this->hasMany(UploadMedia::class, 'category_id', 'id');
    }
}
