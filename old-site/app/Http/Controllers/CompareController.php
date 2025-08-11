<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use Carbon\Carbon;
use App\Models\Tag;
use App\Models\Area;
use App\Models\Unit;
use App\Models\Project;
use Carbon\Traits\Units;
use App\Models\ProjectInfo;
use App\Models\ProjectType;
use App\Models\RecentViews;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use GuzzleHttp\Promise\Create;
use App\Models\InstallmentType;
use App\Models\PaymentSchedule;
use App\Models\UserSearchHistory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Session\Session;
use App\Http\Controllers\API\BaseController;
use App\Models\RoomType;
use Illuminate\Support\Facades\DB;

class CompareController extends Controller
{
    public function __construct()
    {
        // dd($this->middleware('auth'));
//        $this->middleware('auth');

        $this->ProjectModel = Project::query();
    }

    public function index(Request $request, $selectedProjectId = "")
    {
        if (!empty($selectedProjectId) && $request->has('clicked')) {
            $project = Project::find($selectedProjectId);
            AppHelper::addActivityLog([
                "log_name" => config("constants.CustomActivityLogs.compareProjectDetail.value"),
                "log_table" => "projects",
                "project_name" => $project->name,
                "subject_type" => "App\\Models\\Project",
                "subject_id" => $project->id,
                "page_url" => url("/compare/" . $project->id),
                "conversion_id" => config("constants.ActivityLogsConversionIds.clickToCompareId"),
                "description" => "Compare " . $project->name
            ]);
        }

        AppHelper::addActivityLog([
            "log_name" => config("constants.CustomActivityLogs.compareProjectDetail.value"),
            "page_url" => url()->current(),
            "conversion_id" => config("constants.ActivityLogsConversionIds.viewPageId"),
            "description" => "View Compare Page"
        ]);

        $areas = Area::all();
        $projectTypes = ProjectType::all();
        $tags = Tag::all();
        $projects = Project::all();
        return view('project.compare-new', compact('selectedProjectId', 'projects', 'areas', 'projectTypes', 'tags'));
    }

    public function comparenew(Request $request, $id)
    {
        $projects = Project::all();
        return view('compare2', compact('projects'));
    }

    public function gettypes(Request $request, $id)
    {
        $types = Unit::with('project')->where('project_id', $id)->get();
        return \response()->json(['types' => $types]);
    }

    public function get_project_compare(Request $request)
    {
        $project = Project::with('units')
            ->with('owners')
            ->with('location')
            ->with('areas')
            ->with('tags')
            ->find($request->project);
        return \response()->json(['project' => $project]);
    }

    public function compare_list(Request $request)
    {
        $areas = Area::all();
        $projectTypes = ProjectType::all();
        $tags = Tag::all();
        $area = $request->area;
        $progress = $request->progress;
        $type = $request->type_id;
        $tag = $request->tag_id;
        $projects_compare = 0;

        // Filter Start
        $projects = Project::with('project_unit_rooms')
            ->with('units.type')
            ->with('units.installments')
            ->with('units')
            ->with('owners')
            ->with('location')
            ->with('areas')
            ->with('tags')
            ->where('status', 1);

        // Filter by builder name


        // Filter By Areas
        if ($area) {

            $projects = $projects->whereHas('areas', function ($query) use ($area) {
                $query->whereIn('area_id', $area);
            });
        }

        // Filter by Progress
        if ($progress) {
            $projects = $projects->whereIn('progress', $progress);
        }

        // Filter by Project Type
        if ($type) {
            // $projects = $projects->whereIn('project_type_id', $type);
            $projects = $projects->whereHas('units', function ($query) use ($type) {
                $query->whereIn('unit_type_id', $type);
            });
        }

        if ($tag) {
            $projects = $projects->whereHas('tags', function ($query) use ($tag) {
                $query->whereIn('tag_id', $tag);
            });
        }

        $projects = $projects->get();
        //dd($projects);
        //dd($request->all());
        //$projects_compare = Project::join()->join()->join()->whereIn('id', $request->check)->get();
        if ($request->check != null) {
            $projects_compare = Project::whereIn('id', $request->check)->get();
        }
        //dd($projects_compare);
        return view('compare', compact('projects_compare', 'projects', 'areas', 'projectTypes', 'tags'));
    }

    public function FilterCompareProjects(Request $request)
    {

        $ErrorMsg = "";
        $data = [];
        DB::beginTransaction();
        try {
            // echo "<pre>";
            // dd(Project::with('project_rooms.RoomType')->get()->toArray()[6]);
            // dd(Project::with('project_rooms.Rooms')->get()->toArray()[6]) ;
            // return;
            if ($ErrorMsg == "") {
                $area = $request->area;
                $progress = $request->progress;
                $unit_type_id = $request->unit_type_id;
                $project_type = $request->project_type;
                $tag = $request->tag_id;

                // Filter Start
                // $projects = Project::with('units', 'owners', 'location', 'areas', 'tags', 'project_unit_rooms')->where('status', 1);
                $projects = Project::with('units.type')
                    ->with('units.installments')
                    ->with(['units.UnitRooms.RoomType' => function ($query) {
                        $query->orderBy("sort_order", "desc");
                    }])
                    // ->with("units.UnitRooms")
                    ->with(['units.UnitRooms' => function ($query) {
                        $query->orderBy("room_type_id", "asc");
                    }])
                    ->with('units.measurement')
                    ->with('units')
                    ->with('owners')
                    ->with('location')
                    ->with('areas')
                    ->with('tags')
                    ->with('ProjectUtils.Utility:id,utility_name')
                    ->with('ProjectUtils:id,project_id,utility_id')
                    ->with('ProjectAmenities.Amenity:id,amenity_name')
                    ->with('ProjectAmenities:id,project_id,amenity_id')
                    ->where('status', 1);
                // Filter by builder name
                // dd($projects->get()->toArray()[2]);


                // Filter By Areas
                if (count($area)) {
                    $areaIds = array_column($area, 'id');
                    $projects = $projects->whereHas('areas', function ($query) use ($areaIds) {
                        $query->whereIn('area_id', $areaIds);
                    });
                }
                // Filter by Progress
                if (count($progress)) {
                    $projects = $projects->whereIn('progress', $progress);
                }
                // Filter by Project Type
                if (count($project_type)) {
                    $projectTypeIds = array_column($project_type, 'id');
                    // $projects = $projects->whereIn('project_type_id', $unit_type_id);
                    $projects = $projects->whereHas('units', function ($query) use ($projectTypeIds) {
                        $query->whereIn('unit_type_id', $projectTypeIds);
                    });
                }

                if ($tag) {
                    $projects = $projects->whereHas('tags', function ($query) use ($tag) {
                        $query->whereIn('tag_id', $tag);
                    });
                }
                $projects = $projects->get();

                $data["status"] = true;
                $data["message"] = count($projects) > 0 ? "Projects Found Successfully." : "Projects Not Found.";
                $data["data"] = $projects->toArray();
                // return ($data);
            }
        } catch (\Throwable $e) {
            DB::rollback();
            $ErrorMsg = "Error Occurred while finding projects for comparing. Exception Msg : " . $e->getMessage();
            $data["status"] = false;
            $data["message"] = $ErrorMsg;
        }
        if ($ErrorMsg == "") {
            DB::commit();
            $data["roomTypes"] = RoomType::where("to_show", 1)->get();
            return response()->json($data, 200);
        } else {
            $data["status"] = false;
            $data["message"] = $ErrorMsg;
            // $data["Obj"] = $request->all();
            return response()->json($data, 200);
        }
    }
}
