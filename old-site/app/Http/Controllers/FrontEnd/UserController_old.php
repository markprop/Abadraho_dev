<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function profile()
    {
        return view('profile');
    }

    public function profileupdate(Request $request)

    {

        $user_id = Auth::user()->id;
        $user = User::findOrfail($user_id);
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->address = $request->input('Address');
        $user->about_me = $request->input('about_me');
        $user->city = $request->input('city');
        $user->phone_number = $request->input('phone_number');
        

        if ($request->hasfile('image')) {
            
            $destination = 'upload/profile/' . $user->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
           

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/profile/', $filename);
            $user->image = $filename;
        }


        $user->update();
        return redirect()->back()->with('success', 'Your Profile Has Been Updated');
    }

    public function changePassword(Request $request)
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
