<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Referral;
use Auth;
use App\DonationHelp;
use App\ReferralBonus;

class ReferralController extends Controller
{
    public function __construct() {
    	$this->middleware(['auth','customChecks']);
    }
    public function manageReferrals() {
    	$user = Auth::User();
    	//get the referrals
    	$referrals = Referral::where('relatedReferrerUserID', $user->id)->get();
        $refs = array();
        $remaining_amount = 0;
        
        $withdrawn_ref_ids = ReferralBonus::where('userID'
            , $user->id)->pluck('amount', 'donationHelpID')->toArray();
    	foreach($referrals as $referral) {
            //loop through donations
            foreach($referral->member->donations as $donation) {
                if($donation->phGh == 'gh') {
                    continue;
                }
                
                $data = array();
                $data['name'] = $referral->member->name;  
                $data['amount'] = number_format($donation->amount,2);
                $bonus = 0.1 * $donation->amount;
                
                if(strtolower($donation->status) == DonationHelp::$SLIP_CONFIRMED) {
                    $data['status'] = 'Completed';
                    $data['bonus'] = number_format($bonus, 2);
                    if(!in_array($donation->id, array_keys($withdrawn_ref_ids))) {
                        $remaining_amount += $bonus;
                    }
                }else{
                    $data['status'] = 'Pending';
                    $data['bonus'] = number_format(0, 2);
                }
                $data['date'] = date('d-m-Y', strtotime($donation->created_at));
                $refs[]  = $data;
            }
    	}
        
        //get the referral bonuses
        $withdrawn_amount = array_sum(array_values($withdrawn_ref_ids));

        usort($refs, 'sortDateFunction');
        
        //get the referrer if
        $ref_id = $user->email;
        if($user->hasRole('superadmin')){
            $ref_id = '';
        } 
        if(strlen($user->referrerUsername) > 0) {
            $ref_id = $user->referrerUsername;
        }
    	return view('referrals/index', compact('referrals', 'ref_id', 'refs'
            , 'withdrawn_amount', 'remaining_amount'));
    }
    public function referrals() {
        $user = Auth::User();
        //get the referrals
        $referrals = Referral::where('relatedReferrerUserID', $user->id)->paginate(50);
               
        //get the referrer if
        $ref_id = $user->email;
        if($user->hasRole('superadmin')){
            $ref_id = '';
        } 
        if(strlen($user->referrerUsername) > 0) {
            $ref_id = $user->referrerUsername;
        }
        return view('referrals/referrals', compact('referrals', 'ref_id'));
    }
}
