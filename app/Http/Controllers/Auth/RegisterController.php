<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\RegisterRequest;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Helpers\AppHelper;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // dd($data);
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_number' => ['required', 'numeric', 'digits:11'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instce after a valid registration.
     *
     * @param array $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'password' => Hash::make($data['password']),
            'provider' => 'WEBSITE',
        ]);
    }

    public function RegisterNewWebsiteUser(RegisterRequest $request)
    {
        $data = $request->all();
        // dd($data['first_name']);
        $check = $this->create($data);
        
        return redirect("login")->withSuccess('User register successfully');
    }

    public function VerifyPhoneNoOtp(Request $request)
    {
        // return $request->all();
        $ErrorMsg = "";
        $data = [];
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'phone_no_otp' => ['required', 'numeric', 'digits:4'],
            ]);

            if ($validator->fails()) {
                $data["status"] = false;
                $data["message"] = "Some thing went wrong: Validation Error.";
                $data["error"] = $validator->errors();
                return response()->json($data, 200);
            }
            // return response()->json($data, 200);
            if ($ErrorMsg == "") {
                $DataSet = User::where("id", Auth::user()->id)->where("phone_no_otp", $request->phone_no_otp);
                if (count($DataSet->get()) > 0) {
                    $update = $DataSet->update([
                        "is_phone_no_verified" => 1
                    ]);
                    $data["status"] = true;
                    $data["message"] = "Phone No Verified Successfully.";
                    $data["data"] = $DataSet->first();
                } else {
                    $ErrorMsg = "Phone No Otp is not matched.";
                }
            }
        } catch (\Throwable $e) {
            DB::rollback();
            $ErrorMsg = "Error Occurred while verify phone no OTP. Exception Msg : " . $e->getMessage();
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

    public function ResendPhoneNoOtp(Request $request)
    {
        $ErrorMsg = "";
        $data = [];
        DB::beginTransaction();
        try {
            if ($ErrorMsg == "") {
                $LoggedInUser = User::where("id", Auth::user()->id);

                $updateOtp = $LoggedInUser->update([
                    'phone_no_otp' => AppHelper::GeneratRandomNumber(),
                ]);

                $data["status"] = true;
                $data["message"] = "Phone no OTP has been Sent.";
                $data["data"] = $LoggedInUser->first();
            }
        } catch (\Throwable $e) {
            DB::rollback();
            $ErrorMsg = "Error Occurred while resend phone no OTP. Exception Msg : " . $e->getMessage();
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

    public function SubmitWebUserPhoneNo(Request $request)
    {
        // return $request->submit_phone_no;
        $ErrorMsg = "";
        $data = [];
        DB::beginTransaction();
        try {
            $phone_number = $request->submit_phone_no;
            $request->phone_number = $phone_number;
            $param = ["phone_number" => $phone_number];
            $validator = Validator::make($param, [
                'phone_number' => ['required', 'numeric', 'digits:11'],
            ]);

            if ($validator->fails()) {
                $data["status"] = false;
                $data["message"] = "Some thing went wrong: Validation Error.";
                $data["error"] = $validator->errors();
                return response()->json($data, 200);
            }

            // return $request->all();
            // return response()->json($data, 200);

            if ($ErrorMsg == "") {
                $CheckIsPhoneNoIsExist = User::where("id", "!=", Auth::user()->id)
                    ->where("phone_number", $phone_number)
                    ->get();

                if (count($CheckIsPhoneNoIsExist) > 0) {
                    $ErrorMsg = "This phone number has already been taken.";
                }
            }

            if ($ErrorMsg == "") {
                $loggedInUser = User::where("id", Auth::user()->id);

                $update = $loggedInUser->update([
                    'phone_number' => $request->submit_phone_no,
                    'phone_no_otp' => AppHelper::GeneratRandomNumber(),
                ]);

                $data["status"] = true;
                // $data["message"] = "Phone no has been updated and send OTP successfully.";
                $data["message"] = "Phone no has been updated.";
                $data["data"] = $loggedInUser->first();
            }
        } catch (\Throwable $e) {
            DB::rollback();
            $ErrorMsg = "Error Occurred while submit phone no. Exception Msg : " . $e->getMessage();
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
