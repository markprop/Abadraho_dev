<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Builder;
use App\Models\Project;
use App\Models\ProjectType;
use App\Models\Unit;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {
        // $projects = Project::all();
        // $areas = Area::all();
        // $types = ProjectType::all();
        return view('projects');
    }
    public function allprojects()
    {
        return Project::first();
    }
    public function areas()
    {
        return Area::select('id', 'name AS text')->get();
    }
    public function projectTypes()
    {
        return ProjectType::select('id', 'title AS text')->get();
    }
    public function search(Request $request)
    {

        $projects = Project::with('units', 'owners', 'location');

        // dd($request->admin);
        // Get by admin name
        if ($request->builder) {
            // dd('sda');
            $builderName = $request->builder;
            $projects = $projects->whereHas('owners', function ($query) use ($builderName) {
                $query->where('name', 'like', '%' . $builderName . '%');
            });
        }

        // Get by Progress
        if ($request->progress) {
            $projects = $projects->whereIn('progress', $request->progress);
        }
        // dd('outside');
        // Get By Area
        if ($request->area) {
            // dd('no default value');
            $projects = $projects->whereIn('area', $request->area);
        }

        // Get by Project Type
        if ($request->type) {
            $projects = $projects->whereIn('project_type_id', $request->type);
        }

        // Get by Down Payment
        if ($request->minDP || $request->maxDP) {
            # code...
            // $minDP = $request->minDP;
            // $maxDP = null;
            $minDP = $request->minDP ?? 0;
            $maxDP = $request->maxDP ?? Unit::max('down_payment');
            $projects = $projects->whereHas('units', function ($query) use ($minDP, $maxDP) {
                $query->whereBetween('down_payment', [$minDP, $maxDP]);
            });
        }

        // Get by Monthly Installment
        if ($request->minMI || $request->maxMI) {
            $minMI = $request->minMI ?? 0;
            $maxMI = $request->maxMI ?? Unit::max('monthly_installment');
            // return "minimum " . $request->minMI . "         Maximum: " . $maxMI;
            $projects = $projects->whereHas('units', function ($query) use ($minMI, $maxMI) {
                $query->whereBetween('monthly_installment', [$minMI, $maxMI]);
            });
        }

        // Get by Price
        if ($request->minPrice || $request->maxPrice) {
            $minPrice = $request->minPrice ?? 0;
            $maxPrice = $request->maxPrice ?? Unit::max('price');
            $projects = $projects->whereHas('units', function ($query) use ($minPrice, $maxPrice) {
                $query->whereBetween('price', [$minPrice, $maxPrice]);
            });
        }
        // dd(response()->json($projects->get()));
        return $projects->get();
        dd($projects->get());
        $projects = $projects->get();
        return $projects;
    }
    public function details(Project $project)
    {
        $project = $project->with('owners', 'units')->where('id', $project->id)->first();
        return view('project-details', compact('project'));
        dd($project);
    }
}
