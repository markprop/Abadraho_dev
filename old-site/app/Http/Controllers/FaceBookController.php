<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class FaceBookController extends Controller
{
    /**
     * Login Using Facebook
     */
    public function provider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleCallback()
    {
        $user = Socialite::with('facebook')->stateless()->user();
        // dd($user->id);

        $db_user = User::where("record_id", '112633033241319998526')->first();
        if ($db_user) {
            // login user
            Auth::login($db_user);
        } else {
            // register user
            $new_user = User::create([
                'first_name' => $user->user['name'],
                'last_name' => $user->nickname,
                'email' => $user->email,
                'record_id' => $user->id,
                'avatar' => $user->avatar,
                'provider' => 'FACEBOOK',
                'password' => Hash::make("12345678"),
            ]);
            Auth::login($new_user);
        }

        return redirect('/');
    }
}
