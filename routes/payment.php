<?php

use App\Http\Controllers\Payment\PaymopController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Payment\PaypalController;
use App\Http\Controllers\Payment\StripeController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;




Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{

    //Paypal Payment
    Route::get('/paypal/payservice', [PaypalController::class,'payService'])->name('paypal.payment');
    Route::get('/paypal/callback', [PaypalController::class,'transactionCallback'])->name('paypal.callback');
    Route::get('/paypal/error', [PaypalController::class,'errorPayment'])->name('paypal.error_payment');


   //Stripe Payment
    Route::get('/stripe/create-payment', [StripeController::class,'create'])->name('stripe.payment.create');
    Route::post('/stripe/create-payment-intent', [StripeController::class,'createStripePaymentintent'])->name('stripe.payment_intent.create');
    Route::get('/stripe/callback', [StripeController::class,'transactionCallback'])->name('stripe.callback');

    //paymop Payment
    Route::get('/paymop/create-payment', [PaymopController::class,'create'])->name('paymop.payment.create');
    Route::post('/paymop/create-payment-intent', [PaymopController::class,'createpaymopPaymentintent'])->name('paymop.payment_intent.create');
    Route::get('/paymop/callback', [PaymopController::class,'transactionCallback'])->name('paymop.callback');

});




