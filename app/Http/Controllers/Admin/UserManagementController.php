<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;

class UserManagementController extends Controller
{
    function __construct() {
        $this->middleware(['admin','verify']);
    } 

    public function users()
    {
        return \App\User::all();
    } 

    public function promote($id)
    {
       User::where('id',$id)->update(['usergroup' => 3]);
       return response()->json('ok');
    }
    public function verify($id)
    {
         User::where('id',$id)->update(['usergroup' => 2]);
         return response()->json('ok');
    }

    public function unverify($id)
    {
        User::where('id',$id)->update(['usergroup'=> 1]);
        return response()->json('ok');
    }

    public function demote($id)
    {
        User::where('id',$id)->update(['usergroup' => 1]);
        return response()->json('ok');
    }

    public function ban($id)
    {   
        User::where('id',$id)->update(['ban' => true]);
        return response()->json('ok');
    } 

    public function unban($id)
    {
        User::where('id',$id)->update(['ban' => false]);
        return response()->json('ok');
    }
}
