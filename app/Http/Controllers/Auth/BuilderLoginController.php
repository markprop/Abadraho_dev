<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\API\BaseController;
use App\Models\Builder;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

// use Auth;

class BuilderLoginController extends BaseController
{
    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    public function builderLoginForm()
    {
        // dd('dsas');
        return view('auth.admin.login');
    }

    public function builderLogin(Request $request)
    {
        request()->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        // dd(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember));
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return redirect()->intended(route('project.index'));
        } else {
            // dd($request->email);
            return redirect()->back()->withInput($request->only('email', 'remember'));
        }
    }
}
