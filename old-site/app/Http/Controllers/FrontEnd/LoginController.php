<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login() {
        if(Auth::check()) {
            return redirect('/');
        }
        return view('login');
    }

}
