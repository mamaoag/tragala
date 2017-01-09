<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Verified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check() && Auth::user()->verified && !Auth::user()->ban) {
            return $next($request);
        }
        else{
        if(Auth::user()->ban){
            Auth::logout();
            return redirect()->to('/login')->withInfo('Your account is suspended');
        }
        Auth::logout();
        return redirect()->to('/login')->withInfo('Please verify your account');}
    }
}
