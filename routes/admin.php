<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

// Admin Routes
Route::name('admin.')->group(function(){
        Route::get('add-user', [AdminController::class, 'AddUser'])->name('add-user'); 
    });