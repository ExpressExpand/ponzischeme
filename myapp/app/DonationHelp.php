<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DonationHelp extends Model
{
	const SLIP_ACTIVE = 'active'; //immediately creating a ph/GH
	const SLIP_MATCHED = 'matched'; //after 3weeks for ph and after 30days for gh;
	const SLIP_NONACTIVE = 'non-active'; //after payment has been made either ph/gh
	const SLIP_CANCELLED = 'cancelled'; //users cancelling a ph/gh request
	const SLIP_ELAPSED = 'elapsed'; //after the set time has elapsed

	protected $table = 'donation_helps';
    protected $fillable = array('paymentType', 'amount', 'phGh', 'isConfirmed', 'userID', 'status');
    
}
