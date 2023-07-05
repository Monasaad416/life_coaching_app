<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Payment\TapController;
use App\Http\Controllers\Payment\MyfatoorahController;
use App\Http\Controllers\Payment\PaypalController;

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




// Route::middleware('auth:client-api')->get('/', function (Request $request) {
    // return $request->user();

    Route::post('/myfatoorah/payservice', [MyfatoorahController::class,'payService'])->name('myfatoorah.payment');
    Route::get('/myfatoorah/callback', [MyfatoorahController::class,'transactionCallback'])->name('myfatoorah.callback');
    Route::get('/myfatoorah/error', [MyfatoorahController::class,'errorPayment'])->name('myfatoorah.error_payment');

    Route::post('/paypal/payservice', [PaypalController::class,'payService'])->name('paypal.payment');
    Route::get('/paypal/callback', [PaypalController::class,'transactionCallback'])->name('paypal.callback');
    Route::get('/paypal/error', [PaypalController::class,'errorPayment'])->name('paypal.error_payment');
// });
