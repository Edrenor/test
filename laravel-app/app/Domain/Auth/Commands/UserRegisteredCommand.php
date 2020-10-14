<?php

namespace App\Domain\Auth\Commands;

use Illuminate\Console\Command;
use App\Models\Wallet;
use App\Domain\Auth\Models\User;

class UserRegisteredCommand extends Command
{

    private $userId;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    public function handle()
    {
        $user   = User::find($this->userId);
        $wallet = new Wallet();

        $wallet->user()->associate($user);
        $wallet->balance = 0;
        $wallet->save();
    }
}
