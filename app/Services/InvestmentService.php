<?php

namespace App\Services;

use App\Models\Account;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class InvestmentService
{
    private Authenticatable $user;
    private $account;

    public function __construct()
    {
        $this->user = Auth::user();
        $this->account = Account::where('user_uuid', $this->user['user_uuid'])->first();
    }

    public function create()
    {
        return $this->account;
    }

    public function store(): void
    {
        $this->account->investment_money = 0;

        DB::table('accounts')
            ->where('user_uuid', $this->user['user_uuid'])
            ->update(['investment_money' => $this->account->investment_money]);
    }

    public function receive(float $money = null): void
    {
        if ($this->account->money < $money) {
            throw ValidationException::withMessages([
                'receive_investment_money' => 'Sorry, but you do not have enough money to transfer.'
            ]);
        }
        if (empty($money)) {
            throw ValidationException::withMessages([
                'receive_investment_money' => 'No amount was specified.'
            ]);
        }
        $this->account->money -= $money;
        $this->account->investment_money += $money;

        DB::table('accounts')
            ->where('user_uuid', $this->user['user_uuid'])
            ->update(['investment_money' => $this->account->investment_money]);

        DB::table('accounts')
            ->where('user_uuid', $this->user['user_uuid'])
            ->update(['money' => $this->account->money]);
    }

    public function send(float $money = null): void
    {
        if ($this->account->investment_money < $money) {
            throw ValidationException::withMessages([
                'send_investment_money' => 'Sorry, but you do not have enough money to transfer.'
            ]);
        }
        if (empty($money)) {
            throw ValidationException::withMessages([
                'send_investment_money' => 'No amount was specified.'
            ]);
        }
        $this->account->money += $money;
        $this->account->investment_money -= $money;

        DB::table('accounts')
            ->where('user_uuid', $this->user['user_uuid'])
            ->update(['investment_money' => $this->account->investment_money]);

        DB::table('accounts')
            ->where('user_uuid', $this->user['user_uuid'])
            ->update(['money' => $this->account->money]);
    }
}
