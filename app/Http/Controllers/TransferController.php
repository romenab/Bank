<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Services\TransferService;
use Illuminate\Support\Facades\Auth;

class TransferController
{
    public function create()
    {
        $user = Auth::user();
        $account = Account::where('user_uuid', $user['user_uuid'])->first();
        return view('account.money-transfer', ['account' => $account]);
    }

    public function send()
    {
        $validated = request()->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'account_number' => ['required'],
            'money' => ['required', 'numeric'],
        ]);
        $transfer = new TransferService();
        $transfer->send($validated);
        return redirect('/transfer')->with('success', 'Transfer successful!');
    }
}
