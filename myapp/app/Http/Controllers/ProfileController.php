<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use File;
use Image;
use Response;

class ProfileController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
	}
    public function viewProfile() {
    	$user = Auth::User();
    	return view('profile/index',compact('user'));
    } 
    public function changePicture(Request $request) {
        //check if the auth is players
        $user = Auth::User();
        $inputs = $request->all();
         $validator = $this->validate($request, [
            'avatar' => 'mimes:png,jpg,jpeg,jpg,gif',
            ]);
        if($validator != null){
            if ($validator->fails()) { 
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }
        }
        $user_id = $user->id;
        //call the profile model
        if($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = md5(microtime() . $file->getClientOriginalName()) . "." . $file->getClientOriginalExtension();
            // $image = $file->move();
            $filepath = public_path()."/images/profilepix/".$filename;
            $image = Image::make($file)->resize(150, null, function($constraint) {
            	$constraint->aspectRatio();
            })->save($filepath);
        }   
        if($user->avatar || strlen($user->avatar) > 1) {
            File::delete(public_path().'/images/profilepix/'.$user->avatar);
        }

        $user->avatar = $filename;
        $user->save();
        
        $response = array(
            'msg' => $filename, 
            'responseCode' => 200,   
        );
        return Response::json( $response );
    }
}
