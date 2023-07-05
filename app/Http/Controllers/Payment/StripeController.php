<?php

namespace App\Http\Controllers\Payment;

use Stripe\StripeClient;
use Illuminate\Http\Request;
use Modules\Order\Entities\Order;
use App\Http\Controllers\Controller;

class StripeController extends Controller
{
    public function create() {
        return view('front.payments.create',[

        ]);
    }



    public function createStripePaymentintent() {
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret_key'));
        $paymentIntent = $stripe->paymentIntents->create([
        'amount' => 1099,
        'currency' => 'usd',
        'payment_method_types' => ['card'],
        ]);



        return [
             'clientSecret' => $paymentIntent->client_secret,
        ];
    }

    public function transactionCallback (Request $request)
    {
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret_key'));
        $paymentIntent = $stripe->paymentIntents->retrieve(
        $request->payment_intent,
        []
        );

        return dd($paymentIntent);
    }
}
