<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LaptopController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\BookingsController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PhotoController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\SiteSettingsController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\PackagesController;
use App\Models\Faq;

// Admin Routes
Route::name('admin.')->group(function(){
        Route::get('user/management', [AdminController::class, 'user'])->name('manage-user');
        Route::get('management', [AdminController::class, 'admin'])->name('manage-admin');

        Route::get('/gallery/management', [AdminController::class, 'gallery'])->name('gallery-management');
        
        
        Route::get('media/category-list', [CategoryController::class, 'index'])->name('media-category-list'); 
        
        Route::get('images/add', [PhotoController::class, 'index'])->name('add-images');
        Route::post('images', [PhotoController::class, 'store'])->name('photo.store');

        Route::get('faq/add', [FaqController::class, 'create'])->name('add-faqs');
        Route::get('faqs', [FaqController::class, 'index'])->name('faqs');
        Route::get('faq/edit/{faq}', [FaqController::class, 'edit'])->name('faq.edit');
        Route::post('faq/store', [FaqController::class, 'store'])->name('faq.store');
        Route::put('faq/update/{faq}', [FaqController::class, 'update'])->name('faq.update');
        Route::delete('faq/delete/{faq}', [FaqController::class, 'destroy'])->name('faq.delete');

        Route::get('add/videos', [VideoController::class, 'index'])->name('add-videos');
        Route::post('videos', [VideoController::class, 'store'])->name('video.store');


        Route::resource('brand', BrandController::class);
        Route::resource('laptop', LaptopController::class);
        Route::resource('site-settings', SiteSettingsController::class);

    });