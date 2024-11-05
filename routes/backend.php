<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthenticateController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\PropertyController;

// Login Routes
Route::get('/login', [AuthenticateController::class, 'index'])->name('backend.login');
Route::post('/login', [AuthenticateController::class, 'login'])->name('backend.login.post');
Route::get('/logout', [AuthenticateController::class, 'logout'])->name('backend.logout');

// Redirect / to login page if not authenticated
Route::get('/', function () {
    return redirect()->route('backend.login');
});

Route::middleware('auth')->group(function () {
    // Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('backend.dashboard');

    // Property Routes with 'admin/properties' prefix
    Route::prefix('properties')->name('admin.properties.')->group(function () {
        Route::get('/', [PropertyController::class, 'index'])->name('index');
        Route::get('/create', [PropertyController::class, 'create'])->name('create');
        Route::post('/store', [PropertyController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [PropertyController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [PropertyController::class, 'update'])->name('update');
        Route::post('/delete/{id}', [PropertyController::class, 'destroy'])->name('delete');
        Route::get('/step/{step}', [PropertyController::class, 'getStepView'])->name('step');
        
        Route::get('/quick-create', [PropertyController::class, 'quick'])->name('quick');
    });
});
