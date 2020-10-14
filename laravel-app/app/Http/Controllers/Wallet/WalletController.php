<?php

namespace App\Http\Controllers\Wallet;

use App\Domain\Auth\Models\User;
use App\Domain\Transition\Commands\EnterTransitionCommand;
use App\Domain\Wallet\Commands\AddFundsToWallet;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;

class WalletController extends Controller
{

    public function addFunds(Request $request)
    {
        $funds    = $request->request->get('funds');
        $userId   = Auth::user()->getAuthIdentifier();
        $walletId = User::find($userId)->wallet->id;
        $this->dispatch(new AddFundsToWallet($walletId, $funds));
        $this->dispatch(new EnterTransitionCommand($userId, $walletId, $funds));

        return redirect()->route('home');
    }
}