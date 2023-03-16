<?php

use App\Models\Post;
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

Route::get('/', function () {
    return view('posts', ['posts' => Post::all()]);
});

Route::get('posts/{post:slug}', function (Post $post) {
    var_dump($post->category());
    return view('test/welcome', ['post' => $post]);
})/*->where('post:slug', '[a-zA-Z-]+')*/
;
