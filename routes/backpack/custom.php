<?php

use App\Facades\Route;
use App\Http\Controllers\Admin\ClientCrudController;
use App\Http\Controllers\Admin\CompanyAffiliateCrudController;
use App\Http\Controllers\Admin\CompanyCrudController;
use App\Http\Controllers\Admin\CompanyTypeCrudController;
use App\Http\Controllers\Admin\EmployeeCrudController;
use App\Http\Controllers\Admin\FontCrudController;
use App\Http\Controllers\Admin\GenderCrudController;
use App\Http\Controllers\Admin\JobPositionCrudController;
use App\Http\Controllers\Admin\ServiceCrudController;
use App\Http\Controllers\Admin\StaffMemberCrudController;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix' => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin'),
    ),
    'namespace' => 'App\Http\Controllers\Admin',
], function (): void { // custom admin routes

    Route::crud('company-type', CompanyTypeCrudController::class);
    Route::crud('font', FontCrudController::class);
    Route::crud('client', ClientCrudController::class);
    Route::crud('staff-member', StaffMemberCrudController::class);
    Route::crud('service', ServiceCrudController::class);
    Route::crud('job-position', JobPositionCrudController::class);
    Route::crud('gender', GenderCrudController::class);

    Route::prefix('company')->group(function (): void {
        Route::crud('/', CompanyCrudController::class);
        Route::crud('{company_id}/client', ClientCrudController::class);
        Route::crud('{company_id}/service', ServiceCrudController::class);
        Route::crud('{company_id}/job_position', JobPositionCrudController::class);

        Route::prefix('{company_id}/service')->group(function (): void {
            Route::crud('/', ServiceCrudController::class);
            Route::crud('{service_id}/job_position', JobPositionCrudController::class);
        });

        Route::prefix('{company_id}/job_position')->group(function (): void {
            Route::crud('/', JobPositionCrudController::class);
            Route::crud('{job_position_id}/service', ServiceCrudController::class);
        });

        Route::prefix('{company_id}/staff-member')->group(function (): void {
            Route::crud('/', StaffMemberCrudController::class);
            Route::crud('{person_id}/employee', EmployeeCrudController::class);
        });

        Route::prefix('{company_id}/company-affiliate')->group(function (): void {
            Route::crud('/', CompanyAffiliateCrudController::class);
            Route::crud('{company_affiliate_id}/employee', EmployeeCrudController::class);
        });
    });
}); // this should be the absolute last line of this file
