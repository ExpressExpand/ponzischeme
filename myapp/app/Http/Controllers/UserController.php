<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MessagingTransaction;
use Auth;
use App\DonationHelp;

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

    	$data = array(
    		'user' => $user,
    		'messages' => $messages,
    		'donations' => $donations,
    		'collections' => $collections,
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
    private function retrieveMatchedGhs($user) {
    	$collections = array();
    	$collections = DonationHelp::where(['userID' => $user->id
            , 'status'=> DonationHelp::$SLIP_MATCHED, 'phGh'=> 'gh'])->get();
    	return $collections;
    }

}
