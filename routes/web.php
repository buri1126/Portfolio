<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FollowerController;

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



Route::controller(PostController::class)->middleware(['auth'])->group(function(){
    Route::get('/', 'index')->name('index');
    Route::post('/posts', 'store')->name('store');
    Route::get('/posts/create', 'create')->name('create');
    Route::get('/posts/like/{id}','like')->name('like');
    Route::get('/posts/unlike/{id}','unlike')->name('unlike');
    Route::get('/posts/{post}', 'show')->name('show');
    Route::put('/posts/{post}', 'update')->name('update');
    Route::delete('/posts/{post}', 'delete')->name('delete');
    Route::get('/posts/{post}/edit', 'edit')->name('edit');
    
   
});

Route::get('/categories/{category}', [CategoryController::class,'index']);

Route::controller(UserController::class)->middleware(['auth'])->group(function(){
    Route::get('/users/{user}/edit','edit')->name('edit');  
    Route::get('/users/{user}','profile')->name('profile');
    Route::put('/users/{user}','update')->name('update');
});

Route::get('/teams/{team}', [TeamController::class,'index']);

Route::delete('/posts/comments/{comment}', [CommentController::class,'delete']);
Route::get('/posts/{post}/comments',[CommentController::class,'index']);
Route::post('/posts/{post}/comments',[CommentController::class,'comment']);

Route::get('/users/{user}/follow', [FollowerController::class,'follow']);
Route::get('/users/{user}/unfollow', [FollowerController::class,'unfollow']);



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




require __DIR__.'/auth.php';
