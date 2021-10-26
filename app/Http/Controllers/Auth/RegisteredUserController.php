<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\CustomerPersonalInformation;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        if(basicSettings()->new_registration==2){

            return view('auth.register');
        }else{
            return abort(404);
        }
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        if(basicSettings()->new_registration==2){
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $user->assignRole('Customer');
            $personalInfo = new CustomerPersonalInformation;
            $personalInfo->user_id = $user->id;
            if(!$personalInfo->where('username',Str::slug($request->name))->exists()){
                $personalInfo->username = Str::slug($request->name);
            }else{
                $personalInfo->username = Str::slug($request->name).Str::random(5);
            }
                $personalInfo->save();
            event(new Registered($user));

            Auth::login($user);

            return redirect(RouteServiceProvider::HOME);
        }else{
            return abort(404);
        }

    }
}
