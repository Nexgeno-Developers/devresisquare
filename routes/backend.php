<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthenticateController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\PropertyController;

// Authentication
Route::get('/', function () {
    return redirect(route('backend.login'));
});

// Redirect to the login page if accessing /admin without authentication
Route::get('/admin', function () {
    return redirect(route('backend.login'));
});

// Login routes
Route::get('/admin/login', [AuthenticateController::class, 'index'])->name('backend.login');
Route::post('/admin/login', [AuthenticateController::class, 'login'])->name('backend.login.post');
Route::get('/admin/logout', [AuthenticateController::class, 'logout'])->name('backend.logout');


Route::group(['middleware' => 'auth', 'prefix' => 'properties'], function () {
    Route::get('/', [PropertyController::class, 'index'])->name('admin.properties.index');
    Route::get('/create', [PropertyController::class, 'create'])->name('admin.properties.create'); // Add this line
    Route::post('/store', [PropertyController::class, 'store'])->name('admin.properties.store');
    Route::get('/edit/{id}', [PropertyController::class, 'edit'])->name('admin.properties.edit'); // Use {id} for property ID
    Route::post('/update/{id}', [PropertyController::class, 'update'])->name('admin.properties.update'); // Update route
    Route::post('/delete/{id}', [PropertyController::class, 'destroy'])->name('admin.properties.delete'); // Delete route
});


// Dashboard route
// Route::group(['middleware' => 'auth'], function () {
//     Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('backend.dashboard');
// });
