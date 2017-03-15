<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;

class DonationHelp extends Model
{
	static $SLIP_PENDING = 'pending'; //immediately creating a ph/GH
	static $SLIP_MATCHED = 'matched'; //after 3weeks for ph and after 30days for gh;
	static $SLIP_CONFIRMED = 'confirmed'; //payment has been made for ph
	static $SLIP_WITHDRAWAL = 'withdrawn'; //payment was withdrawn for gh
	static $SLIP_NONACTIVE = 'non-active'; //after payment has been made either ph/gh
	static $SLIP_CANCELLED = 'cancelled'; //users cancelling a ph/gh request
	static $SLIP_ELAPSED = 'elapsed'; //after the set time has elapsed

	protected $table = 'donation_helps';
    protected $fillable = array('paymentType', 'amount', 'phGh', 'isConfirmed', 'userID', 'status');
 
}
