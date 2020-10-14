<?php

namespace App\Domain\Wallet\Commands;

use App\Domain\Wallet\Models\Wallet;
use Illuminate\Console\Command;

class AddFundsToWalletCommand extends Command
{

    /** @var int */
    private $walletId;

    /** @var int */
    private $funds;

    public function __construct(int $walletId, int $funds)
    {
        $this->walletId = $walletId;
        $this->funds    = $funds;
    }

    public function handle()
    {
        /** @var Wallet $wallet */
        $wallet          = Wallet::find($this->walletId);
        $wallet->balance += $this->funds;
        $wallet->save();
    }
}
