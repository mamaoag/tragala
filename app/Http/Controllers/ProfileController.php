<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Posts;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('verify');
    }

    public function profile($username)
    {
        $user = User::where('username',$username)->first();
        
        if($user)
                return view('users.profile',['user' => $user]);   

        abort(404);
    }

    public function edit_profile($username)
    {
        return view('users.edit');
    }

    public function update($user,Request $request)
    {
        //Validate
        $this->validate($request,[
            'first_name' => 'min:2',
            'last_name' => 'min:2',
            'location' => 'min:5',
            'gender' => 'required',
        ]);

        User::find($user)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'location' => $request->location,
            'gender' => $request->gender,
        ]);

        return response()->json('ok');
    }

    public function avatar(Request $request)
    {
        $image = $request->file('file');

        $this->validate($request,[
            'file' => 'image',
        ]);

        $image->move('images/'.$image->getClientOriginalName());

        Auth::user()->update([
            'avatar' => 'http:://localhost:8000/images/'.$image->getClientOriginalName()
        ]);
        
        return response()->json('ok');
    }

    public function notifications()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return view('users.notifications',['notifs' => Auth::user()->notifications]);
    }

    public function profile_json($user)
    {
        return Auth::user();
    }
}
