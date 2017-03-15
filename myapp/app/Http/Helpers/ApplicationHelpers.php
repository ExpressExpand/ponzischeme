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
				throw new exception('You cannot go below your last ph. Ensure you put an amount 
					that is equal or greater than '.$highest);
			}
		}		
	}
	public static function checkForActivePh($user) {
		$donations = array();
		$donations = DonationHelp::where(['userID' => $user->id, 'phGh' => 'ph', 'status' => 'confirmed'])
		->get()->toArray();
		if(count($donations) == 0) {
			throw new MyCustomException("You need to first Provide Help before you can Get Help", 1);
		}
		return $this;
	}
	public static function bonuses() {
		$bonus = array(
			'16000' => 10000
		);
	}
}