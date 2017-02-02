<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgetPassword;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest',['except'=>'logout']);
    }

    public function display()
    {
        //Return view
        return view('auth.login');
    }
    
    public function valid(Request $request)
    {
        //Validate
        $this->validate($request,[
            'username' => 'required',
            'password' => 'required',
        ]);

        //Authenticate
        if(Auth::attempt(['username' => $request->username, 'password' => $request->password])){
            User::where('username',$request->username)->update(['activated' => true]);
            return redirect()->route('home');
        } elseif (Auth::attempt(['email' => $request->username, 'password' => $request->password])){
            User::where('username', $request->username)->update(['activated' => true]);
            return redirect()->route('home');
        } else{
            return redirect()->back()->withError('Invalid Username/Password or Account does not exist');
        }

    }

    public function forget_password(Request $request)
    {
            $this->validate($request,[
                    'email' => 'required|email'
            ]);
            $user = \App\User::where('email',$request->email)->first();
            if(!$user){
                return redirect()->to('/forget')->withError('No email existed');
            }
            $code = str_random(6);
            \App\Forget::create([
                'email' => $request->email,
                'token' => $code
            ]);
            
            #Mail::to($request->email)->send(new ForgetPassword($user,$code));
            return redirect()->to('/forget/success');
    }

    public function change_password($token, Request $request)
    {
            $detail = \App\Forget::where('token',$token)->first();

            $user = \App\User::where('email',$detail->email)->first();

            $this->validate($request,[
                'password' => 'required|min:2|confirmed'
            ]);

            $user->password = Hash::make($request->password);
            return redirect()->to('/login')->withInfo('Success, your password has been changed');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->to('/');
    }
}
