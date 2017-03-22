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
		$this->middleware(['auth','customChecks']);
	}
    public function create() {
    	//check if the ph amount is blocked
    	return view('ph/new_donation');
    }
    public function store(PhRequest $request) {
    	$user = Auth::user();
    	try{
    		ApplicationHelpers::usersCantGoBelowPHAmountChecks($request->input('amount'), $user);
            ApplicationHelpers::checkForMutilplesOfTen($request->input('amount'));
    		$donate = new DonationHelp();
    		$donate->paymentType = $request->input('paymentType');
    		$donate->amount = $request->amount;
    		$donate->phGh = 'ph';
    		$donate->userID = $user->id;
    		$donate->status = DonationHelp::$SLIP_PENDING;
            $donate->recordID = uniqid();
    		$donate->save();

    		Session::flash('flash_message', "Your Donation was successful. Please wait while you are matched.");
    		return redirect()->back();
    	}catch(MyCustomException $ex) {
    		return redirect()->back()->withInput()->withErrors($ex->getMessage());
    	}
    }
    public function allPayments() {
        //get all the transactions
        //shows all the successful and cancelled user payments
        $user = Auth::User();   
        $donations = DonationHelp::where(['userID' => $user->id, 'phGh' => 'ph'])
            ->where(function($query) {
                $query->where('status', DonationHelp::$SLIP_CONFIRMED)
                ->orWhere('status', DonationHelp::$SLIP_CANCELLED);
            })->paginate(50);
        return view('ph/all_payments', compact('donations'));
    }
    public function makePayment() {
        // The records below are unconfirmed requests matched to your account. Please select each and attach proof of payment. Also ensure receipient confirms on the portal.
        $user = Auth::User();
        $donations = DonationHelp::where(['userID'=> $user->id, 'phGh' => 'ph'
            , 'status'=> DonationHelp::$SLIP_MATCHED])->get();
        return view('ph/make_payment', compact('donations'));
    }
    public function transactions() {
        //Manage all your pending PH entries
        $user = Auth::User();
        $donations = DonationHelp::where(['userID' => $user->id, 'phGh' => 'ph'
            , 'status'=> DonationHelp::$SLIP_PENDING])->paginate(50);
        return view('ph/transactions', compact('donations'));
    }
    
}
