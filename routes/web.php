<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
Use Iilluminate\view;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\ShopController;
use App\Models\Package;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('frontend.index');
});

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.dashboard');


Route::middleware(['auth', 'dynamic.user.prefix'])->group(function () {
        
    Route::get('/{user_prefix}/dashboard', function () {
            return view('dashboard');
        })->name('user.dashboard');
        
        require base_path('routes/client.php');
    });

// In web.php
Route::post('/check-email', [RegisteredUserController::class, 'checkEmail']);
Route::post('/login-checkEmail', [RegisteredUserController::class, 'loginCheckEmail']);

//Shopping Route

Route::get('/shop', [ShopController::class, 'ShopProducts'])->name('shop');

Route::get('/checkout', [FrontEndController::class, 'checkout'])->name('checkout');


Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.placeOrder');

Route::get('/thank-you', [CheckoutController::class, 'thankYou'])->name('thank.you');

Route::get('/modal/quick-add', [CartController::class, 'quickAdd'])->name('modal.quick.add');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.update.quantity');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');


require __DIR__.'/auth.php';
