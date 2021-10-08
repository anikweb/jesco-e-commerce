<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
class GithubController extends Controller
{
    public function githubRedirect()
    {
        // return 'aschi';

        return Socialite::driver('github')->redirect();
    }
    public function githubCallback()
    {
        // return 'aschi';
        $user = Socialite::driver('github')->user();
        $newUserAttempt = User::where('email',$user->getEmail())->first();
        if($newUserAttempt){
            Auth::login($newUserAttempt);
            return redirect(RouteServiceProvider::HOME);
        }else{
            $newUser = User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => bcrypt(Str::random(8)),
            ]);

            $newUser->assignRole('Customer');

            Auth::login($newUser);
            return redirect(RouteServiceProvider::HOME);
        }



    }


}
