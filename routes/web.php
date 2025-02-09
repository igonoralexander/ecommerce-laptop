<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\EmailController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\CategoryController;

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

    if (session::has('AdmLogId'))
    {
        Session::pull('AdmLogId');
        $category = App\Models\Category::All();
        return view('welcome', compact('category'));
    }
    else
    {
        $category = App\Models\Category::All();
        return view('welcome', compact('category'));
    }
});


Route::get('/ourservices.php', function () {

    if (session::has('AdmLogId'))
    {
        Session::pull('AdmLogId');
        $category = App\Models\Category::All();
        return view('pages.ourservices', compact('category'));
    }
    else
    {
        $category = App\Models\Category::All();
        return view('pages.ourservices', compact('category'));
    }
});

Route::get('/aboutus.php', function () {
    
    if (session::has('AdmLogId'))
    {
        Session::pull('AdmLogId');
        $category = App\Models\Category::All();
        return view('pages.aboutus', compact('category'));
    }
    
    else
    {
        $category = App\Models\Category::All();
        return view('pages.aboutus', compact('category'));
    }
    
});

Route::get('/blog.php', function () {
    if (session::has('AdmLogId'))
    {
        Session::pull('AdmLogId');
        $blogs = App\Models\Blog::All();
        return view('pages.blog', compact('blogs') );
    }

    else
    {
        $blogs = App\Models\Blog::orderBy('id', 'DESC')->paginate(10);
        return view('pages.blog', compact('blogs') );
    }
    
   
});

// Route::get('/testimonial.php', function () {
//     return view('pages.testimonial');
// });


Route::get('/ourcontact.php', [EmailController::class, 'create']);
Route::post('/sendemail', [EmailController::class, 'sendEmail']) -> name('send.email');

Route::get('/addphotos.php', [PhotoController::class, 'create']);
Route::post('/storeimg.php', [PhotoController::class, 'storePhoto']) -> name('store.photo');

Route::get('/createblog.php', [BlogController::class, 'create']);

Route::get('/manageblogs.php', [BlogController::class, 'manageBlog']);

Route::post('/newposts.php', [BlogController::class, 'storeBlogPosts']) -> name('store.blogposts');

Route::get('/blogs/{blogs}', [BlogController::class, 'showBlog']);

    Route::put('/blogs/{blogs}', [BlogController::class, 'update'])->name('blogs.update');

    Route::delete('/blogs/{blogs}', [BlogController::class, 'destroy'])-> name('blogs.delete');

    Route::get('blogs/{blogs}/edit', [BlogController::class, 'edit'])-> name('blogs.edit');



Route::get('/photo-category/{id}', [PhotoController::class, 'displayPhoto'])->name('photo-gallery');

Route::get('/video-category/{id}', [VideoController::class, 'show'])->name('video-gallery');

Route::post('/storevideo.php', [VideoController::class, 'store']) -> name('video.store');


Route::get('/addcategory.php', [CategoryController::class, 'index']);

Route::get('/viewallcategories.php', [CategoryController::class, 'show']);

Route::post('/savecategory.php', [CategoryController::class, 'store'])->name ('add-category');

Route::put('/category/{category}', [CategoryController::class, 'update'])->name('categories.update');

Route::delete('/category/{category}', [CategoryController::class, 'destroy'])-> name('categories.delete');

Route::get('category/{category}/edit', [CategoryController::class, 'edit'])-> name('categories.edit');


Route::get('/admin.php', [AdminController::class, 'index'])->middleware('AdloggedIn');
Route::post('/admaccess.php', [AdminController::class, 'store'])->name('admin-login');
Route::get('/dashboard.php', [AdminController::class, 'dashboard'])->middleware('isAdLoggedIn');
Route::get('/adminlogout', [AdminController::class, 'logout']);

Route::get('/login.php', [RegisterUserController::class, 'login'])->middleware('loggedIn');
Route::get('/register.php', [RegisterUserController::class, 'registration'])->middleware('loggedIn');
Route::post('/registeruser', [RegisterUserController::class, 'registeruser']) ->name('register-user');
Route::post('/loginuser', [RegisterUserController::class, 'loginuser']) ->name('login-user');
Route::get('/userdashboard.php', [RegisterUserController::class, 'userdashboard'])->middleware('isLoggedIn');
Route::get('/logout', [RegisterUserController::class, 'logout']);