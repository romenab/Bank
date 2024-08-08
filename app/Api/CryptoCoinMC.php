<?php

namespace App\Api;

use Dotenv\Dotenv;

class CryptoCoinMC
{
    protected string $api;

    public function __construct()
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../..');
        $dotenv->load();
        $this->api = $_ENV['MY_CRYPTO_API'];
    }

    public function getResponse(): array
    {
        $parameters = [
            'start' => '1',
            'limit' => '100',
            'convert' => 'USD'
        ];

        $headers = [
            'Accepts: application/json',
            'X-CMC_PRO_API_KEY: ' . $this->api,
        ];
        $qs = http_build_query($parameters);
        $request = "https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest?$qs";


        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $request,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_RETURNTRANSFER => 1
        ]);

        $response = curl_exec($curl);
        $data = json_decode($response);
        $currencies = [];
        foreach ($data->data as $currency) {
            $currencies[] = [
                'name' => $currency->name,
                'symbol' => $currency->symbol,
                'price' => $currency->quote->USD->price,
                'percent_one' => $currency->quote->USD->percent_change_1h,
                'percent_twenty_four' => $currency->quote->USD->percent_change_24h,
                'percent_seven' => $currency->quote->USD->percent_change_7d,
                'market_cap' => $currency->quote->USD->market_cap
            ];
        }
        curl_close($curl);
        return $currencies;
    }
}
