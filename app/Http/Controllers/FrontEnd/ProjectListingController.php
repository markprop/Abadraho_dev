<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\Projects\ListingRequest;
use App\Models\Area;
use App\Models\Builder;
use App\Models\Progress;
use App\Models\Project;
use App\Models\ProjectType;
use App\Models\RecentViews;
use App\Models\Tag;
use App\Models\Unit;
use App\Models\UserSearchHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectListingController extends Controller
{
    public function __construct()
    {
        $this->ProjectModel = Project::query();
    }

    public function index(Request $request, $slug = "")
    {
        $areaId = 0;
        $projecttypeId = 0;
        $slugsId = 0;
        
        $projects = Project::with('progress', 'units', 'owners', 'location', 'areas', 'tags', 'project_unit_rooms', 'type')
            ->where('projects.status', 1);
    
        if(isset($_GET['area'])) {
            $area = Area::where('name', $_GET['area'])->first();
    
            if($area) {
                $areaId = $area->id;
                $projects = $projects->where('area','=',$area->id);
            }
        }
        
        if($slug != "") {
            $slugs = Area::where('slug', $slug)->first();
            if($slugs) {
                $slugsId = $slugs->id;
                $projects = $projects->where('area','=',$slugs->id);
            }
        }
    
        if(isset($_GET['property_type'])) {
            $project_type = ProjectType::where('title', $_GET['property_type'])->first();
            
            if($project_type) {
                $projecttypeId = $project_type->id;
                $projects = $projects->where('project_type_id','=',$project_type->id);
            }
        }
    
        $projects = $projects->paginate(10);
        
        $areas = Area::all();
        $progress = Progress::all();
        $tags = Tag::all();
        $builders = Builder::select('id', 'full_name')->get();
        $projectTypes = ProjectType::all();
        $recent_view_data = RecentViews::with('project')
            ->whereDate('created_at', Carbon::today())
            ->where('user_id', Auth::id())->get();
        // Add allProjects for the dropdown
        $allProjects = Project::where('status', 1)->orderBy('name')->get();
    
        $searchData = UserSearchHistory::where('search_type', 'calculator')->where(function ($q) use($request) {
            return $q->where("cookie", $request->cookie("XSRF-TOKEN"))->orWhere("user_id", auth()->id());
        })
            ->orderBy('id', 'desc')
            ->first();
    
        return view('projects.index', compact('builders', 'projects', 'progress', 'areas', 'areaId', 'projecttypeId', 'projectTypes', 'recent_view_data', 'tags', 'searchData', 'allProjects'));
    }

    private function search(ListingRequest $request)
    {
        $perPageRecord = 10;
        $user_id = 0;
        $searchData = $request->validated();
    
        if (Auth::check()) {
            $user_id = Auth::id();
            UserSearchHistory::where("cookie", $request->cookie("XSRF-TOKEN"))
                ->where("user_id", 0)
                ->update(["user_id" => $user_id]);
        }
    
        // Save User Search History
        $this->saveSearchHistory($request->cookie("XSRF-TOKEN"), $searchData['maxBudget'], $user_id, $searchData['isCalculator'] ? true : false);
    
        $searchData['minDP'] = str_replace(",", "", $searchData['minDP']);
        $searchData['maxDP'] = str_replace(",", "", $searchData['maxDP']);
        $searchData['minMI'] = str_replace(",", "", $searchData['minMI']);
        $searchData['maxMI'] = str_replace(",", "", $searchData['maxMI']);
        $searchData['minPrice'] = str_replace(",", "", $searchData['minPrice']);
        $searchData['maxPrice'] = str_replace(",", "", $searchData['maxPrice']);
        $searchData['calcSearch'] = $searchData['calcSearch'] ?: false;
        $page = $searchData['page'] ?: 1;
    
        // Filter Start
        $projects = $this->ProjectModel
            ->with('units')
            ->with('owners')
            ->with('location')
            ->with('areas')
            ->with('tags');
    
        $projects = $projects->where("status", 1);
    
        // Filter by project name
        if ($searchData['project_name']) {
            $projects = $projects->whereIn('id', $searchData['project_name']);
        }
    
        // Filter by builder name
        if ($searchData['builder']) {
            $projects = $projects->whereHas('owners', function ($query) use ($searchData) {
                $query->whereIn('builder_id', $searchData['builder']);
            });
        }
    
        // Filter By Areas
        if ($searchData['area']) {
            $projects = $projects->whereHas('areas', function ($query) use ($searchData) {
                $query->whereIn('area_id', $searchData['area']);
            });
        }
    
        // Filter by Progress
        if ($searchData['progress']) {
            $projects = $projects->whereIn('progress', $searchData['progress']);
        }
    
        // Filter by Project Type
        if ($searchData['type_id']) {
            $projects = $projects->whereHas('units', function ($query) use ($searchData) {
                $query->whereIn('unit_type_id', $searchData['type_id']);
            });
        }
    
        // Filter by Down Payment
        if ($searchData['minDP'] || $searchData['maxDP']) {
            $minDP = $searchData['minDP'] ?: 0;
            $maxDP = $searchData['maxDP'] ?: Unit::max('down_payment');
            $projects = $projects->whereHas('units', function ($query) use ($minDP, $maxDP) {
                $query->whereBetween('down_payment', [$minDP, $maxDP]);
            });
        }
    
        // Filter by Monthly Installment
        if ($searchData['minMI'] || $searchData['maxMI']) {
            $minMI = $searchData['minMI'] ?: 0;
            $maxMI = $searchData['maxMI'] ?: Unit::max('monthly_installment');
    
            $projects = $projects->whereHas('units', function ($query) use ($minMI, $maxMI) {
                $query->whereBetween('monthly_installment', [$minMI, $maxMI]);
            });
        }
    
        // Filter by Price
        if ($searchData['minPrice'] || $searchData['maxPrice']) {
            $minPrice = $searchData['minPrice'] ?: 0;
            $maxPrice = $searchData['maxPrice'] ?: Unit::max('price');
            $projects = $projects->whereHas('units', function ($query) use ($minPrice, $maxPrice) {
                $query->whereBetween('total_unit_amount', [$minPrice, $maxPrice]);
            });
        }
    
        // Filter by Budget
        if ($searchData['minPrice'] || $searchData['maxBudget']) {
            $minPrice = $searchData['minPrice'] ?: 0;
            $maxBudget = $searchData['maxBudget'] ?: Unit::max('price');
            $projects = $projects->whereHas('units', function ($query) use ($minPrice, $maxBudget) {
                $query->whereBetween('total_unit_amount', [$minPrice, $maxBudget]);
            });
        }
    
        // Filter by tags
        if ($searchData['tag_id']) {
            $projects = $projects->whereHas('tags', function ($query) use ($searchData) {
                $query->whereIn('tag_id', $searchData['tag_id']);
            });
        }
    
        if (!empty($request->reseller_id) && $request->reseller_id == "Latest") {
            $projects = $this->ProjectModel->orderBy('created_at', 'desc')->where("status", 1);
        } elseif (!empty($request->reseller_id) && $request->reseller_id == "popularity") {
            $projects = $this->ProjectModel->orderBy('views', 'desc')->where("status", 1);
        } elseif (!empty($request->reseller_id) && $request->reseller_id == "Oldest") {
            $projects = $this->ProjectModel->orderBy('created_at', 'asc')->where("status", 1);
        } elseif (!empty($request->reseller_id) && $request->reseller_id == "Highest_by_price") {
            $projects = $this->ProjectModel->orderBy('min_price', 'desc')->where("status", 1);
        } elseif (!empty($request->reseller_id) && $request->reseller_id == "Lowest_by_price") {
            $projects = $this->ProjectModel->orderBy('min_price', 'asc')->where("status", 1);
        } elseif (!empty($request->reseller_id) && $request->reseller_id == "Sort_by_progress") {
            $projects = $this->ProjectModel->orderBy('progress', 'asc')->where("status", 1);
        } elseif (!empty($request->reseller_id) && $request->reseller_id == "Sort_by_area") {
            $projects = $this->ProjectModel->orderBy('area', 'asc')->where("status", 1);
        }
    
        $projects = $projects->paginate($perPageRecord);
    
        return view('projects.search', compact('page', 'projects', 'searchData'));
    }

    private function saveSearchHistory($token, $searchData, $user_id, $isCalculator = false)
    {
        if ($isCalculator) {
            return UserSearchHistory::create([
                'user_id' => $user_id,
                'hash' => 'HDfv6',
                'search_type' => 'calculator',
                'downPayment' => $searchData['downPayment'],
                'maxBudget' => $searchData['maxBudget'],
                'slabCasting' => $searchData['slabCasting'],
                'plinth' => $searchData['plinth'],
                'colour' => $searchData['colour'],
                'monthInstall' => $searchData['monthInstall'],
                'yearlyInstall' => $searchData['yearlyInstall'],
                'halfYearlyInstall' => $searchData['halfYearlyInstall'],
                'quarterlyInstall' => $searchData['quarterlyInstall'],
                'possession' => $searchData['possession'],
                "cookie" => $token,
                'json' => json_encode([
                    'area' => $searchData['area'],
                    'type' => $searchData['type'],
                    'maxBudget' => $searchData['maxBudget'],
                    'downPayment' => $searchData['downPayment'],
                    'monthInstall' => $searchData['monthInstall'],
                    'yearlyInstall' => $searchData['yearlyInstall'],
                    'halfYearlyInstall' => $searchData['halfYearlyInstall'],
                    'quarterlyInstall' => $searchData['quarterlyInstall'],
                    'possession' => $searchData['possession'],
                    'projectType' => $searchData['projectType'],
                    'duration' => $searchData['duration'],
                    'slabCasting' => $searchData['slabCasting'],
                    'plinth' => $searchData['plinth'],
                    'colour' => $searchData['colour']
                ], false),
            ]);
        }
        return UserSearchHistory::create([
            'user_id' => $user_id,
            'hash' => 'HDfv6',
            'search_type' => 'filter',
            'minDP' => $searchData['minDP'],
            'maxDP' => $searchData['minDP'],
            'minMI' => $searchData['minMI'],
            'maxMI' => $searchData['maxMI'],
            'minPrice' => $searchData['minPrice'],
            'maxPrice' => $searchData['maxPrice'],
            "cookie" => $token,
            'json' => json_encode([
                'area' => $searchData['area'],
                'progress' => $searchData['progress'],
                'type' => $searchData['type_id'],
                'builder' => $searchData['builder'],
                'minDP' => $searchData['minDP'] ?: 0,
                'maxDP' => $searchData['maxDP'] ?: 0,
                'minMI' => $searchData['minMI'] ?: 0,
                'maxMI' => $searchData['maxMI'] ?: 0,
                'minPrice' => $searchData['minPrice'] ?: 0,
                'maxPrice' => $searchData['maxPrice'] ?: 0,
                'maxBudget' => $searchData['maxBudget'],
                'tag' => $searchData['tag_id'],
            ])
        ]);
    }
}
