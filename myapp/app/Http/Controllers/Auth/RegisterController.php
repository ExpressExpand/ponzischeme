<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Helpers\MyCustomException;
use App\Http\Helpers\EmailHelpers;

use App\Country;
use App\Referral;
use App\Role;
use Session;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if($data['email'] == $data['referral_email']) {
            $data['referral_email'] = '';
        }
        return Validator::make($data, [
            'fullname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|same:password_confirm',
            'phone' => 'required|min:3',
            'relatedCountryID' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $referrer= null;
        //we need to get the ip
        $ip = get_ip_address();
        //check if a referral email exists
        if($data['referral_email'] && strlen($data['referral_email'])) {
            //get their referral user model
            $referrer = User::where(
                'email', $data['referral_email'])->orWhere('referrerUsername', $data['referral_email'])->first();
        }else{
            $referrer = User::where('email', 'maxteetechnologies@gmail.com')->first();
        }
        if($referrer == null) {
            $referrer = User::where('email', 'maxteetechnologies@gmail.com')->first();
        }
        $referrer->points = $referrer->points + 5;
        $referrer->save();

        $level = 1;
        //check the current level of the referral and increment by one
        if($referrer !== null) {
            $level_check = Referral::where('relatedReferralUserID', $referrer->id)->first();
            if($level_check) {
                $level = $level_check->level + 1;
            }    
        }

        $user = User::create([
            'name' => $data['fullname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'phone' => $data['phone'],
            'relatedCountryID' => $data['relatedCountryID'], 
            'ip' => $ip,
        ]);

        //attach users to role
        $user->attachRole(Role::where('name', 'users')->first()->id);

        //update the referral model
        $ref = new Referral();
        $ref->relatedReferrerUserID = $referrer->id;//many relationship downlines
        $ref->relatedReferralUserID = $user->id;//one relationship the recommended guy
        $ref->level = $level;
        $ref->save();

        //now send an email the the user
        $sender = null;
        $email = new EmailHelpers($sender, $user);
        $email->setSubject = 'no-reply';
        $email->body = $this->getBodyHtml($user);
        $email->send();

        return $user;
    }
    public function showRegistrationForm()
    {
        $countries = Country::pluck('name', 'id');
        //get the referral if available from the session
        $ref_id = Session::get('ref_id');
        if(!$ref_id || !isset($ref_id)) {
            $ref_id = '';
        }
        
        return view('auth.register', compact('countries', 'ref_id'));
    }
    private function getBodyHtml($user) {
        $body = sprintf('   
            <table border="1" cellpadding="0" cellspacing="0" width="100%s">
                <tr>
                 <td style="padding: 25px 0 0 0;">
                   <h3> Hello %s, </h3>
                   <p>Thank you for creating an account on Easypayworldwide.com. </p>

                    <br />
                    <p>Management.</p>
                    <p>%s</p>
                 </td>
                </tr>
            </table>
        '
        ,'%'
        , ucfirst($user->name)
        , env('EMAILHELPER_USERNAME'));
        return $body;
    }
}
