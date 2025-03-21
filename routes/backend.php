<?php
// routes/backend.php

use App\Http\Controllers\Backend\AuthenticateController;
use App\Http\Controllers\Backend\BranchController;
use App\Http\Controllers\Backend\BusinessSettingsController;
use App\Http\Controllers\Backend\ComplianceController;
use App\Http\Controllers\Backend\ContactCategoryController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\DesignationController;
use App\Http\Controllers\Backend\EstateChargeController;
use App\Http\Controllers\Backend\EstateChargeItemController;
use App\Http\Controllers\Backend\InvoiceController;
use App\Http\Controllers\Backend\JobTypeController;
use App\Http\Controllers\Backend\OfferController;
use App\Http\Controllers\Backend\OwnerGroupController;
use App\Http\Controllers\Backend\PropertyController;
use App\Http\Controllers\Backend\PropertyRepairController;
use App\Http\Controllers\Backend\TenancyController;
use App\Http\Controllers\Backend\TenancySubStatusController;
use App\Http\Controllers\Backend\TenancyTypeController;
use App\Http\Controllers\Backend\WebsiteController;
use App\Http\Controllers\Backend\WorkOrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Login Routes
Route::get('/login', [AuthenticateController::class, 'index'])->name('backend.login');
Route::post('/login', [AuthenticateController::class, 'login'])->name('backend.login.post');
Route::get('/logout', [AuthenticateController::class, 'logout'])->name('backend.logout');

// Redirect / to login page if not authenticated
Route::get('/', function () {
    return redirect()->route('backend.login');
});

Route::middleware('auth')->group(function () {
    Route::get('/clear-cache', function () {
        // Clear application cache
        Artisan::call('cache:clear');

        // Clear configuration cache
        Artisan::call('config:clear');

        // Optionally clear other caches you might need
        Artisan::call('route:clear');
        Artisan::call('view:clear');

        // Flash a success message
        flash('Cache cleared successfully')->success();

        // Redirect back to the previous page
        return back();
    })->name('cache.clear');

    Route::get('/search-properties', function (Request $request) {
        return searchProperties($request);
    })->name('properties.search');

    Route::get('/get_contacts_info_by_property/{propertyId}/contacts/{categoryId}', function ($propertyId, $categoryId) {
        return response()->json(get_contacts_by_property_and_category($propertyId, $categoryId));
    })->name('admin.getContactsByProperty');

    Route::get('/get_tenants_by_property/{propertyId}', function ($propertyId) {
        return response()->json(get_tenants_by_property($propertyId));
    })->name('admin.getTenantsByProperty');

    // Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('backend.dashboard');

    Route::resource('contact-categories', ContactCategoryController::class);

    Route::name('admin.')->group(function () {
        // Property
        Route::prefix('properties')->name('properties.')->controller(PropertyController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/view/{id}', 'view')->name('view');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/update/{id}', 'update')->name('update');
            Route::post('/delete/{id}', 'destroy')->name('delete');
            Route::get('/step/{step}', 'getStepView')->name('step');
            Route::get('/quick-create', 'quick')->name('quick');
            Route::get('/quick_step/{step}', 'getQuickStepView')->name('quick_step');
            Route::post('/quick-store', 'quickStore')->name('quick_store');
            Route::get('/deleted', 'showSoftDeletedProperties')->name('soft_deleted');
            Route::post('/restore/{id}', 'restore')->name('restore');
            Route::post('/bulk-restore', 'bulkRestore')->name('bulk-restore');
            // Route::get('/{property_id}/{tabname}',  'showTabContent')->name('tabcontent');
        });

        // Designation
        Route::prefix('designations')->name('designations.')->controller(DesignationController::class)->group(function () {
            Route::get('/', 'index')->name('index');  // List all designations
            Route::get('/create', 'create')->name('create');  // Show create form
            Route::post('/store', 'store')->name('store');  // Store new designation
            Route::get('/edit/{designation}', 'edit')->name('edit');  // Show edit form
            Route::put('/update/{designation}', 'update')->name('update');  // Update designation
            Route::delete('/delete/{designation}', 'destroy')->name('destroy');  // Delete designation
        });

        // Branch
        Route::prefix('branches')->name('branches.')->controller(BranchController::class)->group(function () {
            Route::get('/', 'index')->name('index');  // List all branches
            Route::get('/create', 'create')->name('create');  // Show create form
            Route::post('/store', 'store')->name('store');  // Store new branch
            Route::get('/edit/{branch}', 'edit')->name('edit');  // Show edit form
            Route::put('/update/{branch}', 'update')->name('update');  // Update branch
            Route::delete('/delete/{branch}', 'destroy')->name('destroy');  // Delete branch
        });

        // Contacts
        Route::prefix('contacts')->name('contacts.')->controller(ContactController::class)->group(function () {
            Route::get('/', 'index')->name('index');  // List all contacts
            Route::get('/create', 'create')->name('create');  // Show create form
            Route::get('/contact_step/{step}', 'getQuickStepView')->name('contact_step');  // Get quick step view
            Route::post('/store', 'contactStore')->name('store');  // Store contact
            Route::post('/quick-store-contact', 'quicklyStoreContact')->name('quick_contact_store');  // Quick store contact
            Route::get('/properties/search', 'searchProperties')->name('properties.search');  // Search properties
            Route::get('/show/{id}', 'show')->name('show');  // Show individual contact
            Route::get('/edit/{id}', 'edit')->name('edit');  // Show edit form
            Route::post('/update/{id}', 'update')->name('update');  // Update contact
            Route::post('/delete/{id}', 'delete')->name('delete');  // Delete contact
        });

        // Estate Charges
        Route::prefix('estate-charges')->name('estate-charges.')->controller(EstateChargeController::class)->group(function () {
            Route::get('/', 'index')->name('index');  // List all estate charges
            Route::get('/create', 'create')->name('create');  // Show create form
            Route::post('/store', 'store')->name('store');  // Store new estate charge
            Route::get('/{estateCharge}/show', 'show')->name('show');  // Show individual estate charge
            Route::get('/{estateCharge}/edit', 'edit')->name('edit');  // Show edit form
            Route::put('/{estateCharge}/update', 'update')->name('update');  // Update estate charge
            Route::delete('/{estateCharge}/destroy', 'destroy')->name('destroy');  // Delete estate charge
        });

        // Estate Charge Items
        Route::prefix('estate-charges-items')->name('estate-charges-items.')->controller(EstateChargeItemController::class)->group(function () {
            Route::get('/', 'index')->name('index');  // List all estate charge items
            Route::get('/create', 'create')->name('create');  // Show create form
            Route::post('/store', 'store')->name('store');  // Store new estate charge item
            Route::get('/{estateChargeItem}', 'show')->name('show');  // Show individual estate charge item
            Route::get('/{estateChargeItem}/edit', 'edit')->name('edit');  // Show edit form
            Route::put('/{estateChargeItem}/update', 'update')->name('update');  // Update estate charge item
            Route::delete('/{estateChargeItem}/destroy', 'destroy')->name('destroy');  // Delete estate charge item
        });

        // Owner Groups
        Route::prefix('owner-groups')->name('owner-groups.')->controller(OwnerGroupController::class)->group(function () {
            Route::get('/', 'index')->name('index');  // List all owner groups
            Route::get('/create', 'create')->name('create');  // Show create form
            Route::get('/create-group', 'createGroup')->name('create_group');  // Show create group form
            Route::post('/store', 'store')->name('store');  // Store new owner group
            Route::post('/store-group', 'storeGroup')->name('store_group');  // Store new owner group subgroup
            Route::post('/update-group/{id}', 'updateGroup')->name('update_group');  // Update subgroup
            Route::post('/delete-group/{id}', 'deleteGroup')->name('delete_group');  // Delete subgroup
            Route::get('/{ownerGroup}/show', 'show')->name('show');  // Show individual owner group
            Route::get('/{ownerGroup}/edit', 'edit')->name('edit');  // Show edit form
            Route::put('/{ownerGroup}/update', 'update')->name('update');  // Update owner group
            Route::post('/{ownerGroup}/delete', 'destroy')->name('destroy');  // Delete owner group
            Route::post('/update-main/{id}', 'updateMain')->name('updateMain');  // Update main owner group
        });

        // Tenancy
        Route::prefix('tenancies')->name('tenancies.')->controller(TenancyController::class)->group(function () {
            Route::get('/create', 'create')->name('create');  // Show create form
            Route::post('/store', 'store')->name('store');  // Store new tenancy
            Route::get('/{id}', 'show')->name('show');  // Show individual tenancy
            Route::get('/{id}/edit', 'edit')->name('edit');  // Show edit form
            Route::post('/{id}/update', 'update')->name('update');  // Update tenancy
            Route::delete('/{id}/delete', 'destroy')->name('delete');  // Delete tenancy
        });

        // Keeping this route separate since it follows a different URL structure
        Route::get('/properties/{propertyId}/tenancies', [TenancyController::class, 'index'])->name('tenancies.index');

        // Offer
        Route::prefix('offers')->name('offers.')->controller(OfferController::class)->group(function () {
            Route::get('/', 'index')->name('index');  // List all offers
            Route::get('/create', 'create')->name('create');  // Show create form
            Route::post('/store', 'store')->name('store');  // Store new offer
            Route::get('/{offer}/edit', 'edit')->name('edit');  // Show edit form
            Route::put('/{offer}/update', 'update')->name('update');  // Update offer
            Route::delete('/{offer}/delete', 'destroy')->name('destroy');  // Delete offer
        });

        // don't change url its used in property-offer.js file
        Route::post('offers/{id}/set-main-person', [OfferController::class, 'setMainPerson'])->name('offers.setMainPerson');
        Route::post('offers/{id}/update-status', [OfferController::class, 'updateStatus'])->name('offers.updateStatus');

        Route::prefix('tenancy-sub-statuses')->name('tenancy_sub_statuses.')->controller(TenancySubStatusController::class)->group(function () {
            Route::get('/', 'index')->name('index');  // List all tenancy sub statuses
            Route::get('/show', 'show')->name('show');  // Show individual sub status
            Route::get('/create', 'create')->name('create');  // Show create form
            Route::post('/store', 'store')->name('store');  // Store new tenancy sub status
            Route::get('/edit/{tenancySubStatus}', 'edit')->name('edit');  // Show edit form
            Route::put('/update/{tenancySubStatus}', 'update')->name('update');  // Update tenancy sub status
            Route::delete('/delete/{tenancySubStatus}', 'destroy')->name('destroy');  // Delete tenancy sub status
        });

        Route::prefix('tenancy-types')->name('tenancy_types.')->controller(TenancyTypeController::class)->group(function () {
            Route::get('/', 'index')->name('index');  // List all tenancy types
            Route::get('/show', 'show')->name('show');  // Show individual tenancy type
            Route::get('/create', 'create')->name('create');  // Show create form
            Route::post('/store', 'store')->name('store');  // Store new tenancy type
            Route::get('/edit/{tenancyType}', 'edit')->name('edit');  // Show edit form
            Route::put('/update/{tenancyType}', 'update')->name('update');  // Update tenancy type
            Route::delete('/delete/{tenancyType}', 'destroy')->name('destroy');  // Delete tenancy type
        });

        Route::prefix('compliance')->name('compliance.')->controller(ComplianceController::class)->group(function () {
            Route::get('/type/form/{complianceTypeId}/{complianceRecordId?}', 'getComplianceForm')->name('type.form');
            Route::post('/store', 'storeCompliance')->name('store');
            Route::post('/update', 'updateCompliance')->name('update');
            Route::delete('/delete/{complianceRecordId}', 'deleteCompliance')->name('delete');
        });

        Route::prefix('/property-repairs')->group(function () {
            Route::controller(PropertyRepairController::class)->group(function () {
                Route::get('/issue-list', 'index')->name('property_repairs.index');
                Route::get('repair-show/{id}', 'show')->name('property_repairs.show');
                Route::get('repair-edit/{id}/edit', 'edit')->name('property_repairs.edit');
                Route::put('repair-update/{id}', 'update')->name('property_repairs.update');
                Route::delete('repair-delete/{id}', 'destroy')->name('property_repairs.delete');

                Route::get('/raise-repair-issue-create', 'repairRaise')->name('property_repairs.create');  // List all property repairs
                Route::get('/repair-category/{categoryId}/subcategories', 'getSubCategories')->name('property_repairs.getSubCategories');
                Route::post('/raise-issue-store', 'raiseIssueStore')->name(name: 'property_repairs.store');  // List all property repairs
                Route::post('/repair/check-last-step', 'checkLastStep')->name('repair.checkLastStep');
                Route::get('/get-repair-categories', 'getCategories')->name('get.repair.categories');
                Route::get('/selected-property/tenants', 'getPropertyTenants')->name('get.property_repairs.tenants');
                Route::get('/repair/{repair}/workorder-invoice', 'workOrderInvoice')->name('repair.workorder.invoice');
            });
        });

        Route::prefix('/job-types')->group(function () {
            Route::controller(JobTypeController::class)->group(function () {
                Route::get('/list', 'index')->name('job_types.index');  // List all job types
                Route::get('/show/{id}', 'show')->name('job_types.show');  // Show single job type
                Route::get('/edit/{id}', 'edit')->name('job_types.edit');  // Edit job type
                Route::put('/update/{id}', 'update')->name('job_types.update');  // Update job type
                Route::delete('/delete/{id}', 'destroy')->name('job_types.delete');  // Delete job type

                Route::get('/create', 'create')->name('job_types.create');  // Show form to create job type
                Route::post('/store', 'store')->name('job_types.store');  // Store new job type

                Route::get('/parent/{parentId}/subcategories', 'getSubTypes')->name('job_types.getSubCategories');  // Fetch subcategories
                Route::get('/get-all', 'getAllJobTypes')->name('job_types.getAll');  // Fetch all job types
            });
        });

        Route::prefix('/work-orders')->group(function () {
            Route::controller(WorkOrderController::class)->group(function () {
                Route::post('/store', 'store')->name('work_orders.store');  // Save new work order
                Route::get('/get/{repairIssueId}', 'getWorkOrder')->name('work_orders.get');  // Get work order by repair issue id
            });
        });

        Route::prefix('/invoices')->group(function () {
            Route::controller(InvoiceController::class)->group(function () {
                Route::get('/', 'index')->name('invoices.index');
                Route::post('/generate/{workOrderId}', 'createFromWorkOrder')->name('invoices.generate');
                Route::get('/view/{id}', 'show')->name('invoices.show');
                Route::get('/download/{id}', 'download')->name('invoices.download');
                Route::post('/mark-paid/{id}', 'markAsPaid')->name('invoices.mark_paid');

                Route::get('/edit/{invoice}', 'edit')->name('invoices.edit');
                Route::put('/update/{invoice}', 'update')->name('invoices.update');
            });
        });
    });

    // website setting
    Route::group(['prefix' => 'website', 'as' => 'website.'], function () {
        Route::controller(WebsiteController::class)->group(function () {
            Route::get('/footer', 'footer')->name('footer');
            Route::get('/header', 'header')->name('header');
            Route::get('/appearance', 'appearance')->name('appearance');
        });
    });

    // Business Settings
    Route::controller(BusinessSettingsController::class)->group(function () {
        Route::post('/business-settings/update', 'update')->name('business_settings.update');
    });
});
