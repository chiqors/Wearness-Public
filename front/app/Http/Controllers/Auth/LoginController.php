<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Hash;

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
    protected $redirectTo = '/student';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $email = $request->email;
        $password = $request->password;

        if(isset($user)){
            if($user->verified !== 1){                                
                if ($user->level == 2) {
                    return back()->with('errorss', 'Please login in instructor page!');               
                }elseif ($user->level == 1) {
                    return back()->with('errorss', 'Please login in admin page!');               
                }
                return back()->with('errorss', 'Email verification has been send, check your email!');                                                    
            }elseif($user->customer->status == 'Off'){
                return back()->with('errorss', 'Account has been suspend!');                  
            }else{
                if(Auth::attempt(['email' => $email, 'password' => $password, 'verified' => 1])){
                    return redirect('/student');
                }else{
                    return back()->with('errorss', 'These credentials do not match our records');                                                    
                }
            }
        }else{
            return back()->with('errorss', 'These credentials do not match our records');                                                    
        }
    }   
}
