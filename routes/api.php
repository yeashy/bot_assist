<?php

use App\Http\Controllers\API\AddressController;
use App\Http\Controllers\API\Telegram\AuthController;
use App\Http\Controllers\API\Telegram\WebhookController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('telegram')
    ->as('telegram.')
    ->namespace('App\Http\Controllers\API\Telegram')
    ->group(function () {
        Route::post('/{token}/webhook', [WebhookController::class, 'handle'])->name('webhook');
    });

Route::prefix('address')
    ->as('address.')
    ->controller(AddressController::class)
    ->group(function () {
        Route::get('/suggest/{address}', 'suggest')->name('suggest');
    });

Route::prefix('user')
    ->as('user.')
    ->controller(UserController::class)
    ->middleware('auth.logged')
    ->group(function () {
        Route::get('me', 'me')->name('me');
    });
