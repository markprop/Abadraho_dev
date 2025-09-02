<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Unit;
use App\Models\Project;
use App\Models\Measurement;
use App\Models\ProjectType;
use Illuminate\Http\Request;
use App\Models\InstallmentType;
use App\Http\Requests\UnitRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\UnitRoom;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Helpers\AppHelper;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        // return $this->middleware('auth:admin');
        $this->middleware('manage_user_types');
    }
    public function index()
    {
        return "ss";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $project = Project::get()->where('id', 12);
        $project_id = $request->id;
        $measurements = Measurement::all();
        $types = ProjectType::all();
        $installments = InstallmentType::all();
        // dd($project, $request->id, 'create unit');
        return view('panel.admin.unit.create', compact('project_id', 'measurements', 'types', 'installments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UnitRequest $request)
    {
        if ($request->measurement_type == NULL) {
            $request->measurement_type = 1;
        }

        if ($request->installment_type == NULL) {
            $request->installment_type = 1;
        }

        $measurementData = Measurement::where('id', $request->measurement_type)->first();

        if ($request->covered_area != NULL) {
            if ($request)
                $measurementInFeet = $request->covered_area * $measurementData->convertor;
        } else {
            $measurementInFeet = NULL;
        }

        $price = $request->price ? $request->price : 0;
        $loanAmount = $request->loan_amount ? $request->loan_amount : 0;
        $totalUnitAmount = $price + $loanAmount;

        $unit = Unit::create([
            'title' => $request->title,
            'rooms' => $request->rooms,
            'covered_area' => $measurementInFeet,
            'measurement_type' => $request->measurement_type,
            'project_id' => $request->project_id,
            'price' => $price,
            'loan_amount' => $loanAmount,
            'total_unit_amount' => $totalUnitAmount,
            'down_payment' => $request->down_payment,
            'monthly_installment' => $request->monthly_installment,
            'installment' => $request->installment,
            'installment_type' => $request->installment_type,
            'description' => $request->description,
            'unit_type_id' => $request->unit_type_id,
        ]);


        // Begin For Payment Plan
        if ($request->payment_plan_img) {
            $payment_plan_img_name = 'payment_plan_' . time() . '.' . $request->payment_plan_img->extension();
            $request->payment_plan_img->move(public_path('uploads/project_images/project_' . $request->project_id . '/unit_' . $unit->id), $payment_plan_img_name);
            $unit->payment_plan_img = $payment_plan_img_name;
        }
        // End For Payment Plan

        // Begin For Documents
        if ($request->floor_plan_img) {
            $floor_plan_img_name = 'floor_plan_' . time() . '.' . $request->floor_plan_img->extension();
            $request->floor_plan_img->move(public_path('uploads/project_images/project_' . $request->project_id . '/unit_'  . $unit->id), $floor_plan_img_name);
            $unit->floor_plan_img = $floor_plan_img_name;
        }
        // End For Documents

        $unit->save();
        $project = Project::where('id', $request->project_id)->first();
        if ($project->min_price == 0 || $project->min_price > $request->price) {
            $project->min_price = $request->price;
            $project->save();
        }
        
       return redirect('/admin/project/' .$project->id)->with('successMsg', 'Unit has been Added!');

        // return redirect('/admin/project/' . $project->slug);
        // dd($unit, 'store', $request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {
        $measurements = Measurement::all();
        $types = ProjectType::all();
        $installments = InstallmentType::all();
        return view('panel.admin.unit.update', compact('unit', 'measurements', 'types', 'installments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(UnitRequest $request, Unit $unit)
    {
        // this condition will never happend but is here just incase
        if ($request->measurement_type == NULL) {
            $request->measurement_type = 1;
        }

        // this condition will never happend but is here just incase
        if ($request->installment_type == NULL) {
            $request->installment_type = 1;
        }

        $measurementData = Measurement::where('id', $request->measurement_type)->first();

        if ($request->covered_area != NULL) {
            $measurementInFeet = $request->covered_area * $measurementData->convertor;
        } else {
            $measurementInFeet = NULL;
        }

        $price = $request->price ? $request->price : 0;
        $loanAmount = $request->loan_amount ? $request->loan_amount : 0;
        $totalUnitAmount = $price + $loanAmount;

        $unit->title = $request->title;
        $unit->rooms = $request->rooms;
        $unit->covered_area = $measurementInFeet;
        $unit->measurement_type = $request->measurement_type;
        $unit->price = $price;
        $unit->loan_amount = $loanAmount;
        $unit->total_unit_amount = $totalUnitAmount;
        $unit->monthly_installment = $request->monthly_installment;
        $unit->installment = $request->installment;
        $unit->installment_type = $request->installment_type;
        $unit->down_payment = $request->down_payment;
        $unit->description = $request->description;
        $unit->unit_type_id = $request->unit_type_id;
        // Begin For Payment Plan

        // If New Image Found
        if ($request->payment_plan_img) {
            // Delete Previous Image
            $image_path = '/uploads/project_images/project_' . $unit->project_id . '/unit_' . $unit->id  . '/' . $unit->payment_plan_img;
            File::delete(public_path() . $image_path);

            // Save New Image
            $payment_plan_img_name = 'payment_plan_' . time() . '.' . $request->payment_plan_img->extension();
            $request->payment_plan_img->move(public_path('uploads/project_images/project_' . $unit->project_id . '/unit_' . $unit->id), $payment_plan_img_name);
            $unit->payment_plan_img = $payment_plan_img_name;
        }
        // If Image Deleted
        elseif ($request->payment_plan_img_remove == 1) {
            $image_path = 'uploads/project_images/project_' . $unit->project_id . '/unit_' . $unit->id . '/' . $unit->payment_plan_img;
            Storage::disk('public')->delete($image_path); // Changed to use Storage facade with public disk
            $unit->payment_plan_img = NULL;
        }

        // End For Payment Plan

        // Begin For Floor Plan

        // If New Image Found
        if ($request->floor_plan_img) {
            // Delete Previous Image
            $image_path = '/uploads/project_images/project_' . $unit->project_id . '/unit_' . $unit->id  . '/' . $unit->floor_plan_img;
            File::delete(public_path() . $image_path);

            // Save New Image
            $floor_plan_img_name = 'floor_plan_' . time() . '.' . $request->floor_plan_img->extension();
            $request->floor_plan_img->move(public_path('uploads/project_images/project_' . $unit->project_id . '/unit_'  . $unit->id), $floor_plan_img_name);
            $unit->floor_plan_img = $floor_plan_img_name;
        }
        // If Image Deleted
        elseif ($request->floor_plan_img_remove == 1) {
            $image_path = 'uploads/project_images/project_' . $unit->project_id . '/unit_' . $unit->id . '/' . $unit->floor_plan_img;
            Storage::disk('public')->delete($image_path); // Changed to use Storage facade with public disk
            $unit->floor_plan_img = NULL;
        }
        // End For Documents

        $unit->save();
        $unit->touch();

        $project = Project::where('id', $unit->project_id)->first();
        // dd($project);
        if ($project->min_price == 0 || $project->min_price > $request->price) {
            $project->min_price = $request->price;
            $project->save();
        }
        
        return redirect('/admin/project/' .$project->id)->with('successMsg', 'Unit has been Updated!');

        // return redirect()->back()->withSuccess('Unit has been Updated!');

        // return redirect('/admin/project/' . $project->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Unit $unit)
    // {
    //     // Delete the folder from uploads
    //     $image_path = '/uploads/project_images/project_' . $unit->project_id . '/unit_' . $unit->id;
    //     File::deleteDirectory(public_path() . $image_path);

    //     Unit::destroy($unit->id);
    //     return back();
    // }

    public function destroy(Request $request)
    {
        // return $request->unit_id;

        $ErrorMsg = "";
        $data = [];
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'unit_id' => ['required'],
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

                $projectUnit = Unit::where("id", $request->unit_id);
                $deleteProject = AppHelper::isArchiveRecord($projectUnit);
                if ($deleteProject["status"]) {
                    $data["status"] = $deleteProject["status"];
                    $data["message"] = "Project Unit deleted successfully.";
                    // dd($request->project_id);
                    // dd("select * from projects where id = " . $request->project_id);
                    $updatedRecord = DB::select("select * from units where id = " . $request->unit_id);
                    // dd($updatedRecord);
                    $data["data"] = (count($updatedRecord) > 0) ? $updatedRecord : [];
                } else {
                    $ErrorMsg = $deleteProject["message"];
                }
            }
        } catch (\Throwable $e) {
            DB::rollback();
            $ErrorMsg = "Error Occurred while deleting project unit. Exception Msg : " . $e->getMessage();
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


    public function createUnitRoomBackup(Request $request, Unit $unit)
    {
        $requestData = request()->validate([
            'room_type_id' => 'required',
            'unit_id' => 'required',
            'width' => 'required',
            'length' => 'required',
            // 'covered_area' => 'required',
            'extras' => 'required',
        ]);
        // dd($request->all());
        $room_type_id = $request->room_type_id;
        $unit_id = $request->id;
        $width = $request->width;
        $length = $request->length;
        $covered_area = $width * $length;
        $extras = $request->extras;
        $unitRoom = $unit->room()->attach(['room_type_id' => $room_type_id], array('unit_id' => $unit_id, 'width' => $width, 'length' => $length, 'covered_area' => $covered_area, 'extras' => $extras));
        // dd('test');
        // dd($unit->room()->attach(['room_type_id' => 3], array('unit_id' => $request->id, 'width' => 4, 'length' => 5)), $request->id);
        // dd($unitRoom);
        // exit;
        return ['success' => true, 'message' => 'New user created !!'];
    }

    // public function createUnitRoom(Request $request, Unit $unit)
    // {
    //     dd($request->all());
    //     $requestData = request()->validate([
    //         'room_type_id' => 'required',
    //         'unit_id' => 'required',
    //         'size' => 'min:0',
    //         'width_feet' => 'min:0',
    //         'width_inches' => 'min:0|max:11',
    //         'length_feet' => 'min:0',
    //         'length_inches' => 'min:0|max:11',
    //         'covered_area' => 'min:0',
    //         'extras' => '',
    //     ]);

    //     $width_inches = (12 * $request->width_feet) + $request->width_inches;
    //     $length_inches = (12 * $request->length_feet) + $request->length_inches;
    //     if ($request->covered_area) {
    //         $covered_area = $request->covered_area * 144;
    //     } else {
    //         $covered_area = $width_inches * $length_inches;
    //     }
    //     $unitRoom = $unit->room()->attach(['room_type_id' => $request->room_type_id], array('unit_id' => $request->unit_id, 'project_id' => $request->project_id, 'width' => $width_inches, 'length' => $length_inches, 'covered_area' => $covered_area, 'extras' => $request->extras));
    //     // dd($unit->id);
    //     // return redirect('admin/project/' . $request->project_id);
    //     return back();
    // }

    public function createUnitRoom(Request $request, Unit $unit)
    {
        // dd($request->all());

        // return $request->all();
        $ErrorMsg = "";
        $data = [];
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'room_type_id' => 'required',
                'unit_id' => 'required',
                // 'size' => 'min:0',
                'width_feet' => 'min:1',
                'width_inches' => 'min:0|max:11',
                'length_feet' => 'min:1',
                'length_inches' => 'min:0|max:11',
                'covered_area' => 'min:0',
                'extras' => '',
            ]);

            if ($validator->fails()) {
                $data["status"] = false;
                $data["message"] = "Some thing went wrong: Validation Error.";
                $data["error"] = $validator->errors();
                return response()->json($data, 200);
            }
            // return response()->json($data, 200);
            if ($ErrorMsg == "") {
                $DataSet = UnitRoom::create([
                    "unit_id" => $request->unit_id,
                    "project_id" => $request->project_id,
                    "width" => $request->width,
                    "width_feet" => $request->width_feet,
                    "width_inches" => $request->width_inches,
                    "length" => $request->length,
                    "length_feet" => $request->length_feet,
                    "length_inches" => $request->length_inches,
                    "room_type_id" => $request->room_type_id,
                    "covered_area" => $request->covered_area,
                    "extras" => $request->extras,
                    "is_display_on_listing" => 1,
                ]);
                if ($DataSet) {
                    $data["status"] = true;
                    $data["message"] = "Add unit room successfully.";
                    $data["data"] = $DataSet;
                }
            }
        } catch (\Throwable $e) {
            DB::rollback();
            $ErrorMsg = "Error Occurred while add new unit room. Exception Msg : " . $e->getMessage();
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

    public function updateRoom(Request $request, Unit $unit)
    {

        // return $request->all();
        $ErrorMsg = "";
        $data = [];
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'room_type_id' => 'required',
                'unit_id' => 'required',
                'table_id' => 'required',
                'width_feet' => 'min:1',
                'width_inches' => 'min:0|max:11',
                'length_feet' => 'min:1',
                'length_inches' => 'min:0|max:11',
                'covered_area' => 'min:0',
                'extras' => '',
            ]);

            if ($validator->fails()) {
                $data["status"] = false;
                $data["message"] = "Some thing went wrong: Validation Error.";
                $data["error"] = $validator->errors();
                return response()->json($data, 200);
            }
            // return response()->json($data, 200);
            if ($ErrorMsg == "") {
                $DataSet = UnitRoom::where("id", $request->table_id)->update([
                    "unit_id" => $request->unit_id,
                    "project_id" => $request->project_id,
                    "width" => $request->width,
                    "width_feet" => $request->width_feet,
                    "width_inches" => $request->width_inches,
                    "length" => $request->length,
                    "length_feet" => $request->length_feet,
                    "length_inches" => $request->length_inches,
                    "room_type_id" => $request->room_type_id,
                    "covered_area" => $request->covered_area,
                    "extras" => $request->extras,
                    // "is_display_on_listing" => $request->is_display_on_listing,
                ]);
                if ($DataSet) {
                    $data["status"] = true;
                    $data["message"] = "Unit room details updated successfully.";
                    $data["data"] = $DataSet;
                }
            }
        } catch (\Throwable $e) {
            DB::rollback();
            $ErrorMsg = "Error Occurred while update unit room. Exception Msg : " . $e->getMessage();
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


    // public function updateRoom(Request $request)
    // {

    //     request()->validate([
    //         'room_type_id' => 'required',
    //         'unit_id' => 'required',
    //         'size' => 'min:0',
    //         'width_feet' => 'min:0',
    //         'width_inches' => 'min:0|max:11',
    //         'length_feet' => 'min:0',
    //         'length_inches' => 'min:0|max:11',
    //         'covered_area' => 'min:0',
    //         'extras' => '',
    //     ]);

    //     $width_inches = (12 * $request->width_feet) + $request->width_inches;
    //     $length_inches = (12 * $request->length_feet) + $request->length_inches;
    //     if ($request->covered_area) {
    //         $covered_area = $request->covered_area * 144;
    //     } else {
    //         $covered_area = $width_inches * $length_inches;
    //     }

    //     $query = DB::table('room_type_unit')
    //         ->where('id', $request->table_id)
    //         ->update([
    //             'room_type_id' => $request->room_type_id,
    //             'unit_id' => $request->unit_id,
    //             'width' => $width_inches,
    //             'length' => $length_inches,
    //             'covered_area' => $covered_area,
    //             'extras' => $request->extras
    //         ]);

    //     return back();
    // }

    // public function destroyRoom(Request $request, $room_id)
    // {
    //     DB::table('room_type_unit')->delete($room_id);
    //     return back();
    // }

    public function isArchiveUnitRoom(Request $request)
    {
        $ErrorMsg = "";
        $data = [];
        DB::beginTransaction();
        try {
            // Validate that unit_room_ids is provided (can be a string or array)
            $validator = Validator::make($request->all(), [
                'unit_room_ids' => 'required', // Accept string or array
            ]);
    
            if ($validator->fails()) {
                $data["status"] = false;
                $data["message"] = "Something went wrong: Validation Error.";
                $data["error"] = $validator->errors();
                return response()->json($data, 200);
            }
    
            // Handle the input (could be a comma-separated string or array)
            $roomIds = $request->input('unit_room_ids');
            if (is_string($roomIds)) {
                $roomIds = explode(',', $roomIds); // Convert comma-separated string to array
            }
    
            // Ensure $roomIds is an array
            if (!is_array($roomIds)) {
                $roomIds = [$roomIds]; // Wrap single value in array if not already
            }
    
            // Validate each ID exists in the room_type_unit table
            $validator->after(function ($validator) use ($roomIds) {
                foreach ($roomIds as $id) {
                    if (!UnitRoom::withoutGlobalScope(HasIsNonArchiveScope::class)->where('id', intval($id))->exists()) {
                        $validator->errors()->add('unit_room_ids', "Unit room ID {$id} does not exist or is already archived.");
                    }
                }
            });
    
            if ($validator->fails()) {
                $data["status"] = false;
                $data["message"] = "Something went wrong: Validation Error.";
                $data["error"] = $validator->errors();
                return response()->json($data, 200);
            }
    
            if ($ErrorMsg == "") {
                $successCount = 0;
                $failedIds = [];
    
                foreach ($roomIds as $id) {
                    $unitRoomQuery = UnitRoom::withoutGlobalScope(HasIsNonArchiveScope::class)->where('id', intval($id));
                    $result = AppHelper::isArchiveRecord($unitRoomQuery);
    
                    if ($result["status"]) {
                        $successCount++;
                    } else {
                        $failedIds[] = $id;
                        $ErrorMsg = $result["message"] ?: "Failed to archive Unit room ID {$id}.";
                    }
                }
    
                if ($successCount > 0) {
                    $data["status"] = true;
                    $data["message"] = $successCount === count($roomIds)
                        ? "Unit room(s) deleted successfully."
                        : "Partially deleted: {$successCount} of " . count($roomIds) . " unit room(s) deleted. Failed IDs: " . implode(', ', $failedIds);
                    $updatedRecords = DB::select("SELECT * FROM room_type_unit WHERE id IN (" . implode(',', array_map('intval', $roomIds)) . ")");
                    $data["data"] = !empty($updatedRecords) ? $updatedRecords : [];
                } else {
                    $data["status"] = false;
                    $data["message"] = "No unit rooms were deleted. " . ($ErrorMsg ?: "Unknown error.");
                }
            }
        } catch (\Throwable $e) {
            DB::rollback();
            $ErrorMsg = "Error Occurred while deleting UnitRoom(s). Exception Msg : " . $e->getMessage();
            $data["status"] = false;
            $data["message"] = $ErrorMsg;
        }
        if ($ErrorMsg == "" && $data["status"]) {
            DB::commit();
            return response()->json($data, 200);
        } else {
            DB::rollback();
            $data["status"] = false;
            $data["message"] = $ErrorMsg ?: $data["message"];
            return response()->json($data, 200);
        }
    }
}