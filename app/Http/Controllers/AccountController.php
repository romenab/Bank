<?php

namespace App\Http\Controllers;

use App\Api\ExchangeRateApi;
use App\Models\Account;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;


class AccountController extends Controller
{
    private Authenticatable $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function create()
    {
        $exchangeRateApi = new ExchangeRateApi();
        $currencies = $exchangeRateApi->getResponse();
        return view('account.pop-up-box', ['user' => $this->user, 'currencies' => $currencies]);
    }

    public function store()
    {
        $faker = \Faker\Factory::create();
        $attributes = [
            'user_uuid' => $this->user['user_uuid'],
            'currency' => request('currency'),
            'account_number' => $faker->creditCardNumber(),
            'money' => $faker->numberBetween(1000, 100000),
        ];
        Account::create($attributes);
        return redirect('/home');
    }

    public function show()
    {
        $account = Account::where('user_uuid', $this->user['user_uuid'])->first();
        return view('account.home', ['user' => $this->user, 'account' => $account]);
    }

    public function redirectToAccount()
    {
        $accountType = request('account');
        return redirect($accountType == 'investment' ? '/investment' : '/home');
    }
}
