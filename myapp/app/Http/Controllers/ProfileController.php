<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use Auth;
use File;
use Image;
use Response;
use Session;
use App\EmailVerify;
use URL;
use Carbon;
use App\User;
use Hash;
use App\Http\Helpers\EmailHelpers;

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
    public function storeProfile(ProfileRequest $request) {
        $inputs = $request->all();
        //store in the user table
        $user = Auth::User();
        $user->bankName = $inputs['bankName'];
        $user->accountName = $inputs['accountName'];
        $user->accountNumber = $inputs['accountNumber'];
        $user->save();
        Session::flash('flash_message', 'Your profile was successfully updated');
        return redirect()->back();
    }
    public function changeUsername(Request $request){
        if(!$request->input('referrerUsername') && !strlen($request->input('referrerUsername'))) {
            return redirect()->back()->withErrors('The Referrer Username cannot be empty');
        }
        $user = Auth::User();
        $user->referrerUsername = $request->input('referrerUsername');
        $user->save();
        Session::flash('flash_message', 'Your profile was successfully updated');
        return redirect()->back();
    }
    public function verifyEmail(Request $request) {
        //generate a unique hash
        $user = Auth::User();
        if($user->isVerified == 1) {
            return redirect('Your email has previously been verified');
        }
        $unique_hash = md5(uniqid(). time());
        $hash = bcrypt($unique_hash);
        
        try {
            //store the hash into the table
            $verify = new EmailVerify();
            $verify->hash = $hash;
            $verify->userID = $user->id;
            $verify->save();
            //send a mail and generate a callback url
            $url = URL::to('/verified/email/'.$hash);
            $body = $this->getEmailVerifiedBodyTemplate($user, $url);
            //send a mail
            $email = new EmailHelpers();
            $email->setSubject('Email Verification');
            $email->setbody($body);
            if(!$email->sendMail()){
                return redirect()->back()->withErrors('An error occured while trying to send email.
                 Please try again later');
            }
            Session::flash('flash_message', 'An Email verification link has been sent to your 
                email which is set to expire in 1hour');
            return redirect()->back();
        }catch(MyCustomException $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
        }

    }
    public function verifiedEmail(Request $request, $hash) {
        //query the email verify table
        $user = Auth::User();
        $verify = EmailVerify::where(['hash' => $hash,
         'userID' => $user->id])->whereDate(
            'created_at', '<=', Carbon::now()->subHour()->toDateString())->first();
        if(!$verify) {
            return redirect('/profile')->withErrors('The date has already expired');
        }
        //update the user table
        $user->isVerified = 1;
        $user->save();
        Session::flash('flash_message', 'Your Email was successfully verified');
        return redirect('/profile');

    }
    private function getEmailVerifiedBodyTemplate($user, $url) {
        $body = sprintf('   
            <table border="1" cellpadding="0" cellspacing="0" width="100%s">
                <tr>
                 <td style="padding: 25px 0 0 0;">
                   <h3> Hello %s, </h3>
                   <p>Below is your verification code which will expire in 1 hour time.
                    Click to verify your Account or copy and paste in your browser</p>

                   <center><a href="%s" style="font-size: 18px">%s</a></center>

                   <p>Regards, </p>
                   <p>Management.</p>
                 </td>
                </tr>
            </table>
        '
        ,'%'
        , $user->name
        , $url
        , $url);
        return $body;
    }
    public function changePassword() {
        $user = Auth::User();
        return view('profile.password', compact('user'));
    }
    public function storeChangedPassword(Request $request, $user_id) {
        //only admin can perform this operation
        $inputs = $request->all();
        $validator = $this->validate($request, [
            'old_password' => 'required|min:6',
            'password' => 'required|min:6',
            'confirmPassword' => 'required|min:6|same:password',
        ]);
        if($validator !== null) {
            return redirect()->back();
        }
        //everything is ok save the password profile
        $user = User::findOrFail($user_id);
   
        if(!Hash::check($inputs['old_password'], $user->password)) {
            return redirect()->back()->withErrors('Your old password does not match your
              previous password in the system. Please contact support');
        }
        $user->password = bcrypt($inputs['password']);
        $user->save();
        //if successful redirect
        Session::flash('flash_message', 'Password change successful');
        return redirect()->back();
    }
}
