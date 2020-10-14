<?php

namespace App\Domain\Transition\Commands;

use App\Domain\Auth\Models\User;
use App\Domain\Wallet\Models\Wallet;
use App\Domain\Deposit\Models\Deposit;
use App\Domain\Transition\Models\Transaction;
use Illuminate\Console\Command;

class TransactionCommand extends Command
{

    protected $signature = 'transaction';

    /** @var int */
    private $userId;

    /** @var int */
    private $walletId;

    /** @var int */
    private $amount;

    /** @var string */
    private $type;

    /** @var int|null */
    private $depositId;

    public function __construct(int $userId, int $walletId, int $amount, string $type, int $depositId = null)
    {
        parent::__construct();
        $this->userId    = $userId;
        $this->walletId  = $walletId;
        $this->amount    = $amount;
        $this->type      = $type;
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
        $transition->type   = $this->type;
        $transition->amount = $this->amount;
        $transition->save();
    }
}
