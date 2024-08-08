<?php

namespace App\Api;


use Dotenv\Dotenv;

class ExchangeRateApi
{
    protected string $api;

    public function __construct()
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../..');
        $dotenv->load();
        $this->api = $_ENV['MY_EXCHANGE_RATE_API'];
    }

    public function getResponse(string $userCurrency = 'USD'): array
    {
        $request = "https://v6.exchangerate-api.com/v6/{$this->api}/latest/{$userCurrency}";
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $request,
            CURLOPT_RETURNTRANSFER => true,
        ]);
        $response = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($response, true);

        $currencies = [];
        foreach ($data['conversion_rates'] as $currency => $rate) {
            $currencies[] = [
                'currency' => $currency,
                'rate' => $rate,
            ];
        }

        return $currencies;
    }
}
