<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function deposits()
    {
        return $this->hasMany('App\Models\Deposit');
    }

    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction');
    }
}
