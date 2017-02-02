<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use App\Comment;
use App\Dislike;
use Auth;
use App\User;

class StatusController extends Controller
{
    public function like($id,$uid)
    {
        $check = Dislike::where('user_id', Auth::user()->id)->where('post_id',$id)->first();
        if($check){
            $check->delete();
        } 
               
        $check_post = Like::where('user_id', Auth::user()->id)->where('post_id',$id)->first();
        if(!$check_post){
            $r = Like::create([
                    'user_id' => Auth::user()->id,  
                    'post_id' => $id 
                ]);
            User::find($uid)->notify(new \App\Notifications\LikeNotification(Auth::user()) );
            return $r;
        }
    }   

    public function unlike($id,$uid)
    {
        $check = Like::where('user_id', Auth::user()->id)->where('post_id',$id)->first();

        if($check){
            $check->delete();
            return 1;
        }
        return 0;
    }

    public function dislike($id,$uid)
    {   
        $check = Like::where('user_id', Auth::user()->id)->where('post_id',$id)->first();        
        if($check){
            $check->delete();
        }
        
        $check_post = Like::where('user_id', Auth::user()->id)->where('post_id',$id)->first();
        if(!$check_post){
         $r = Dislike::create([
                'user_id' => Auth::user()->id,
                'post_id' => $id 
            ]);
            return $r;
        }
    }   

    public function undislike($id,$uid)
    {
        $check = Dislike::where('user_id', Auth::user()->id)->where('post_id',$id)->first();

        if($check){
            $check->delete();
            return 1;
        }

        return 0;
    }

    public function status($id)
    {
        $like = Like::where('user_id',Auth::user()->id)->where('post_id',$id)->first();
        $dislike = Dislike::where('user_id',Auth::user()->id)->where('post_id',$id)->first();
        $comments = Comment::where('post_id',$id)->count();
        $like_counts = Like::where('post_id',$id)->count();
        $dislike_counts = Dislike::where('post_id',$id)->count();
        if($like && ! $dislike){
            return ['action' => 'liked','likes' => $like_counts, 'dislikes' => $dislike_counts, 'comments' => $comments];
        }elseif(! $like && $dislike){
            return ['action' => 'disliked','likes' => $like_counts, 'dislikes' => $dislike_counts, 'comments' => $comments];
        }
        else{
            return ['action' => 'none','likes' => $like_counts, 'dislikes' => $dislike_counts, 'comments' => $comments];
        }
        
    }

    public function comment($id, $uid,Request $request)
    {
        $r = Comment::create([
            'user_id' => Auth::user()->id,
            'post_id' => $id,
            'body' => $request->body
        ]);
        
        \App\User::find($uid)->notify(new \App\Notifications\CommentReceived(Auth::user()));
        return $r;        
    }

    public function getComments($id)
    {
        return Comment::where('post_id',$id)->get();
    }

    function safe($id, Request $request)
    {
        return \App\Safe::create([
                'post_id' => $id,
                'is_safe' => $request->safe,
                'user_id' => Auth::user()->id
        ]);           

    }
}
