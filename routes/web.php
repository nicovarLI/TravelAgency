<?php

use App\Http\Controllers\AirlineController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\FlightController;
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

Route::get('/cities', [CityController::class, 'index'])->name('cities.index');
Route::get('/airlines', [AirlineController::class, 'index'])->name('airlines.index');
Route::get('/', [FlightController::class, 'index'])->name('flights.index');

//Route::redirect('{unknown}', '/flights')->where('unknown', '(.*)');
