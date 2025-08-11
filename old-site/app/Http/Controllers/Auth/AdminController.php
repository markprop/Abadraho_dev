<?php

namespace App\Http\Controllers\Auth;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\Admin as ModelsAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use DB;
use Config;

class AdminController extends Controller
{
    public function __construct()
    {
        // $this->middleware('guest:admin');

        // $this->middleware(['manage_user_types'], ['except' => ['AdminForbidden']]);
    }
    public function adminLoginForm()
    {
        // dd(!Auth::check());
        if (!Auth::check()) {
            return view('auth.admin.login');
        } else {
            return redirect("/admin/dashboard");
        }
    }
    public function adminLogin(Request $request)
    {
        request()->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return redirect('admin/dashboard');
        }
        // dd(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember));
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return redirect('admin/dashboard');
        } else {
            dd($request->email);
            return redirect()->back()->withErrors($request->only('email', 'remember'));
        }
    }

    public function AttemptAdminLogin(Request $request)
    {
        // return $request->first_name;
        $ErrorMsg = "";
        $data = [];
        $loggedIn = false;
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => 'required|string|min:8',
            ]);

            if ($validator->fails()) {
                $data["status"] = false;
                $data["message"] = "Some thing went wrong: Validation Error.";
                $data["error"] = $validator->errors();
                return response()->json($data, 200);
            }

            $isUserExist = User::where("email", $request->email)->first();
            if ($isUserExist == null) {
                $ErrorMsg = "Invalid credentials";
            }

            if ($ErrorMsg == "") {
                if ($isUserExist->user_type_id == Config::get("constants.UserTypeIds.WebSiteUser")) {
                    $ErrorMsg = "This User is not authorized for admin panel.";
                }
            }
            // return response()->json($data, 200);
            if ($ErrorMsg == "") {
                if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
                    $loggedIn = true;
                }
                // dd(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember));
                if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
                    $loggedIn = true;
                }

                if ($loggedIn) {
                    $data["status"] = true;
                    $data["message"] = "Logged in successfully.";
                    $data["data"] = Auth::user();
                }
                else
                {
                    $data["status"] = false;
                    $data["message"] = "Invalid Credentials";   
                }

                
            }
        } catch (\Throwable $e) {
            DB::rollback();
            $ErrorMsg = "Error Occurred while login user. Exception Msg : " . $e->getMessage();
            $data["status"] = false;
            $data["message"] = $ErrorMsg;
        }
        if ($ErrorMsg == "") {
            DB::commit();
            return response()->json($data, 200);
        } else {
            $data["status"] = false;
            $data["message"] = $ErrorMsg;
            // $data["Obj"] = $request->all();
            return response()->json($data, 200);
        }
    }

    public function adminRegisterForm()
    {
        return view('auth.admin.register');
    }
    public function adminRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ]);
        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(10)
        ]);

        return $this->adminLogin($request);
    }

    public function AdminForbidden(Request $request)
    {
        return view("errors.AdminForbidden");
    }
}
