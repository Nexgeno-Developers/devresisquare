<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Auth\AuthController;

// Group for web routes
Route::group(['middleware' => 'web'], function () {
    // Auth routes
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Frontend routes
    Route::get('/', [FrontendController::class, 'index'])->name('home');
});
Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('backend.dashboard');
});
// Optional: Redirect from '/admin' to the login page if not authenticated
// Route::get('/admin', function () {
//     return redirect(route('backend.login'));
// });
