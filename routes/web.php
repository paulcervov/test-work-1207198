<?php

use App\Http\Controllers\Home\IndexController;
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

    });

});
