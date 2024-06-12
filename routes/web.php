<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ScreeningController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\ProfileController;

// Default route
Route::get('/', function () {
    return view('welcome');
});

// Auth routes
Auth::routes(['verify' => true]);

// Login routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Register routes
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Password Reset routes
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Profile route
Route::get('/profile', [ProfileController::class, 'show'])->name('profile');

// Home route
Route::get('/', [HomeController::class, 'index']);

// Movie routes
Route::resource('movies', MovieController::class);
Route::get('movies/{movie}/{screening}', [MovieController::class, 'show_session'])->name('movies.show_session');

// Purchase routes
Route::post('/purchases', [PurchaseController::class, 'store'])->middleware('auth');

// Screening routes
Route::resource('screenings', ScreeningController::class);
