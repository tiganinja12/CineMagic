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
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;

use App\Http\Middleware\EnsureUserIsNotCustomer;

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
Route::get('movies/{movie}/{screening}', [MovieController::class, 'show_session'])->name('movies.show_session');

// Purchase routes
Route::post('/purchases', [PurchaseController::class, 'store'])->middleware('auth');

Route::get('carrinho', [CarrinhoController::class, 'index'])->name('carrinho.index');
Route::post('carrinho/{screening}/{seat}', [CarrinhoController::class, 'store_bilhete'])->name('carrinho.bilhete.store');
Route::put('carrinho/tickets/{ticket}', [CarrinhoController::class, 'update_bilhete'])->name('carrinho.update');
Route::delete('carrinho/tickets/{ticket}', [CarrinhoController::class, 'destroy_bilhete'])->name('carrinho.bilhete.destroy');
Route::delete('carrinho', [CarrinhoController::class, 'destroy'])->name('carrinho.destroy');
Route::post('carrinho', [CarrinhoController::class, 'store'])->name('carrinho.store');
Route::get('carrinho/show/{ticket}', [CarrinhoController::class,'carrinho_show'])->name('carrinho.show');



Route::post('bilheteira', [TicketController::class, 'create'])->name('bilheteira.create');

// Screening routes
Route::middleware(['auth', EnsureUserIsNotCustomer::class])->group(function () {
    Route::resource('screenings', ScreeningController::class);
});
