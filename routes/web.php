<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;

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

Route::get('/', function () { return view('auth.login');})->name('login');
Route::get('/todo', function () { return view('todo');});
Route::get('/user/email', [PostController::class, 'runEmailCommand']);

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' =>'admin'], function(){
    Route::get('/users', [AdminController::class, 'index'])->name('users');
});

Route::group(['middleware' =>'auth'], function(){
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/posts', [PostController::class, 'index'])->name('all-posts');
    Route::get('/add-post', [PostController::class, 'create'])->name('add_post');
    Route::post('/add-post-create', [PostController::class, 'store']);
    Route::get('/edit-post/{id}', [PostController::class, 'edit'])->name('edit_post');
    Route::post('/update-post', [PostController::class, 'update']);
    Route::post('/delete-post', [PostController::class, 'destroy']);
    Route::get('/posts/{id?}', [PostController::class, 'show'])->name('view_post');
});


