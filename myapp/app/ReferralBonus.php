<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReferralBonus extends Model
{
    protected $table = 'referral_bonus';
    protected $fillable = array('userID', 'amount', 'donationHelpID');

   	public function donation() {
   		return $this->belongsTo('DonationTransaction', 'donationHelpID');
   	}
}
