<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    protected $fillable = array('relatedReferrerUserID', 'relatedReferralUserID', 'level');
}
