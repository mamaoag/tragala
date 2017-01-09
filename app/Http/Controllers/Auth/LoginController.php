<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;

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

    public function logout()
    {
        Auth::logout();
        return redirect()->to('/');
    }
}
