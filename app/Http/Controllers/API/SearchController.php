<?php

namespace App\Http\Controllers\API;

use App\Models\Unit;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class SearchController extends Controller
{
    public function all(Request $request)
    {
        // Get All Projects
        return Project::with('units', 'owners', 'location')->get();
    }

    public function filter(Request $request)
    {
        // return $request->all();
        // return response()->json($request->all());

        $area = json_decode($request->area);
        $progress = json_decode($request->progress);
        $type = json_decode($request->type);
        $builder = json_decode($request->builder);
        $minDP = json_decode($request->minDP);
        $maxDP = json_decode($request->maxDP);
        $minMI = json_decode($request->minMI);
        $maxMI = json_decode($request->maxMI);
        $minPrice = json_decode($request->minPrice);
        $maxPrice = json_decode($request->maxPrice);

        // Get All Projects
        $projects = Project::with('units', 'owners', 'location');

        // Filter by admin name
        if ($builder) {
            $projects = $projects->whereHas('owners', function ($query) use ($builder) {
                $query->where('first_name', 'like', '%' . $builder . '%');
            });
        }
        // Filter by Progress
        if ($progress) {
            $projects = $projects->whereIn('progress', $progress);
        }

        // Filter By Area
        if ($area) {
            $projects = $projects->whereIn('area', $area);
        }

        // Filter by Project Type
        if ($type) {
            $projects = $projects->whereIn('project_type_id', $type);
        }

        // Filter by Down Payment
        if ($minDP || $maxDP) {

            return $projects->get();
            $minDP = $minDP ?? 0;
            $maxDP = $maxDP ?? Unit::max('down_payment');
            $projects = $projects->whereHas('units', function ($query) use ($minDP, $maxDP) {
                $query->whereBetween('down_payment', [$minDP, $maxDP]);
            });
        }

        // Filter by Monthly Installment
        if ($minMI || $maxMI) {
            $minMI = $minMI ?? 0;
            $maxMI = $maxMI ?? Unit::max('monthly_installment');

            $projects = $projects->whereHas('units', function ($query) use ($minMI, $maxMI) {
                $query->whereBetween('monthly_installment', [$minMI, $maxMI]);
            });
        }

        // Filter by Price
        if ($minPrice || $maxPrice) {
            $minPrice = $minPrice ?? 0;
            $maxPrice = $maxPrice ?? Unit::max('price');
            $projects = $projects->whereHas('units', function ($query) use ($minPrice, $maxPrice) {
                $query->whereBetween('price', [$minPrice, $maxPrice]);
            });
        }
        return $projects->get();
    }
}
