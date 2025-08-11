<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProjectType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectTypeRequest;
use App\Helpers\AppHelper;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ProjectTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        // $this->middleware('auth:admin');
        $this->middleware('manage_user_types');
    }

    public function index()
    {
        $projectTypes = ProjectType::all();
        return view('panel.admin.type.index', compact('projectTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.admin.type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectTypeRequest $request)
    {
        ProjectType::create([
            'title' => $request->title,
        ]);

        return redirect('/admin/project_type');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectType  $projectType
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectType $projectType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectType  $projectType
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectType $projectType)
    {
        return view('panel.admin.type.edit', compact('projectType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProjectType  $projectType
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectTypeRequest $request, ProjectType $projectType)
    {
        $projectType->title = $request->title;
        $projectType->save();
        $projectType->touch();
        return redirect('/admin/project_type');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectType  $projectType
     * @return \Illuminate\Http\Response
     */

    // public function destroy(ProjectType $projectType)
    // {
    //     ProjectType::destroy($projectType->id);
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
                'project_type_id' => ['required', 'numeric'],
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

                $eloquent = ProjectType::where("id", $request->project_type_id);
                $deleteTrash = AppHelper::isArchiveRecord($eloquent);
                if ($deleteTrash["status"]) {
                    $data["status"] = $deleteTrash["status"];
                    $data["message"] = "Project type deleted successfully.";
                    // dd($request->progress_id);
                    // dd("select * from projects where id = " . $request->progress_id);
                    // $updatedRecord = DB::select("select * from areas where id = " . $request->project_type_id);
                    // dd($updatedRecord);
                    // $data["data"] = (count($updatedRecord) > 0) ? $updatedRecord : [];
                } else {
                    $ErrorMsg = $deleteTrash["message"];
                }
            }
        } catch (\Throwable $e) {
            DB::rollback();
            $ErrorMsg = "Error Occurred while deleting project type. Exception Msg : " . $e->getMessage();
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
