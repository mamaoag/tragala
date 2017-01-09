<?php

namespace App\Traits;
use App\Friend;
use App\User;
trait Friendable
{
    public function follow_user($id)
    {   
        
        $follow = Friend::create([
            'user_id' => $this->id,
            'follower_id' => $id,
        ]);
        
        return $follow;
    }

    public function unfollow_user($id)
    {
        $check = Friend::where('follower_id', $id)
                        ->where('user_id', $this->id)
                        ->first();
        if($check){
            $check->delete();
            return 1;
        }
        return 0;
    }

    public function follow_back($id)
    {
        $follow = Friend::where('user_id', $id)
                        ->where('follower_id', $this->id)
                        ->first();

        if($follow){
            $follow->update([
                'followed_back' => true
            ]);
            return 1;
        }

        return 0;
    }

    public function followers()
    {

        return Friend::where('follower_id',$this->id)->get();
    }

    public function following()
    {
        return Friend::where('user_id', $this->id)->get();
    }

    public function isFollowing($id)
    {
        return (bool) Friend::where('user_id',$this->id)
                        ->where('follower_id', $id)
                        ->where('followed_back', false)
                        ->first();
    }

    public function isFollower($id)
    {
       return (bool) Friend::where('user_id', $id)
                        ->where('follower_id', $this->id)
                        ->where('followed_back',false)
                        ->first();
    }
}