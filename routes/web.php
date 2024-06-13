<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ScreeningController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
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

// Profile routes with middleware to protect access
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('password/change', [ProfileController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('password/change', [ProfileController::class, 'changePassword'])->name('password.update');
});

// Home route
Route::get('/home', [HomeController::class, 'index']);

// Admin routes
Route::get('/admin/users', [AdminController::class, 'index'])->middleware('auth')->name('admin.index');
Route::get('admin/users/create', [AdminController::class, 'create'])->name('admin.create');
Route::post('admin/users', [AdminController::class, 'store'])->name('admin.store');
Route::get('admin/users/{user}', [AdminController::class, 'show'])->name('admin.show');
Route::get('/admin/users/{user}/edit', [AdminController::class, 'edit'])->middleware('auth')->name('admin.edit');
Route::put('/admin/users/{user}', [AdminController::class, 'update'])->middleware('auth')->name('admin.update');
Route::delete('admin/users/{user}', [AdminController::class, 'destroy'])->name('admin.destroy');
Route::patch('admin/{user}/block', [AdminController::class, 'block'])->name('admin.block');
Route::patch('admin/{user}/unblock', [AdminController::class, 'unblock'])->name('admin.unblock');
Route::delete('admin/{user}', [AdminController::class, 'softDelete'])->name('admin.softDelete');
Route::patch('admin/{user}/restore', [AdminController::class, 'restore'])->name('admin.restore');


// Movie routes
Route::resource('movies', MovieController::class);

// Purchase routes
Route::post('/purchases', [PurchaseController::class, 'store'])->middleware('auth');

// Screening routes
Route::resource('screenings', ScreeningController::class);
