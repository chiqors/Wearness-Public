<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Mail;
use App\Mail\ResetPassword;
use App\User;
use Str;
use Hash;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    public function reset(Request $request)
    {
        $users = User::where('email', $request->email)->first();

        if(isset($users)){
            $password = Str::random(10);
            $user = array('email' => $users->email , 'password' => $password, 'name' => $users->name);
            User::where('email', $request->email)->update([
                'password' => Hash::make($password)
            ]);
            Mail::to($users->email)->send(new ResetPassword($user));
            return back()->with('success', 'New password has been send to your email');
        }else{
            return back()->with('errorss', 'Email not found');                    
        }        
    }
}
