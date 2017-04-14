<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReferralBonus extends Model
{
    protected $table = 'referral_bonus';
    protected $fillable = array('userID', 'amount', 'donationTransactionID');

   	public function transaction() {
   		return $this->belongsTo('DonationTransaction', 'donationTransactionID');
   	}
}
