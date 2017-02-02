<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    function __construct() {
        $this->middleware(['admin','verify']);
    }

    function unique()
    {
        return \App\User::whereMonth('created_at', '=',Carbon::now()->month)->count();
    }

    function reports()
    {
        return \App\Report::where('read',false)->count();
    }

    function new_posts()
    {
        return \App\Post::whereDate('created_at', '=' ,Carbon::today()->toDateString())->count();
    }
}
