<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
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

            Route::prefix('employees')
                ->controller(EmployeeController::class)
                ->group(function () {
                    Route::get('/', 'list')->name('list');
                    Route::get('/schedule', 'schedule')->name('schedule');

                    Route::prefix('{employeeId}')->group(function () {
                        Route::get('/', 'index')->name('index');
                        Route::get('/info', 'info')->name('info');
                    });
                });

            Route::prefix('positions')
                ->controller(JobPositionController::class)
                ->group(function () {
                    Route::get('/', 'list')->name('list');

                    Route::prefix('{positionId}')->group(function () {
                        Route::get('/', 'index')->name('index');

                        Route::prefix('services')
                            ->controller(ServiceController::class)
                            ->group(function () {
                                Route::get('/', 'list')->name('list');

                                Route::prefix('{serviceId}')->group(function () {
                                    Route::get('/', 'index')->name('index');
                                });
                            });
                    });
                });
        });
    });
