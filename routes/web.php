<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CryptoController;
use App\Http\Controllers\InvestmentAccountController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TransferController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create']);
Route::post('/login', [SessionController::class, 'store']);

Route::post('/logout', [SessionController::class, 'destroy']);

Route::get('/pop-up', [AccountController::class, 'create']);
Route::post('/pop-up', [AccountController::class, 'store']);

Route::get('/home', [AccountController::class, 'show']);
Route::get('/account', [AccountController::class, 'redirectToAccount']);


Route::get('/transfer', [TransferController::class, 'create']);
Route::post('/transfer', [TransferController::class, 'send']);

Route::get('/crypto/available', [CryptoController::class, 'available']);
Route::get('/crypto', [CryptoController::class, 'create']);
Route::post('/crypto/buy', [CryptoController::class, 'buy']);
Route::post('/crypto/sell', [CryptoController::class, 'sell']);

Route::get('/investment', [InvestmentAccountController::class, 'create']);
Route::post('/investment', [InvestmentAccountController::class, 'store']);
Route::post('/investment/receive', [InvestmentAccountController::class, 'receive']);
Route::post('/investment/send', [InvestmentAccountController::class, 'send']);

