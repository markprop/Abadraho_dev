<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function googleLogin(Request $request)
    {
        // Session::put('redirect_after_google_login', $request->ref);
        return Socialite::driver('google')->redirect();
    }

    public function googleRedirect()
    {
        try {
            $google_user = Socialite::with('google')->user();
            $user = User::where('record_id', $google_user->getId())->first();

            if(!$user) {
                $new_user = User::create([
                    'first_name' => $google_user->getName(),
                    'email' => $google_user->getEmail(),
                    'record_id' => $google_user->getId(),
                    'provider' => 'GOOGLE',
                    'password' => '12345678'
                ]);
                Auth::login($new_user);
                return redirect()->intended('/');
            } else {
                Auth::login($user);
                return redirect()->intended('/');
            }

        } catch (\Throwable $th) {
            dd('Something went wrong! '. $th->getMessage());
        }

        // $user = Socialite::with('google')->stateless()->user();
        
        // $is_registered = User::where(["email" => $user->email, "record_id" => null])->first();
        // if ($is_registered) {
        //     $htmlMsg = "<div style='color:red; text-align:center;'><h2>";
        //     $htmlMsg .= "This Google account email (<u>" . $user->email . "</u>) is already exists in our database , please try custom login from this Google account email(<u>" . $user->email . "</u>).<br>";
        //     $htmlMsg .= "<a href='https://abadraho.com'> <u>Go To Home</u> </a>";
        //     $htmlMsg .= "</h2></div>";
        //     return $htmlMsg;
        // }

        // $db_user = User::where("record_id", $user->id)->first();
        // if ($db_user) {
        //     // login user
        //     Auth::login($db_user);
        // } else {
        //     // register user
        //     $new_user = User::create([
        //         'first_name' => $user->user['given_name'],
        //         'last_name' => $user->user['family_name'],
        //         'record_id' => $user->id,
        //         'email' => $user->email,
        //         'avatar' => $user->avatar,
        //         'provider' => 'GOOGLE',
        //         'password' => Hash::make("12345678"),
        //     ]);
        //     Auth::login($new_user);
        // }

        // return Session::get("redirect_after_google_login")
        //     ? Redirect::to(Session::get("redirect_after_google_login"))
        //     : redirect('/');
    }

    public function facebookLogin(Request $request)
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function facebookRedirect()
    {
        try {
            $facebook_user = Socialite::with('facebook')->user();
            $user = User::where('record_id', $facebook_user->getId())->first();
            if(!$user) {
                $new_user = User::create([
                    'first_name' => $facebook_user->getName(),
                    'email' => $facebook_user->getEmail(),
                    'record_id' => $facebook_user->getId(),
                    'provider' => 'FACEBOOK',
                    'password' => '12345678'
                ]);
                Auth::login($new_user);
                return redirect()->route('home');
            } else {
                Auth::login($user);
                return redirect()->route('home');
            }

        } catch (\Throwable $th) {
            dd('Something went wrong! '. $th->getMessage());
        }

        // $user = Socialite::with('facebook')->stateless()->user();
        // $is_registered = User::where(["email" => $user->email, "record_id" => null])->first();
        // if ($is_registered) {
        //     $htmlMsg = "<div style='color:red; text-align:center;'><h2>";
        //     $htmlMsg .= "This Facebook account email (<u>" . $user->email . "</u>) is already exists in our database , please try custom login from this Facebook account email(<u>" . $user->email . "</u>).<br>";
        //     $htmlMsg .= "<a href='https://abadraho.com'> <u>Go To Home</u> </a>";
        //     $htmlMsg .= "</h2></div>";
        //     return $htmlMsg;
        // }

        // $db_user = User::where("record_id", $user->id)->first();
        // if ($db_user) {
        //     // login user
        //     Auth::login($db_user);
        // } else {
        //     // register user
        //     $new_user = User::create([
        //         'first_name' => $user->user['name'],
        //         'last_name' => $user->nickname,
        //         'email' => $user->email,
        //         'record_id' => $user->id,
        //         'avatar' => $user->avatar,
        //         'provider' => 'FACEBOOK',
        //         'password' => Hash::make("12345678"),
        //     ]);
        //     Auth::login($new_user);
        // }

        // return Session::get("redirect_after_facebook_login")
        //     ? Redirect::to(Session::get("redirect_after_facebook_login"))
        //     : redirect('/');
    }
}
