<?php

namespace App\Console\Commands;

use App\Domain\Deposit\Models\Deposit;
use App\Domain\Transaction\Commands\TransactionCommand;
use App\Domain\Wallet\Commands\AddFundsToWalletCommand;
use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesJobs;

class AccrualFundsToDeposit extends Command
{

    use DispatchesJobs;
    protected $signature = 'accrual-funds-command';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        while (true) {
            $deposits = Deposit::where('active', 1)->get();
            /** @var Deposit $deposit */
            foreach ($deposits as $deposit) {
                $profit = $deposit->invested * $deposit->percent;

                $this->dispatch(new AddFundsToWalletCommand($deposit->wallet->id, $profit));
                $deposit->accrue_times += 1;
                $deposit->profit += $profit;
                $this->dispatch(new TransactionCommand($deposit->user->id,
                    $deposit->wallet->id,
                    $profit,
                    'accrue',
                    $deposit->id
                )
                );

                if ($deposit->accrue_times == 10) {
                    $deposit->active = 0;
                    $this->dispatch(new TransactionCommand($deposit->user->id,
                            $deposit->wallet->id,
                            $profit,
                            'close_deposit',
                            $deposit->id
                        )
                    );
                }
                $deposit->save();
            }
            sleep(60);

        }
    }
}
