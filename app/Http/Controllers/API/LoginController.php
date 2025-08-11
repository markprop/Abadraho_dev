<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\User\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class LoginController extends BaseController
{
    public function webLogin(LoginRequest $request)
    {
        try {
            if(!Auth::attempt($request->only('email', 'password'))) {
                return redirect()->back()->with('error', 'Invalid username or password');
            }
            return Redirect::to($request['ref']);
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Something went wrong, please contact administrator.');
        }
    }

    public function updatePhoneNumber(Request $request)
    {
        $user = User::where('id', $request->user_id)->first();
        $user->phone_number = isset($request->get_phone_number) ? $request->get_phone_number : null;
        $user->save();
        $user->touch();
        $response = [
            'data' => $user,
            'success' => true,
            'response' => '200',
            'message' => 'Success',
        ];
        return $this->sendResponse($response, 'Successfully.');
    }

    public function userExists(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        if ($user) {
            $response = [
                'data' => $user,
                'success' => true,
                'response' => '200',
                'message' => 'Success',
            ];
            return $this->sendResponse($response, 'Successfully.');
        } elseif (!$user) {
            $response = [
                'data' => $user,
                'success' => true,
                'response' => '404',
                'message' => 'Success',
            ];
            return $this->sendResponse($response, 'Successfully.');
        }
    }

    public function user(Request $request)
    {

        if ($request->id) {
            $user = User::where('id', $request->id)->first();
            $user->email = $request->email;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->phone_number = $request->phone_number;
            $user->username = $request->username;
            $user->save();
        }

        $user = User::where('id', $request->user_id)->first();


        $response = [
            'request' => $request->all(),
            'data' => $user,
            'success' => true,
            'response' => '404',
            'message' => 'Success',
        ];
        return $this->sendResponse($response, 'Successfully.');
        return $this->sendResponse($user, 'Successfully.');
    }

    public function webLogout(Request $request)
    {
        // return redirect(url()->previous());
        // dd(url()->previous());
        // dd($request->route()->named("project.compare"));
        // dd(app('router')->getRoutes()->match(app('request')->create(url()->previous())));
        // dd(app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName());
        // dd(app('router')->getRoutes()->match(app('request')->create(url()->previous()))->uri());
        // dd($request);
        // dd(Route::getCurrentRoute()->getKey());
        // dd(Route::getRoutes());
        // // return "Ssss";
        // dd(Route::getCurrentRoute());
        // dd(url()->previous());
        Auth::logout();
        $arrAuthenticatedRouteName = ["web.project.details", "project.compare"];
        $getPreviousRouteName = app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName();
        if (in_array($getPreviousRouteName, $arrAuthenticatedRouteName)) {
            return redirect()->route('project.listing');
        } else if ($getPreviousRouteName == "web.user.profile") {
            return redirect("/");
        } else {
            return redirect(url()->previous());
        }
    }
}
