<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\User;
use Hash;

class ChangePasswordController extends Controller
{
  public function getPassword($token)
  {
    // return "select * from password_resets where token = ".$token;
    // $TokenRecord = DB::select("select * from password_resets where token = '".$token."'");
    // if(count($TokenRecord) == 0){
    //   return "<div style='text-align:center;'><h2 style='color:red;'>Reset Token has been Expired.</h2><br><a href='/reset-password'>Go Back Reset Password</a></div>";
    // }
    // dd($TokenRecord);
    return view('change-password', ['token' => $token]);
  }

  public function updatePassword(Request $request)
  {
    // dd($request->all());
    $request->validate([
      'password' => 'required|string|min:6|confirmed',
      'password_confirmation' => 'required',

    ]);

    $passwordReset = DB::table('password_resets')
      ->where(['token' => $request->token])
      ->first();

    //  dd($passwordReset->email);

    if (!$passwordReset) {

      return back()->withInput()->with('error', 'Invalid token!');
    }


    $updateUserPassword = User::where('email', $passwordReset->email)
      ->update(['password' => Hash::make($request->password)]);

    if ($updateUserPassword) {
      DB::table('password_resets')->where(['email' => $request->email])->delete();
    }

    return back()->with('message', 'Your password has been changed!');
  }

  
}
