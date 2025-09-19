<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Builder;
use App\Models\Progress;
use App\Models\Project;
use App\Models\ProjectType;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OffPlanController extends Controller
{
    public function __construct()
    {
        // No middleware for now, but can be added if needed
    }

    public function index(Request $request)
    {
        // Get all active projects with necessary relationships
        $projects = Project::with([
            'progress', 
            'units', 
            'owners', 
            'location', 
            'areas', 
            'tags', 
            'project_unit_rooms', 
            'type',
            'ProjectArea'
        ])
        ->where('projects.status', 1)
        ->where('projects.progress', '!=', 'Completed') // Only off-plan projects
        ->orderBy('projects.created_at', 'desc');

        // Apply filters
        $filters = $this->applyFilters($projects, $request);
        
        // Get all projects for map (without pagination)
        $allProjectsForMap = clone $projects;
        $allProjectsForMap = $allProjectsForMap->get();
        
        // Get paginated results for listings
        $projects = $projects->paginate(12);

        // Get filter options
        $areas = Area::all();
        $progress = Progress::all();
        $tags = Tag::all();
        $builders = Builder::select('id', 'full_name')->get();
        $projectTypes = ProjectType::all();

        // Get all projects for search dropdown
        $allProjects = Project::where('status', 1)
            ->where('progress', '!=', 'Completed')
            ->orderBy('name')
            ->get();

        // Prepare projects data for Mapbox (using all projects, not paginated)
        $projectsForMap = $allProjectsForMap->map(function ($project) {
            // Ensure proper cover image path
            $coverImage = $project->project_cover_img;
            
            if ($coverImage && !str_starts_with($coverImage, 'http') && !str_starts_with($coverImage, '/')) {
                // If it's a relative path, make it absolute
                $coverImage = asset($coverImage);
            } elseif ($coverImage && str_starts_with($coverImage, '/')) {
                // If it starts with /, it's already a path, just add the domain
                $coverImage = url($coverImage);
            } elseif (!$coverImage) {
                // Use default image if no cover image
                $coverImage = asset('images/default-project.jpg');
            }
            
            return [
                'id' => $project->id,
                'name' => $project->name,
                'slug' => $project->slug,
                'address' => $project->address,
                'latitude' => $project->latitude,
                'longitude' => $project->longitude,
                'price' => $project->units->min('total_unit_amount') ?? $project->discount_price ?? 0,
                'progress' => $project->progress->title ?? 'Unknown',
                'type' => $project->type->title ?? 'Unknown',
                'cover_image' => $coverImage,
                'area' => $project->location->name ?? 'Unknown Area',
                'bedrooms' => $project->units->pluck('bedrooms')->filter()->unique()->values()->toArray(),
                'completion_date' => $project->added_time ?? 'TBD',
                'property_id' => $project->property_id ?? '',
                'rooms' => $project->rooms ?? ''
            ];
        });

        return view('off-plan.index', compact(
            'projects', 
            'areas', 
            'progress', 
            'tags', 
            'builders', 
            'projectTypes', 
            'allProjects',
            'projectsForMap',
            'filters'
        ));
    }

    private function applyFilters($projects, Request $request)
    {
        $filters = [];

        // Filter by area
        if ($request->filled('area')) {
            $areaIds = is_array($request->area) ? $request->area : [$request->area];
            $projects->whereHas('areas', function ($query) use ($areaIds) {
                $query->whereIn('area_id', $areaIds);
            });
            $filters['area'] = $areaIds;
        }

        // Filter by project type
        if ($request->filled('type_id')) {
            $typeIds = is_array($request->type_id) ? $request->type_id : [$request->type_id];
            $projects->whereIn('project_type_id', $typeIds);
            $filters['type_id'] = $typeIds;
        }

        // Filter by progress status
        if ($request->filled('progress')) {
            $progressIds = is_array($request->progress) ? $request->progress : [$request->progress];
            $projects->whereIn('progress_status_id', $progressIds);
            $filters['progress'] = $progressIds;
        }

        // Filter by builder
        if ($request->filled('builder')) {
            $builderIds = is_array($request->builder) ? $request->builder : [$request->builder];
            $projects->whereHas('owners', function ($query) use ($builderIds) {
                $query->whereIn('builder_id', $builderIds);
            });
            $filters['builder'] = $builderIds;
        }

        // Filter by price range
        if ($request->filled('min_price') || $request->filled('max_price')) {
            $minPrice = $request->min_price ?: 0;
            $maxPrice = $request->max_price ?: 999999999;
            $projects->whereHas('units', function ($query) use ($minPrice, $maxPrice) {
                $query->whereBetween('total_unit_amount', [$minPrice, $maxPrice]);
            });
            $filters['min_price'] = $minPrice;
            $filters['max_price'] = $maxPrice;
        }

        // Filter by bedrooms
        if ($request->filled('bedrooms')) {
            $bedrooms = is_array($request->bedrooms) ? $request->bedrooms : [$request->bedrooms];
            $projects->whereHas('units', function ($query) use ($bedrooms) {
                $query->whereIn('bedrooms', $bedrooms);
            });
            $filters['bedrooms'] = $bedrooms;
        }

        // Filter by tags
        if ($request->filled('tags')) {
            $tagIds = is_array($request->tags) ? $request->tags : [$request->tags];
            $projects->whereHas('tags', function ($query) use ($tagIds) {
                $query->whereIn('tag_id', $tagIds);
            });
            $filters['tags'] = $tagIds;
        }

        // Search by project name
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $projects->where('name', 'like', "%{$searchTerm}%");
            $filters['search'] = $searchTerm;
        }

        // Filter by bonus/offers
        if ($request->filled('with_bonus')) {
            $projects->whereHas('ProjectVoucher', function ($query) {
                $query->where('is_active', 1);
            });
            $filters['with_bonus'] = true;
        }

        return $filters;
    }

    public function getProjectsForMap(Request $request)
    {
        // This method can be used for AJAX requests to get updated project data
        $projects = Project::with(['progress', 'units', 'location', 'type'])
            ->where('projects.status', 1)
            ->where('projects.progress', '!=', 'Completed');

        // Apply same filters as index method
        $this->applyFilters($projects, $request);

        $projectsForMap = $projects->get()->map(function ($project) {
            // Ensure proper cover image path
            $coverImage = $project->project_cover_img;
            if ($coverImage && !str_starts_with($coverImage, 'http') && !str_starts_with($coverImage, '/')) {
                // If it's a relative path, make it absolute
                $coverImage = asset($coverImage);
            } elseif ($coverImage && str_starts_with($coverImage, '/')) {
                // If it starts with /, it's already a path, just add the domain
                $coverImage = url($coverImage);
            } elseif (!$coverImage) {
                // Use default image if no cover image
                $coverImage = asset('images/default-project.jpg');
            }
            
            return [
                'id' => $project->id,
                'name' => $project->name,
                'slug' => $project->slug,
                'address' => $project->address,
                'latitude' => $project->latitude,
                'longitude' => $project->longitude,
                'price' => $project->units->min('total_unit_amount') ?? $project->discount_price ?? 0,
                'progress' => $project->progress->title ?? 'Unknown',
                'type' => $project->type->title ?? 'Unknown',
                'cover_image' => $coverImage,
                'area' => $project->location->name ?? 'Unknown Area',
                'bedrooms' => $project->units->pluck('bedrooms')->filter()->unique()->values()->toArray(),
                'completion_date' => $project->added_time ?? 'TBD',
                'property_id' => $project->property_id ?? '',
                'rooms' => $project->rooms ?? ''
            ];
        });

        return response()->json($projectsForMap);
    }
}
