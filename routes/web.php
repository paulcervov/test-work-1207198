<?php

use App\Http\Controllers\Home\CategoryController;
use App\Http\Controllers\Home\IndexController;
use App\Http\Controllers\Home\PostController;
use App\Http\Controllers\Home\RoleController;
use App\Http\Controllers\Home\UserController;
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
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->prefix('home')->group(function () {

    Route::get('/', [IndexController::class, 'index'])->name('home.index');

    Route::name('home.')->group(function () {

        Route::patch('users/{user}/restore', [UserController::class, 'restore'])->name('users.restore');
        Route::resource('users', UserController::class)->except('show');

        Route::patch('posts/{post}/restore', [PostController::class, 'restore'])->name('posts.restore');
        Route::resource('posts', PostController::class)->except('show');

        Route::patch('categories/{category}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
        Route::resource('categories', CategoryController::class)->except('show');
    });
});
