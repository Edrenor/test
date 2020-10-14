<?php

namespace App\Http\Controllers\Wallet;

use App\Domain\Auth\Models\User;
use App\Domain\Transition\Commands\TransactionCommand;
use App\Domain\Wallet\Commands\AddFundsToWalletCommand;
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
        $this->dispatch(new AddFundsToWalletCommand($walletId, $funds));
        $this->dispatch(new TransactionCommand($userId, $walletId, $funds, 'enter'));

        return redirect()->route('home');
    }
}
