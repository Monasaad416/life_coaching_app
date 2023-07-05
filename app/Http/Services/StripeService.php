<?php

namespace App\Http\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;



class StripeService
{
    private $base_url;
    private $headers;
    private $request_client;

    public function __construct(Client $request_client) {
        $this->request_client = $request_client;
        $this->base_url = env('MYFATOORA_BASE_URL');
        $this->headers = [
            'Content_Type' => 'application/json',
            'Authorization' => 'Bearer ' . env('MYFATOORA_TOKEN')
        ];

    }



    public function buildRequest($url,$method, $data=[]) {
        $request = new Request($method , $this->base_url.$url, $this->headers);
        if(!$data) {
            return false;
        }
            $response = $this->request_client->send( $request ,[
                'json' => $data
            ]);


            if($response->getStatusCode() != 200) {
                return false;
            }

             $response = json_decode($response->getBody(),true);
            return $response;
      
        }



    

    public function sendPayment($data) {
        return $this->buildRequest("/v2/SendPayment","POST",$data);
       // return $response;
        // if($response) {
        //     // $this->saveTransactionPayment;
        // }
    }


    public function getPaymentStatus($data) {
        return $this->buildRequest("/v2/getPaymentStatus","POST",$data);
    }

}
