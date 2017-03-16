<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
{
	public function __construct() {
		$this->middleware('auth', 'blockedUser');
	}
    public function viewUser() {
    	$users = User::latest()->all()->paginate(20);
    	return view('admin/users/view', compact('users'));
    }
}
