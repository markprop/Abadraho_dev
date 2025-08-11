<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\URL;

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
    //  protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function googleLogin()
    {
        return Socialite::driver('google')
            ->with(["prompt" => "select_account"])
            ->redirect();
    }
    public function googleRedirect()
    {

        $googleUser = Socialite::with('google')->stateless()->user();
        
        $isExistGoogleUser = User::where("record_id", $googleUser->id)->get();
        // dd($isExistGoogleUser);
        // dd($user->user['given_name']);
        // dd($user, $user->user['given_name'], $user->name, $user->id, $user->email);
        if (count($isExistGoogleUser) > 0) {
            Auth::login($isExistGoogleUser[0]);
        } else {
                
            // dd($googleUser);
            
            $checkDuplicateUser = User::where("email" , $googleUser->email)->get();
            if(count($checkDuplicateUser) > 0){
                $htmlMsg = "<div style='color:red; text-align:center;'><h2>";
                $htmlMsg .= "This Google account email (<u>".$googleUser->email."</u>) is already exists in our database , please try custom login from this Google account email(<u>".$googleUser->email."</u>).<br>";
                $htmlMsg .= "<a href='https://abadraho.com'> <u>Go To Home</u> </a>";
                $htmlMsg .= "</h2></div>";
                return $htmlMsg;
            }
            
            $registerGoogleUser = User::create([
                'first_name' => $googleUser->user['given_name'],
                'last_name' => $googleUser->user['family_name'],
                'record_id' => $googleUser->id,
                'email' => $googleUser->email,
                'avatar' => $googleUser->avatar,
                'provider' => 'GOOGLE',
                'password' => Hash::make("12345678"),
            ]);

            Auth::login($registerGoogleUser);
        }

        return redirect()->intended(session('requested_session_url'));
    }
    public function facebookLogin()
    {
        return Socialite::with('facebook')->stateless()->redirect();
    }
    public function facebookRedirect()
    {
        $facebookUser = Socialite::with('facebook')->stateless()->user();
// dd($facebookUser);
        $isExistUser = User::where("record_id", $facebookUser->id)->get();

        if (count($isExistUser) > 0) {
            Auth::login($isExistUser[0]);
        } else {
            if($facebookUser->email != null){
                $checkDuplicateUser = User::where("email" , $facebookUser->email)->get();
                if(count($checkDuplicateUser) > 0){
                    $htmlMsg = "<div style='color:red; text-align:center;'><h2>";
                    $htmlMsg .= "This Facebook account email (<u>".$facebookUser->email."</u>) is already exists in our database , please try custom login from this Facebook account email(<u>".$facebookUser->email."</u>).<br>";
                    $htmlMsg .= "<a href='https://abadraho.com'> <u>Go To Home</u> </a>";
                    $htmlMsg .= "</h2></div>";
                    return $htmlMsg;
                }
            }
            $registerUser = User::create([
                'first_name' => $facebookUser->user['name'],
                'last_name' => $facebookUser->nickname,
                'email' => $facebookUser->email,
                'record_id' => $facebookUser->id,
                'avatar' => $facebookUser->avatar,
                'provider' => 'FACEBOOK',
                'password' => Hash::make("12345678"),
            ]);

            Auth::login($registerUser);
        }

        return redirect()->intended(session('requested_session_url'));
    }

    public function save_phone(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'phone' => 'required|numeric|digits:12'
        ]);
        $user = User::where('id', Auth::user()->id)->first();
        $user->phone_number = $request->phone;
        $user->save();
        $user->touch();
    }

    public function requested_session_url(Request $request)
    {
        $url = $request->url;
        session(['requested_session_url' => $url]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/admin/login');
    }
}
