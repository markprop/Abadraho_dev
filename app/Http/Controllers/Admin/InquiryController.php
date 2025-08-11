<?php

namespace App\Http\Controllers\Admin;

use App\Models\Unit;
use App\Models\Inquiry;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Exports\ZohoFormExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use App\Models\Builder;
use App\Models\ProjectOwners;
use Illuminate\Support\Facades\Config;

class InquiryController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:admin');
        $this->middleware('manage_user_types');
    }

    public function index(Request $request)
    {
        $inquiries = Inquiry::orderBy('created_at', 'DESC');
        $allProjects = Project::orderBy("name", "ASC");

        if (Auth::user()->user_type_id == Config::get("constants.UserTypeIds.Builder")) {
            $Builder = Builder::where("user_id", Auth::user()->id)->first();
            $BuilderProjectIds = ProjectOwners::where("builder_id", $Builder->id)->pluck("project_id");
            // dd($BuilderProjectIds->toArray());

            $inquiries = $inquiries->whereIn("project_id", $BuilderProjectIds->toArray());
            $allProjects = $allProjects->whereIn("id", $BuilderProjectIds->toArray());
        }

        // if($request['from']) dd($request['from']);
        $searchQuery = [];
        $searchQuery['name'] = $request->name ? $request->name : null;
        $searchQuery['email'] = $request->email ? $request->email : null;
        $searchQuery['phone_number'] = $request->phone_number ? $request->phone_number : null;
        $searchQuery['address'] = $request->address ? $request->address : null;
        $searchQuery['project_id'] = $request->project_id ? $request->project_id : null;
        $searchQuery['unit_id'] = $request->unit_id ? $request->unit_id : null;
        $searchQuery['from'] = $request['from'] ?? "";
        $searchQuery['to'] = $request['to'] ?? "";

        $request['name'] && $inquiries =  $inquiries->where("name", "LIKE", $request['name']);
        $request['email'] && $inquiries =  $inquiries->where("email", "LIKE", $request['email']);
        $request['phone_number'] && $inquiries =  $inquiries->where("phone_number", "LIKE", $request['phone_number']);
        $request['address'] && $inquiries =  $inquiries->where("address", "LIKE", $request['address']);
        if ($request['project_id']) {
            foreach ($request['project_id'] as $project) {
                $inquiries =  $inquiries->where("project_id", "LIKE", $project);
            }
        }
        if ($request['unit_id']) {
            foreach ($request['unit_id'] as $unit) {
                $inquiries =  $inquiries->where("unit_id", "LIKE", $unit);
            }
        }
        if ($request['from'] != "" && $request['to'] != "") {
            $inquiries = $inquiries->whereBetween("created_at", [$request['from'], $request['to']]);
        }
        
        $perPageRecord = $request->perPageRecord ? $request->perPageRecord : config('constants.PageLimit');
        $inquiries = $inquiries->paginate($perPageRecord);
        $allProjects = $allProjects->get();

        return view('panel.admin.zoho_forms.index', compact('inquiries', 'searchQuery', 'allProjects'));
    }

    public function show(Inquiry $inquiry)
    {
        $unit = Unit::where('id', $inquiry->unit_id)->first();
        $projectName = Project::where('id', $unit->project_id);
        return view('panel.admin.zoho_forms.show', compact('inquiry'));
    }

    public function export(Request $request)
    {
        $searchQuery = $request['searchQuery'];
        $fileName = 'ZohoForm-' . date('Y-m-d-H-i-s') . '.xlsx';
        $fields = $request['fields'];
        return Excel::download(new ZohoFormExport($fields, $searchQuery), $fileName);
    }
    public function destroy(Inquiry $inquiry)
    {
        Inquiry::destroy($inquiry->id);
        return back();
    }
}
