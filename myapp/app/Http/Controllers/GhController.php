<?php

namespace App\Http\Controllers;

use App\Http\Helpers\ApplicationHelpers;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\PhRequest;
use App\Http\Helpers\MyCustomException;
use App\DonationHelp;
use Session;

class GhController extends Controller
{
	public function __construct() {
		$this->middleware(['auth', 'customChecks']);
	}
    public function create() {
    	return view('gh.create');
    }
    public function store(PhRequest $request) {
     	$user = Auth::user();
    	try {
    		ApplicationHelpers::checkForActivePh($user);
            ApplicationHelpers::checkForExistingGh($user);
            APPLICATIONHelpers::checkForGhEligibility($user, $request->input('amount'));

            // TODO: CHECK FOR VALID AMOUNT THE USER IS ALLOWED TO GH WHICH INCLUDE THE REFERRALS

            //store the data
            $donate = new DonationHelp();
            $donate->paymentType = $request->input('paymentType');
            $donate->amount = $request->input('amount');
            $donate->phGh = 'gh';
            $donate->userID = $user->id;
            $donate->status = DonationHelp::$SLIP_PENDING;
            $donate->recordID = uniqid();
            $donate->save();
    
            Session::flash('flash_message', "Your Request was successful. Please wait while you are matched.");
            return redirect()->back();
    	}catch(MyCustomException $ex) {
    		return redirect()->back()->withInput()->withErrors($ex->getMessage());
    	}
    }
    
}
