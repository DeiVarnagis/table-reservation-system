<?php

use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RestaurantController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('restaurants',RestaurantController::class)->except(['edit', 'update']);
Route::resource('reservations', ReservationController::class)->except(['edit', 'update']);
Route::fallback(function () {
    return redirect('/restaurants');
});
