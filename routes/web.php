<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlotController;
use App\Http\Controllers\SchemeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\CustomerController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('customer', CustomerController::class);
Route::resource('plot', PlotController::class);
Route::resource('booking', BookingController::class);
Route::resource('scheme', SchemeController::class);
Route::resource('invoice', InvoiceController::class);


