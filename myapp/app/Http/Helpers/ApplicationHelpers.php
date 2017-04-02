<?php 
namespace app\Http\Helpers;
use App\DonationHelp;

use App\Http\Helpers\ApplicationHelpers;
use App\Http\Helpers\MyCustomException;
use App\DonationTransaction;

final class ApplicationHelpers {
	public static function usersCantGoBelowPHAmountChecks($amount, $user) {
		$donations = array();
		// $donations = DonationHelp::where(['userID' => $user->id, 'phGh' => 'ph'])->get();
		$donations = DonationHelp::where(['userID' => $user->id, 'phGh' => 'ph'])
		->where(function($query) {
			$query->orWhere('status', 'confirmed')
			->orWhere('status', 'matched')
			->orWhere('status', 'pending');
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
	public static function getPointColor($points) {
		if($points > 50) {
			return '#00ceae';
		}elseif($points < 50) {
			return '#DC143C';
		}else{
			return '#F0E68C';
		}
	}
	public static function getCurrentBitcoinRate(){
		$ch = curl_init();
        //SETUUP URL
        curl_setopt($ch, CURLOPT_URL, "http://api.coindesk.com/v1/bpi/currentprice.json");
        // curl_setopt( $ch, CURLOPT_POST, true );
        // curl_setopt( $ch, CURLOPT_HTTPHEADER, $this->getHeaders());
        // curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $response = json_decode(curl_exec($ch)); 
        // $code = curl_getinfo($ch);
        // Close connection
        curl_close($ch);
        $rate = $response->bpi->USD->rate;
        $rate = (float) str_replace(',','', $rate);
        //convert to dollars
        $dollar = 1 / $rate;
        $dollar = number_format($dollar, 8, '.','');
        return $dollar;
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
	public static function checkForExistingPh ($user) {
		$donations = array();
		$donations = DonationHelp::where(['userID' => $user->id, 'phGh' => 'ph'])
			->where(function($query) {
				$query->where('status',  DonationHelp::$SLIP_PENDING)
				->orWhere('status', DonationHelp::$SLIP_MATCHED);
			})->get()->toArray();
		if(count($donations) > 0) {
			throw new MyCustomException("Your existing pending/match PH has to be
			 confirmed before you can create another", 1);
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
	private static function getCalculatedHours() {
		//get the week day from the  current date full character
		$day = date('l', time());
		switch(strtolower($day)) {
			case 'thursday':
				//convert 4 days to hours
				$hours = 96;
			break;
			case 'friday':
				$hours = 120;
			break;
			case 'saturday':
				$hours = 72;
			break;
			default:
				$hours = 48;
			break;
		}
		return $hours;
	}
	private static function processPenaltyDate(){
		$date = new \DateTime("now");
		$date->setTime(23, 59);
		$timestamp = $date->getTimestamp();
		$hours = self::getCalculatedHours();
		//add the hours to current date
		$penalty_date = $timestamp + ($hours * 60 * 60);
		return $penalty_date;
	}
	private static function createTransactionForMatchedRequests($donation_id, $collection_id,
		 $amount) {
		$penalty_date = self::processPenaltyDate();
		$transaction = new DonationTransaction();
		$transaction->donationHelpID = $donation_id;
		$transaction->collectionHelpID = $collection_id;
		$transaction->recipientUserID = '';
		$transaction->payerUserID = '';
		$transaction->amount = $amount;
		$transaction->filename = '';
		$transaction->fileHash = '';
		$transaction->penaltyDate = $penalty_date;
		$transaction->matchDate = time();
		$transaction->save();
	}
	//matching begins
	public static function doExactMatch (array $ghs, array $phs, array $users) {
		echo "Finding exact match..............<br />";

		foreach($ghs as $gh_key => $gh) {
			$gh_name = $users[$gh['userID']];
            foreach($phs as $ph_key => $ph) {
            	$ph_name = $users[$ph['userID']];
            	
                if($gh['amount'] == $ph['amount']) {
                	echo "Matching PH ".$ph_name."(".$ph['amount'].") 
            		with GH ".$gh_name."(".$gh['amount'].")...<br />";
                	//check that u dont match a user to himself
                	if($ph['userID'] == $gh['userID']) {
                		continue;
                	}
                    //match exists
                    echo "Match FOUND FOR  PH ".$ph_name."(".$ph['amount'].") 
            			with GH ".$gh_name."(".$gh['amount'].")...<br />";

            		
            		//secondly update the donation:help table
            		$update_gh = DonationHelp::findOrFail($gh['id']);
            		$update_gh->status = DonationHelp::$SLIP_MATCHED;
            		$update_gh->matchDate = date('Y-m-d H:i:s', time());
            		$update_gh->save();
            		// self::createTransactionForMatchedRequests($update_gh->id
            		// 	, $gh['userID'], $ph['userID'], $gh['amount']);

            		$update_ph = DonationHelp::findOrFail($ph['id']);
            		$update_ph->status = DonationHelp::$SLIP_MATCHED;
            		$update_ph->matchDate = date('Y-m-d H:i:s', time());
            		$update_ph->save();
            		self::createTransactionForMatchedRequests($update_ph->id, $update_gh->id
            			// , $gh['userID'], $ph['userID']
            			, $gh['amount']);

            		//remove from the array
            		unset($phs[$ph_key]);
            		unset($ghs[$gh_key]);
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
					if(!array_key_exists($i, $phs) || !array_key_exists($j, $phs)) {
						continue;
					}
					$ph_name_one = $users[$phs[$i]['userID']];
					$ph_name_two = $users[$phs[$j]['userID']];
					if($i==$j) {
						continue;
					}
					$sum = $phs[$i]['amount'] + $phs[$j]['amount'];
					if($gh['amount'] == $sum) {
						//check that u dont match a user to himself
	                	if($phs[$i]['userID'] == $gh['userID'] || $phs[$j]['userID'] == $gh['userID']) {
	                		continue;
	                	}
						echo "Matching GH ".$gh_name."(".$gh['amount'].") 
            				with PH ".$ph_name_one.$phs[$i]['amount'].
            				" and ".$ph_name_two.$phs[$j]['amount']."....<br />";
	            		
	            	
	            		//secondly update the donation:help table
	            		$update_gh = DonationHelp::findOrFail($gh['id']);
	            		$update_gh->status = DonationHelp::$SLIP_MATCHED;
	            		$update_gh->matchDate = date('Y-m-d H:i:s', time());
	            		$update_gh->save();
	            		
	            		// self::createTransactionForMatchedRequests($update_gh->id
            			// , $gh['userID'], $phs[$i]['userID'], $phs[$i]['amount']);
            			// self::createTransactionForMatchedRequests($update_gh->id
            			// , $gh['userID'], $phs[$j]['userID'], $phs[$j]['amount']);

	            		$update_ph = DonationHelp::findOrFail($phs[$i]['id']);
	            		$update_ph->status = DonationHelp::$SLIP_MATCHED;
	            		$update_ph->matchDate = date('Y-m-d H:i:s', time());
	            		$update_ph->save();

	            		self::createTransactionForMatchedRequests($update_ph->id, $update_gh->id
            			// , $gh['userID'], $phs[$i]['userID']
            			, $phs[$i]['amount']);

	            		$update_ph = DonationHelp::findOrFail($phs[$j]['id']);
	            		$update_ph->status = DonationHelp::$SLIP_MATCHED;
	            		$update_ph->matchDate = date('Y-m-d H:i:s', time());
	            		$update_ph->save();

	            		
            			self::createTransactionForMatchedRequests($update_ph->id, $update_gh->id
            			// , $gh['userID'], $phs[$j]['userID']
            			, $phs[$j]['amount']);

	            		//remove from the array
	            		unset($ghs[$gh_key]);
	            		unset($phs[$i]);
	            		unset($phs[$j]);
					}
				}
			}
		}
		return array($ghs, $phs);
	}

	public static function matchOnePHToTwoGH(array $ghs, array $phs, $users) {
		echo "Finding one ph to two gh..............<br />";
		$gh_count = count($ghs);
		foreach ($phs as $ph_key => $ph) {
			$ph_name = $users[$ph['userID']];
			for($i=0; $i<$gh_count; $i++){
				for($j=0; $j<count($ghs); $j++) {
					if(!array_key_exists($i, $ghs) || !array_key_exists($j, $ghs)) {
						continue;
					}
					$gh_name_one = $users[$ghs[$i]['userID']];
					$gh_name_two = $users[$ghs[$j]['userID']];
					if($i==$j) {
						continue;
					}
					$sum = $ghs[$i]['amount'] + $ghs[$j]['amount'];
					if($ph['amount'] == $sum) {
						//check that u dont match a user to himself
	                	if($ghs[$i]['userID'] == $ph['userID'] || $ghs[$j]['userID'] == $ph['userID']) {
	                		continue;
	                	}
						echo "Matching PH ".$ph_name."(".$ph['amount'].") 
            				with GH ".$gh_name_one." and ".$gh_name_two."....<br />";
						
						
	            		//secondly update the donation:help table
	            		$update_ph = DonationHelp::findOrFail($ph['id']);
	            		$update_ph->status = DonationHelp::$SLIP_MATCHED;
	            		$update_ph->matchDate = date('Y-m-d H:i:s', time());
	            		$update_ph->save();

	            		// self::createTransactionForMatchedRequests($update_ph->id
            			// , $ghs[$i]['userID'], $ph['userID'], $ghs[$i]['amount']);
            			// self::createTransactionForMatchedRequests($update_ph->id
            			// , $ghs[$j]['userID'], $ph['userID'], $ghs[$j]['amount']);

	            		$update_gh = DonationHelp::findOrFail($ghs[$i]['id']);
	            		$update_gh->status = DonationHelp::$SLIP_MATCHED;
	            		$update_gh->matchDate = date('Y-m-d H:i:s', time());
	            		$update_gh->save();

	            		self::createTransactionForMatchedRequests($update_ph->id, $update_gh->id
            			// , $ghs[$i]['userID'], $ph['userID']
            			, $ghs[$i]['amount']);
            			
	            		$update_gh = DonationHelp::findOrFail($ghs[$j]['id']);
	            		$update_gh->status = DonationHelp::$SLIP_MATCHED;
	            		$update_gh->matchDate = date('Y-m-d H:i:s', time());
	            		$update_gh->save();

	            		self::createTransactionForMatchedRequests($update_ph->id, $update_gh->id
            			// , $ghs[$j]['userID'], $ph['userID']
            			, $ghs[$j]['amount']);

	            		//remove from the array
	            		unset($phs[$ph_key]);
	            		unset($ghs[$i]);
	            		unset($ghs[$j]);
					}
				}
			}
		}
		return array($ghs, $phs);
	}
	public static function matchOneGHToThreePH(array $ghs, array $phs, $users) {
		echo "Finding one gh to three ph..............<br />";
		$ph_count = count($phs);
		foreach ($ghs as $gh_key => $gh) {
			$gh_name = $users[$gh['userID']];
			for($i=0; $i<$ph_count; $i++){
				for($j=0; $j<count($phs); $j++) {
					for($k=0; $k<count($phs); $k++) {
						if(!array_key_exists($i, $phs) || !array_key_exists($j, $phs)
							|| !array_key_exists($k, $phs)) {
							continue;
						}
						if($i==$j || $i==$k || $j==$k){
							continue;
						}
						$ph_name_one = $users[$phs[$i]['userID']];
						$ph_name_two = $users[$phs[$j]['userID']];
						$ph_name_three = $users[$phs[$k]['userID']];
					
						$sum = $phs[$i]['amount'] + $phs[$j]['amount'] + $phs[$k]['amount'];
						if($gh['amount'] == $sum) {
							//check that u dont match a user to himself
		                	if($phs[$i]['userID'] == $gh['userID'] || $phs[$j]['userID'] == $gh['userID']
		                		|| $phs[$k]['userID'] == $gh['userID']) {
		                		continue;
		                	}
							echo "Matching GH ".$gh_name."(".$gh['amount'].") 
	            				with PH ".$ph_name_one." and ".$ph_name_two." and ".$ph_name_three."....<br />";
							
						
		            		//secondly update the donation:help table
		            		$update_gh = DonationHelp::findOrFail($gh['id']);
		            		$update_gh->status = DonationHelp::$SLIP_MATCHED;
		            		$update_gh->matchDate = date('Y-m-d H:i:s', time());
		            		$update_gh->save();

		            		// self::createTransactionForMatchedRequests($update_gh->id
	            			// , $gh['userID'], $phs[$i]['userID'], $phs[$i]['amount']);
	            			// self::createTransactionForMatchedRequests($update_gh->id
	            			// , $gh['userID'], $phs[$j]['userID'], $phs[$j]['amount']);
	            			// self::createTransactionForMatchedRequests($update_gh->id
	            			// , $gh['userID'], $phs[$k]['userID'], $phs[$k]['amount']);

		            		$update_ph = DonationHelp::findOrFail($phs[$i]['id']);
		            		$update_ph->status = DonationHelp::$SLIP_MATCHED;
		            		$update_ph->matchDate = date('Y-m-d H:i:s', time());
		            		$update_ph->save();

		            		self::createTransactionForMatchedRequests($update_ph->id, $update_gh->id
	            			// , $gh['userID'], $phs[$i]['userID']
	            			, $phs[$i]['amount']);

		            		$update_ph = DonationHelp::findOrFail($phs[$j]['id']);
		            		$update_ph->status = DonationHelp::$SLIP_MATCHED;
		            		$update_ph->matchDate = date('Y-m-d H:i:s', time());
		            		$update_ph->save();

		            		self::createTransactionForMatchedRequests($update_ph->id, $update_gh->id
	            			// , $gh['userID'], $phs[$j]['userID']
	            			, $phs[$j]['amount']);

		            		$update_ph = DonationHelp::findOrFail($phs[$k]['id']);
		            		$update_ph->status = DonationHelp::$SLIP_MATCHED;
		            		$update_ph->matchDate = date('Y-m-d H:i:s', time());
		            		$update_ph->save();

		            		self::createTransactionForMatchedRequests($update_ph->id, $update_gh->id
	            			// , $gh['userID'], $phs[$k]['userID']
	            			, $phs[$k]['amount']);

		            		//remove from the array
		            		unset($ghs[$gh_key]);
		            		unset($phs[$i]);
		            		unset($phs[$j]);
		            		unset($phs[$k]);
						}
					}
				}
			}
		}
		return array($ghs, $phs);
	}
	//one person pays three people
	public static function matchOnePHToThreeGH(array $ghs, array $phs, $users) {
		echo "Finding one ph to three gh..............<br />";
		$gh_count = count($ghs);
		foreach ($phs as $ph_key => $ph) {
			$ph_name = $users[$ph['userID']];
			for($i=0; $i<$gh_count; $i++){
				for($j=0; $j<count($ghs); $j++) {
					for($k=0; $k<count($ghs); $k++) {
						if(!array_key_exists($i, $ghs) || !array_key_exists($j, $ghs)
							|| !array_key_exists($k, $ghs)) {
							continue;
						}
						if($i==$j || $i==$k || $j==$k){
							continue;
						}
						$gh_name_one = $users[$ghs[$i]['userID']];
						$gh_name_two = $users[$ghs[$j]['userID']];
						$gh_name_three = $users[$ghs[$k]['userID']];
					
						$sum = $ghs[$i]['amount'] + $ghs[$j]['amount'] + $ghs[$k]['amount'];
						if($ph['amount'] == $sum) {
							//check that u dont match a user to himself
		                	if($ghs[$i]['userID'] == $ph['userID'] || $ghs[$j]['userID'] == $ph['userID']
		                		|| $ghs[$k]['userID'] == $ph['userID']) {
		                		continue;
		                	}
							echo "Matching PH ".$ph_name."(".$ph['amount'].") 
	            				with GH ".$gh_name_one." and ".$gh_name_two." and ".$gh_name_three."....<br />";
							
							
		            		//secondly update the donation:help table
		            		$update_ph = DonationHelp::findOrFail($ph['id']);
		            		$update_ph->status = DonationHelp::$SLIP_MATCHED;
		            		$update_ph->matchDate = date('Y-m-d H:i:s', time());
		            		$update_ph->save();

		            		// self::createTransactionForMatchedRequests($update_ph->id
	            			// , $ghs[$i]['userID'], $ph['userID'], $ghs[$i]['amount']);
	            			// self::createTransactionForMatchedRequests($update_ph->id
	            			// , $ghs[$j]['userID'], $ph['userID'], $ghs[$j]['amount']);
	            			// self::createTransactionForMatchedRequests($update_ph->id
	            			// , $ghs[$k]['userID'], $ph['userID'], $ghs[$k]['amount']);

		            		$update_gh = DonationHelp::findOrFail($ghs[$i]['id']);
		            		$update_gh->status = DonationHelp::$SLIP_MATCHED;
		            		$update_gh->matchDate = date('Y-m-d H:i:s', time());
		            		$update_gh->save();

		            		self::createTransactionForMatchedRequests($update_ph->id, $update_gh->id
	            			// , $ghs[$i]['userID'], $ph['userID']
	            			, $ghs[$i]['amount']);
	            			
		            		$update_gh = DonationHelp::findOrFail($ghs[$j]['id']);
		            		$update_gh->status = DonationHelp::$SLIP_MATCHED;
		            		$update_gh->matchDate = date('Y-m-d H:i:s', time());
		            		$update_gh->save();

		            		self::createTransactionForMatchedRequests($update_ph->id, $update_gh->id
	            			// , $ghs[$j]['userID'], $ph['userID']
	            			, $ghs[$j]['amount']);
							
							$update_gh = DonationHelp::findOrFail($ghs[$k]['id']);
		            		$update_gh->status = DonationHelp::$SLIP_MATCHED;
		            		$update_gh->matchDate = date('Y-m-d H:i:s', time());
		            		$update_gh->save();

		            		self::createTransactionForMatchedRequests($update_ph->id, $update_gh->id
	            			// , $ghs[$k]['userID'], $ph['userID']
	            			, $ghs[$k]['amount']);

		            		//remove from the array
		            		unset($phs[$ph_key]);
		            		unset($ghs[$i]);
		            		unset($ghs[$j]);
		            		unset($ghs[$k]);
	            		}
					}
				}
			}
		}
		return array($ghs, $phs);
	}


}