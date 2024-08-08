<?php

namespace App\Services;

use App\Api\CryptoCoinMC;
use App\Models\Account;
use App\Models\Crypto;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CryptoService
{
    private CryptoCoinMc $crypto;
    private array $cryptoCurrencies;
    private Authenticatable $user;
    private $account;

    public function __construct()
    {
        $this->crypto = new CryptoCoinMC();
        $this->cryptoCurrencies = $this->crypto->getResponse();
        $this->user = Auth::user();
        $this->account = Account::where('user_uuid', $this->user['user_uuid'])->firstOrFail();
    }

    public function create(): array
    {
        $ownedCrypto = Crypto::where('user_uuid', $this->user['user_uuid'])->get();
        $tableUpdate = [];
        foreach ($ownedCrypto as $owned) {
            $priceNow = null;
            foreach ($this->cryptoCurrencies as $c) {
                if ($c['name'] == $owned->crypto_name) {
                    $priceNow = $c['price'];
                    break;
                }
            }
            $profit = $priceNow - $owned->purchase_price;
            $percentage = ($profit / $owned->purchase_price) * 100;
            $tableUpdate[] = [
                'crypto_name' => $owned->crypto_name,
                'amount' => $owned->amount,
                'purchase_price' => $owned->purchase_price,
                'priceNow' => $priceNow,
                'profit' => $profit,
                'percentage' => $percentage
            ];
        }
        return [
            'crypto' => $this->cryptoCurrencies,
            'account' => $this->account,
            'ownedCrypto' => $ownedCrypto,
            'tableUpdate' => $tableUpdate
        ];
    }

    public function buy(string $userCrypto, float $userAmount = null): void
    {
        if (empty($userAmount)) {
            throw ValidationException::withMessages([
                'crypto_amount' => 'No amount was specified.'
            ]);
        }
        $price = null;
        foreach ($this->cryptoCurrencies as $cryptoCurrency) {
            if ($cryptoCurrency['name'] === $userCrypto) {
                $price = $cryptoCurrency['price'];
                break;
            }
        }
        $money = $price * $userAmount;
        if ($this->account->investment_money < $money) {
            throw ValidationException::withMessages([
                'crypto_buy' => 'Sorry, but you do not have enough money.'
            ]);
        }
        $updated_investment_money = $this->account->investment_money - $money;
        DB::table('accounts')
            ->where('user_uuid', $this->user['user_uuid'])
            ->update(['investment_money' => $updated_investment_money]);

        $attributes = [
            'user_uuid' => $this->user['user_uuid'],
            'crypto_name' => $userCrypto,
            'amount' => $userAmount,
            'purchase_price' => $price,
        ];
        Crypto::create($attributes);
    }

    public function sell(int $cryptoId): void
    {
        $cryptoData = Crypto::where('id', $cryptoId)->first();
        $amount = $cryptoData->amount;
        $name = $cryptoData->crypto_name;
        foreach ($this->cryptoCurrencies as $cryptoCurrency) {
            if ($cryptoCurrency['name'] === $name) {
                $price = $cryptoCurrency['price'];
                break;
            }
        }
        $money = $price * $amount;
        $updated_investment_money = $this->account->investment_money + $money;
        DB::table('accounts')
            ->where('user_uuid', $this->user['user_uuid'])
            ->update(['investment_money' => $updated_investment_money]);
        $cryptoData->delete();
    }

    public function available(): array
    {
        $cryptoCurrencies = $this->crypto->getResponse();
        return $cryptoCurrencies;
    }
}
