<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if (!is_null(Auth::user())) {
        return redirect('home');    
    }
    return view('auth.login');
});

Auth::routes();

Route::middleware(['auth'])->group(function ($route) {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    $route->group(['prefix' => 'register-user'], function ($route) {
        Route::get('/', [App\Http\Controllers\UserController::class, 'create']);
        Route::get('{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
        Route::post('/', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');
        Route::put('{id}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
    });
    Route::get('/pokemon/{id}', [App\Http\Controllers\HomeController::class, 'show'])->name('pokemon');
    Route::get('/pokemon-favorite/{id}', [App\Http\Controllers\HomeController::class, 'setFavorite'])->name('pokemon.favorite');
});