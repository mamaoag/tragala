<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class FilterController extends Controller
{
    public function __construct()
    {
        $this->middleware('verify');
    }

    public function latest()
    {
        return \App\Post::orderBy('created_at','DESC')->get();
    }

    public function hot()
    {
        $posts = \App\Post::all();
            foreach($posts as $post){
                
                $like =  \App\Like::where('post_id',$post->id)->count();
                $comment =  \App\Comment::where('post_id',$post->id)->count();
                $total = $like + $comment;
                $post->stats = $total;
                $post->total_comment = $comment;
                $post->save();             
            }
        
        
        return \App\Post::orderBy('stats','desc')->get();
    }

    public function trending()
    {
        $posts = \App\Post::all();

        foreach($posts as $post){
            $comment = \App\Comment::where('post_id',$post->id)->count();
            $post->comment = $comment;
            $post->save();
        }

        return \App\Post::orderBy('total_comment', 'desc')->get();
    }
}
