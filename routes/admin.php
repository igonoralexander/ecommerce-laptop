<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PhotoController;
use App\Http\Livewire\Admin\MediaNewCategory;

// Admin Routes
Route::name('admin.')->group(function(){
        Route::get('users/management', [AdminController::class, 'users'])->name('add-user');
        Route::get('media/category-list', [CategoryController::class, 'index'])->name('media-category-list'); 
        
        Route::get('add/images', [PhotoController::class, 'index'])->name('add-images');
        Route::post('images', [PhotoController::class, 'store'])->name('photo.store');


    });