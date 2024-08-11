<?php

namespace App\Services;

use App\Api\ExchangeRateApi;
use App\Models\Account;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TransferService
{
    public function send(array $validated): void
    {
        $userMoney = $validated['money'];
        $recipient = User::where('first_name', $validated['first_name'])
            ->where('last_name', $validated['last_name'])
            ->first();

        $recipientAccount = Account::where('user_uuid', $recipient->user_uuid)
            ->where('account_number', $validated['account_number'])
            ->first();

        if (!$recipientAccount) {
            throw ValidationException::withMessages([
                'first_name' => 'Sorry, but such recipient account does not exist.'
            ]);
        }
        $user = Auth::user();
        $userAccount = Account::where('user_uuid', $user['user_uuid'])->first();

        if ($userAccount['money'] < $validated['money']) {
            throw ValidationException::withMessages([
                'first_name' => 'Sorry, but you do not have enough money to transfer.'
            ]);
        }
        $userAccount->money -= $validated['money'];

        if ($userAccount->currency == $recipientAccount->currency) {
            $recipientAccount->money += $validated['money'];
        }

        if ($userAccount->currency != $recipientAccount->currency) {
            $exchangeRateApi = new ExchangeRateApi();
            $currencies = $exchangeRateApi->getResponse($userAccount->currency);

            foreach ($currencies as $currency) {
                if ($currency['currency'] == $recipientAccount->currency) {
                    $rate = $currency['rate'];
                    $validated['money'] *= $rate;
                    $recipientAccount->money += $validated['money'];
                    break;
                }
            }
        }

        DB::table('accounts')
            ->where('user_uuid', $userAccount->user_uuid)
            ->update(['money' => $userAccount->money]);

        DB::table('accounts')
            ->where('user_uuid', $recipientAccount->user_uuid)
            ->update(['money' => $recipientAccount->money]);

        DB::table('transactions')->insert([
            'sender_uuid' => $userAccount->user_uuid,
            'receiver_uuid' => $recipientAccount->user_uuid,
            'sender_money' => $userMoney,
            'receiver_money' => $validated['money'],
            'created_at' => now(),
        ]);

    }
}
