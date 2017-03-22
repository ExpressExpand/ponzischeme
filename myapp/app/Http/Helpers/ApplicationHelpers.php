<?php 
namespace app\Http\Helpers;
use App\DonationHelp;

use App\Http\Helpers\ApplicationHelpers;
use App\Http\Helpers\MyCustomException;


final class ApplicationHelpers {
	public static function usersCantGoBelowPHAmountChecks($amount, $user) {
		$donations = array();
		// $donations = DonationHelp::where(['userID' => $user->id, 'phGh' => 'ph'])->get();
		$donations = DonationHelp::where(['userID' => $user->id, 'phGh' => 'ph'])
		->where(function($query) {
			$query->orWhere('status', 'confirmed')
			->orWhere('status', 'matched')
			->orWhere('status', 'pending')
			->orWhere('status', 'withdrawn');
		})->get()->pluck('amount')->toArray();
		if(count($donations) > 0) {
			//determine the largest amount
			$highest = max($donations);
			if($amount < $highest) {
				throw new MyCustomException('You cannot go below your last ph. Ensure you put an amount 
					that is equal or greater than '.$highest);
			}
		}		
	}
	public static function checkForActivePh($user) {
		$donations = array();
		$donations = DonationHelp::where(['userID' => $user->id, 'phGh' => 'ph'
			, 'status' => 'confirmed'])
		->get()->toArray();
		if(count($donations) == 0) {
			throw new MyCustomException("You need to first Provide Help before you 
				can Get Help", 1);
		}
	}
	public static function checkForExistingGh ($user) {
		$donations = array();
		$donations = DonationHelp::where(['userID' => $user->id, 'phGh' => 'gh'
			, 'status' => DonationHelp::$SLIP_PENDING])
		->get()->toArray();
		if(count($donations) > 0) {
			throw new MyCustomException("You cannot create more than one
			 existing GH Request", 1);
		}
	}
	public static function checkForGhEligibility($user, $amount) {
		$donations = array();
		$donations = DonationHelp::where(['userID' => $user->id, 'phGh' => 'ph'])
			->where( function($query) {
				$query->where('status', DonationHelp::$SLIP_CONFIRMED)
				->orWhere('status', DonationHelp::$SLIP_PARTIALWITHDRAWAL);
			})->pluck('amount')->toArray();
		//add the referral to the donation_amount
		$donation_amount = array_sum($donations);

		//TODO:://check for confirmed referral amount before user can withdraw

		if(count($donation == 0)) {
			throw new MyCustomException("Sorry you are not eligible to withdraw.
			 Make sure you PH and you PH are confrimed before you can withdraw", 1);
		}elseif($donation_amount < $amount){
			throw new MyCustomException("Your GH amount exceeds the overall amount you can GH", 1);
		}
	}
	public static function bonuses() {
		$bonus = array(
			'16000' => 10000
		);
	}
	public static function checkForMutilplesOfTen($amount){
		if($amount % 10 !== 0){
			throw new MyCustomException('The amount must be in multiples of 10');
		}
	}

	//matching begins
	public static function doExactMatch ($ghs, $phs) {
		echo "Finding exact match..............<br />";
		foreach($ghs as $gh) {
            foreach($phs as $ph) {
            	echo "Matching PH".$ph->user->name."(".$ph->amount.") with GH ".$gh->user->name."(".$gh->amount.")...<br />";
                if($gh == $ph) {
                    //match exists
                    var_dump('exact match');
                }
            }
        }
	}
	public static function matchOneGHToTwoPH($ghs, $phs) {
		echo "Finding one gh to two ph..............<br />";
		// foreach($ghs as $gh) {
		// 	for($i=0;$i<)
		// }

	}

}