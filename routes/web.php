<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [BlogController::class, 'index']);

Route::get('posts/{post:slug}', function (Post $post) {
    return view('post', ['post' => $post]);
});

Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/login', [AuthController::class, 'doLogin']) ;
Route::delete('/logout', [AuthController::class, 'logout'])->name('auth.logout') ;

Route::get('categories/{category:slug}', function (Category $category) {
    return view('posts', ['posts' => $category->posts, 'categories' => Category::all(), 'currentCategory' => $category]);
});

Route::prefix('/blog')->name('blog.')->controller(BlogController::class)->group(function () {

    Route::get('', 'index')->name('index');

    Route::get('/new', 'create')->name('create')->middleware('auth');

    Route::post('/new', 'store');

    Route::get('/{post}/edit', 'edit')->name('edit')->middleware('auth');

    Route::post('/{post}/edit', 'update')->name('update');

    Route::get('/{slug}-{post}', 'show')->where([
        'slug' => '[a-z0-9\-]+',
        'post' => '[0-9]+'
    ])->name('show');
});



