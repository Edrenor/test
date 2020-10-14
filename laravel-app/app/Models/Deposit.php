<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function wallet()
    {
        return $this->belongsTo('App\Models\Wallet');
    }

}
