<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class FriendController extends Controller
{
    public function check($id)
    {
        if(Auth::user()->id == $id){
            return ['status' => 'you'];
        }

        
        if(Auth::user()->isFollower($id)){
            return ['status' => 'follower'];
        }

        if(Auth::user()->isFollowing($id)){
            return ['status' => 'following'];
        }
        return ['status' => 'none'];
    }    
    
    public function add($id)
    {
        $r = Auth::user()->follow_user($id);

        User::find($id)->notify(new \App\Notifications\FollowRequest(Auth::user()) );
        
        return $r;
    }

    public function delete($id)
    {
        return Auth::user()->unfollow_user($id);
    }

    public function followback($id)
    {
        $r = Auth::user()->follow_back($id);
        User::find($id)->notify(new \App\Notifications\FollowRequest(Auth::user()));
        return $r;
    }
}
