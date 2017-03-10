<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
        , 'phone', 'isBlocked', 'bankName', 'bankAccountName', 'bankAccountNumber'
        , 'bitCoinAddress', 'avatar', 'relatedCountryID', 'credibilityScore',
    ];
    public function country() {
        $this->belongsTo('App\Country', 'relatedCountryID');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
