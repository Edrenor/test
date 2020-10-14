<?php

namespace App\Domain\Auth\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function wallet()
    {
        return $this->hasOne('App\Models\Wallet');
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
