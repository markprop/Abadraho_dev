<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Utility;
use App\Http\Requests\UtilitiesRequest;
use Illuminate\Http\Request;
use App\Helpers\AppHelper;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class UtilitiesController extends Controller
{
    //

    public function index()
    {
        $utilities = Utility::all();


        return view('panel.admin.utilities.index', compact('utilities'));
    }

    public function create()
    {
        return view('panel.admin.utilities.create');
    }

    public function store(UtilitiesRequest $request)
    {
        Utility::create([
            'utility_name' => $request->utility_name,
            'is_active' => $request->is_active,
        ]);

        return redirect('/admin/utilities')->with('message', 'Amenity Created Successfully');
    }

    public function edit(Utility $utility)
    {
        return view('panel.admin.utilities.edit', compact('utility'));
    }

    public function update(UtilitiesRequest $request, Utility $utility)
    {
        $utility->utility_name = $request->utility_name;
        $utility->is_active = $request->is_active;
        $utility->save();
        $utility->touch();
        return redirect('/admin/utilities')->with('message', 'Amenity Updated Successfully');
    }


    // public function destroy(Utility $utility)
    // {
    //     Utility::destroy($utility->id);
    //     return back()->with('delete', 'Amenity Deleted Successfully' );
    // }

    public function destroy(Request $request)
    {

        $ErrorMsg = "";
        $data = [];
        // return $request->all();
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'utility_id' => ['required', 'numeric'],
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

                $eloquent = Utility::where("id", $request->utility_id);
                $deleteTrash = AppHelper::isArchiveRecord($eloquent);
                if ($deleteTrash["status"]) {
                    $data["status"] = $deleteTrash["status"];
                    $data["message"] = "Utility deleted successfully.";
                } else {
                    $ErrorMsg = $deleteTrash["message"];
                }
            }
        } catch (\Throwable $e) {
            DB::rollback();
            $ErrorMsg = "Error Occurred while deleting Utility. Exception Msg : " . $e->getMessage();
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
