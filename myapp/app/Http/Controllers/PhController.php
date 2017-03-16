<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PhRequest;
use App\Http\Helpers\ApplicationHelpers;
use Auth;
use App\DonationHelp;
use Session;
use App\Http\Helpers\MyCustomException;



class PhController extends Controller
{
	public function __construct() {
		$this->middleware(['auth','blockedUser']);
	}
    public function create() {
    	//check if the ph amount is blocked
    	return view('ph/new_donation');
    }
    public function store(PhRequest $request) {
    	$user = Auth::user();
    	// dd($request->input('paymentType'));
    	try{
    		ApplicationHelpers::usersCantGoBelowPHAmountChecks($request->input('amount'), $user);
    		$donate = new DonationHelp();
    		$donate->paymentType = $request->input('paymentType');
    		$donate->amount = $request->amount;
    		$donate->phGh = 'ph';
    		$donate->userID = $user->id;
    		$donate->status = DonationHelp::$SLIP_PENDING;
    		$donate->save();

    		Session::flash('flash_message', "Your Donation was successful. Please wait while you are matched.");
    		return redirect()->back();
    	}catch(MyCustomException $ex) {
    		return redirect()->back()->withInput()->withErrors($ex->getMessage());
    	}
    }
    public function allPayments() {
        //get all the transactions
        // $donations = Donation
    }
    public function transactions() {
        //get all the ph slips
        $user = Auth::User();
        $donations = DonationHelp::where(['userID' => $user->id, 'phGh' => 'ph'])->get();
        return view('ph/transactions', compact('donations'));
    }
}
