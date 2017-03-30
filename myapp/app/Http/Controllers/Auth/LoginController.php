<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Response;
// use Gregwar\Captcha\CaptchaBuilder;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest', ['except' => 'logout']);
    }
     public function showLoginForm()
    {
        // $builder = new CaptchaBuilder;
        // $builder->build($width = 150, $height = 40);
        return view('auth.login');
    }
    
    protected function credentials(Request $request)
    {
        $field = filter_var($request->input($this->username()), FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        $request->merge([$field => $request->input($this->username())]);
        return $request->only($field, 'password');
    }
    public function username() {
        return 'login';
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required', 'password' => 'required',
            'captcha' => 'required|captcha',
        ]);
    }
    public function captcha() {
        $img = captcha_img('flat');
        $response = Response::json(array('data' => $img));
        return $response;
    }


}
