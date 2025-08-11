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

// use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\URL;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;
use Illuminate\Support\Facades\Session;

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
