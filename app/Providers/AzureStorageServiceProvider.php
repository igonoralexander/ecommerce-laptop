<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;
use App\Services\AzureBlobStorage;
use Illuminate\Support\Facades\Storage;

class AzureStorageServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Storage::extend('azure', function ($app, $config) {
            return new Filesystem(new AzureBlobStorage($config));
        });
    }
}