<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'bankName', 'accountNumber', 'accountName', 'isBonusCollected',
        'bitcoinAddress', 'avatar', 'relatedCountryID', 'points', 'isBlocked', 'ip', 'referrerUsername'
        , 'bonusAmount'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function country() {
        return $this->belongsTo('App\Country', 'relatedCountryID');
    }

    public function donations() {
        return $this->hasMany('App\DonationHelp', 'userID');
    }


}
