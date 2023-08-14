<?php

use App\Http\Controllers\CityController;
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
Route::prefix('cities')->name('cities.')->group(function () {
    Route::controller(CityController::class)->group(function () {
        Route::get('/', 'getCities')->name('getCities');
        Route::put('/{city}', 'update')->name('update');
        Route::post('/', 'store')->name('store');
        Route::delete('/{city}', 'destroy')->name('destroy');
    });
});
