<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VoucherRequest;
use App\Models\Project;
use App\Models\User;
use App\Models\UserVoucher;
use BeyondCode\Vouchers\Facades\Vouchers;
use BeyondCode\Vouchers\Models\Voucher;
use BeyondCode\Vouchers\Rules\Voucher as RulesVoucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Helpers\AppHelper;

class VoucherController extends Controller
{
    public function index() {
        $status = [
            'Active',
            'Redeemed',
        ];
        
        $voucherData = [];
        $vouchers = Voucher::all();
        
        for ($i = 0; $i < count($vouchers); $i++) {
            $arr = json_decode($vouchers[$i]->data, true);
            //$arr["created_at"] = $vouchers->toArray()[$i]["created_at"];
            // dd($arr);
            array_push($voucherData , $arr);
            // $paymentData = unserialize($paymentSchedules[$i]->json);
        }
        return view('panel.admin.vouchers.index', compact('vouchers', 'voucherData', 'status'));
    }

    public function downloadedVoucherList(Request $request)
    {
        $perPageRecord = $request->perPageRecord ? $request->perPageRecord : config('constants.PageLimit');
        // $user_vouchers = UserVoucher::orderBy('created_at', 'DESC')->paginate($perPageRecord);

        $user_vouchers = UserVoucher::select(
                    "users.id",
                    "users.first_name",
                    "users.last_name",
                    "projects.name",
                    "user_voucher.redeemed_at"
                )
                ->leftJoin("users", "users.id", "=", "user_voucher.user_id")
                ->leftJoin("projects", "projects.id", "=", "user_voucher.voucher_id")
                ->paginate($perPageRecord);
  
        return view('panel.admin.vouchers.downloaded-voucher', compact('user_vouchers'));
    }

    public function create() {
        $projects = Project::all();
        return view('panel.admin.vouchers.create', compact('projects'));
    }

    public function store(Request $request) {
        // dd($request);
        $data = $request->only('code', 'user_full_name','user_email','user_phone', 'project_name', 'status', 'expires_at', 'data');
        // dd($data);
        // $test['code'] = rand();
        $test['data'] = json_encode($data);
        // dd($test);
        Voucher::insert($test);
        return view('panel.admin.vouchers.create');
    }
    
    public function edit(Voucher $voucher) {
        $status = [
            'Active',
            'Redeemed',
        ];
        return view('panel.admin.vouchers.edit', compact('voucher', 'status'));
    }
    
    public function update(VoucherRequest $request, Voucher $voucher) {
        $voucher->status = $request->status;
        $voucher->expires_at = $request->expires_at;
        $voucher->save();
        $voucher->touch();
        return redirect('/admin/voucher');
    }
    
    public function destroy($voucher_id) {
        $voucher = Voucher::find($voucher_id);
        $voucher->delete();
        return response()->json(['status' => 'Deleted Successfully']); 

        // $ErrorMsg = "";
        // $data = [];
        // DB::beginTransaction();
        // try {
        //     $validator = Validator::make($request->all(), [
        //         'voucher_id' => ['required', 'numeric'],
        //     ]);
        //     if ($validator->fails()) {
        //         $data["status"] = false;
        //         $data["message"] = "Something went wrong: Validation Error.";
        //         $data["error"] = $validator->errors();
        //         return response()->json($data, 200);
        //     }
        //     if ($ErrorMsg == "") {
        //         $eloquent = Voucher::where("id", $request->voucher_id);
        //         $deleteTrash = AppHelper::isArchiveRecord($eloquent);
        //         if ($deleteTrash["status"]) {
        //             $data["status"] = $deleteTrash["status"];
        //             $data["message"] = "Voucher deleted successfully.";
        //         } else {
        //             $ErrorMsg = $deleteTrash["message"];
        //         }
        //     }
        // } catch (\Throwable $e) {
        //     DB::rollback();
        //     $ErrorMsg = "Error Occurred while deleting voucher. Exception Msg : " . $e->getMessage();
        //     $data["status"] = false;
        //     $data["message"] = $ErrorMsg;
        // }
        // if ($ErrorMsg == "") {
        //     DB::commit();
        //     return response()->json($data, 200);
        // } else {
        //     $data["status"] = false;
        //     $data["message"] = $ErrorMsg;
        //     // $data["Obj"] = $request->all();
        //     return response()->json($data, 200);
        // }
    }
}