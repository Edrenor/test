<?php

namespace App\Domain\Transaction\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public $table = 'transactions';

    public function user()
    {
        return $this->belongsTo('App\Domain\Auth\Models\User');
    }

    public function wallet()
    {
        return $this->belongsTo('App\Domain\Wallet\Models\Wallet');
    }

    public function deposit()
    {
        return $this->belongsTo('App\Domain\Deposit\Models\Deposit');
    }

}
