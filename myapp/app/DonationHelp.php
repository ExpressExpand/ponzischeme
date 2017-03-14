<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DonationHelp extends Model
{
    protected $fillable = array('paymentType', 'amount', 'phGh', 'isConfirmed', 'userID');
    
}
