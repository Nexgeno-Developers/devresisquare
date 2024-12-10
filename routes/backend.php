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
use App\Http\Controllers\Backend\OfferController;
use App\Http\Controllers\Backend\BranchController;
use App\Http\Controllers\Backend\DesignationController;

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


    Route::name('admin.')->group(function () {

        // Designation
        Route::prefix('/designations')->group(function () {
            Route::get('/', [DesignationController::class, 'index'])->name('designations.index'); // List all designation
            Route::get('/create', [DesignationController::class, 'create'])->name('designations.create'); // Show create form
            Route::post('/store', [DesignationController::class, 'store'])->name('designations.store'); // Store new branch
            Route::get('/edit/{branch}', [DesignationController::class, 'edit'])->name('designations.edit'); // Show edit form
            Route::put('/update/{branch}', [DesignationController::class, 'update'])->name('designations.update'); // Update branch
            Route::delete('/delete/{branch}', [DesignationController::class, 'destroy'])->name('designations.destroy'); // Delete branch
        });

        // Branch
        Route::prefix('/branches')->group(function () {
            Route::get('/', [BranchController::class, 'index'])->name('branches.index'); // List all branches
            Route::get('/create', [BranchController::class, 'create'])->name('branches.create'); // Show create form
            Route::post('/store', [BranchController::class, 'store'])->name('branches.store'); // Store new branch
            Route::get('/edit/{branch}', [BranchController::class, 'edit'])->name('branches.edit'); // Show edit form
            Route::put('/update/{branch}', [BranchController::class, 'update'])->name('branches.update'); // Update branch
            Route::delete('/delete/{branch}', [BranchController::class, 'destroy'])->name('branches.destroy'); // Delete branch
        });

        // Contacts
        Route::get('contacts', [ContactController::class, 'index'])->name('contacts.index');
        Route::get('contacts/create', [ContactController::class, 'create'])->name('contacts.create');
        Route::get('contacts/contact_step/{step}', [ContactController::class, 'getQuickStepView'])->name('contacts.contact_step');
        Route::post('contacts/store', [ContactController::class, 'contactStore'])->name('contacts.store');
        Route::get('contacts/properties/search', [ContactController::class, 'searchProperties'])->name('contacts.properties.search');
        // Route::post('contacts/store', [ContactController::class, 'store'])->name('contacts.store');
        Route::get('contacts/show/{id}', [ContactController::class, 'show'])->name('contacts.show');
        Route::get('contacts/edit/{id}', [ContactController::class, 'edit'])->name('contacts.edit');
        Route::post('contacts/update/{id}', [ContactController::class, 'update'])->name('contacts.update');
        Route::post('contacts/delete/{id}', [ContactController::class, 'delete'])->name('contacts.delete');

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

        // Offer
        Route::get('offers', [OfferController::class, 'index'])->name('offers.index');
        Route::get('offers/create', [OfferController::class, 'create'])->name('offers.create');
        Route::post('offers/store', [OfferController::class, 'store'])->name('offers.store');
        Route::get('offers/{offer}/edit', [OfferController::class, 'edit'])->name('offers.edit');
        Route::put('offers/{offer}/update', [OfferController::class, 'update'])->name('offers.update');
        Route::delete('offers/{offer}/delete', [OfferController::class, 'destroy'])->name('offers.destroy');
    });
});
