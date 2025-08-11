<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoomType;
use Illuminate\Http\Request;
use \Awps\FontAwesome;
use App\Helpers\AppHelper;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class RoomTypeController extends Controller
{
    public function __construct()
    {
        // return $this->middleware('auth:admin');
        $this->middleware('manage_user_types');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roomTypes = RoomType::all();
        return view('panel.admin.room.index', compact('roomTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $icons = new \Awps\FontAwesome();
        $icon_arr = $icons->getAllData();

        return view('panel.admin.room.create', compact('icon_arr'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        RoomType::create(request()->validate([
            'name' => 'required|unique:room_types',
            'icon' => '',
            'to_show' => '',
        ]));

        return redirect('/admin/room_type');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RoomType  $roomType
     * @return \Illuminate\Http\Response
     */
    public function edit(RoomType $roomType)
    {
        $icons = new \Awps\FontAwesome();
        $icon_arr = $icons->getAllData();
        return view('panel.admin.room.edit', compact('roomType', 'icon_arr'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RoomType  $roomType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RoomType $roomType)
    {
        request()->validate([
            'name' => 'required|unique:room_types,name,' . $roomType->id,
            'to_show' => ''
        ]);

        $roomType->name = $request->name;
        $roomType->icon = $request->icon;
        $roomType->to_show = $request->to_show;
        $roomType->save();
        $roomType->touch();

        return redirect('/admin/room_type');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RoomType  $roomType
     * @return \Illuminate\Http\Response
     */

    // public function destroy(RoomType $roomType)
    // {
    //     RoomType::destroy($roomType->id);
    //     return back();
    // }

    public function destroy(Request $request)
    {

        $ErrorMsg = "";
        $data = [];
        // return $request->all();
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'room_type_id' => ['required', 'numeric'],
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

                $eloquent = RoomType::where("id", $request->room_type_id);
                $deleteTrash = AppHelper::isArchiveRecord($eloquent);
                if ($deleteTrash["status"]) {
                    $data["status"] = $deleteTrash["status"];
                    $data["message"] = "Room type deleted successfully.";
                } else {
                    $ErrorMsg = $deleteTrash["message"];
                }
            }
        } catch (\Throwable $e) {
            DB::rollback();
            $ErrorMsg = "Error Occurred while deleting Room type. Exception Msg : " . $e->getMessage();
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
