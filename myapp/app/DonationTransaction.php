<?php

namespace App;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class DonationTransaction extends Model
{
    protected $table = 'donation_help_transactions';
    protected $fillable = array(
    	'donationHelpID', 'collectionHelpID', 'recipientUserID', 'payerUserID', 
    	'receiverConfirmed', 'amount',
    	'payerConfirmed', 'filename', 
    	'fileHash', 'penaltyDate', 'matchDate', 'fakePOP', 'isDefaulted',
    );
    public function donation() {
    	return $this->belongsTo('App\DonationHelp', 'donationHelpID');
    }
    public function collection(){
        return $this->belongsTo('App\DonationHelp', 'collectionHelpID');
    }
   
    protected function getPenaltyDateAttribute($value) {
        return date('d-M-Y h:i:sa', $value);
    }
    protected function getMatchDateAttribute($value) {
        return date('d-M-Y h:i:sa', $value);
    }
}
