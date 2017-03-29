<?php

namespace App\Http\Controllers;

use App\Http\Helpers\ApplicationHelpers;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\PhRequest;
use App\Http\Helpers\MyCustomException;
use App\DonationHelp;
use Session;
use App\DonationTransaction;

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
    
            Session::flash('flash_message', "Your Request was successful.   
                Please wait while you are matched.");
            return redirect()->back();
    	}catch(MyCustomException $ex) {
    		return redirect()->back()->withInput()->withErrors($ex->getMessage());
    	}
    }
    public function displayReceivedPayment(){
        $user = Auth::User();
        //query the transaction table
        $collections = DonationHelp::where(['userID' => $user->id
            , 'status'=> DonationHelp::$SLIP_MATCHED, 'phGh'=> 'gh'])->get();
        return view('gh/received_payment', compact('collections'));
    }
    public function confirmReceivedPayment(Request $request, $trans_id){
        $user = Auth::User();
        $transaction = DonationTransaction::where('id', $trans_id)->first();
        if($transaction->collection->user->id !== $user->id) {
            return redirect()->back();
        }
        return view('gh/confirm_payment', compact('transaction'));
    }
    public function storeConfirmReceivedPayment(Request $request, $trans_id) {
        $user = Auth::User();
        $transaction = DonationTransaction::where('id', $trans_id)->first();
        if($transaction->collection->user->id !== $user->id) {
            return redirect()->back();
        }
        $transaction->receiverConfirmed = 1;
        $transaction->save();

        //we need to check if this person has received all ammounts
        //get the collections
        $collection = DonationHelp::where(['userID' => $user->id
            , 'id'=> $transaction->collectionHelpID, 'phGh'=> 'gh'])->first();
        //query all other trasnsactions
        $gh_sum = DonationTransaction::where('collectionHelpID'
            , $transaction->collectionHelpID)->sum('amount');
        if($transaction->collection->amount == $gh_sum){
            //full payment received
            $transaction->collection->status = DonationHelp::$SLIP_WITHDRAWAL;
        }else{
            $transaction->collection->status = DonationHelp::$SLIP_PARTIALWITHDRAWAL;
        }
        $transaction->collection->save();

        //check if the donation has fully been paid
        $ph_sum = DonationTransaction::where('donationHelpID'
            , $transaction->donationHelpID)->sum('amount');
        if($transaction->donation->amount == $ph_sum){
            //full payment received
            $transaction->donation->status == DonationHelp::$SLIP_CONFIRMED;
        }
        $transaction->donation->save();
        Session::flash('flash_message', 'Payment confirmation successful');
        return redirect('confirm/gh/payment');
    }
    public function viewGHAttachment(Request $request, $trans_id) {
        $user = Auth::User();
        $transaction = DonationTransaction::where(
            ['id'=>$trans_id])->first();    
        if($transaction->collection->user->id !== $user->id ) {
            if (!$user->hasRole('superadmin'))
                return redirect()->back();
        }
        return view('ph/attachment', compact('transaction'));
    }
    public function flagAsPop(Request $request, $trans_id){
        $user = Auth::User();
        $transaction = DonationTransaction::where(
            ['id'=>$trans_id])->first();    
        if($transaction->collection->user->id !== $user->id) {
            return redirect()->back();
        }
        $transaction->fakePOP = 1;
        $transaction->save();

        Session::flash('flash_message', 'Operation successful.
         Please wait, The system will automatically rematch you within 72 hours while the support team 
         takes a look at the failed transaction. We are sorry for any inconvieniences. Be rest assured, 
         This will be resolved in a timely fashion');
        return redirect()->back();
    }
    public function paymentHistory(Request $request) {
        $user = Auth::User();
        $collections = DonationHelp::where('userID', $user->id)
            ->where('phGh', 'gh')->where(function($query) {
                $query->where('status', DonationHelp::$SLIP_WITHDRAWAL)
                ->orWhere('status', DonationHelp::$SLIP_PARTIALWITHDRAWAL);
            })->get();
        return view('gh/history', compact('collections'));
    }
}
