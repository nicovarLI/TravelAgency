<?php

use App\Http\Controllers\CityController;
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

Route::controller(CityController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::post('/', 'store')->name('cities.store');
    Route::delete('/{city}', 'destroy')->name('cities.destroy');
    Route::patch('/{city}', 'update')->name('cities.update');
});
