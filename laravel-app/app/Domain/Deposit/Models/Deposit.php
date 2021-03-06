<?php

namespace App\Domain\Deposit\Models;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    public $table = 'deposits';

    public function user()
    {
        return $this->belongsTo('App\Domain\Auth\Models\User');
    }

    public function wallet()
    {
        return $this->belongsTo('App\Domain\Wallet\Models\Wallet');
    }

}
