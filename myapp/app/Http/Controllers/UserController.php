<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MessagingTransaction;
use Auth;
use App\DonationHelp;
use App\DonationTransaction;
use Mail;
use Carbon;

class UserController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
	}
    public function dashboard() {
    	$user = Auth::User();
    	$messages = $this->getInboxMessages($user);
    	$donations = $this->retrieveMatchedPhs($user);
    	$collections = $this->retrieveMatchedGhs($user);
        $payouts = $this->retrievePayouts();
        $active_phs = $this->getActivePHStatusInWeek($user);

    	$data = array(
    		'user' => $user,
    		'messages' => $messages,
    		'donations' => $donations,
    		'collections' => $collections,
            'payouts' => $payouts,
            'active_phs' => $active_phs,
    	);
    	return view('dashboard', $data);
    }
    private function getInboxMessages($user) {
    	$messages = array();
    	$messages = MessagingTransaction::where(
    		['userID'=> $user->id, 'messageFlag'=> 'received'])->where('readStatus', 0)
    		->take(5)->latest()->get();
    	return $messages;
    }
    private function retrieveMatchedPhs($user) {
    	$donations = array();
    	$donations = DonationHelp::where(
    		['userID'=> $user->id, 'phGh' => 'ph'
            , 'status'=> DonationHelp::$SLIP_MATCHED])->get();
    	return $donations;
    }
    // private function 
    private function retrieveMatchedGhs($user) {
    	$collections = array();
    	$collections = DonationHelp::where(['userID' => $user->id, 'phGh' => 'gh'])
    	->where(function($query){
    		$query->where('status', DonationHelp::$SLIP_MATCHED)
    		->orWhere('status', DonationHelp::$SLIP_PENDING);
    	})->get();
    	return $collections;
    }
    private function retrievePayouts() {
        $payouts = DonationTransaction::where(['receiverConfirmed' => 1, 'fakePOP' => 0,
         'payerConfirmed' => 1])->paginate(10);
        return $payouts;
    }
    private function getActivePHStatusInWeek($user) {
        $active_phs = DonationHelp::where(['userID' => $user->id, 'phGh' => 'ph', 'isConfirmed' => 0])
            ->where(function($query) {
                $query->where('status', DonationHelp::$SLIP_MATCHED)
                ->orWhere('status', DonationHelp::$SLIP_PENDING)
                ->orWhere('status', DonationHelp::$SLIP_CONFIRMED);
        })->get();
        return $active_phs;
    }
}
