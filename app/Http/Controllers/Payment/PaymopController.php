<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class PaymopController extends Controller
{

    public function payService() {
        $token = $this->getToken();
        $order = $this->createOrder($token);

    }


    public function getToken() {
        $request_client = new Client();
        $response = $request_client->post('https://accept.paymob.com/api/auth/tokens',[
            'api_key' => config('services.paymop.token')
        ]);

        return $response->object()->token;
    }


    public function createOrder() {
        $items = [
            "name" => "ASC1515",
            "amount_cents" => "500000",
            "description" => "Smart Watch",
            "quantity" =>  "1"
        ];

    }

    public function transactionCallback (Request $request) {
        $data=[];
        $data['Key']= $request->paymentId;
        $data['KeyType']= 'paymentId';

        //return dd($request->all());
        return $this->myfatoorahService->getPaymentStatus($data);
    }



    public function errorPayment (Request $request) {
        return dd($request);
    }
}
