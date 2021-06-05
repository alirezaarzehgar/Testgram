<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostActionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])
    ->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/{username}', ProfileController::class)->name('profile');

    Route::resource('account', AccountController::class);
    Route::resource('post', PostController::class);
    Route::post('post/{id}/comment', [PostController::class, 'storeComment'])->name('post.comment.store');
    Route::post('post/{id}/like', [PostController::class, 'storeLike'])->name('post.like.store');
    Route::post('/{username}/follow', [UserController::class, 'follow'])->name('user.follow');
});
