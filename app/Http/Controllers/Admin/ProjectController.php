<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Area;
use App\Models\Builder;
use App\Models\Project;
use App\Models\RoomType;
use App\Models\Measurement;
use App\Models\ProjectInfo;
use App\Models\Amenity;
use App\Models\Utility;
use App\Models\ProjectType;
use Illuminate\Support\Str;
use App\Models\ProjectUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProjectRequest;
use App\Helpers\AppHelper;
use App\Models\Progress;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\ProjectAmenities;
use App\Models\ProjectUtilities;
use Illuminate\Support\Facades\Config;
use App\Models\ProjectOwners;

class ProjectController extends Controller
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

    public function index(Request $request)
    {
        // dd (Auth::user()->user_type_id == Config::get("constants.UserTypeIds.Builder"));
        // return Config::get("constants.UserTypeIds");
        // dd(Auth::user());
        // $admin = Builder::where('id', Auth::user()->id)->first();
        // $projects = $admin->projects;
        $status = [
            'Live',
            'Pending',
            'Declined',
        ];



        $projects = Project::orderBy("name", "ASC");

        if (Auth::user()->user_type_id == Config::get("constants.UserTypeIds.Builder")) {
            $Builder = Builder::where("user_id", Auth::user()->id)->first();
            $BuilderProjectIds = ProjectOwners::where("builder_id", $Builder->id)->pluck("project_id");
            // dd($BuilderProjectIds->toArray());

            $projects = $projects->whereIn("id", $BuilderProjectIds->toArray());
        }

        $searchQuery = [];
        $searchQuery['id'] = $request['id'] ? $request['id'] : null;
        $searchQuery['areas'] = $request['areas'] ? $request['areas'] : null;
        $searchQuery['progress'] = $request['progress'] ? $request['progress'] : null;
        $searchQuery['status'] = $request['status'] ? $request['status'] : null;
        $searchQuery['from'] = $request['from'] ?? "";
        $searchQuery['to'] = $request['to'] ?? "";
        // $searchQuery['daterange'] = $request['daterange'] ? $request['daterange'] : null;

        if ($request['id']) {
            foreach ($request['id'] as $project_id) {
                $projects = $projects->Where('id', $project_id);
            }
            // $builder = $request['id'];
            // $projects = $projects->whereHas('owners', function ($query) use ($builder) {
            //     $query->whereIn('builder_id', $builder);
            // });
        }
        if ($request['areas']) {
            // dd("i m running!!!", $request['areas']);
            // foreach ($request['areas'] as $area) {
            //     $projects = $projects->Where('area', $area);
            // }
            $area = $request['areas'];
            $projects = $projects->whereHas('areas', function ($query) use ($area) {
                $query->whereIn('area_id', $area);
            });
        }
        if ($request['progress']) {
            // foreach ($request['progress'] as $progress) {
            //     $projects = $projects->Where('progress', $progress);
            // }
            $progress = $request['progress'];
            $projects = $projects->whereIn('progress', $progress);
        }
        if ($request['status']) {
            // foreach ($request['status'] as $status1) {
            //     $projects = $projects->Where('status', $status1);
            // }
            $status1 = $request['status'];
            $projects = $projects->whereIn('status', $status1);
        }
        if ($request['from'] != "" && $request['to'] != "") {
            $projects = $projects->whereBetween("created_at", [$request['from'], $request['to']]);
        }

        // $projects = $projects->select("id")->get()->toArray();
        $projects = $projects->get();
        // dd($projects->toArray());
        return view('panel.admin.project.index', compact('projects', 'status', 'searchQuery'));
    }

    public function pending(Request $request)
    {
        // dd (Auth::user()->user_type_id == Config::get("constants.UserTypeIds.Builder"));
        // return Config::get("constants.UserTypeIds");
        // dd(Auth::user());
        // $admin = Builder::where('id', Auth::user()->id)->first();
        // $projects = $admin->projects;
        $status = [
            'Live',
            'Pending',
            'Declined',
        ];

        $projects = Project::orderBy("name", "ASC")->where("status", 2);
        $allProjects = Project::orderBy("name", "ASC");

        if (Auth::user()->user_type_id == Config::get("constants.UserTypeIds.Builder")) {
            $Builder = Builder::where("user_id", Auth::user()->id)->first();
            $BuilderProjectIds = ProjectOwners::where("builder_id", $Builder->id)->pluck("project_id");
            // dd($BuilderProjectIds->toArray());

            $projects = $projects->whereIn("id", $BuilderProjectIds->toArray());
            $allProjects = $allProjects->whereIn("id", $BuilderProjectIds->toArray());
        }

        $searchQuery = [];
        $searchQuery['id'] = $request['id'] ? $request['id'] : null;
        $searchQuery['areas'] = $request['areas'] ? $request['areas'] : null;
        $searchQuery['progress'] = $request['progress'] ? $request['progress'] : null;
        $searchQuery['status'] = $request['status'] ? $request['status'] : null;
        $searchQuery['from'] = $request['from'] ?? "";
        $searchQuery['to'] = $request['to'] ?? "";
        // $searchQuery['daterange'] = $request['daterange'] ? $request['daterange'] : null;

        if ($request['id']) {
            foreach ($request['id'] as $project_id) {
                $projects = $projects->Where('id', $project_id);
            }
            // $builder = $request['id'];
            // $projects = $projects->whereHas('owners', function ($query) use ($builder) {
            //     $query->whereIn('builder_id', $builder);
            // });
        }
        if ($request['areas']) {
            // dd("i m running!!!", $request['areas']);
            // foreach ($request['areas'] as $area) {
            //     $projects = $projects->Where('area', $area);
            // }
            $area = $request['areas'];
            $projects = $projects->whereHas('areas', function ($query) use ($area) {
                $query->whereIn('area_id', $area);
            });
        }
        if ($request['progress']) {
            // foreach ($request['progress'] as $progress) {
            //     $projects = $projects->Where('progress', $progress);
            // }
            $progress = $request['progress'];
            $projects = $projects->whereIn('progress', $progress);
        }
        if ($request['status']) {
            // foreach ($request['status'] as $status1) {
            //     $projects = $projects->Where('status', $status1);
            // }
            $status1 = $request['status'];
            $projects = $projects->whereIn('status', $status1);
        }
        if ($request['from'] != "" && $request['to'] != "") {
            $projects = $projects->whereBetween("created_at", [$request['from'], $request['to']]);
        }

        // $projects = $projects->select("id")->get()->toArray();
        $projects = $projects->get();
        $allProjects = $allProjects->get();
        // dd($projects->toArray());
        return view('panel.admin.project.index2', compact('projects', 'status', 'searchQuery', 'allProjects'));
    }

    public function active(Request $request)
    {
        // dd (Auth::user()->user_type_id == Config::get("constants.UserTypeIds.Builder"));
        // return Config::get("constants.UserTypeIds");
        // dd(Auth::user());
        // $admin = Builder::where('id', Auth::user()->id)->first();
        // $projects = $admin->projects;
        $status = [
            'Live',
            'Pending',
            'Declined',
        ];



        $projects = Project::orderBy("name", "ASC")->where("status", 1);
        $allProjects = Project::orderBy("name", "ASC");

        if (Auth::user()->user_type_id == Config::get("constants.UserTypeIds.Builder")) {
            $Builder = Builder::where("user_id", Auth::user()->id)->first();
            $BuilderProjectIds = ProjectOwners::where("builder_id", $Builder->id)->pluck("project_id");
            // dd($BuilderProjectIds->toArray());

            $projects = $projects->whereIn("id", $BuilderProjectIds->toArray());
            $allProjects = $allProjects->whereIn("id", $BuilderProjectIds->toArray());
        }

        $searchQuery = [];
        $searchQuery['id'] = $request['id'] ? $request['id'] : null;
        $searchQuery['areas'] = $request['areas'] ? $request['areas'] : null;
        $searchQuery['progress'] = $request['progress'] ? $request['progress'] : null;
        $searchQuery['status'] = $request['status'] ? $request['status'] : null;
        $searchQuery['from'] = $request['from'] ?? "";
        $searchQuery['to'] = $request['to'] ?? "";
        // $searchQuery['daterange'] = $request['daterange'] ? $request['daterange'] : null;

        if ($request['id']) {
            foreach ($request['id'] as $project_id) {
                $projects = $projects->Where('id', $project_id);
            }
            // $builder = $request['id'];
            // $projects = $projects->whereHas('owners', function ($query) use ($builder) {
            //     $query->whereIn('builder_id', $builder);
            // });
        }
        if ($request['areas']) {
            // dd("i m running!!!", $request['areas']);
            // foreach ($request['areas'] as $area) {
            //     $projects = $projects->Where('area', $area);
            // }
            $area = $request['areas'];
            $projects = $projects->whereHas('areas', function ($query) use ($area) {
                $query->whereIn('area_id', $area);
            });
        }
        if ($request['progress']) {
            // foreach ($request['progress'] as $progress) {
            //     $projects = $projects->Where('progress', $progress);
            // }
            $progress = $request['progress'];
            $projects = $projects->whereIn('progress', $progress);
        }
        if ($request['status']) {
            // foreach ($request['status'] as $status1) {
            //     $projects = $projects->Where('status', $status1);
            // }
            $status1 = $request['status'];
            $projects = $projects->whereIn('status', $status1);
        }
        if ($request['from'] != "" && $request['to'] != "") {
            $projects = $projects->whereBetween("created_at", [$request['from'], $request['to']]);
        }

        // $projects = $projects->select("id")->get()->toArray();
        $projects = $projects->get();
        $allProjects = $allProjects->get();
        // dd($projects->toArray());
        return view('panel.admin.project.index3', compact('projects', 'status', 'searchQuery', 'allProjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = ProjectType::all();
        $progressStatus = Progress::all();
        $builders = Builder::all();
        $areas = Area::all();
        $tags = Tag::all();
        return view('panel.admin.project.create', compact('progressStatus', 'types', 'builders', 'areas', 'tags'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    // public function storeProject(ProjectRequest $request)
    public function store(ProjectRequest $request)
    {
        // dd(Str::slug($request->name));
        // $projectName = "Saima Defence Mall & Residency";
        // dd (Str::slug($projectName));
        // $projectName = $request->name;
        // dd($request->all());

        $arrOwners = [];
        if (Auth::user()->user_type_id == Config::get("constants.UserTypeIds.Builder")) {
            $Builder = Builder::where("user_id", Auth::user()->id)->first();
            // $BuilderProjectIds = ProjectOwners::where("builder_id", $Builder->id)->pluck("project_id");
            // $arrOwners = array_push($arrOwners, $Builder->id);
            array_push($arrOwners, $Builder->id);
            // dd($BuilderProjectIds->toArray());
        } else {
            $arrOwners = $request->owners;
        }
        // dd($arrOwners);
        // dd($request->all());

        $projectSlug = Str::slug($request->name);
        $parsed_time = Carbon::now();
        if ($request->added_time) {
            $parsed_time = Carbon::parse($request->added_time);
        }
        // For property_id ID
        $property_id = bin2hex(random_bytes(2));
        $CheckDuplicateProjectSlug = Project::where("slug", $projectSlug)->count();
        // dd ($CheckDuplicateProjectSlug);
        if ($CheckDuplicateProjectSlug) {
            // return back()->with("successMsg", "Amenities addedd successfully.");
            return back()->withInput()->with("errorMsg", "This project name [" . $request->name . "] is already exist.");
        }

        $selectedProgress = Progress::where("id", $request->progress_status_id)->first();
            // dd($selectedProgress->progress_status_name);
        ;
        $projectInputArr = [
            'name' => $request->name,
            'address' => $request->address,
            'discount_price' => $request->discount_price,
            //  'area' => 2,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'progress_status_id' => $request->progress_status_id,
            'progress' => $selectedProgress->progress_status_name,
            'rooms' => $request->rooms,
            'details' => $request->details,
            // 'installment_length' => $request->installment_length,
            'slug' => $projectSlug,
            'added_time' => $parsed_time,
            'property_id' => $property_id,
            "project_video" => $request->project_video,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_tags' => $request->meta_tags,
            'marketed_by' => $request->marketed_by,
            'views' => 0,
        ];
        // dd($projectInputArr);
        $project = Project::create($projectInputArr);

        if ($request->status) {
            $project->status = $request->status;
        }
        // Begin For Documents
        if ($request->project_doc) {
            $project_doc_name = time() . '.' . $request->project_doc->extension();
            $request->project_doc->move(public_path('uploads/project_documents/project_' . $project->id), $project_doc_name);
            $project->project_doc = $project_doc_name;
        }
        // End For Documents
        // Begin For Images
        // dd($request->file('project_imgs'));
        if ($request->file('project_imgs')) {
            $imageName = array();
            if ($images = $request->file('project_imgs')) {
                foreach ($images as $image) {
                    $name = time() . '_' . $image->getClientOriginalName();
                    $image->move('uploads/project_images/project_' . $project->id, $name);
                    $imageName[] = 'uploads/project_images/project_' . $project->id . '/' . $name;
                }
            }
            $project->project_imgs = implode('|', $imageName);
        }
        // Begin For Cover Images
        if ($request->project_cover_img) {
            $project_cover_img_name = 'cover_' . time() . '.' . $request->project_cover_img->extension();
            $request->project_cover_img->move(public_path('uploads/project_images/project_' . $project->id), $project_cover_img_name);
            $project->project_cover_img = $project_cover_img_name;
        }
        // End For Cover Images

        // Begin for Project Video
        /*if ($request->hasFile('project_video')) {
            $filenameWithExt = $request->file('project_video')->getClientOriginalName();
            // $project_video_name = time() . '.' . $request->project_doc->extension();
            $request->project_video->move(public_path('uploads/project_videos/project_' . $project->id), $filenameWithExt);
            $project->project_video = $filenameWithExt;
        }*/


        $project->save();
        $project->touch();
        // End For Images

        $user = Auth::user();

        ProjectUsers::create([
            'project_id' => $project->id,
            'admin_id' => $user->id,
            'status' => 0,
        ]);

        // Begin for multiple areas
        $project->ProjectArea()->attach($request->areas);

        // Begin for multiple owners

        if ($arrOwners) {
            $project->owners()->attach($arrOwners);
        }
        // End for multiple owners

        // Begin for multiple tags
        $project->tags()->attach($request->tags);

        $projectInfo = ProjectInfo::create([
            'project_id' => $project->id,
            'main_heading' => $request->main_heading,
            'sub_heading' => $request->sub_heading,
            'bullet_1' => $request->bullet_1,
            'bullet_2' => $request->bullet_2,
            'bullet_3' => $request->bullet_3,
            'bullet_4' => $request->bullet_4,
            'bullet_5' => $request->bullet_5,
            'bullet_6' => $request->bullet_6,
        ]);

        // return redirect('admin/project/' . $project->slug)->withInput()->with();
        return redirect('admin/project/' . $project->id);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $amenities = Amenity::all();
        $utilities = Utility::all();


        $js = json_encode($project);
        $letter = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'];
        $roomTypes = RoomType::all();
        $measurements = Measurement::all();

        $total_months = $project->installment_length;
        $years = number_format(floor($total_months / 12));
        $months = number_format($total_months % 12);
        if ($months != 0) {
            $length = $years . ' Years ' . $months . ' Months';
        } else {
            $length = $years . ' Years';
        }

        $added_ago = Carbon::parse($project->added_time);
        $added_ago = $added_ago->diffForHumans();

        return view('panel.admin.project.show1', compact('amenities', 'utilities', 'project', 'letter', 'roomTypes', 'measurements', 'length', 'added_ago'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = ProjectType::all();
        $builders = Builder::all();
        $areas = Area::all();
        $tags = Tag::all();
        $progressStatus = Progress::all();
        $project_info = ProjectInfo::where('project_id', $project->id)->first();
        if ($project->added_time) {
            $time = Carbon::createFromFormat('Y-m-d H:i:s', $project->added_time)->format('d-m-Y H:i:s');
        } else {
            $time = '';
        }
        if (!$project_info) {
            ProjectInfo::create([
                'project_id' => $project->id,
                'main_heading' => '',
                'sub_heading' => '',
                'bullet_1' => '',
                'bullet_2' => '',
                'bullet_3' => '',
                'bullet_4' => '',
                'bullet_5' => '',
                'bullet_6' => '',
            ]);
        }
        // dd($project->toArray() , "ss");

        return view('panel.admin.project.update', compact('project', 'progressStatus', 'types', 'builders', 'areas', 'time', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $parsed_time = $request->added_time;

        if ($request->added_time) {
            $parsed_time = Carbon::parse($request->added_time);
        }

        $project->name = $request->name;
        $project->address = $request->address;
        // $project->area = $request->area;
        $project->latitude = $request->latitude;
        $project->longitude = $request->longitude;
        //  $project->project_type_id = $request->project_type_id;
        $progress = Progress::where("id", $request->progress_status_id)->first();
        // dd($progress->progress_status_name);
        $project->progress_status_id = $request->progress_status_id;
        $project->progress = $progress->progress_status_name;
        $project->rooms = $request->rooms;
        $project->details = $request->details;
        // $project->installment_length = $request->installment_length;
        $project->project_video = $request->project_video;
        $project->slug = Str::slug($request->name);
        $project->added_time = $parsed_time;
        $project->meta_title = $request->meta_title;
        $project->meta_description = $request->meta_description;
        $project->meta_tags = $request->meta_tags;
        $project->marketed_by = $request->marketed_by ?? "";
        $project->min_price = $request->min_price ?? 0;
        $project->discount_price = $request->discount_price ?? 0;

        if ($request->status) {
            $project->status = $request->status;
        }

        // Begin For Documents
        if ($request->project_doc) {
            // Delete Previous
            $path = '/uploads/project_documents/project_' . $project->id . '/' . $project->project_doc;
            File::delete(public_path() . $path);

            // Save New
            $project_doc_name = time() . '.' . $request->project_doc->extension();
            $request->project_doc->move(public_path('uploads/project_documents/project_' . $project->id), $project_doc_name);
            $project->project_doc = $project_doc_name;
        }
        // End For Documents

        // Begin For Images
        if ($request->file('project_imgs')) {
            $imageName = array();
            if ($images = $request->file('project_imgs')) {
                foreach ($images as $image) {
                    $name = time() . '_' . $image->getClientOriginalName();
                    $image->move('uploads/project_images/project_' . $project->id, $name);
                    $imageName[] = 'uploads/project_images/project_' . $project->id . '/' . $name;
                }
            }
            $project->project_imgs = implode('|', $imageName);
        }

        // Begin For Cover Images
        if ($request->project_cover_img) {
            // Delete Previous
            $path = '/uploads/project_videos/project_' . $project->id . '/' . $project->project_cover_img;
            File::delete(public_path() . $path);

            // Save New
            $project_cover_img_name = 'cover_' . time() . '.' . $request->project_cover_img->extension();
            $request->project_cover_img->move(public_path('uploads/project_images/project_' . $project->id), $project_cover_img_name);
            $project->project_cover_img = 'uploads/project_images/project_' . $project->id . '/' . $project_cover_img_name;
        }
        // End For Cover Images

        // Begin for Project Video
        /* if ($request->hasFile('project_video')) {
            // Delete Previous
            $path = '/' . $project->project_video;
            File::delete(public_path() . $path);

            // Save New
            $filenameWithExt = $request->file('project_video')->getClientOriginalName();
            // $project_video_name = time() . '.' . $request->project_doc->extension();
            $request->project_video->move(public_path('uploads/project_videos/project_' . $project->id), $filenameWithExt);
            $project->project_video = 'uploads/project_videos/project_' . $project->id . '/' . $filenameWithExt;
        }*/


        $project->save();
        $project->touch();
        // End For Images

        // Begin for multiple areas
        $project->ProjectArea()->sync($request->areas);
        // dd($request->all());

        // Begin for multiple owners
        $arrOwners = [];
        if (Auth::user()->user_type_id == Config::get("constants.UserTypeIds.Builder")) {
            $Builder = Builder::where("user_id", Auth::user()->id)->first();
            // $BuilderProjectIds = ProjectOwners::where("builder_id", $Builder->id)->pluck("project_id");
            // $arrOwners = array_push($arrOwners, $Builder->id);
            array_push($arrOwners, $Builder->id);
            // dd($BuilderProjectIds->toArray());
        } else {
            $arrOwners = $request->owners;
        }
        // End for multiple owners

        // Begin for multiple tags
        $project->tags()->sync($request->tags);

        // Update Project Info

        $project->project_info->main_heading = $request->main_heading;
        $project->project_info->sub_heading = $request->sub_heading;
        $project->project_info->bullet_1 = $request->bullet_1;
        $project->project_info->bullet_2 = $request->bullet_2;
        $project->project_info->bullet_3 = $request->bullet_3;
        $project->project_info->bullet_4 = $request->bullet_4;
        $project->project_info->bullet_5 = $request->bullet_5;
        $project->project_info->bullet_6 = $request->bullet_6;

        $project->project_info->save();

        return redirect('admin/project/'. $project->id)->with('message', 'Project Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // return $request->project_id;

        $ErrorMsg = "";
        $data = [];
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'project_id' => ['required'],
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

                $project = Project::where("id", $request->project_id);
                $deleteProject = AppHelper::isArchiveRecord($project);
                if ($deleteProject["status"]) {
                    $data["status"] = $deleteProject["status"];
                    $data["message"] = "Project deleted successfully.";
                    // dd($request->project_id);
                    // dd("select * from projects where id = " . $request->project_id);
                    $updatedRecord = DB::select("select * from projects where id = " . $request->project_id);
                    // dd($updatedRecord);
                    $data["data"] = (count($updatedRecord) > 0) ? $updatedRecord : [];
                } else {
                    $ErrorMsg = $deleteProject["message"];
                }
            }
        } catch (\Throwable $e) {
            DB::rollback();
            $ErrorMsg = "Error Occurred while deleting project. Exception Msg : " . $e->getMessage();
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

    // public function destroy(Project $project)

    //     // $image_path = '/uploads/project_images/project_2';
    //     // File::deleteDirectory(public_path() . $image_path);
    //     // Project::destroy($project->id);
    //     // return back();
    // }

    public function import_projects()
    {
        // dd('da');
        return view('panel.admin.project.import-csv');
    }

    // CSV File To Array
    function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }

    // Import CSV and save the record to the database

    public function AddUpdateAmenities(Request $request)
    {
        // return $request->all();
        // dd($request->all());
        $project_id = $request->project_id;
        if (isset($request->projectAmeniies) && count($request->projectAmeniies) > 0) {

            $deleteOldAmenities = DB::delete('delete from project_amenities where project_id = ?', [$project_id]);
            // dd($deleteOldAmenities);
            $arrprojectAmenities = [];
            for ($i = 0; $i < count($request->projectAmeniies); $i++) {
                $decodeAmenity = json_decode($request->projectAmeniies[$i], true);
                // dd($decodeAmenity);
                $checkDuplicate = ProjectAmenities::where("project_id", $request->project_id)->where("amenity_id", $decodeAmenity["id"])->get();
                if (count($checkDuplicate) > 0) {
                    $ErrorMsg = "This Amenity [" . $decodeAmenity["amenity_name"] . "] is already exist in this project.";
                    // dd($ErrorMsg);
                    return back()->with("errorMsg", $ErrorMsg);
                }
                $amenity = [
                    "project_id" => $request->project_id,
                    "amenity_id" => $decodeAmenity["id"],
                    "is_active" => 1,
                    "created_by" => Auth::user()->id
                ];

                array_push($arrprojectAmenities, $amenity);
            }
            if (count($arrprojectAmenities) > 0) {
                $insert = ProjectAmenities::insert($arrprojectAmenities);

                if ($insert) {
                    return back()->with("successMsg", "Amenities addedd successfully.");
                } else {
                    return back()->with("errorMsg", "Amenities not addedd successfully.");
                }
            }
        } else {
            return back()->with("errorMsg", "Atleast one amenities is mandatory.");
        }
    }

    public function AddUpdateUtilities(Request $request)
    {
        // dd($request->all());
        $project_id = $request->project_id;
        if (isset($request->projectUtilities) && count($request->projectUtilities) > 0) {

            $deleteOldUtilities = DB::delete('delete from project_utilities where project_id = ?', [$project_id]);
            // dd($deleteOldAmenities);
            $arrprojectUtilities = [];
            for ($i = 0; $i < count($request->projectUtilities); $i++) {
                $decodeUtility = json_decode($request->projectUtilities[$i], true);
                // dd($decodeUtility);
                $checkDuplicate = ProjectUtilities::where("project_id", $request->project_id)->where("utility_id", $decodeUtility["id"])->get();
                if (count($checkDuplicate) > 0) {
                    $ErrorMsg = "This Utility [" . $decodeUtility["utility_name"] . "] is already exist in this project.";
                    // dd($ErrorMsg);
                    return back()->with("errorMsg", $ErrorMsg);
                }
                $utility = [
                    "project_id" => $request->project_id,
                    "utility_id" => $decodeUtility["id"],
                    "is_active" => 1,
                    "created_by" => Auth::user()->id
                ];

                array_push($arrprojectUtilities, $utility);
            }
            if (count($arrprojectUtilities) > 0) {
                $insert = ProjectUtilities::insert($arrprojectUtilities);

                if ($insert) {
                    return back()->with("successMsg", "Utilities addedd successfully.");
                } else {
                    return back()->with("errorMsg", "Utilities not addedd successfully.");
                }
            }
        } else {
            return back()->with("errorMsg", "Atleast one utility is mandatory.");
        }
    }

    public function importCsv(Request $request)
    {

        // Begin For Documents
        if ($request->projects->extension()) {
            $projects_name = time() . '.' . $request->projects->extension();
            $request->projects->move(public_path('uploads/project_imports'), $projects_name);
            // End For Documents
            $file = public_path('uploads/project_imports/' . $projects_name);

            $projectsArray = $this->csvToArray($file);
            // dd($projectsArray);
            for ($i = 0; $i < count($projectsArray); $i++) {
                // Defining Slug
                $projectsArray[$i]['slug'] = Str::slug($projectsArray[$i]['name']);
                // dd(Auth::user()->id);
                dd($projectsArray[$i]['slug']);
                dd($projectsArray[$i]['slug']);
                $project = Project::firstOrCreate($projectsArray[$i]);

                // Adding Pivot Owners
                $project->owners()->attach(Auth::user()->id);
            }

            dd(Project::all());
        } else {
            return back();
        }
    }

    // public function __AddUpdateAmenities(Request $request)
    // {
    //     // return $request->all();
    //     // dd($request->all());

    //     $ErrorMsg = "";
    //     $data = [];
    //     $project_id = $request->project_id;
    //     DB::beginTransaction();
    //     try {
    //         $validator = Validator::make($request->all(), [
    //             'project_id' => ['required'],
    //         ]);

    //         if ($validator->fails()) {
    //             $data["status"] = false;
    //             $data["message"] = "Some thing went wrong: Validation Error.";
    //             $data["error"] = $validator->errors();
    //             return response()->json($data, 200);
    //         }
    //         // return $request->all();
    //         // return response()->json($data, 200);
    //         if ($ErrorMsg == "") {

    //             if (isset($request->projectAmeniies) && count($request->projectAmeniies) > 0) {

    //                 $deleteOldAmenities = DB::delete('delete from project_amenities where project_id = ?', [$project_id]);
    //                 dd($deleteOldAmenities);
    //                 $arrprojectAmenities = [];
    //                 for ($i = 0; $i < count($request->projectAmeniies); $i++) {
    //                     $decodeAmenity = json_decode($request->projectAmeniies[$i], true);
    //                     // dd($decodeAmenity);
    //                     $checkDuplicate = ProjectAmenities::where("project_id", $request->project_id)->where("amenity_id", $decodeAmenity["id"])->get();
    //                     if (count($checkDuplicate) > 0) {
    //                         $ErrorMsg = "This Amenity [" . $decodeAmenity["amenity_name"] . "] is already exist in this project.";
    //                         break;
    //                         // dd($ErrorMsg);
    //                         // return back()->with("errorMsg", $ErrorMsg);
    //                     }
    //                     $amenity = [
    //                         "project_id" => $request->project_id,
    //                         "amenity_id" => $decodeAmenity["id"],
    //                         "is_active" => 1,
    //                         "created_by" => Auth::user()->id
    //                     ];

    //                     array_push($arrprojectAmenities, $amenity);
    //                 }
    //                 if (count($arrprojectAmenities) > 0) {
    //                     $insert = ProjectAmenities::insert($arrprojectAmenities);

    //                     if ($insert) {
    //                         $data["status"] = true;
    //                         $data["message"] = "Update project emenities successfully.";
    //                         // return back()->with("successMsg", "Amenities addedd successfully.");
    //                     }
    //                 }
    //             } else {
    //                 $ErrorMsg = "Atleast one amenities is mandatory.";
    //             }
    //         }
    //     } catch (\Throwable $e) {
    //         DB::rollback();
    //         $ErrorMsg = "Error Occurred while updating project amenities. Exception Msg : " . $e->getMessage();
    //         $data["status"] = false;
    //         $data["message"] = $ErrorMsg;
    //     }
    //     if ($ErrorMsg == "") {
    //         DB::commit();
    //         return back()->with($data);
    //         // return response()->json($data, 200);
    //     } else {
    //         $data["status"] = false;
    //         $data["message"] = $ErrorMsg;
    //         // return back()->with("errorMsg", "Atleast one amenities is mandatory.");
    //         return back()->with($data);
    //         // $data["Obj"] = $request->all();
    //         // return response()->json($data, 200);
    //     }
    // }

    public function CreateNewProject(Request $request)
    {
        // return $request->all();
        $ErrorMsg = "";
        $data = [];
        $project_id = $request->project_id;
        DB::beginTransaction();
        try {

            $parsed_time = Carbon::now();
            if ($request->added_time) {
                $parsed_time = Carbon::parse($request->added_time);
            }

            $property_id = bin2hex(random_bytes(2));
            $CheckDuplicateProjectSlug = Project::where("slug", Str::slug($request->name))->count();

            if ($CheckDuplicateProjectSlug) {
                // return back()->with("successMsg", "Amenities addedd successfully.");
                return back()->withInput()->with("errorMsg", "This project name [" . $request->name . "] is already exist.");
            }

            $project = Project::create([
                'name' => $request->name,
                'address' => $request->address,
                //  'area' => 2,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'progress' => $request->progress,
                'rooms' => $request->rooms,
                'details' => $request->details,
                'installment_length' => $request->installment_length,
                'slug' => Str::slug($request->name),
                'added_time' => $parsed_time,
                'property_id' => $property_id,
                "project_video" => $request->project_video,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'meta_tags' => $request->meta_tags,
                'marketed_by' => $request->marketed_by,
            ]);

            if ($request->status) {
                $project->status = $request->status;
            }

            if ($request->project_doc) {
                $project_doc_name = time() . '.' . $request->project_doc->extension();
                $request->project_doc->move(public_path('uploads/project_documents/project_' . $project->id), $project_doc_name);
                $project->project_doc = $project_doc_name;
            }

            if ($request->file('project_imgs')) {
                $imageName = array();
                if ($images = $request->file('project_imgs')) {
                    foreach ($images as $image) {
                        $name = time() . '_' . $image->getClientOriginalName();
                        $image->move('uploads/project_images/project_' . $project->id, $name);
                        $imageName[] = 'uploads/project_images/project_' . $project->id . '/' . $name;
                    }
                }
                $project->project_imgs = implode('|', $imageName);
            }

            if ($request->project_cover_img) {
                $project_cover_img_name = 'cover_' . time() . '.' . $request->project_cover_img->extension();
                $request->project_cover_img->move(public_path('uploads/project_images/project_' . $project->id), $project_cover_img_name);
                $project->project_cover_img = $project_cover_img_name;
            }

            $project->save();
            $project->touch();
            $user = Auth::user();
            ProjectUsers::create([
                'project_id' => $project->id,
                'admin_id' => $user->id,
                'status' => 0,
            ]);
            $project->areas()->attach($request->areas);
            if ($request->owners) {
                $project->owners()->attach($request->owners);
            }
            $project->tags()->attach($request->tags);

            $projectInfo = ProjectInfo::create([
                'project_id' => $project->id,
                'main_heading' => $request->main_heading,
                'sub_heading' => $request->sub_heading,
                'bullet_1' => $request->bullet_1,
                'bullet_2' => $request->bullet_2,
                'bullet_3' => $request->bullet_3,
                'bullet_4' => $request->bullet_4,
                'bullet_5' => $request->bullet_5,
                'bullet_6' => $request->bullet_6,
            ]);
        } catch (\Throwable $e) {
            DB::rollback();
            $ErrorMsg = "Error Occurred while add new project. Exception Msg : " . $e->getMessage();
            $data["status"] = false;
            $data["message"] = $ErrorMsg;
        }
        if ($ErrorMsg == "") {
            DB::commit();
            return back()->with($data);
            // return response()->json($data, 200);
        } else {
            $data["status"] = false;
            $data["message"] = $ErrorMsg;
            // return back()->with("errorMsg", "Atleast one amenities is mandatory.");
            return back()->with($data);
            // $data["Obj"] = $request->all();
            // return response()->json($data, 200);
        }

        // return redirect('admin/project/' . $project->slug)->withInput()->with();
        return redirect('admin/project/' . $project->slug);
    }
}
