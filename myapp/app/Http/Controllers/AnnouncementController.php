<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Announcement;
use Auth;
use Session;

class AnnouncementController extends Controller
{
    public function __construct() {

    }
    public function create(Request $request) {

    	return view('admin/announcements/create');
    }
    public function store(Request $request) {
    	$validator = $this->validate($request, [
    		'message' => 'required|min:5'
    	]);
    	if($validator !== null) {
    		return redirect()->back()->withInput()->withErrors('The  message field is required');
    	}
    	$announcement = new Announcement();
    	$announcement->message = $request->input('message');
    	$announcement->userID = Auth::User()->id;
    	$announcement->save();
    	Session::flash('flash_message', 'Announcement created successfully');
    	return redirect()->back();
    }
    public function index() {
    	$announcement = Announcement::latest()->first();
    	return view('admin.announcements.show', compact('announcement'));
    }
}
