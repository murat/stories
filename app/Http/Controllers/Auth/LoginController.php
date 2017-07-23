<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use \App\User;
use Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user to the Omniauth authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from Omniauth.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();

        $login = User::where('provider', '=', $provider)
                     ->where('provider_uid', '=', $user->id);

        if ($login->exists()) {
            $login = $login->first();
        } else {
            $login = new User;
            $login->name = $user->name;
            $login->email = $user->email;
            $login->password = Hash::make(rand());
            $login->provider = $provider;
            $login->provider_uid = $user->id;
            $login->save();
        }

        if (Auth::login($login)) {
            return redirect('/')->with('success', "Welcome {$user->name}!");
        } else {
            return redirect('/login')->with('error', "An error occurred!");
        }
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();

            return redirect('/');
        }
    }
}
