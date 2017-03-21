<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    protected $fillable = array('relatedReferrerUserID', 'relatedReferralUserID', 'level');

    public function owner() {
    	return $this->belongsTo('App\User', 'relatedReferrerUserID');
    }
    public function member() {
    	return $this->belongsTo('App\User', 'relatedReferralUserID');
    }
}
