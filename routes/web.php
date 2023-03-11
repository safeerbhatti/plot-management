<?php

use App\Http\Controllers\Scheme\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Plot\PlotController;
use App\Http\Controllers\Scheme\SchemeController;
use App\Http\Controllers\Account\AccountController;
use App\Http\Controllers\Booking\BookingController;
use App\Http\Controllers\Invoice\InvoiceController;
use App\Http\Controllers\Customer\CustomerController;


Route::get('/', [SchemeController::class, 'index']);

Route::get('/dashboard', function () {
    return redirect('/');
});

// Route::get('/', [SchemeController::class, 'index']);

Route::middleware('auth')->group(function () {

    Route::post('/{scheme}/invoice/test', [InvoiceController::class, 'store']);
    Route::get('/booking/customers', [BookingController::class, 'viewCustomers']);
    Route::post('/{scheme}/booking/assign', [BookingController::class, 'saveCustomer']);
    Route::get('/{scheme}/assign/customer/{id}', [BookingController::class, 'assignCustomer']);
    Route::get('/{scheme}/customer/assign-new', [BookingController::class, 'assignNewCustomer']);
    Route::get('/plots', [SchemeController::class, 'list']);
    Route::get('/{scheme}/invoices/{id}', [InvoiceController::class, 'list']);
    Route::get('/{scheme}/invoice/pay/{booking}', [InvoiceController::class, 'pay']);
    Route::get('/{scheme}/invoice/custom', [InvoiceController::class, 'custom']);
    Route::post('/invoice/getBookingMonths', [InvoiceController::class, 'getBookingMonths']);
    Route::post('/{scheme}/expense', [AccountController::class, 'storeExpense']);
    Route::get('/{scheme}/expense', [AccountController::class, 'createExpense']);
    Route::post('/bi-yearly', [InvoiceController::class, 'storeBiYearly']);
    Route::get('/bi-yearly/pay/{id}', [InvoiceController::class, 'payBiYearly']);
    Route::post('/dev-charges', [InvoiceController::class, 'storeDevCharges']);
    Route::get('/dev-charges/pay/{id}', [InvoiceController::class, 'payDevCharges']);

    Route::get('/scheme/profile/{id}', [ProfileController::class, 'profile']);
    
    Route::delete('/scheme/delete/{id}', [SchemeController::class, 'destroy'])->name('scheme');


    Route::resource('{scheme}/customer', CustomerController::class);
    Route::resource('{scheme}/plot', PlotController::class);
    Route::resource('{scheme}/booking', BookingController::class);
    Route::resource('scheme', SchemeController::class);
    Route::resource('{scheme}/invoice', InvoiceController::class);
    Route::resource('{scheme}/account', AccountController::class);

    Route::prefix('{slug}')->group(function () {

    });
 });
 
Auth::routes();

Route::get('/{slug}', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
