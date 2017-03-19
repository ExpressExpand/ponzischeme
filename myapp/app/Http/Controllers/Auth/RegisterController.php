<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use App\Country;
use App\Referral;
use App\Role;

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
        return $user;
    }
    public function showRegistrationForm()
    {
        $countries = Country::pluck('name', 'id');
        return view('auth.register', compact('countries'));
    }
}
