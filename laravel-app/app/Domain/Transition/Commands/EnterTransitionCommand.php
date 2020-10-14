<?php

namespace App\Domain\Transition\Commands;

use App\Domain\Auth\Models\User;
use App\Domain\Wallet\Models\Wallet;
use App\Models\Deposit;
use App\Domain\Transition\Models\Transaction;
use Illuminate\Console\Command;

class EnterTransitionCommand extends Command
{

    /** @var int */
    private $userId;

    /** @var int */
    private $walletId;

    /** @var int */
    private $amount;

    /** @var int|null */
    private $depositId;

    public function __construct(int $userId, int $walletId, int $amount, int $depositId = null)
    {
        $this->userId    = $userId;
        $this->walletId  = $walletId;
        $this->amount    = $amount;
        $this->depositId = $depositId;
    }

    public function handle()
    {
        $transition = new Transaction();
        $transition->wallet()->associate(Wallet::find($this->walletId));
        $transition->user()->associate(User::find($this->userId));
        if ($this->depositId) {
            $transition->deposit()->associate(Deposit::find($this->depositId));
        }
        $transition->type   = 'enter';
        $transition->amount = $this->amount;
        $transition->save();
    }
}
