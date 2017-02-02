<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\User;
use App\Post;

class FeedController extends Controller
{
   public function feed()
   {
    
    $posts = Post::where('user_id',Auth::user()->id)
                    ->orWhereIn('user_id', Auth::user()->following()->pluck('follower_id'))
                    ->orderBy('created_at','desc')->get();
    return $posts;
   }

   public function profile_feed($id)
   {
       return Post::where('user_id',$id)
                    ->orderBy('created_at','desc')->get();
   }
   
   public function user()
   {
       return Auth::user();
   }
}
