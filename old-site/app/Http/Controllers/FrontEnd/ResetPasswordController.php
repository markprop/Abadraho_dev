<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class ResetPasswordController extends Controller
{
    //resetpassword
    public function resetpassword()
    {
        return view('reset-password');
    }

    public function postEmail(Request $request)
    {
        $request->validate(
            ['email' => 'required|email|exists:users'], 
            ['exists' => 'This :attribute is not exists in our database.']
        );

        $customMessages = [
            'required' => 'The :attribute field is required.'
        ];

        $token = Str::random(60);
        DB::table('password_resets')->insert(

            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
        );

        $sendEmail =  Mail::send('auth.verify', ['token' => $token, 'email' => $request->email], function ($message) use ($request) {

            $message->from($request->email);
            $message->to($request->email);
            $message->subject('Reset Password Notification');
        });

        return back()->with('message', 'We have sent you a link on your email');
    }
}
