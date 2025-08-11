<?php

namespace App\Http\Controllers\Admin;

use App\Models\Unit;
use Illuminate\Http\Request;
use App\Models\ZohoForm;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Exports\ZohoFormExport;
use Maatwebsite\Excel\Facades\Excel;

class ZohoFormController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:admin');
        $this->middleware('manage_user_types');
    }

    public function index()
    {
        $records = ZohoForm::all();

        // $units = Unit::all();
        $units = Unit::all();
        //dd($units);
        return view('panel.admin.zoho_forms.index', compact('records', 'units'));
    }

    public function show(ZohoForm $zohoForm)
    {
        $unit = Unit::where('id', $zohoForm->unit_id)->first();
        $projectName = Project::where('id', $unit->project_id);
        return view('panel.admin.zoho_forms.show', compact('zohoForm'));
    }

    public function export(Request $request)
    {
        $fileName = 'ZohoForm-' . date('Y-m-d-H-i-s') . '.xlsx';
        $fields = $request['fields'];
        return Excel::download(new ZohoFormExport($fields), $fileName);
    }

    // public function test()
    // {
    //     dd('ALi');
    // }
}
