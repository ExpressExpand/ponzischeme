<?php 
namespace app\Http\Helpers;
use App\DonationHelp
final class ApplicationHelpers {
	public static usersCantGoBelowPHAmountChecks($amount, $user) {
		$donations = DonationHelp::where(['userID' => $user->id, 'phGh' => 'ph'])->get;
		if(!$donations) {
			return true;
		}
		//determine the largest amount
		$check_amounts = array();
		foreach($donations as $donation){
			$check_amounts[] = $donation->amount;
		}
		$highest = array_max($check_amounts);
		if($amounts < $highest) {
			throw new exception('You cannot go below your last ph. Ensure you put an amount 
				that is equal or greater than '.$highest);
		}
		return true;
	}
}