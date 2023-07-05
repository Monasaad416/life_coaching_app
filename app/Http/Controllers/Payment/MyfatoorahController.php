<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\MyfatoorahService;

class MyfatoorahController extends Controller
{
        public $myfatoorahService;
    public function __construct(MyfatoorahService $myfatoorahService) {
        $this->myfatoorahService = $myfatoorahService;
    }
    public function payService() {
        $data = [
            //Fill required data
            'NotificationOption' => 'Lnk', //'SMS', 'EML', or 'ALL'
            'InvoiceValue'       => '50',
            'CustomerName'       => 'fname lname',
            'DisplayCurrencyIso' => 'EGP',
            'MobileCountryCode'  => '+2',
            'CustomerMobile'     => '1234567890',
            'CustomerEmail'      => 'email@example.com',
            'CallBackUrl'        => env('MYFATOORAH_CALLBACK_URL'),
            'ErrorUrl'           => env('MYFATOORAH_ERROR_URL'),
            'Language'           => 'en', //or 'ar'
            'CustomerReference'  => 'orderId',
            //'CustomerAddress'    => 'kudf kjdvjfv jhf',
            //'CustomerCivilId'    => 'CivilId',
            //'UserDefinedField'   => 'This could be string, number, or array',
            //'ExpiryDate'         => '', //The Invoice expires after 3 days by default. Use 'Y-m-d\TH:i:s' format in the 'Asia/Kuwait' time zone.
            //'SourceInfo'         => 'Pure PHP', //For example: (Symfony, CodeIgniter, Zend Framework, Yii, CakePHP, etc)

            //'InvoiceItems'       => $invoiceItems,
        ];

        return $this->myfatoorahService->sendPayment($data);

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
