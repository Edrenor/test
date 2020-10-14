<?php

namespace App\Domain\Deposit\Commands;

use App\Domain\Wallet\Models\Wallet;
use Illuminate\Console\Command;
use Exception;

class CreateDepositCommand extends Command
{

    /** @var int */
    private $walletId;

    /** @var int */
    private $deposit;

    public function __construct(int $walletId, $deposit)
    {
        $this->walletId = $walletId;
        $this->deposit  = $deposit;
    }

    /**
     * @throws Exception
     */
    public function handle()
    {
        /** @var Wallet $wallet */
        $wallet = Wallet::find($this->walletId);

        if ($wallet->balance-$this->deposit < 0){
            throw new Exception('Недостаточно денег на счету');
        }
        $wallet->balance -= $this->deposit;

        $wallet->save();
        return $wallet->id;
    }
}