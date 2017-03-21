<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Referral;
use Auth;

class ReferralController extends Controller
{
    public function __construct() {
    	$this->middleware(['auth','customChecks']);
    }
    public function index() {
    	$user = Auth::User();
    	//get the referrals
    	$referrals = Referral::where('relatedReferrerUserID', $user->id)->paginate(50);
    	//count the total referals
    	$referrals_count = Referral::where('relatedReferrerUserID', $user->id)->count();
    	//get the total referral amount
    	foreach($referrals as $referral) {
    		//get the  number of confirmed ph
    		$donations = $referral->donations;
    	}

    	return view('referrals/index', compact('referrals'));
    }
}
