<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use Socialite;

class AuthenticateController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)
                ->fields([
                    'first_name',
                    'last_name',
                    'name',
                    'email',
                    'gender'
                ])
                ->user();
        
        $authenticate = $this->findOrCreate($user,$provider);        
        Auth::login($authenticate);        
        return redirect()->to('home');
    }

    public function findOrCreate($user, $provider)
    {
        $check = User::where('provider_id',$user->id)->first();

        if($check){
            $check->activated = true;
            $check->save();
            return $check;
        }
         return User::create([
                'first_name' => $user->user['first_name'],
                'last_name' => $user->user['last_name'],
                'username'=> strtolower(str_replace(' ','',$user->user['first_name']).$user->user['last_name']),
                'provider' => $provider,
                'avatar' => $user->avatar_original,
                'provider_id' => $user->id,
                'email' => $user->getEmail(),
                'gender' => $user->user['gender'],
                'verified' => true,
                'activated' => true,
                'hash' => str_random(10),
            ]);   
        
    }
}
