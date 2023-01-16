<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlotController;
use App\Http\Controllers\SchemeController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\CustomerController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    dd(Auth::user());
});

Route::get('/dashboard', function () {
    return view('home');
});


Route::middleware('auth')->group(function () {
    Route::get('/booking/customers', [BookingController::class, 'viewCustomers']);
    Route::post('/booking/assign', [BookingController::class, 'saveCustomer']);
    Route::get('/assign/customer/{id}', [BookingController::class, 'assignCustomer']);
    Route::get('/customer/assign-new', [BookingController::class, 'assignNewCustomer']);
    Route::get('/{scheme}/plots', [SchemeController::class, 'list']);
    Route::get('/invoices/{id}', [InvoiceController::class, 'list']);
    Route::get('/invoice/pay/{booking}', [InvoiceController::class, 'pay']);
    Route::get('/invoice/custom', [InvoiceController::class, 'custom']);
    Route::post('/invoice/getBookingMonths', [InvoiceController::class, 'getBookingMonths']);
    
    Route::resource('customer', CustomerController::class);
    Route::resource('plot', PlotController::class);
    Route::resource('booking', BookingController::class);
    Route::resource('scheme', SchemeController::class);
    Route::resource('invoice', InvoiceController::class);
    Route::resource('account', AccountController::class);
 });
 
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
