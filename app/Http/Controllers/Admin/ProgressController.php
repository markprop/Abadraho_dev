<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProgressRequest;
use App\Models\Progress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Helpers\AppHelper;

class ProgressController extends Controller
{
    //

    public function index()
    {
        $progress = Progress::all();
        

        return view('panel.admin.progress.index', compact('progress'));
    }

    public function create()
    {
        return view('panel.admin.progress.create');
    }

    public function store(ProgressRequest $request)
    {
        Progress::create([
            'progress_status_name' => $request->progress_status_name,
            'isActive' => $request->isActive,
        ]);

        return redirect('/admin/progress')->with('message', 'Progress Created Successfully' );
    }

    public function edit(Progress $progress_data)
    {
        return view('panel.admin.progress.edit', compact('progress_data'));
    }

    public function update(ProgressRequest $request, Progress $progress_data)
    {
        $progress_data->progress_status_name = $request->progress_status_name;
        $progress_data->isActive = $request->isActive;
        $progress_data->save();
        $progress_data->touch();
        return redirect('/admin/progress')->with('message', 'Progress Updated Successfully' );
    }

    public function destroy(Request $request)
    {
        
        // return $request->progress_id;
        $ErrorMsg = "";
        $data = [];
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'progress_id' => ['required','numeric'],
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

                $eloquent = Progress::where("id", $request->progress_id);
                $deleteTrash = AppHelper::isArchiveRecord($eloquent);
                if ($deleteTrash["status"]) {
                    $data["status"] = $deleteTrash["status"];
                    $data["message"] = "Progress deleted successfully.";
                    // dd($request->progress_id);
                    // dd("select * from projects where id = " . $request->progress_id);
                    $updatedRecord = DB::select("select * from progress_status where id = " . $request->progress_id);
                    // dd($updatedRecord);
                    $data["data"] = (count($updatedRecord) > 0) ? $updatedRecord : [];
                } else {
                    $ErrorMsg = $deleteTrash["message"];
                }
            }
        } catch (\Throwable $e) {
            DB::rollback();
            $ErrorMsg = "Error Occurred while deleting Progress. Exception Msg : " . $e->getMessage();
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
