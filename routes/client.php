<?php

use App\Http\Controllers\Client\BookingsController;
use App\Http\Controllers\Client\ProfileManagementController;
use Illuminate\Support\Facades\Route;

// Everything here will be prefixed with the dynamic user slug

Route::name('client.')->prefix('{user_prefix}')->group(function () {
    Route::get('/profile/management', [ProfileManagementController::class, 'ProfileManagement'])->name('management');
    Route::get('/change/password', [ProfileManagementController::class, 'ChangePassword'])->name('change-password');

    Route::resource('bookings', BookingsController::class); 
});