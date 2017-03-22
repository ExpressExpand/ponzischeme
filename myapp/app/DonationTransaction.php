<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DonationTransaction extends Model
{
    protected $table = 'donation_help_transactions';
    protected $fillable = array(
    	'donationHelpID', 'recipientUserID', 'payerUserID', 
    	'receiverConfirmed', 'amount',
    	'payerConfirmed', 'filename', 
    	'fileHash', 'penaltyDate', 'matchDate', 'fakePOP'
    );
    public function donation() {
    	return $this->belongsTo('App\DonationHelp', 'donationHelpID');
    }
}
