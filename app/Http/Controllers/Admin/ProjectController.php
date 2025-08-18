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
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('manage_user_types');
    }

    public function index(Request $request)
    {
        $status = ['Live', 'Pending', 'Declined'];
        $projects = Project::orderBy("name", "ASC");

        if (Auth::user()->user_type_id == Config::get("constants.UserTypeIds.Builder")) {
            $Builder = Builder::where("user_id", Auth::user()->id)->first();
            $BuilderProjectIds = ProjectOwners::where("builder_id", $Builder->id)->pluck("project_id");
            $projects = $projects->whereIn("id", $BuilderProjectIds->toArray());
        }

        $searchQuery = [];
        $searchQuery['id'] = $request['id'] ? $request['id'] : null;
        $searchQuery['areas'] = $request['areas'] ? $request['areas'] : null;
        $searchQuery['progress'] = $request['progress'] ? $request['progress'] : null;
        $searchQuery['status'] = $request['status'] ? $request['status'] : null;
        $searchQuery['from'] = $request['from'] ?? "";
        $searchQuery['to'] = $request['to'] ?? "";

        if ($request['id']) {
            foreach ($request['id'] as $project_id) {
                $projects = $projects->Where('id', $project_id);
            }
        }
        if ($request['areas']) {
            $area = $request['areas'];
            $projects = $projects->whereHas('areas', function ($query) use ($area) {
                $query->whereIn('area_id', $area);
            });
        }
        if ($request['progress']) {
            $progress = $request['progress'];
            $projects = $projects->whereIn('progress', $progress);
        }
        if ($request['status']) {
            $status1 = $request['status'];
            $projects = $projects->whereIn('status', $status1);
        }
        if ($request['from'] != "" && $request['to'] != "") {
            $projects = $projects->whereBetween("created_at", [$request['from'], $request['to']]);
        }

        $projects = $projects->get();
        return view('panel.admin.project.index', compact('projects', 'status', 'searchQuery'));
    }

    public function pending(Request $request)
    {
        $status = ['Live', 'Pending', 'Declined'];
        $projects = Project::orderBy("name", "ASC")->where("status", 2);
        $allProjects = Project::orderBy("name", "ASC");

        if (Auth::user()->user_type_id == Config::get("constants.UserTypeIds.Builder")) {
            $Builder = Builder::where("user_id", Auth::user()->id)->first();
            $BuilderProjectIds = ProjectOwners::where("builder_id", $Builder->id)->pluck("project_id");
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

        if ($request['id']) {
            foreach ($request['id'] as $project_id) {
                $projects = $projects->Where('id', $project_id);
            }
        }
        if ($request['areas']) {
            $area = $request['areas'];
            $projects = $projects->whereHas('areas', function ($query) use ($area) {
                $query->whereIn('area_id', $area);
            });
        }
        if ($request['progress']) {
            $progress = $request['progress'];
            $projects = $projects->whereIn('progress', $progress);
        }
        if ($request['status']) {
            $status1 = $request['status'];
            $projects = $projects->whereIn('status', $status1);
        }
        if ($request['from'] != "" && $request['to'] != "") {
            $projects = $projects->whereBetween("created_at", [$request['from'], $request['to']]);
        }

        $projects = $projects->get();
        $allProjects = $allProjects->get();
        return view('panel.admin.project.index2', compact('projects', 'status', 'searchQuery', 'allProjects'));
    }

    public function active(Request $request)
    {
        $status = ['Live', 'Pending', 'Declined'];
        $projects = Project::orderBy("name", "ASC")->where("status", 1);
        $allProjects = Project::orderBy("name", "ASC");

        if (Auth::user()->user_type_id == Config::get("constants.UserTypeIds.Builder")) {
            $Builder = Builder::where("user_id", Auth::user()->id)->first();
            $BuilderProjectIds = ProjectOwners::where("builder_id", $Builder->id)->pluck("project_id");
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

        if ($request['id']) {
            foreach ($request['id'] as $project_id) {
                $projects = $projects->Where('id', $project_id);
            }
        }
        if ($request['areas']) {
            $area = $request['areas'];
            $projects = $projects->whereHas('areas', function ($query) use ($area) {
                $query->whereIn('area_id', $area);
            });
        }
        if ($request['progress']) {
            $progress = $request['progress'];
            $projects = $projects->whereIn('progress', $progress);
        }
        if ($request['status']) {
            $status1 = $request['status'];
            $projects = $projects->whereIn('status', $status1);
        }
        if ($request['from'] != "" && $request['to'] != "") {
            $projects = $projects->whereBetween("created_at", [$request['from'], $request['to']]);
        }

        $projects = $projects->get();
        $allProjects = $allProjects->get();
        return view('panel.admin.project.index3', compact('projects', 'status', 'searchQuery', 'allProjects'));
    }

    public function create()
    {
        $types = ProjectType::all();
        $progressStatus = Progress::all();
        $builders = Builder::all();
        $areas = Area::all();
        $tags = Tag::all();
        return view('panel.admin.project.create', compact('progressStatus', 'types', 'builders', 'areas', 'tags'));
    }

    public function store(ProjectRequest $request)
    {
        $arrOwners = [];
        if (Auth::user()->user_type_id == Config::get("constants.UserTypeIds.Builder")) {
            $Builder = Builder::where("user_id", Auth::user()->id)->first();
            array_push($arrOwners, $Builder->id);
        } else {
            $arrOwners = $request->owners;
        }

        $projectSlug = Str::slug($request->name);
        $parsed_time = Carbon::now();
        if ($request->added_time) {
            $parsed_time = Carbon::parse($request->added_time);
        }
        $property_id = bin2hex(random_bytes(2));
        $CheckDuplicateProjectSlug = Project::where("slug", $projectSlug)->count();
        if ($CheckDuplicateProjectSlug) {
            return back()->withInput()->with("errorMsg", "This project name [" . $request->name . "] is already exist.");
        }

        $selectedProgress = Progress::where("id", $request->progress_status_id)->first();

        $projectInputArr = [
            'name' => $request->name,
            'address' => $request->address,
            'discount_price' => $request->discount_price,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'progress_status_id' => $request->progress_status_id,
            'progress' => $selectedProgress->progress_status_name,
            'rooms' => $request->rooms,
            'details' => $request->details,
            'slug' => $projectSlug,
            'added_time' => $parsed_time,
            'property_id' => $property_id,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_tags' => $request->meta_tags,
            'marketed_by' => $request->marketed_by,
            'views' => 0,
        ];

        $project = Project::create($projectInputArr);

        if ($request->status) {
            $project->status = $request->status;
        }

        // Handle project document
        if ($request->hasFile('project_doc')) {
            $project_doc_path = $request->file('project_doc')->store('uploads/project_documents/project_' . $project->id, 'public');
            $project->project_doc = $project_doc_path;
        }

        // Handle project images
        if ($request->hasFile('project_imgs')) {
            $imageName = [];
            foreach ($request->file('project_imgs') as $image) {
                $imagePath = $image->store('uploads/project_images/project_' . $project->id, 'public');
                $imageName[] = $imagePath;
            }
            $project->project_imgs = implode('|', $imageName);
        }

        // Handle project cover image
        if ($request->hasFile('project_cover_img')) {
            $project_cover_img_path = $request->file('project_cover_img')->store('uploads/project_images/project_' . $project->id, 'public');
            $project->project_cover_img = $project_cover_img_path;
        }

        // Handle project video
        if ($request->hasFile('project_video')) {
            $project_video_path = $request->file('project_video')->store('uploads/project_videos/project_' . $project->id, 'public');
            $project->project_video = $project_video_path;
        }

        $project->save();
        $project->touch();

        ProjectUsers::create([
            'project_id' => $project->id,
            'admin_id' => Auth::user()->id,
            'status' => 0,
        ]);

        $project->ProjectArea()->attach($request->areas);
        if ($arrOwners) {
            $project->owners()->attach($arrOwners);
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

        return redirect('admin/project/' . $project->id);
    }

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

        return view('panel.admin.project.update', compact('project', 'progressStatus', 'types', 'builders', 'areas', 'time', 'tags'));
    }

    public function update(ProjectRequest $request, Project $project)
    {
        $parsed_time = $request->added_time;
        if ($request->added_time) {
            $parsed_time = Carbon::parse($request->added_time);
        }

        $project->name = $request->name;
        $project->address = $request->address;
        $project->latitude = $request->latitude;
        $project->longitude = $request->longitude;
        $progress = Progress::where("id", $request->progress_status_id)->first();
        $project->progress_status_id = $request->progress_status_id;
        $project->progress = $progress->progress_status_name;
        $project->rooms = $request->rooms;
        $project->details = $request->details;
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

        // Handle project document
        if ($request->hasFile('project_doc')) {
            if ($project->project_doc && Storage::disk('public')->exists($project->project_doc)) {
                Storage::disk('public')->delete($project->project_doc);
            }
            $project_doc_path = $request->file('project_doc')->store('uploads/project_documents/project_' . $project->id, 'public');
            $project->project_doc = $project_doc_path;
        }

        // Handle project images
        if ($request->hasFile('project_imgs')) {
            if ($project->project_imgs) {
                foreach (explode('|', $project->project_imgs) as $img) {
                    if (Storage::disk('public')->exists($img)) {
                        Storage::disk('public')->delete($img);
                    }
                }
            }
            $imageName = [];
            foreach ($request->file('project_imgs') as $image) {
                $imagePath = $image->store('uploads/project_images/project_' . $project->id, 'public');
                $imageName[] = $imagePath;
            }
            $project->project_imgs = implode('|', $imageName);
        }

        // Handle project cover image
        if ($request->hasFile('project_cover_img')) {
            if ($project->project_cover_img && Storage::disk('public')->exists($project->project_cover_img)) {
                Storage::disk('public')->delete($project->project_cover_img);
            }
            $project_cover_img_path = $request->file('project_cover_img')->store('uploads/project_images/project_' . $project->id, 'public');
            $project->project_cover_img = $project_cover_img_path;
        }

        // Handle project video
        if ($request->hasFile('project_video')) {
            if ($project->project_video && Storage::disk('public')->exists($project->project_video)) {
                Storage::disk('public')->delete($project->project_video);
            }
            $project_video_path = $request->file('project_video')->store('uploads/project_videos/project_' . $project->id, 'public');
            $project->project_video = $project_video_path;
        }

        $project->save();
        $project->touch();

        $arrOwners = [];
        if (Auth::user()->user_type_id == Config::get("constants.UserTypeIds.Builder")) {
            $Builder = Builder::where("user_id", Auth::user()->id)->first();
            array_push($arrOwners, $Builder->id);
        } else {
            $arrOwners = $request->owners;
        }

        $project->ProjectArea()->sync($request->areas);
        $project->tags()->sync($request->tags);

        $project->project_info->main_heading = $request->main_heading;
        $project->project_info->sub_heading = $request->sub_heading;
        $project->project_info->bullet_1 = $request->bullet_1;
        $project->project_info->bullet_2 = $request->bullet_2;
        $project->project_info->bullet_3 = $request->bullet_3;
        $project->project_info->bullet_4 = $request->bullet_4;
        $project->project_info->bullet_5 = $request->bullet_5;
        $project->project_info->bullet_6 = $request->bullet_6;
        $project->project_info->save();

        return redirect('admin/project/' . $project->id)->with('message', 'Project Updated Successfully');
    }

    public function destroy(Request $request)
    {
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

            if ($ErrorMsg == "") {
                $project = Project::where("id", $request->project_id);
                $deleteProject = AppHelper::isArchiveRecord($project);
                if ($deleteProject["status"]) {
                    $data["status"] = $deleteProject["status"];
                    $data["message"] = "Project deleted successfully.";
                    $updatedRecord = DB::select("select * from projects where id = " . $request->project_id);
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
            return response()->json($data, 200);
        }
    }

    public function import_projects()
    {
        return view('panel.admin.project.import-csv');
    }

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

    public function AddUpdateAmenities(Request $request)
    {
        $project_id = $request->project_id;
        if (isset($request->projectAmeniies) && count($request->projectAmeniies) > 0) {
            $deleteOldAmenities = DB::delete('delete from project_amenities where project_id = ?', [$project_id]);
            $arrprojectAmenities = [];
            for ($i = 0; $i < count($request->projectAmeniies); $i++) {
                $decodeAmenity = json_decode($request->projectAmeniies[$i], true);
                $checkDuplicate = ProjectAmenities::where("project_id", $request->project_id)->where("amenity_id", $decodeAmenity["id"])->get();
                if (count($checkDuplicate) > 0) {
                    $ErrorMsg = "This Amenity [" . $decodeAmenity["amenity_name"] . "] is already exist in this project.";
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
                    return back()->with("successMsg", "Amenities added successfully.");
                } else {
                    return back()->with("errorMsg", "Amenities not added successfully.");
                }
            }
        } else {
            return back()->with("errorMsg", "At least one amenity is mandatory.");
        }
    }

    public function AddUpdateUtilities(Request $request)
    {
        $project_id = $request->project_id;
        if (isset($request->projectUtilities) && count($request->projectUtilities) > 0) {
            $deleteOldUtilities = DB::delete('delete from project_utilities where project_id = ?', [$project_id]);
            $arrprojectUtilities = [];
            for ($i = 0; $i < count($request->projectUtilities); $i++) {
                $decodeUtility = json_decode($request->projectUtilities[$i], true);
                $checkDuplicate = ProjectUtilities::where("project_id", $request->project_id)->where("utility_id", $decodeUtility["id"])->get();
                if (count($checkDuplicate) > 0) {
                    $ErrorMsg = "This Utility [" . $decodeUtility["utility_name"] . "] is already exist in this project.";
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
                    return back()->with("successMsg", "Utilities added successfully.");
                } else {
                    return back()->with("errorMsg", "Utilities not added successfully.");
                }
            }
        } else {
            return back()->with("errorMsg", "At least one utility is mandatory.");
        }
    }

    public function importCsv(Request $request)
    {
        if ($request->projects->extension()) {
            $projects_name = time() . '.' . $request->projects->extension();
            $request->projects->move(public_path('uploads/project_imports'), $projects_name);
            $file = public_path('Uploads/project_imports/' . $projects_name);
            $projectsArray = $this->csvToArray($file);
            for ($i = 0; $i < count($projectsArray); $i++) {
                $projectsArray[$i]['slug'] = Str::slug($projectsArray[$i]['name']);
                $project = Project::firstOrCreate($projectsArray[$i]);
                $project->owners()->attach(Auth::user()->id);
            }
            return redirect('admin/project');
        } else {
            return back();
        }
    }

    public function CreateNewProject(Request $request)
    {
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
                return back()->withInput()->with("errorMsg", "This project name [" . $request->name . "] is already exist.");
            }
            $project = Project::create([
                'name' => $request->name,
                'address' => $request->address,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'progress' => $request->progress,
                'rooms' => $request->rooms,
                'details' => $request->details,
                'installment_length' => $request->installment_length,
                'slug' => Str::slug($request->name),
                'added_time' => $parsed_time,
                'property_id' => $property_id,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'meta_tags' => $request->meta_tags,
                'marketed_by' => $request->marketed_by,
            ]);
            if ($request->status) {
                $project->status = $request->status;
            }
            if ($request->hasFile('project_doc')) {
                $project_doc_path = $request->file('project_doc')->store('uploads/project_documents/project_' . $project->id, 'public');
                $project->project_doc = $project_doc_path;
            }
            if ($request->hasFile('project_imgs')) {
                $imageName = [];
                foreach ($request->file('project_imgs') as $image) {
                    $imagePath = $image->store('uploads/project_images/project_' . $project->id, 'public');
                    $imageName[] = $imagePath;
                }
                $project->project_imgs = implode('|', $imageName);
            }
            if ($request->hasFile('project_cover_img')) {
                $project_cover_img_path = $request->file('project_cover_img')->store('uploads/project_images/project_' . $project->id, 'public');
                $project->project_cover_img = $project_cover_img_path;
            }
            if ($request->hasFile('project_video')) {
                $project_video_path = $request->file('project_video')->store('uploads/project_videos/project_' . $project->id, 'public');
                $project->project_video = $project_video_path;
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
        } else {
            $data["status"] = false;
            $data["message"] = $ErrorMsg;
            return back()->with($data);
        }
    }
}