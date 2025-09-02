<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Tag;
use App\Models\Area;
use App\Models\Progress;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Project;
use App\Models\Builder;
use App\Models\ProjectType;
use App\Models\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Cookie;
use Spatie\Activitylog\Models\Activity;

class HomeController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {
        $areas = Area::get();
        $progress = Progress::all();
        $projectTypes = ProjectType::all();
        $categoryId = Blog::pluck('category_id');
        $blogs = Blog::whereIn('category_id', $categoryId)->orderByDesc('created_at')->get();
        $categories = BlogCategory::whereIn('id', $categoryId)->get()->keyBy('id');

        // Featured Properties
        $featured_properties = Project::orderBy('id', 'desc')->where('status', 1)->take(5)->get();
        $tags = Tag::all();
        $builders = Builder::select('id', 'full_name')->get();
        $allProjects = Project::withoutGlobalScope('delete')->orderBy('name')->get(); // Add this line

        $projectDetails = [];

        return view('home', compact('progress', 'builders', 'areas', 'projectTypes', 'featured_properties', 'blogs', 'tags', 'projectDetails', 'categories', 'allProjects'));
    }

    // public function index()
    // {
    //     // dd(Auth::check());
    //     // $activity = activity()->log('Look mum, I logged something');
    //     // $activity->description = "Hello Iam home page";
    //     // $activity->save();

    //     // dd(Auth::user(), Auth::Guest() , Cookie::get('adminemail'));
    //     // dd(Auth::user(), Auth::Guest() , Auth::guard('admin')->check());
    //     // dd("Ss");

    //     $areas = Area::get();
    //     $progress = Progress::all();
    //     $projectTypes = ProjectType::all();
    //     // $blog = Blog::all();

    //     $categoryId = Blog::pluck('category_id');
    //     $blogs = Blog::whereIn('category_id', $categoryId)->orderByDesc('created_at')->get();
    //     // $categories = BlogCategory::find($categoryId);
    //     $categories = BlogCategory::whereIn('id', $categoryId)->get()->keyBy('id');

    //     // Featured Properties
    //     $featured_properties = Project::orderBy('id', 'desc')->where('status', 1)->take(5)->get();
    //     $tags = Tag::all();
    //     $builders = Builder::select('id', 'full_name')->get();
    //     $projectDetails = [];

    //     // $data = Unit::where("id", 285)
    //     //     ->with("UnitRooms.RoomType")
    //     //     ->with("UnitRooms")
    //     //     ->get();

    //     // print_r($data->toArray()[0]["unit_rooms"]);
    //     // $dataU = $data->toArray()[0]["unit_rooms"];
    //     // $arrExtras = [];
    //     // foreach ($dataU as $room) {
    //     //     $key = $room["room_type"]["id"];
    //     //     if (!array_key_exists($key, $arrExtras)) {
    //     //         $arrExtras[$key] = ["extras" => 0];
    //     //     }

    //     //     $arrExtras[$key]["room_type_name"] = $room["room_type"]["name"];
    //     //     $arrExtras[$key]["extras"] += $room["extras"] != null ? $room["extras"] : 0;
    //     // }
    //     // dd($arrExtras);
    //     // return;

    //     // foreach ($featured_properties as $Pkey => $project) {
    //     //     foreach ($project->project_unit_rooms->unique('id') as $Rkey => $roomType) {
    //     //         foreach ($project->units as $Ukey => $unit) {
    //     //             $projectDetails[$Pkey][$Rkey][$Ukey] = count($unit->room->where('id', $roomType->id));
    //     //         }
    //     //     }
    //     // }

    //     // dd($projectDetails);

    //     return view('home', compact('progress', 'builders', 'areas', 'projectTypes', 'featured_properties', 'blogs', 'tags', 'projectDetails', 'categories'));
    // }
}
