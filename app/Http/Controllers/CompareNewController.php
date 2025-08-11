<?php
namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Project;
use Illuminate\Http\Request;

class CompareNewController extends Controller
{
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
}
