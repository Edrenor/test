<?php

namespace App\Domain\Wallet\Commands;

use App\Domain\Auth\Models\User;
use App\Domain\Transition\Models\Transaction;
use App\Domain\Wallet\Models\Wallet;
use App\Domain\Deposit\Models\Deposit;
use Illuminate\Console\Command;

class CreateDepositTransitionCommand extends Command
{

    /** @var int */
    private $userId;

    /** @var int */
    private $walletId;

    /** @var int */
    private $deposit;

    /** @var int */
    private $depositId;

    public function __construct(int $userId, int $walletId, int $deposit, int $depositId)
    {
        $this->userId    = $userId;
        $this->walletId  = $walletId;
        $this->deposit   = $deposit;
        $this->depositId = $depositId;
    }

    public function handle()
    {
        $transition = new Transaction();
        $transition->wallet()->associate(Wallet::find($this->walletId));
        $transition->user()->associate(User::find($this->userId));
        $transition->deposit()->associate(Deposit::find($this->depositId));
        $transition->type   = 'create_deposit';
        $transition->amount = $this->deposit;
        $transition->save();
    }
}
