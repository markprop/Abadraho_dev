<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VoucherRequest;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Response;
use App\Models\UserVoucher;
use BeyondCode\Vouchers\Facades\Vouchers;
// use BeyondCode\Vouchers\Models\Voucher;
use BeyondCode\Vouchers\Rules\Voucher as RulesVoucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Helpers\AppHelper;
use App\Models\Voucher;
use App\Models\Unit;
use App\Models\UnitsVoucher;
use App\Models\Builder;
use App\Models\ProjectOwners;
use Illuminate\Support\Facades\Config;


class VoucherController extends Controller
{

    public function __construct()
    {
        $this->middleware('manage_user_types');
    }

    public function index() {
        
        $status = [
            'Disable',
            'Active'
        ];
        $vouchers = Voucher::with('project','units_voucher.unit');
        if (Auth::user()->user_type_id == Config::get("constants.UserTypeIds.Builder"))
        {
            $Builder = Builder::where("user_id", Auth::user()->id)->first();
            $BuilderProjectIds = ProjectOwners::where("builder_id", $Builder->id)->pluck("project_id");
            $vouchers = $vouchers->whereIn("project_id", $BuilderProjectIds->toArray());
        }
        $vouchers = $vouchers->orderBy('id', 'DESC')->paginate(50);
        return view('panel.admin.vouchers.index', compact('vouchers', 'status'));
   
    }

    public function downloadedVoucherList(Request $request)
    {
        $perPageRecord = 100;
        $user_vouchers = UserVoucher::with('user', 'voucher.units_voucher.unit', 'voucher.project')
            ->orderBy('created_at', 'DESC');

        if (Auth::user()->user_type_id == Config::get("constants.UserTypeIds.Builder")) {
            $builder = Builder::where("user_id", Auth::user()->id)->first();
            $builderProjectIds = ProjectOwners::where("builder_id", $builder->id)->pluck("project_id");
            $user_vouchers = $user_vouchers->whereIn("voucher.project_id", $builderProjectIds->toArray());
        }

        $user_vouchers = $user_vouchers->paginate($perPageRecord);
  
        return view('panel.admin.vouchers.downloaded-voucher', compact('user_vouchers'));
    }

    public function create() {

        $projects = Project::with('ProjectVoucher');
        if (Auth::user()->user_type_id == Config::get("constants.UserTypeIds.Builder")) {
            $Builder = Builder::where("user_id", Auth::user()->id)->first();
            $BuilderProjectIds = ProjectOwners::where("builder_id", $Builder->id)->pluck("project_id");
            $projects = $projects->whereIn("id", $BuilderProjectIds->toArray());
        }
        $projects = $projects->get();

        return view('panel.admin.vouchers.create', compact('projects'));
    }

    public function store(Request $request) {

        $validated = $request->validate([
            'project_id'        =>   'required',
            'name'              =>   'required',
            'discount_by'       =>   'required',
            'discount_applied'  =>   'required',
            'discount_value'    =>   'required',
            // 'code'              =>   'required|unique:vouchers',
            'status'            =>   'required',
            'expires_date'      =>   'required'
        ]);

        $voucher = Voucher::create([
            'project_id'        =>   $request->project_id,
            'name'              =>   $request->name,
            'discount_by'       =>   $request->discount_by,
            'discount_applied'  =>   $request->discount_applied,
            'discount_value'    =>   $request->discount_value,
            // 'code'              =>   $request->code,
            'status'            =>   $request->status == "2" ?  '0' : '1',
            'expires_at'        =>   date('Y-m-d H:i:s', strtotime($request->expires_date))
        ]);

        if($request->discount_applied == "unit")
        {
            foreach($request->units as $unit)
            {
                $unit_voucher = UnitsVoucher::create([
                    'voucher_id'   =>  $voucher->id,
                    'unit_id'      =>  $unit
                ]); 
            }
        }
    
        return redirect('admin/voucher');
    }

    public function getprojectunits($project_id) {
        if(!empty($project_id)){
            $data = Unit::with('UnitVoucher')->where('project_id', $project_id)->get();
            return response()->json($data);
        }
    }

    public function edit($id) {
        $voucher = Voucher::with('units_voucher.unit', 'project.units')->find($id);
        $projects = Project::with('ProjectVoucher')->get();
        return view('panel.admin.vouchers.edit', compact('voucher', 'projects'));
    }
    
    public function update(Request $request, $id) {

        $validated = $request->validate([
            'project_id'        =>   'required',
            'name'              =>   'required',
            'discount_by'       =>   'required',
            'discount_applied'  =>   'required',
            'discount_value'    =>   'required',
            // 'code'              =>   'required',
            'status'            =>   'required',
            'expires_date'      =>   'required'
        ]);

        $voucher = Voucher::find($id);
        $voucher->project_id       =  $request->project_id;
        $voucher->name             =  $request->name;
        $voucher->discount_by      =  $request->discount_by;
        $voucher->discount_applied =  $request->discount_applied;
        $voucher->discount_value   =  $request->discount_value;
        // $voucher->code             =  $request->code;
        $voucher->status           =  $request->status == "2" ?  '0' : '1';
        $voucher->expires_at       =  date('Y-m-d H:i:s', strtotime($request->expires_date));
        $voucher->save();
        $voucher->touch();

        $delete_voucher_units = UnitsVoucher::where('voucher_id',$id)->delete();

        if($request->discount_applied == "unit")
        {
            foreach($request->units as $unit)
            {
                $unit_voucher = UnitsVoucher::create([
                    'voucher_id'   =>  $voucher->id,
                    'unit_id'      =>  $unit
                ]); 
            }
        }

        return redirect('/admin/voucher');
    }
    
    public function destroy($voucher_id) {
        $voucher = Voucher::find($voucher_id);
        $voucher->delete();
        return response()->json(['status' => 'Deleted Successfully']); 
    //     $ErrorMsg = "";
    //     $data = [];
    //     DB::beginTransaction();
    //     try {
    //         $validator = Validator::make($request->all(), [
    //             'voucher_id' => ['required', 'numeric'],
    //         ]);
    //         if ($validator->fails()) {
    //             $data["status"] = false;
    //             $data["message"] = "Something went wrong: Validation Error.";
    //             $data["error"] = $validator->errors();
    //             return response()->json($data, 200);
    //         }
    //         if ($ErrorMsg == "") {
    //             $eloquent = Voucher::where("id", $request->voucher_id);
    //             $deleteTrash = AppHelper::isArchiveRecord($eloquent);
    //             if ($deleteTrash["status"]) {
    //                 $data["status"] = $deleteTrash["status"];
    //                 $data["message"] = "Voucher deleted successfully.";
    //             } else {
    //                 $ErrorMsg = $deleteTrash["message"];
    //             }
    //         }
    //     } catch (\Throwable $e) {
    //         DB::rollback();
    //         $ErrorMsg = "Error Occurred while deleting voucher. Exception Msg : " . $e->getMessage();
    //         $data["status"] = false;
    //         $data["message"] = $ErrorMsg;
    //     }
    //     if ($ErrorMsg == "") {
    //         DB::commit();
    //         return response()->json($data, 200);
    //     } else {
    //         $data["status"] = false;
    //         $data["message"] = $ErrorMsg;
    //         // $data["Obj"] = $request->all();
    //         return response()->json($data, 200);
    //     }
     }
}
