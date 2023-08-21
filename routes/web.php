<?php

use App\Http\Controllers\AirlineController;
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

Route::get('/cities', [CityController::class, 'index'])->name('cities.index');
Route::get('/airlines', [AirlineController::class, 'index'])->name('airlines.index');

Route::redirect('/', '/airlines');
Route::redirect('{unknown}', '/airlines')->where('unknown', '(.*)');
