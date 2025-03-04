<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
Use Iilluminate\view;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\VideoController;

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
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// In web.php
Route::post('/check-email', [RegisteredUserController::class, 'checkEmail']);
Route::post('/login-checkEmail', [RegisteredUserController::class, 'loginCheckEmail']);


Route::delete('/gallery/delete/{id}', [AdminController::class, 'deleteMedia']);
Route::get('/gallery/search', [AdminController::class, 'searchGallery'])->name('gallery.search');
Route::get('/gallery/load', [AdminController::class, 'loadMoreMedia'])->name('gallery.load');


Route::post('/admin/video/upload-chunk', [VideoController::class, 'uploadChunk'])->name('admin.video.upload.chunk');

Route::get('/share/media/{id}', function ($id) {
    $media = \App\Models\UploadMedia::findOrFail($id);
    $fileUrl = Storage::url($media->file_url); // Get the storage URL

    return Response::redirectTo($fileUrl); // Redirect to actual file
})->name('media.share');


Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth'])->name('admin.dashboard');

require __DIR__.'/auth.php';
