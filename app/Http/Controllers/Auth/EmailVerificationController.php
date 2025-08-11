<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function email_verification_request(EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/home');
    }

    public function email_verify() {
        return view('auth.verify');
    }
}
