<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use Illuminate\Http\Request;
use App\Http\Requests\AmenitiesRequest;
use App\Helpers\AppHelper;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class AmenitiesController extends Controller
{
    //

    public function index()
    {
        $amenities = Amenity::all();


        return view('panel.admin.amenities.index', compact('amenities'));
    }

    public function create()
    {
        return view('panel.admin.amenities.create');
    }

    public function store(AmenitiesRequest $request)
    {
        Amenity::create([
            'amenity_name' => $request->amenity_name,
            'is_active' => $request->is_active,
        ]);

        return redirect('/admin/amenities')->with('message', 'Amenity Created Successfully');;
    }

    public function edit(Amenity $amenity)
    {
        return view('panel.admin.amenities.edit', compact('amenity'));
    }

    public function update(AmenitiesRequest $request, Amenity $amenity)
    {
        $amenity->amenity_name = $request->amenity_name;
        $amenity->is_active = $request->is_active;
        $amenity->save();
        $amenity->touch();
        return redirect('/admin/amenities')->with('message', 'Amenity Updated Successfully');
    }


    // public function destroy(Amenity $amenity)
    // {
    //     Amenity::destroy($amenity->id);
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
                'amenity_id' => ['required', 'numeric'],
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

                $eloquent = Amenity::where("id", $request->amenity_id);
                $deleteTrash = AppHelper::isArchiveRecord($eloquent);
                if ($deleteTrash["status"]) {
                    $data["status"] = $deleteTrash["status"];
                    $data["message"] = "Amenity deleted successfully.";
                } else {
                    $ErrorMsg = $deleteTrash["message"];
                }
            }
        } catch (\Throwable $e) {
            DB::rollback();
            $ErrorMsg = "Error Occurred while deleting Amenity. Exception Msg : " . $e->getMessage();
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
