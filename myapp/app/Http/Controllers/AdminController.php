<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Entrust;
use Session;
use Auth;
use App\Role;
use App\DonationHelp;

class AdminController extends Controller
{
	public function __construct() {
		$this->middleware(['auth', 'customChecks', 'role:admin|superadmin']);
	}
    public function viewUsers() {
    	$users = User::latest()->paginate(20);
    	$users_count = User::get()->count();
    	$active_count = User::where('isBlocked', 0)->count();
    	$inactive_count = User::where('isBlocked', 1)->count();
    	//get the roles
    	$roles = array();
    	$roles_maps = Role::pluck('display_name', 'id')->toArray();
    	foreach($roles_maps as $id => $value) {
    		if(strtolower($value) == 'super admin') {
    			continue;
    		}
    		$roles[$id] = $value;
    	}
    	
    	return view('admin/users/view', compact('users', 'roles', 'users_count', 'active_count', 'inactive_count'));
    }
    public function blockUser(Request $request, $user_id) {
    	$user = User::findOrFail($user_id);
    	$user->isBlocked = 1;
    	$user->points = 0;
    	$user->save();
    	Session::flash('flash_message', 'User Blocked was Successful');
    	return redirect()->back();
    }
    public function unblockUser(Request $request, $user_id) {
    	$user = User::findOrFail($user_id);
    	$user->isBlocked = 0;
    	$user->points = 20;
    	$user->save();
    	Session::flash('flash_message', 'User Unblocked was Successful');
    	return redirect()->back();
    }
    public function viewUserProfile(Request $request, $user_id) {
        $user = User::findOrFail($user_id);        
    	return view('admin/users/show',compact('user'));
    } 
    public function storeChangedUserPassword(Request $request, $user_id) {
        //only admin can perform this operation
        $inputs = $request->all();
        $validator = $this->validate($request, [
            'password' => 'required|min:6',
            'confirmPassword' => 'required|min:6|same:password',
        ]);
        if($validator !== null) {
            return redirect()->back();
        }
        //everything is ok save the password profile
        $user = User::findOrFail($user_id);
        $user->password = bcrypt($inputs['password']);
        $user->save();
        //if successful redirect
        Session::flash('flash_message', 'Password change successful');
        return redirect()->back();
    }
    public function changeRoles(Request $request){
    	$inputs = $request->all();
    	//validate
    	$validator = $this->validate($request, array(
    		'change_role' => 'required',
    		'user_ids' => 'required'));
    	if($validator !== null) {
    		return redirect()->back()->withErrors($validator)->withInput();
    	}
    	//get the desired role
    	$role = Role::findOrFail($inputs['change_role']);
    	$users = User::findOrFail($inputs['user_ids']);
    	foreach ($users as $user) {
			$user->detachRoles();
			$user->attachRole($role->id);
    	}
    	Session::flash('flash_message', 'Roles Changed Successfully');
    	return redirect()->back();
    }
    public function viewPhOrders() {
    	$donations = DonationHelp::where('phGh', 'ph')->latest()->paginate(50);
    	//count the pending orders
    	$pending_count = DonationHelp::where(['phGh' => 'ph'
    		, 'status' => DonationHelp::$SLIP_PENDING])->count();
    	//count the confirmed orders
    	$confirmed_count = DonationHelp::where(['phGh' => 'ph'
			, 'status' => DonationHelp::$SLIP_CONFIRMED])->count();
    	// count the ellapsed orders
    	$elapsed_count = DonationHelp::where(['phGh' => 'ph'
    		, 'status' => DonationHelp::$SLIP_ELAPSED])->count();

    	$pending_amount = DonationHelp::where(['phGh' => 'ph'
    		, 'status' => DonationHelp::$SLIP_PENDING])->pluck('amount')->toArray();
    	    	    	
    	$confirmed_amount = DonationHelp::where(['phGh' => 'ph'
    		, 'status' => DonationHelp::$SLIP_CONFIRMED])->pluck('amount')->toArray();

    	$pending_amount = array_sum($pending_amount);
    	$confirmed_amount = array_sum($confirmed_amount);

    	return view('admin.ph', compact('donations','pending_count'
    		, 'confirmed_count', 'elapsed_count', 'pending_amount', 'confirmed_amount'));
    }
    public function viewGhOrders() {
    	$collections = DonationHelp::where('phGh', 'gh')->latest()->paginate(50);
    	//count the confirmed request 
    	$confirmed_count = DonationHelp::where(['phGh' => 'gh'
    		, 'status' => DonationHelp::$SLIP_CONFIRMED])->count();
    	//count the pending request 
    	$pending_count = DonationHelp::where(['phGh' => 'gh'
    		, 'status' => DonationHelp::$SLIP_PENDING])->count();
    	//count the withdrawn request
    	$payout_count = DonationHelp::where(['phGh' => 'gh'
    		, 'status' => DonationHelp::$SLIP_WITHDRAWAL])->count();

    	    	
    	$pending_amount = DonationHelp::where(['phGh' => 'gh'
    		, 'status' => DonationHelp::$SLIP_PENDING])->pluck('amount')->toArray();
    	    	    	
    	$confirmed_amount = DonationHelp::where(['phGh' => 'gh'
    		, 'status' => DonationHelp::$SLIP_CONFIRMED])->pluck('amount')->toArray();

    	$pending_amount = array_sum($pending_amount);
    	$confirmed_amount = array_sum($confirmed_amount);

    	return view('admin.gh', compact('collections', 'confirmed_count'
    		, 'pending_count', 'payout_count', 'pending_amount', 'confirmed_amount'));
    }
   
    public function matchGHRequest(Request $request, $gh_id) {

    }

}
