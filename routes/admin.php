<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LaptopController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SiteSettingsController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\OrderController;


// Admin Routes
Route::name('admin.')->group(function(){
        Route::get('user/management', [AdminController::class, 'user'])->name('manage-user');
        Route::get('management', [AdminController::class, 'admin'])->name('manage-admin');

        Route::get('faq/add', [FaqController::class, 'create'])->name('add-faqs');
        Route::get('faqs', [FaqController::class, 'index'])->name('faqs');
        Route::get('faq/edit/{faq}', [FaqController::class, 'edit'])->name('faq.edit');
        Route::post('faq/store', [FaqController::class, 'store'])->name('faq.store');
        Route::put('faq/update/{faq}', [FaqController::class, 'update'])->name('faq.update');
        Route::delete('faq/delete/{faq}', [FaqController::class, 'destroy'])->name('faq.delete');

        Route::resource('brand', BrandController::class);
        Route::resource('order', OrderController::class);
        Route::resource('laptop', LaptopController::class);
        Route::resource('site-settings', SiteSettingsController::class);

    });