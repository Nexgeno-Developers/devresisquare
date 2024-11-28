<?php
//routes/backend.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthenticateController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\PropertyController;
use App\Http\Controllers\Backend\ContactCategoryController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\EstateChargeController;
use App\Http\Controllers\Backend\EstateChargeItemController;
use App\Http\Controllers\Backend\OwnerGroupController;

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
        Route::get('/view/{id}', [PropertyController::class, 'view'])->name('view');
        Route::get('/edit/{id}', [PropertyController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [PropertyController::class, 'update'])->name('update');
        Route::post('/delete/{id}', [PropertyController::class, 'destroy'])->name('delete');
        Route::get('/step/{step}', [PropertyController::class, 'getStepView'])->name('step');
        Route::get('/quick-create', [PropertyController::class, 'quick'])->name('quick');
        Route::get('/quick_step/{step}', [PropertyController::class, 'getQuickStepView'])->name('quick_step');
        Route::post('/quick-store', [PropertyController::class, 'quickStore'])->name('quick_store');
        Route::get('/deleted', [PropertyController::class, 'showSoftDeletedProperties'])->name('soft_deleted');
        Route::post('/restore/{id}', [PropertyController::class, 'restore'])->name('restore');
        Route::post('/bulk-restore', [PropertyController::class, 'bulkRestore'])->name('bulk-restore');
        // Route::get('/{property_id}/{tabname}', [PropertyController::class, 'showTabContent'])->name('tabcontent');
    });

    Route::resource('contact-categories', ContactCategoryController::class);
    Route::resource('contacts', ContactController::class);

    Route::name('admin.')->group(function () {

        // Estate Charges
        Route::get('estate-charges', [EstateChargeController::class, 'index'])->name('estate-charges.index');
        Route::get('estate-charges/create', [EstateChargeController::class, 'create'])->name('estate-charges.create');
        Route::post('estate-charges/store', [EstateChargeController::class, 'store'])->name('estate-charges.store');
        Route::get('estate-charges/{estateCharge}/show', [EstateChargeController::class, 'show'])->name('estate-charges.show');
        Route::get('estate-charges/{estateCharge}/edit', [EstateChargeController::class, 'edit'])->name('estate-charges.edit');
        Route::put('estate-charges/{estateCharge}/update', [EstateChargeController::class, 'update'])->name('estate-charges.update');
        Route::get('estate-charges/{estateCharge}/destroy', [EstateChargeController::class, 'destroy'])->name('estate-charges.destroy');

        // Estate Charge Items
        Route::get('estate-charges-items', [EstateChargeItemController::class, 'index'])->name('estate-charges-items.index');
        Route::get('estate-charges-items/create', [EstateChargeItemController::class, 'create'])->name('estate-charges-items.create');
        Route::post('estate-charges-items/store', [EstateChargeItemController::class, 'store'])->name('estate-charges-items.store');
        Route::get('estate-charges-items/{estateChargeItem}', [EstateChargeItemController::class, 'show'])->name('estate-charges-items.show');
        Route::get('estate-charges-items/{estateChargeItem}/edit', [EstateChargeItemController::class, 'edit'])->name('estate-charges-items.edit');
        Route::put('estate-charges-items/{estateChargeItem}/destroy', [EstateChargeItemController::class, 'update'])->name('estate-charges-items.update');
        Route::get('estate-charges-items/{estateChargeItem}/destroy', [EstateChargeItemController::class, 'destroy'])->name('estate-charges-items.destroy');

        // Owner Groups
        Route::get('owner-groups', [OwnerGroupController::class, 'index'])->name('owner-groups.index');
        Route::get('owner-groups/create', [OwnerGroupController::class, 'create'])->name('owner-groups.create');
        Route::post('owner-groups/store', [OwnerGroupController::class, 'store'])->name('owner-groups.store');
        Route::get('owner-groups/{ownerGroup}/show', [OwnerGroupController::class, 'show'])->name('owner-groups.show');
        Route::get('owner-groups/{ownerGroup}/edit', [OwnerGroupController::class, 'edit'])->name('owner-groups.edit');
        Route::put('owner-groups/{ownerGroup}/update', [OwnerGroupController::class, 'update'])->name('owner-groups.update');
        Route::post('owner-groups/{ownerGroup}/delete', [OwnerGroupController::class, 'destroy'])->name('owner-groups.destroy');

    });


});
