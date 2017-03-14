<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PhRequest;

class PhController extends Controller
{
    public function create() {
    	//check if the ph amount is blocked
    	return view('ph/new_donation');
    }
    public function store(PhRequest $request) {
    	try{

    	}catch(Exception $ex) {
    		return redirect()->back()->withInput()->withErrors($ex->getMessage());
    	}
    }
}
