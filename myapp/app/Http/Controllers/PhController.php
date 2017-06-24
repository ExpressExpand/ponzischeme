<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PhRequest;
use App\Http\Helpers\ApplicationHelpers;
use Auth;
use App\DonationHelp;
use Session;
use App\Http\Helpers\MyCustomException;
use App\DonationTransaction;
use App\GhLog;

use App\Http\Helpers\CustomFileAttachment;

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
            ApplicationHelpers::checkForExistingPh($user);
            
            switch($request->input('paymentType')){
                case 'bank':
                    if(strlen($user->bankName) == 0){
                        return redirect('/profile')->withErrors('You need to configure your bank details first from your profile.');
                    }
                break;
                case 'bitcoin':
                    if(strlen($user->bitcoinAddress) == 0){
                        return redirect('/profile')->withErrors('You need to configure your bitcoin details first from your profile.');
                    }
                break;
            }

    		$donate = new DonationHelp();
    		$donate->paymentType = strtolower($request->input('paymentType'));
    		$donate->amount = $request->amount;
    		$donate->phGh = 'ph';
    		$donate->userID = $user->id;
    		$donate->status = DonationHelp::$SLIP_PENDING;
            $donate->recordID = uniqid();
    		$donate->save();

            //log it
            $log = GhLog::where('userID', $user->id)->first();
            if(!$log) {
                $log = new GhLog();
            }
            $log->userID = $user->id;
            $log->ghDate = time();
            $log->status = 0;
            $log->save();

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
        //Manage all your pending PH entries and all provide help request
        $user = Auth::User();
        $donations = DonationHelp::where(['userID' => $user->id, 'phGh' => 'ph'])
            ->where('status', '=', DonationHelp::$SLIP_PENDING)->paginate(50);
        return view('ph/transactions', compact('donations'));
    }
    public function cancelPH(Request $request, $ph_id){
        $user = Auth::User();
        $donation = DonationHelp::where(['userID'=> $user->id, 'id'=> $ph_id])->first();
        if(strtolower($donation->status) == DonationHelp::$SLIP_PENDING) {
            $donation->status = DonationHelp::$SLIP_CANCELLED;
            $donation->save();

            //DEDUCT 5 PTS FOR CANCELLED PH
            $user->points = $user->points - 5;
            if($user->points <= 0) {
                //block account
                $user->isBlocked = 1;
            }
            $user->save();

        }else{
            return redirect()->back()->withErrors('You do not have any pending ph');
        }
        
        Session::flash('flash_message', 'Your Ph has been cancelled successfully. 5pts have been deducted');
        return redirect()->back();
    }
    public function confirmMatchPayment(Request $request, $trans_id){
        $user = Auth::User();
        $transaction = DonationTransaction::where(['id'=> $trans_id])->first();
        if($transaction->donation->user->id !== $user->id) {
            return redirect()->back();                    
        }
        return view('ph/confirm_payment', compact('transaction'));
    }
    public function storeConfirmMatchPayment(Request $request) {
        $user = Auth::User();
        $transaction = DonationTransaction::where(
            ['id'=>$request->input('transaction_id')])->first();
        if($transaction->donation->user->id !== $user->id) {
            return redirect()->back();
        }
        //upload the attachment
        $filename = $filehash = '';
        try{
            list($filename, $filehash) = CustomFileAttachment::uploadAttachment($request);
        }catch(MyCustomException $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
        }
        $transaction->filename = $filename;
        $transaction->fileHash = $filehash;
        $transaction->payerConfirmed = 1;
        $transaction->comment = $request->input('comment');
        $transaction->save();
        Session::flash('flash_message', 'Confirmation Successful');
        return redirect('ph/make/payments');
    }
    public function viewPHAttachment(Request $request, $trans_id) {
        $user = Auth::User();
        $transaction = DonationTransaction::where(
            ['id'=>$trans_id])->first();    
        if($transaction->donation->user->id !== $user->id) {
            return redirect()->back();
        }
        return view('ph/attachment', compact('transaction'));
    }
    
}
