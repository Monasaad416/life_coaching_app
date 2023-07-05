<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Http\Services\TapService;
use Illuminate\Http\Request;

class TapController extends Controller
{
    public $tapService;
    public function __construct(TapService $tapService) {
        $this->tapService = $tapService;
    }
    public function payService() {
        $data = [
            //Fill required data
            'amount' => '50',
            'currency' => 'KWD',
            "customer_initiated" => true,
            "threeDSecure" => true,
            "save_card" => false,
            "payment_agreement" => [
                "id" => "payment_agreement_TS07A4620230032t4K21406294"
            ],
            "description" => "Test Description",
            "metadata" => [
                "udf1" => "Metadata 1"
            ],
            "reference" => [
                "transaction" => "txn_01",
                "order" => "ord_01"
            ],
            "receipt" => [
                "email" => true,
                "sms" => true
            ],
            'customer' => [
                "first_name" => "test",
                "middle_name" => "test",
                "last_name" => "test",
                "email" => "test@test.com",
                "phone" => [
                "country_code" => 965,
                "number" => 51234567,
                ],
            ],
            "source"=>[
                "id" =>   "tok_2uKe58232153ZmxV138r5c637",
            ],

            "redirect"=>[
                "url" =>  env('TAP_CALLBACK_URL'),
            ],
        ];




        return $this->tapService->sendPayment($data);

    }

    public function transactionCallback (Request $request) {
        $data=[];
        $data['Key']= $request->paymentId;
        $data['KeyType']= 'paymentId';

        //return dd($request->all());
        return $this->tapService->getPaymentStatus($data);
    }



    public function errorPayment (Request $request) {
        return dd($request);
    }


}
