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

Route::get('/booking/customers', [BookingController::class, 'viewCustomers']);
Route::post('/booking/assign', [BookingController::class, 'saveCustomer']);
Route::get('/booking/assign', [BookingController::class, 'assignCustomer']);
Route::get('/invoices/{id}', [InvoiceController::class, 'list']);
Route::get('/invoice/create/{booking}', [InvoiceController::class, 'create']);


Route::resource('customer', CustomerController::class);
Route::resource('plot', PlotController::class);
Route::resource('booking', BookingController::class);
Route::resource('scheme', SchemeController::class);
Route::resource('invoice', InvoiceController::class);


