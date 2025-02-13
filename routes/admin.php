<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MediaManageCategory;
use App\Http\Livewire\Admin\MediaNewCategory;

// Admin Routes
Route::name('admin.')->group(function(){
        Route::get('add-user', [AdminController::class, 'AddUser'])->name('add-user');
        Route::get('media/category-list', [CategoryController::class, 'index'])->name('media-category-list'); 

    });