<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Srmklive\PayPal\Services\ExpressCheckout;
use Illuminate\Support\Facades\Redirect;

//use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalController extends Controller
{
    public function payService() {
    $data = [];
    $data['items'] = [
            [
                'name'=>'1خدمة',
                'price'=>0.1,
                'desc'=> "lllllll",
                'qty' => 1,
            ] ,
            [
                'name'=>'2خدمة',
                'price'=>0.1,
                'desc'=> 'kkkkkkk',
                'qty' => 2,
            ]
    ];
    $data['invoice_id'] = 1 ;
    $data['invoice_description'] = 'buying new service include shipping';
    $data['return_url'] = config('services.paypal.paypal_callback_url') ;
    $data['cancel_url'] = config('services.paypal.paypal_error_url') ;
    $data['total'] = 0.3;


        $provider = new ExpressCheckout;
   
        $response = $provider->setExpressCheckout($data,true);
        //return dd($response);
        return Redirect::away($response['paypal_link']);
    }


    public function cancel() {
        return response()->json('Payment cancelled',402);
    }

    public function transactionCallback (Request $request)
    {
        $provider = new ExpressCheckout;
        $response = $provider->getExpressCheckoutDetails($request->token);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            dd('Payment was successfull. The payment success page goes here!');
        }

        //cancel and remove info saved in database if error occuers
        dd('Error occured!');
    }



    public function errorPayment (Request $request) {
        return dd($request);
    }


}
