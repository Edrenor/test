<?php

namespace App\Models;

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
        return $this->belongsTo('App\Models\Wallet');
    }

}
