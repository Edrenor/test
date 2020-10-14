<?php

namespace App\Http\Controllers\Deposit;

use App\Domain\Auth\Models\User;
use App\Domain\Deposit\Commands\CreateDepositCommand;
use App\Domain\Transaction\Commands\TransactionCommand;
use App\Http\Controllers\Controller;
use App\Domain\Deposit\Requests\AddDepositRequest;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;
use Exception;

class DepositController extends Controller
{

    public function createDeposit(AddDepositRequest $request)
    {
        $deposit   = $request->request->get('deposit');
        $userId    = Auth::user()->getAuthIdentifier();
        $walletId  = User::find($userId)->wallet->id;
        $depositId = $this->dispatch(new CreateDepositCommand($walletId, $deposit));
        $this->dispatch(new TransactionCommand($userId, $walletId, $deposit, 'create_deposit', $depositId));

        return redirect()->route('home');
    }
}
