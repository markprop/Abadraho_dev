<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Builder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends BaseController
{

    public function register(Request $request){
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
        ]);
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(10),
            'record_id' => isset($request->record_id) ? $request->record_id : '',
            'provider' => isset($request->provider) ? $request->provider : ''
        ]);
        // return $user;



        $response = [
            'type' => 'user',
            'data' => $user,
            'success' => true,
            'response' => '200',
            'message' => 'Success',
        ];
        return $this->sendResponse($response, 'Successfully.');
      /*  if ($request->type == 1){
            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users',
                'email' => 'required|email|unique:users',
            ]);
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'remember_token' => Str::random(10)
            ]);
           // return $user;

            $response = [
                'type' => 'user',
                'data' => $user,
                'success' => true,
                'response' => '200',
                'message' => 'Success',
            ];
            return $this->sendResponse($response, 'Successfully.');
        }elseif ($request->type == 2){
            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:builders',
                'email' => 'required|email|unique:builders',
            ]);
            $admin = Builder::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'remember_token' => Str::random(10),
            ]);

            $response = [
                'type' => 'admin',
                'data' => $admin,
                'success' => true,
                'response' => '200',
                'message' => 'Success',
            ];
            return $this->sendResponse($response, 'Successfully.');
        }*/
    }
}
