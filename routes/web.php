<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobPositionController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::prefix('companies')
    ->as('companies.')
    ->controller(CompanyController::class)
    ->group(function () {

        Route::prefix('{companyId}')->group(function () {
            Route::get('/', 'index')->name('index');

            Route::prefix('positions')
                ->controller(JobPositionController::class)
                ->group(function () {
                Route::get('/', 'list')->name('positions');

                Route::prefix('{positionId}')->group(function () {
                    Route::get('/', 'index')->name('position');

                    Route::prefix('services')
                        ->controller(ServiceController::class)
                        ->group(function () {
                        Route::get('/', 'list')->name('services');

                        Route::prefix('{serviceId}')->group(function () {
                            Route::get('/', 'index')->name('service');
                        });
                    });
                });
            });
        });
    });
