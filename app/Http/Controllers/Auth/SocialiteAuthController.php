<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SocialiteLogin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class SocialiteAuthController extends Controller
{
    public function redirect($driver)
    {
        return Socialite::driver($driver)->redirect();
    }

    public function callback($driver)
    {
        $social_user = Socialite::driver($driver)->user();

        $AuthLogin = SocialiteLogin::where('provider', $driver)->where('provider_id', $social_user->getId())->first();

        if ($AuthLogin) {

            Auth::login($AuthLogin->user());
            Session::regenerate();

            return redirect('/dashboard');

        }

        $db_user = User::where('email', $social_user->getEmail())->first();

        if ($db_user) {

            SocialiteLogin::create([
                'provider' => $driver,
                'provider_id' => $db_user->id,
                'user_id' => $db_user->id,
            ]);

        } else {

            $db_user = User::create([
                'name' => $social_user->getName(),
                'email' => $social_user->getEmail(),
                'password' => bcrypt(rand(100000, 999999)),
            ]);

            SocialiteLogin::create([
                'provider' => $driver,
                'provider_id' => $db_user->id,
                'user_id' => $db_user->id,
            ]);
        }

        Auth::login($db_user);
        Session::regenerate();

        return redirect('/dashboard');
    }
}
