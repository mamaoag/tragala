<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Mail\Confirm;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    
    public function display()
    {
        //Return view
        return view('auth.register');
    }

    public function valid(Request $request)
    {
        //Validation
        $this->validate($request,[
        'first_name' => 'required|min:2',
        'last_name' => 'required|min:2',
        'username' => 'required|min:2|unique:users,username',
        'email' => 'required|email|min:2|unique:users,email',
        'gender' => 'required',
        'password' => 'required|min:2|confirmed',
        'terms' => 'required'
        ]);

        //Create Account
        $code = str_random(10);
        User::create([
        'first_name' => ucfirst($request->first_name),
        'last_name' => ucfirst($request->last_name),
        'username' => $request->username,
        'email' => $request->email,
        'gender' => $request->gender,
        'password' => Hash::make($request->password),
        'hash' => $code,
        ]);


        //Send Email Verification
        Mail::to($request->email)->send(new Confirm($code,ucfirst($request->first_name)));
        return redirect()->to('/login')->withInfo('Congratulations, you created an account. Check your mail to activate it')->withTitle('Success!');
    }

    public function verifyaccount($code)
    {
        $check = User::where('hash',$code)->where('verified',false)->first();
        if($check){
            User::where('hash',$code)->update(['verified' => true]);
            return redirect()->to('/login')->withInfo('Your account has been verified');
        }else{
            abort(404);
        }
    }
}
