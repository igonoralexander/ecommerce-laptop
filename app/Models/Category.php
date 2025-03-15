<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use MicrosoftAzure\Storage\Blob\Models\GetBlobOptions;
use MicrosoftAzure\Storage\Common\Exceptions\ServiceException;


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

    public function getImageUrl()
    {
        $container = env('AZURE_STORAGE_CONTAINER');
        $connectionString = env('AZURE_STORAGE_CONNECTION_STRING');

        if (!$this->image) {
            return null; // No image uploaded
        }

        // Create Blob Client
        $blobClient = BlobRestProxy::createBlobService($connectionString);
        
        // Generate a SAS token (Valid for 1 hour)
        $sasToken = env('AZURE_STORAGE_SAS_TOKEN'); // Store in .env
        return "{$this->image}?{$sasToken}";
    }

    public function media()
    {
        return $this->hasMany(UploadMedia::class, 'category_id', 'id');
    }

    public function packages()
    {
        return $this->hasMany(Package::class, 'category_id', 'id');
    }

}
