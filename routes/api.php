<?php

use App\Http\Controllers\Api\AirlineController;
use App\Http\Controllers\Api\CityController;
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
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::put('/{city}', 'update')->name('update');
        Route::post('/', 'store')->name('store');
        Route::delete('/{city}', 'destroy')->name('destroy');
    });

Route::controller(AirlineController::class)
    ->prefix('airlines')
    ->name('airlines.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::put('/{airline}', 'update')->name('update');
        Route::post('/', 'store')->name('store');
        Route::delete('/{airline}', 'destroy')->name('destroy');
    });
