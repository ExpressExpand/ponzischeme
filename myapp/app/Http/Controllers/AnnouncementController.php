<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Announcement;
use Auth;
use Session;

class AnnouncementController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function create(Request $request) {

    	return view('admin/announcements/create');
    }
    public function store(Request $request) {
        $user = Auth::User();
        if(!$user->hasRole(['superadmin', 'admin'])){
            return redirect()->back()->withErrors('You need to be an admin to perform this action');
        }
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
    public function adminViewAnnouncement() {
        $user = Auth::User();
         if(!$user->hasRole(['superadmin', 'admin'])){
            return redirect()->back()->withErrors('You need to be an admin to perform this action');
        }
        $announcements = Announcement::latest()->paginate(50);
        return view('admin.announcements.adminview', compact('announcements'));
    }
    public function edit(Request $request, $id) {
        $user = Auth::User();
         if(!$user->hasRole(['superadmin', 'admin'])){
            return redirect()->back()->withErrors('You need to be an admin to perform this action');
        }
        $announcement = Announcement::findorfail($id);
        return view('admin.announcements.edit', compact('announcement'));
    }
    public function update(Request $request) {
        $user = Auth::User();
        if(!$user->hasRole(['superadmin', 'admin'])){
            return redirect()->back()->withErrors('You need to be an admin to perform this action');
        }
        $announcement = Announcement::findorFail($request->input('announcement_id'))->first();
        $announcement->message = $request->input('message');
        $announcement->save();
        Session::flash('flash_message', 'Announcement Update was successful');
        return redirect()->back();
    }
    public function destroy(Request $request, $id) {
        $user = Auth::User();
        if(!$user->hasRole(['superadmin', 'admin'])){
            return redirect()->back()->withErrors('You need to be an admin to perform this action');
        }
         $announcement = Announcement::findorFail($id);
         $announcement->delete();
         Session::flash('flash_message', 'Announcement deleted successfully');
         return redirect()->back();
    }
}
