<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Area;
use App\Models\Unit;
use App\Models\Project;
use App\Models\RoomType;
use Carbon\Traits\Units;
use App\Models\ProjectType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\UserSearchHistory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class ProjectController extends BaseController
{
    public function all(Request $request)
    {
        // Get All Projects
        return Project::with('units', 'owners', 'location')->where('status', 1)->get();
    }

    public function filter(Request $request)
    {
        // dd($request->all());
        // return $request->all();
        // return response()->json($request->all());

        // $request->session()->put('area', $request->area);

        $area = $request->area;
        $progress = $request->progress;
        $type = $request->type;
        $builder = $request->builder;
        $minDP = $request->minDP;
        $maxDP = $request->maxDP;
        $minMI = $request->minMI;
        $maxMI = $request->maxMI;
        $minPrice = $request->minPrice;
        $maxPrice = $request->maxPrice;
        $userID = $request->user_id;

        // $userSearchHistory = UserSearchHistory::create([
        //     'user_id' => 1,
        //     'hash' => 'hd4f',
        //     'json' => serialize($request->all()),
        // ]);

        // dd($userSearchHistory);

        // $userSearchHistory = UserSearchHistory::create([
        //     'area' => 
        // ]);
        // dd($area);
        // Get All Projects
        $projects = Project::with('units', 'owners', 'location');
        // return $admin;
        // Filter by admin name
        if ($builder) {

            $projects = $projects->whereHas('owners', function ($query) use ($builder) {
                $query->where('full_name', 'like', '%' . $builder . '%');
            });
        }

        // Filter by Progress
        if ($progress) {
            $projects = $projects->whereIn('progress', $progress);
        }

        // Filter By Area
        if ($area) {
            // dd('no default value');
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
        // return 'asdsa';
        $projects = $projects->get();

        // $response = [
        //     'data' => $projects,
        //     'success' => true,
        //     'response' => '200',
        //     'message' => 'Success',
        // ];
        // return $this->sendResponse($response, 'Successfully.');
        return redirect('/listings', compact('projects'));
    }

    public function show(Request $request)
    {
        $data = Project::with('units', 'owners', 'location', 'project_info')->where('slug', $request->slug)->first();

        $unit_type = array();
        $rooms_data = array();
        $installment_detail = array();
        foreach ($data->units as $key => $unit) {
            if ($unit->id) {
                $rooms_data[$key] = $unit->room;
            }
            if ($unit->installment) {
                $installment_detail[$key] = $unit->installments;
            }
            if ($unit->unit_type_id) {
                $type = ProjectType::where('id', $unit->unit_type_id)->first();
                $unit_type[$key] = $type->title;
            }
        }

        $total_months = $data->installment_length;
        $years = number_format(floor($total_months / 12));
        $months = number_format($total_months % 12);
        if ($months != 0) {
            $length = $years . ' Years ' . $months . ' Months';
        } else {
            $length = $years . ' Years';
        }

        $added_ago = Carbon::parse($data->added_time);
        $added_ago = $added_ago->diffForHumans();
        if ($data) {
            $response = [
                'owners' => isset($data->owners) ? $data->owners : '',
                'data' => $data,
                'unit_types' => array_unique($unit_type),
                'length' => $length,
                'rooms' => $rooms_data,
                'added_ago' => $added_ago,
                'installment_type' => $installment_detail,
                'success' => true,
                'response' => '200',
                'message' => 'Success',
            ];
            return $this->sendResponse($response, 'Successfully.');
        } else {
            return $this->sendResponse($data, 'No Data Found');
        }
    }

    public function compare(Request $request)
    {
        return Project::all()->except(1);
    }

    public function area(Request $request)
    {
        $data = Area::where('id', $request->id)->first();
        if ($data) {
            return $this->sendResponse($data, 'Successfully.');
        } else {
            return $this->sendResponse($data, 'No Data Found');
        }
    }

    public function unit(Request $request)
    {
        $data = ProjectType::where('id', $request->id)->first();
        if ($data) {
            return $this->sendResponse($data, 'Successfully.');
        } else {
            return $this->sendResponse($data, 'No Data Found');
        }
    }

    public function similar(Request $request)
    {
        $data = Project::with('units', 'owners', 'location', 'project_info')->where('id', $request->project_id)->first();
        // return $data->area;
        $unit_type = array();
        foreach ($data->units as $key => $unit) {
            if ($unit->unit_type_id) {
                $type = ProjectType::where('id', $unit->unit_type_id)->first();
                $unit_type[$key] = $type->id;
            }
        }

        $projects = Project::with('units')->where('id', '!=', $request->project_id);
        $projects = $projects
            ->whereHas('units', function ($query) use ($unit_type) {
                $query->whereIn('unit_type_id', $unit_type);
            })
            ->orWhere('area', $data->area)
            ->orWhere('rooms', 'like', '%' . 'rooms' . '%');

        return $this->sendResponse($projects->get(), 'No Data Found');
    }
}
