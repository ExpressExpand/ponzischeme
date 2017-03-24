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
	// TODO
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
	//ph minimum amount
	//TODO
	public static function checkForMinimumPHAmount($amount) {
		if($amount < 1000) {
			throw new MyCustomException("You cannot go below 1000");
		}
	}

	//matching begins
	public static function doExactMatch (array $ghs, array $phs, array $users) {
		echo "Finding exact match..............<br />";

		foreach($ghs as $gh_key => $gh) {
			$gh_name = $users[$gh['userID']];
            foreach($phs as $ph_key => $ph) {
            	$ph_name = $users[$ph['userID']];
            	echo "Matching PH ".$ph_name."(".$ph['amount'].") 
            		with GH ".$gh_name."(".$gh['amount'].")...<br />";


                if($gh == $ph) {
                    //match exists
                    echo "Match FOUND FOR  PH ".$ph_name."(".$ph['amount'].") 
            			with GH ".$gh_name."(".$gh['amount'].")...<br />";

            		//remove from the array
            		unset($phs[$ph_key]);
            		unset($ghs[$gh_key]);
            		//secondly update the donation:help table
            		$update_gh = DonationHelp::findOrFail($gh['id']);
            		$update_gh->status = DonationHelp::$SLIP_MATCHED;
            		$update_ph->matchDate = date('Y-m-d H:i:s', time());
            		$update_gh->save();

            		$update_ph = DonationHelp::findOrFail($ph['id']);
            		$update_ph->status = DonationHelp::$SLIP_MATCHED;
            		$update_ph->matchDate = date('Y-m-d H:i:s', time());
            		$update_ph->save();
                }
            }
        }
        return array($ghs, $phs);
	}

	public static function matchOneGHToTwoPH(array $ghs, array $phs, $users) {
		echo "Finding one gh to two ph..............<br />";
		$ph_count = count($phs);
		foreach ($ghs as $gh_key => $gh) {
			$gh_name = $users[$gh['userID']];
			for($i=0; $i<$ph_count; $i++){
				for($j=0; $j<count($phs); $j++) {
					$ph_name_one = $users[$phs[$i]['userID']];
					$ph_name_two = $users[$phs[$j]['userID']];
					if($i==$j) {
						continue;
					}
					$sum = $i+$j;
					if($gh == $sum) {
						echo "Matching GH ".$gh_name."(".$gh['amount'].") 
            				with PH ".$ph_name_one." and ".$ph_name_one."....<br />";
	            		
	            		//remove from the array
	            		unset($ghs[$gh_key]);
	            		unset($phs[$i]);
	            		unset($phs[$j]);
	            		//secondly update the donation:help table
	            		$update_gh = DonationHelp::findOrFail($gh['id']);
	            		$update_gh->status = DonationHelp::$SLIP_MATCHED;
	            		$update_ph->matchDate = date('Y-m-d H:i:s', time());
	            		$update_gh->save();

	            		$update_ph = DonationHelp::findOrFail($phs[$i]['id']);
	            		$update_ph->status = DonationHelp::$SLIP_MATCHED;
	            		$update_ph->matchDate = date('Y-m-d H:i:s', time());
	            		$update_ph->save();

	            		$update_ph = DonationHelp::findOrFail($phs[$j]['id']);
	            		$update_ph->status = DonationHelp::$SLIP_MATCHED;
	            		$update_ph->matchDate = date('Y-m-d H:i:s', time());
	            		$update_ph->save();
					}
				}
			}
		}
		return array($ghs, $phs);
	}

	public static function matchOnePHToTwoGH(array $ghs, array $phs, $users) {
		echo "Finding one ph to two gh..............<br />";
		$gh_count = count($ghs);
		foreach ($phs as $ph) {
			$ph_name = $users[$ph['userID']];
			for($i=0; $i<$gh_count; $i++){
				for($j=0; $j<count($ghs); $j++) {
					$gh_name_one = $users[$ghs[$i]['userID']];
					$gh_name_two = $users[$ghs[$j]['userID']];
					if($i==$j) {
						continue;
					}
					$sum = $i+$j;
					if($ph == $sum) {
						echo "Matching PH ".$ph_name."(".$ph['amount'].") 
            				with GH ".$gh_name_one." and ".$gh_name_two."....<br />";
						
						//remove from the array
	            		unset($phs[$ph_key]);
	            		unset($ghs[$i]);
	            		unset($ghs[$j]);

	            		//secondly update the donation:help table
	            		$update_ph = DonationHelp::findOrFail($ph['id']);
	            		$update_ph->status = DonationHelp::$SLIP_MATCHED;
	            		$update_ph->matchDate = date('Y-m-d H:i:s', time());
	            		$update_ph->save();

	            		$update_gh = DonationHelp::findOrFail($ghs[$i]['id']);
	            		$update_gh->status = DonationHelp::$SLIP_MATCHED;
	            		$update_ph->matchDate = date('Y-m-d H:i:s', time());
	            		$update_gh->save();

	            		$update_gh = DonationHelp::findOrFail($ghs[$j]['id']);
	            		$update_gh->status = DonationHelp::$SLIP_MATCHED;
	            		$update_ph->matchDate = date('Y-m-d H:i:s', time());
	            		$update_gh->save();
					}
				}
			}
		}
		return array($ghs, $phs);
	}
	public static function matchOneGHToTHREEPH(array $ghs, array $phs, $users) {
		echo "Finding one gh to three ph..............<br />";
		$ph_count = count($phs);
		foreach ($ghs as $gh) {
			$gh_name = $users[$gh['userID']];
			for($i=0; $i<$ph_count; $i++){
				for($j=0; $j<count($phs); $j++) {
					for($k=0; $k<count($phs); $k++) {
						if($i==$j || $i==$k || $j==$k){
							continue;
						}
						$ph_name_one = $users[$phs[$i]['userID']];
						$ph_name_two = $users[$phs[$j]['userID']];
						$ph_name_three = $users[$phs[$k]['userID']];
					
						$sum = $i+$j+$k;
						if($gh == $sum) {
							echo "Matching GH ".$gh_name."(".$gh['amount'].") 
	            				with PH ".$ph_name_one." and ".$ph_name_one." and ".$ph_name_three."....<br />";
							

							//remove from the array
		            		unset($ghs[$gh_key]);
		            		unset($phs[$i]);
		            		unset($phs[$j]);
		            		unset($phs[$k]);
		            		//secondly update the donation:help table
		            		$update_gh = DonationHelp::findOrFail($gh['id']);
		            		$update_gh->status = DonationHelp::$SLIP_MATCHED;
		            		$update_ph->matchDate = date('Y-m-d H:i:s', time());
		            		$update_gh->save();

		            		$update_ph = DonationHelp::findOrFail($phs[$i]['id']);
		            		$update_ph->status = DonationHelp::$SLIP_MATCHED;
		            		$update_ph->matchDate = date('Y-m-d H:i:s', time());
		            		$update_ph->save();

		            		$update_ph = DonationHelp::findOrFail($phs[$j]['id']);
		            		$update_ph->status = DonationHelp::$SLIP_MATCHED;
		            		$update_ph->matchDate = date('Y-m-d H:i:s', time());
		            		$update_ph->save();

		            		$update_ph = DonationHelp::findOrFail($phs[$k]['id']);
		            		$update_ph->status = DonationHelp::$SLIP_MATCHED;
		            		$update_ph->matchDate = date('Y-m-d H:i:s', time());
		            		$update_ph->save();
						}
					}
				}
			}
		}
		return array($ghs, $phs);
	}
	//one person pays three people
	public static function matchOnePHToTHREEGH(array $ghs, array $phs, $users) {
		echo "Finding one ph to three gh..............<br />";
		$gh_count = count($ghs);
		foreach ($phs as $ph) {
			$ph_name = $users[$ph['userID']];
			for($i=0; $i<$gh_count; $i++){
				for($j=0; $j<count($ghs); $j++) {
					for($k=0; $k<count($ghs); $k++) {
						if($i==$j || $i==$k || $j==$k){
							continue;
						}
						$gh_name_one = $users[$ghs[$i]['userID']];
						$gh_name_two = $users[$ghs[$j]['userID']];
						$gh_name_three = $users[$ghs[$k]['userID']];
					
						$sum = $i+$j+$k;
						if($ph == $sum) {
							echo "Matching PH ".$ph_name."(".$ph['amount'].") 
	            				with GH ".$gh_name_one." and ".$gh_name_one." and ".$gh_name_three."....<br />";
							
							//remove from the array
		            		unset($phs[$ph_key]);
		            		unset($ghs[$i]);
		            		unset($ghs[$j]);
		            		unset($ghs[$k]);

		            		//secondly update the donation:help table
		            		$update_ph = DonationHelp::findOrFail($ph['id']);
		            		$update_ph->status = DonationHelp::$SLIP_MATCHED;
		            		$update_ph->matchDate = date('Y-m-d H:i:s', time());
		            		$update_ph->save();

		            		$update_gh = DonationHelp::findOrFail($ghs[$i]['id']);
		            		$update_gh->status = DonationHelp::$SLIP_MATCHED;
		            		$update_ph->matchDate = date('Y-m-d H:i:s', time());
		            		$update_gh->save();

		            		$update_gh = DonationHelp::findOrFail($ghs[$j]['id']);
		            		$update_gh->status = DonationHelp::$SLIP_MATCHED;
		            		$update_ph->matchDate = date('Y-m-d H:i:s', time());
		            		$update_gh->save();
							
							$update_gh = DonationHelp::findOrFail($ghs[$k]['id']);
		            		$update_gh->status = DonationHelp::$SLIP_MATCHED;
		            		$update_ph->matchDate = date('Y-m-d H:i:s', time());
		            		$update_gh->save();
	            		}
					}
				}
			}
		}
		return array($ghs, $phs);
	}


}