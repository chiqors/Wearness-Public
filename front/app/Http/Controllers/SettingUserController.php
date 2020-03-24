<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use Hash;
use App\User;
use App\Customer;
use App\DevTable;

class SettingUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['dev'] = DevTable::first();
        return view('page.setting.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|max:150',
            'email' => 'required|unique:users,email,'.Auth::user()->id.'|max:150',
            'phone_number' => 'required|max:150',
            'job' => 'required|max:150',
            'religion' => 'required|max:150',
            'gender' => 'required|max:150|in:Male,Female',
            'address' => 'required|max:150|',
            'institution' => 'required|max:150|',
            'birth_date' => 'required|max:150|',
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
                if($request->photo != null){
                    $image = $request->file('photo');
                    $photo = rand(). '.' . $image->getClientOriginalExtension();
                    $image->move(public_path("image/asset/customer/"), $photo);
                    Customer::find(Auth::user()->customer->id)->update([
                        'added' => 'register',
                        'photo' => $photo,
                    ]);                    
                }
                
                User::find(Auth::user()->id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                ]);                        
    
                Customer::find(Auth::user()->customer->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,          
                'religion' => $request->religion,
                'job' => $request->job,
                'gender' => $request->gender,
                'address' => $request->address,
                'institution' => $request->institution,
                'birth_date' => $request->birth_date,
                'status' => 'On',
                ]);        
    
                
                return back()->with('success', 'Profile updated');            
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $v = Validator::make($request->all(), [
            'password' => 'required|confirmed|min:6',
            'password_now' => ['required', function ($attribute, $value, $fail) use ($user) {
            if (!\Hash::check($value, $user->password)) {
                return $fail(__('The current password is incorrect.'));
            }
            }],
        ]);        

        if ($v->fails()) {        
            return back()->withInput()->withErrors($v);
        }else{
            $user->update([
                'password' => Hash::make($request->password),
            ]);

            return back()->with('success', 'Password has change');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
