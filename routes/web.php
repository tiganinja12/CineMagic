<?php

use Illuminate\Support\Facades\Route;
// routes/web.php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ScreeningController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Models\Movie;


use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::view('/', 'home')->name('home');


// Auth routes
    //Login
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    //Register
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::view('/dashboard', 'dashboard')->name('dashboard');


// Movie routes
Route::get('/movies', [MovieController::class, 'index']);
Route::get('/movies/{id}', [MovieController::class, 'show']);
Route::resource('movies', MovieController::class);
Route::get('movies/showcase', [MovieController::class, 'showCase'])->name('movies.showcase')->can('viewShowCase', Movie::class);

// Purchase routes
//Route::post('/purchases', [PurchaseController::class, 'store'])->middleware('auth:sanctum');

// Screening routes
Route::get('/screenings', [ScreeningController::class, 'index']);
Route::get('/screenings/{id}', [ScreeningController::class, 'show']);
Route::resource('screenings', ScreeningController::class);

Route::middleware('can:use-cart')->group(function () {
    // Add a discipline to the cart:
    //Route::post('cart/{discipline}', [CartController::class, 'addToCart'])->name('cart.add');

    // Remove a discipline from the cart:
    //Route::delete('cart/{discipline}', [CartController::class, 'removeFromCart'])->name('cart.remove');

    // Show the cart:
    Route::get('cart', [CartController::class, 'show'])->name('cart.show');

    // Clear the cart:
    Route::delete('cart', [CartController::class, 'destroy'])->name('cart.destroy');
});
