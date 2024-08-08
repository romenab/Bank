<?php

namespace App\Http\Controllers;

use App\Services\CryptoService;


class CryptoController extends Controller
{
    private CryptoService $cryptoService;

    public function __construct()
    {
        $this->cryptoService = new CryptoService();
    }

    public function create()
    {
        $cryptoData = $this->cryptoService->create();
        return view('account.crypto', $cryptoData);
    }

    public function buy()
    {
        $userCrypto = request('crypto_buy');
        $userAmount = request('crypto_amount');
        $this->cryptoService->buy($userCrypto, $userAmount);
        return redirect('/crypto')->with('purchased', 'Purchased successfully!');
    }

    public function sell()
    {
        $cryptoId = request('crypto_sell');
        $this->cryptoService->sell($cryptoId);
        return redirect('/crypto')->with('sold', 'Sold successfully!');
    }

    public function available()
    {
        $cryptoCurrencies = $this->cryptoService->available();
        return view('account.available-crypto', ['currencies' => $cryptoCurrencies]);
    }
}
