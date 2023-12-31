<?php

use App\Http\Controllers\Api\AirlineController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\FlightController;
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

Route::controller(CityController::class)
    ->prefix('cities')
    ->name('cities.')
    ->group(static function () {
        Route::get('/', 'index')->name('index');
        Route::get('/all', 'getAll')->name('all');
        Route::post('/', 'store')->name('store');
        Route::prefix('{city}')->group(static function () {
            Route::put('/', 'update')->name('update');
            Route::delete('/', 'destroy')->name('destroy');
        });
    });

Route::controller(AirlineController::class)
    ->prefix('airlines')
    ->name('airlines.')
    ->group(static function () {
        Route::get('/', 'index')->name('index');
        Route::get('/all', 'getAll')->name('all');
        Route::post('/', 'store')->name('store');
        Route::prefix('{airline}')->group(static function () {
            Route::put('/', 'update')->name('update');
            Route::delete('/', 'destroy')->name('destroy');
            Route::get('/cities','getCities')->name('cities');
            Route::delete('/cities','destroyCities')->name('destroyCities');
        });
    });

Route::controller(FlightController::class)
    ->prefix('flights')
    ->name('flights.')
    ->group(static function () {
        Route::get('/', 'index')->name('index');
        Route::get('/all', 'getAll')->name('all');
        Route::post('/', 'store')->name('store');
        Route::prefix('{flight}')->group(static function () {
            Route::put('/', 'update')->name('update');
            Route::delete('/', 'destroy')->name('destroy');
        });
    });
