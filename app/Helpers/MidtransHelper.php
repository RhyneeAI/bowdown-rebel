<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MidtransHelper 
{
    protected $table;
    protected $productionUrl;
    protected $sandboxUrl;
    protected $serverKey;
    protected $clientKey;
    protected $merchantId;

    public function __construct() {
        $this->table = env('MIDTRANS_SERVER_KEY');
        $this->productionUrl = env('MIDTRANS_PRODUCTION_URL', 'https://app.midtrans.com');
        $this->sandboxUrl = env('MIDTRANS_SANDBOX_URL', 'https://app.sandbox.midtrans.com');
        $this->serverKey = env('MIDTRANS_SERVER_KEY');
        $this->clientKey = env('MIDTRANS_CLIENT_KEY');
        $this->merchantId = env('MIDTRANS_MERCHANT_ID');
    }

    public function isProduction(){
        return env('APP_ENV') == 'production';
    }

    public function generateOrderId($length = 5){
        $orderId = 'BD-' . date('Ymd');

        for ($i = 0; $i < $length; $i++) {
            $orderId .= random_int(0, 9);  // Cryptographically secure random number
        }
        return $orderId;
    }
    
    public function send($payload, $endpoint, $method = 'post', $isForce = false)
    {
        try {
            $baseUrl = $this->isProduction() ? $this->productionUrl : $this->sandboxUrl;
            $url = $baseUrl . $endpoint;
            if($isForce){
                $url = $endpoint;
            } 
            // Log::info($url);

            // Jika method GET, konversi payload menjadi query parameters
            if (strtolower($method) === 'get' && !empty($payload)) {
                $queryString = http_build_query($payload);
                $url .= '?' . $queryString;
                $payload = []; // Kosongkan payload agar tidak dikirim dalam body
            }

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Basic ' . base64_encode($this->serverKey . ':')
            ])->$method($url, $payload);

            return $response->json();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}
