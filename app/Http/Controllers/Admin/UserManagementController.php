<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User_type;
use App\Models\User;
use Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Helpers\AppHelper;

class UserManagementController extends Controller
{
    function __construct()
    {
        // $this->middleware('auth:admin');
        $this->middleware('manage_user_types');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $admins = User::orderBy("created_at", "DESC");
        // dd(explode(" ", $request['userName'])[0]);
        $searchQuery = [];
        $searchQuery['name'] = $request->userName ? $request->userName : null;
        $searchQuery['email'] = $request->userEmail ? $request->userEmail : null;
        $searchQuery['userType'] = $request->tag_id ? $request->tag_id : null;
        // dd($searchQuery['userType']);
        $request->userEmail && $admins = $admins->where('email', $searchQuery['email']);
        $request->userName && $admins = $admins->where('first_name', "LIKE", explode(" ", $request['userName'])[0]);
        if (count(explode(" ", $request['userName'])) > 1) {
            $admins = $admins->where("last_name", "LIKE", explode(" ", $request['userName'])[1]);
        }
        if ($request->tag_id) {
            foreach ($request['tag_id'] as $tag_id) {
                $admins = $admins->where('user_type_id', $tag_id);
            }
        }
        // dd($searchQuery);
        $admins = $admins->get();


        $status = [
            'Super Admin',
            'Admin',
            'Manager',
            'Data Entry',
        ];
        return view('panel.admin.users.index', compact('admins', 'status', 'searchQuery'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_user()
    {
        // return "Sssss";
        // return Config::get("constants.UserTypeIds.SuperAdmin");
        $data["UserTypes"] = User_type::where("id", "!=", Config::get("constants.UserTypeIds.SuperAdmin"))->get();
        return view('panel.admin.users.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function AddNewUser(Request $request)
    {
        // return $request->id;
        $ErrorMsg = "";
        $data = [];
        DB::beginTransaction();
        try {

            $ValidateFields = [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'user_type_id' => ['required'],
            ];

            if ($request->id != 0) {
                $ValidateFields["id"] = 'required|numeric';
                if (User::where("email", $request->email)->where("id", "!=", $request->id)->count()) {
                    $ErrorMsg = "This Email is already taken.";
                }
                // array_push($ValidateFields, ["id" => 'required|numeric']);
            }
            if ($request->id == 0) {
                $ValidateFields["password"] = 'required|string|min:8';
                $ValidateFields['email'] = ['required', 'string', 'email', 'max:255', 'unique:users'];
            }
            // return $ValidateFields;
            $validator = Validator::make($request->all(), $ValidateFields);

            if ($validator->fails()) {
                $data["status"] = false;
                $data["message"] = "Some thing went wrong: Validation Error.";
                $data["error"] = $validator->errors();
                return response()->json($data, 200);
            }
            // return response()->json($data, 200);
            if ($ErrorMsg == "") {

                $requestData = [
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'username' => $request->first_name . $request->last_name,
                    'user_type_id' => $request->user_type_id,
                    'email' => $request->email,
                ];

                // add new user
                if ($request->id == 0) {
                    $requestData["password"] = Hash::make($request->password);
                    $DataSet = User::create($requestData);
                }

                // update user
                if ($request->id != 0) {
                    // $userupdate = User::where("id", $request->id)->first()
                    $DataSet = User::where("id", $request->id)->firstOrFail()->update($requestData);
                }

                $data["status"] = true;
                $data["message"] = ($request->id == 0 ? "Add" :  "Update") . " User Successfully.";
                $data["data"] = $DataSet;
            }
        } catch (\Throwable $e) {
            DB::rollback();
            $ErrorMsg = "Error Occurred while add new user. Exception Msg : " . $e->getMessage();
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

    // public function store(Request $request)
    // {
    //     request()->validate([
    //         'name' => 'required',
    //         'email' => 'required|email|unique:admins',
    //         'password' => 'required',
    //         'role_id' => 'required|integer',
    //     ]);

    //     Admin::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //         'role_id' => $request->role_id,
    //     ]);

    //     return redirect('admin/manage_users');
    // }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(User $admin)
    {
        $status = [
            'Super Admin',
            'Admin',
            'Manager',
            'Data Entry',
        ];
        return view('panel.admin.users.show', compact('admin', 'status'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(User $admin)
    {
        $status = [
            'Super Admin',
            'Admin',
            'Manager',
            'Data Entry',
        ];
        $UserTypes = User_type::where("id", "!=", Config::get("constants.UserTypeIds.SuperAdmin"))->get();

        return view('panel.admin.users.update', compact('admin', 'status', 'UserTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {

        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        $admin->role_id = $request->input('role_id');



        $admin->update();
        return redirect()->back()->with('status', 'Profile Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Request $request)
    // {
    //     // Admin::destroy($admin->id);
    //     // return back();
    // }


    public function destroy(Request $request)
    {
        
        $ErrorMsg = "";
        $data = [];
        // return $request->all();
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'user_id' => ['required', 'numeric'],
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

                $eloquent = User::where("id", $request->user_id);
                $deleteTrash = AppHelper::isArchiveRecord($eloquent);
                if ($deleteTrash["status"]) {
                    $data["status"] = $deleteTrash["status"];
                    $data["message"] = "User deleted successfully.";
                    // dd($request->progress_id);
                    // dd("select * from projects where id = " . $request->progress_id);
                    $updatedRecord = DB::select("select * from users where id = " . $request->user_id);
                    // dd($updatedRecord);
                    $data["data"] = (count($updatedRecord) > 0) ? $updatedRecord : [];
                } else {
                    $ErrorMsg = $deleteTrash["message"];
                }
            }
        } catch (\Throwable $e) {
            DB::rollback();
            $ErrorMsg = "Error Occurred while deleting user. Exception Msg : " . $e->getMessage();
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
