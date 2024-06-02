<?php

use App\Http\Controllers\CompanyController;
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

            Route::prefix('positions')->group(function () {
                Route::get('/', 'positions')->name('positions');
                Route::get('/{positionId}', 'positions')->name('positions');
                Route::get('/{positionId}/services', 'services')->name('services');
            });
        });
    });
