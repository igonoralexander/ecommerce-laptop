<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PhotoController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Livewire\Admin\MediaNewCategory;

// Admin Routes
Route::name('admin.')->group(function(){
        Route::get('user/management', [AdminController::class, 'user'])->name('manage-user');
        Route::get('management', [AdminController::class, 'admin'])->name('manage-admin');

        Route::get('/gallery/images/management', [AdminController::class, 'images'])->name('images-management');
        Route::get('/gallery/videos/management', [AdminController::class, 'videos'])->name('videos-management');
        
        Route::get('media/category-list', [CategoryController::class, 'index'])->name('media-category-list'); 
        
        Route::get('add/images', [PhotoController::class, 'index'])->name('add-images');
        Route::post('images', [PhotoController::class, 'store'])->name('photo.store');

        Route::get('add/videos', [VideoController::class, 'index'])->name('add-videos');
        Route::post('videos', [VideoController::class, 'store'])->name('video.store');


    });