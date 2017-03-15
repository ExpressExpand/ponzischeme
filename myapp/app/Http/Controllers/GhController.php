<?php

namespace App\Http\Controllers;

use App\Http\Helpers\ApplicationHelpers;
use Illuminate\Http\Request;
use Auth;
use App\Http\Helpers\MyCustomException;

class GhController extends Controller
{
	public function __construct() {
		$this->middleware(['auth', 'blockedUser']);
	}
    public function create() {
    	return view('gh.create');
    }
     public function store(Request $request) {
     	$user = Auth::user();
    	try {
    		ApplicationHelpers::checkForActivePh($user);
    	}catch(MyCustomException $ex) {
    		return redirect()->back()->withInput()->withErrors($ex->getMessage());
    	}
    }
    
}
