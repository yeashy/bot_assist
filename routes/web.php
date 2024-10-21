<?php

use App\Http\Controllers\API\Telegram\AuthController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\JobPositionController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Controller\ErrorController;

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
            Route::get('/', 'index')->name('main');
            Route::get('/info', 'info')->name('info');

            Route::prefix('employees')
                ->controller(EmployeeController::class)
                ->as('employees.')
                ->group(function () {
                    Route::get('/', 'list')->name('list');
                    Route::get('/schedule', 'schedule')->name('schedule');

                    Route::prefix('{employeeId}')->group(function () {
                        Route::get('/', 'index')->name('index');
                        Route::get('/info', 'info')->name('info');
                        Route::get('/working-period', 'workingPeriod')->name('working-period');
                    });

                    Route::prefix('working-periods')
                        ->middleware(['auth.logged', 'auth.client'])
                        ->group(function () {
                        Route::post('/{workingPeriodId}/assign', 'assign')->name('assign');
                    });
                });

            Route::prefix('positions')
                ->controller(JobPositionController::class)
                ->as('positions.')
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

            Route::prefix('assignments')
                ->controller(AssignmentController::class)
                ->middleware(['auth.logged', 'auth.client'])
                ->as('assignments.')
                ->group(function () {
                    Route::get('/next', 'next')->name('next');
                });

            Route::prefix('user')
                ->as('user.')
                ->group(function () {
                    Route::controller(UserController::class)->group(function () {
                        Route::get('/', 'index')->name('index');
                        Route::get('/edit', 'edit')->name('edit');

                        Route::get('me', 'me')->name('me')->middleware('auth.logged');
                    });
                });

            Route::prefix('clients')
                ->as('clients.')
                ->controller(ClientController::class)
                ->group(function () {
                    Route::post('register', 'register')->name('register');

                    Route::put('update', 'update')->name('update');
                });

            Route::prefix('auth')
                ->as('auth.')
                ->controller(AuthController::class)
                ->group(function () {
                    Route::post('/', 'auth')->name('index');
                });

            Route::prefix('errors')
                ->as('errors.')
                ->controller(ErrorController::class)
                ->group(function () {
                    Route::get('unauthorized', 'unauthorized')->name('unauthorized');
                });
        });
    });
