<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;

class PostController extends Controller
{
    public function create_post(Request $request)
    {
        $this->validate($request,[
            'file' => 'required|image',
            'description' => 'required',
            'category' => 'required',
        ]);
        
        $image = $request->file('file');
        $filename = str_replace(' ',"_",Auth::user()->username.'_'.$image->getClientOriginalName());
        $image->move('posts/',$filename);
        return Post::create([
            'user_id' => Auth::user()->id,
            'description' => $request->description,
            'category' => $request->category,
            'filename' => asset('posts').'/'.$filename,
        
        ]);
        
    }

    public function display($id)
    {
        $post = Post::find($id);
        return view('users.post',['post' => $post]);
    }
}
