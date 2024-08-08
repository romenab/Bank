<?php

namespace App\Http\Controllers;

use App\Services\InvestmentService;


class InvestmentAccountController extends Controller
{
    public function create()
    {
        $investment = new InvestmentService();
        $account = $investment->create();
        return view('account.investment', ['account' => $account]);
    }

    public function store()
    {
        $investment = new InvestmentService();
        $investment->store();
        return redirect('/investment');
    }

    public function receive()
    {
        $money = request('receive_investment_money');
        $investment = new InvestmentService();
        $investment->receive($money);
        return redirect('/investment');
    }

    public function send()
    {
        $money = request('send_investment_money');
        $investment = new InvestmentService();
        $investment->send($money);
        return redirect('/investment');
    }
}
