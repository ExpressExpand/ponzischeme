<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PhRequest;
use App\Http\Helpers\ApplicationHelpers;
use Auth;

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
    	ApplicationHelpers::usersCantGoBelowPHAmountChecks($request->input('amount'), $user);
    	try{
    	}catch(Exception $ex) {
    		return redirect()->back()->withInput()->withErrors($ex->getMessage());
    	}
    }
}
