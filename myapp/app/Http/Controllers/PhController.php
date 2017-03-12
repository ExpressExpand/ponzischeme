<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PhController extends Controller
{
    public function create() {
    	return view('ph/new_donation');
    }
}
