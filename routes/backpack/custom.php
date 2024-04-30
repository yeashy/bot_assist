<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix' => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace' => 'App\Http\Controllers\Admin',
], function () { // custom admin routes

    Route::crud('company-type', 'CompanyTypeCrudController');
    Route::crud('font', 'FontCrudController');
    Route::crud('client', 'ClientCrudController');
    Route::crud('staff-member', 'StaffMemberCrudController');
    Route::crud('service', 'ServiceCrudController');
    Route::crud('job-position', 'JobPositionCrudController');
    Route::crud('gender', 'GenderCrudController');

    Route::prefix('company')->group(function () {
        Route::crud('/', 'CompanyCrudController');
        Route::crud('/{company_id}/company-affiliate', 'CompanyAffiliateCrudController');
        Route::crud('/{company_id}/client', 'ClientCrudController');
        Route::crud('/{company_id}/staff-member', 'StaffMemberCrudController');
        Route::crud('/{company_id}/service', 'ServiceCrudController');
        Route::crud('/{company_id}/job_position', 'JobPositionCrudController');

        Route::prefix('{company_id}/staff-member')->group(function () {
            Route::crud('/{person_id}/employee', 'EmployeeCrudController');
        });
    });
}); // this should be the absolute last line of this file
