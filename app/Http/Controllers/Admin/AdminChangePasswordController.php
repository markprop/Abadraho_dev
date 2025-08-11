<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AdminChangePasswordController extends Controller
{
    //
    public function index()
    {
        return view('panel.admin.admin-change-password');
    }

    public function UpdateAdminPassword(Request $request)
    {
        // dd($request->all());
        $ErrorMsg = "";
        $data = [];
        DB::beginTransaction();
        try {

            $ValidateFields = [
                'old_password' => 'required',
                'new_password' => 'min:8|different:old_password',
                'confirm_password' => 'required',
            ];

            $validator = Validator::make($request->all(), $ValidateFields);

            if ($validator->fails()) {
                $data["status"] = false;
                $data["message"] = "Some thing went wrong: Validation Error.";
                $data["error"] = $validator->errors();
                return response()->json($data, 200);
            }
            // return response()->json($data, 200);
            if ($ErrorMsg == "") {
                $user = User::findOrFail(Auth::user()->id);
                if (Hash::check($request->old_password, $user->password)) {
                    $user->fill([
                        'password' => Hash::make($request->new_password)
                    ])->save();

                    $data["status"] = true;
                    $data["message"] = "Password Changed Successfully.";
                    $data["data"] = $user;
                } else {
                    $ErrorMsg = "The old password does not match.";
                }
            }
        } catch (\Throwable $e) {
            DB::rollback();
            $ErrorMsg = "Error Occurred while change user password. Exception Msg : " . $e->getMessage();
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
}
