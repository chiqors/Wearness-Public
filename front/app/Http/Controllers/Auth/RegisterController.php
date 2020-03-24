<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\VerifyUser;
use App\Customer;
use App\Device;
use Mail;
use App\Mail\ActivationMail;
use Str;
use Auth;
use App\Jobs\SendEmail;

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
    protected $redirectTo = '/student';

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
        // return Validator::make($data, [
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'password' => ['required', 'string', 'min:8', 'confirmed'],
        // ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function register(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|max:150',
            'email' => 'required|unique:users|max:150',
            'phone_number' => 'required|max:150',
            'serial_number' => 'required|max:150',
            'job' => 'required|max:150',
            'gender' => 'required|max:150|in:Male,Female',
            'address' => 'required|max:150|',
            'institution' => 'required|max:150|',
            'birth_date' => 'required|max:150|',
            'password' => 'required|confirmed|min:6',
        ]);

        if ($v->fails()) {
            return back()->withInput()->withErrors($v);
        }else{
            $photo = null;
            if($request->photo != null){
                $v = Validator::make($request->all(), [
                    'photo' => 'mimes:jpeg,jpg,png,gif|required|max:2000'
                ]);                                                   
            }
        
            if ($v->fails()) {
                return back()->withInput()->withErrors($v);
            }else{           
            $device = Device::where('serial_number', $request->serial_number)->whereIn('status', ['On stock', 'On sold'])->first();
                if(isset($device)){                     
                    if($request->photo != null){
                        $image = $request->file('photo');
                        $photo = rand(). '.' . $image->getClientOriginalExtension();
                        $image->move(public_path("image/asset/customer/"), $photo);
                    }

                    $user =  User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => Hash::make($request->password),
                    ]);

                    Device::where('serial_number', $request->serial_number)->update(['status' => 'Active', 'user_id' => $user->id]);

        
                    $verifyUser = VerifyUser::create([
                        'user_id' => $user->id,
                        'token' => sha1(time())
                    ]);
        
                    Customer::create([
                    'user_id' => $user->id,
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone_number' => $request->phone_number,          
                    'religion' => 'null',
                    'job' => $request->job,
                    'gender' => $request->gender,
                    'address' => $request->address,
                    'institution' => $request->institution,
                    'birth_date' => $request->birth_date,
                    'photo' => $photo,
                    'status' => 'On',
                    'added' => 'register',
                    ]);        
        
                    Mail::to($user->email)->send(new ActivationMail($user));       
                    
                    return back()->with('success', 'Email verification has been send to your email');
                }else{  
                    return back()->withInput()->with('errorss', 'Serial number not defined');                    
                }
            
            }    
        }
    }

    public function verifyUser($token)
    {
      $verifyUser = VerifyUser::where('token', $token)->first();
      if(isset($verifyUser) ){
        $user = $verifyUser->user;

        if(!$user->verified) {
          $verifyUser->user->verified = 1;
          $verifyUser->user->save();
          $status = "Your e-mail is verified. You can now login.";
        } else {
          $status = "Your e-mail is already verified. You can now login.";
        }
      } else {
        return redirect('/login')->with('warning', "Sorry your email cannot be identified.");
      }
      return redirect('/login')->with('success', $status);
    }

    public function send()
    {
        $user = array('name' => '1', 'email' => '2' , 'verifyUser' => array('token' => '1', ));
        Mail::to('al_dan@Yahoo.com')->send(new ActivationMail($user));       
    }
}
