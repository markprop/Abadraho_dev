<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity as ActivityLog;
use App\Helpers\AppHelper;
use Illuminate\Support\Facades\Config;

class ActivityLogController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('web');
    }

    public function groupIndex()
    {

        $query = "select concat(b.first_name,' ',b.last_name) full_name,b.phone_number,b.email,b.username,";
        $query .= "a.log_name,a.description,a.page_url,SUM(a.duration_in_second) as duration_in_second,";
        $query .= "SEC_TO_TIME(SUM(a.duration_in_second)) duration_in_minutes,COUNT(a.id) as projectCounter ,a.ip";
        // $query .= ",date_format(a.created_at, '%Y-%m-%d - %W') created_at";
        $query .= " FROM `activity_log` a";
        $query .= " LEFT JOIN users b on a.causer_id = b.id";
        $query .= " LEFT JOIN projects c on a.subject_id = c.id";
        $query .= " WHERE a.log_name = '" . Config::get("constants.CustomActivityLogs.viewProjectDetails.value") . "'";
        $query .= " GROUP by b.id,b.first_name,b.last_name,b.phone_number,b.username,a.log_name,a.description,a.page_url,a.ip";
        // dd($query);
        $data = DB::select($query);

        // $data = ActivityLog::all();
        $logProp = [];


        // foreach ($data as $datum) {
        //     $JsonToArr = json_decode($datum->properties, true);

        //     // dd($userHistory->toArray()["created_at"]);
        //     //dd($JsonToArr);
        //     $logProp[] = $JsonToArr;
        //     //dd($logProp);

        // }

        return view('panel.admin.activity_log', compact('data', 'logProp'));
    }

    public function index(Request $request)
    {
        $perPageRecord = $request->perPageRecord ? $request->perPageRecord : config('constants.PageLimit');
        // dd(DB::table("activity_log")->get()[0]);
        $data = DB::table("activity_log")
            ->orderBy("activity_log.id", "desc")
            ->select(
                "activity_log.id",
                "activity_log.log_name",
                "activity_log.conversion_id",
                "activity_log_conversions.conversion",
                "activity_log_conversions.description as conversionDescription",
                DB::raw("concat(users.first_name , ' ' , users.last_name) as full_name"),
                "users.phone_number",
                "users.email",
                "activity_log.description",
                DB::raw("date_format(activity_log.created_at, '%Y-%m-%d %r  %W') formated_created_at"),
                "activity_log.page_url",
                "activity_log.duration_in_second",
                "activity_log.ip",
                "activity_log.created_at",
                DB::raw("SEC_TO_TIME(activity_log.duration_in_second) duration_in_minutes")
            )
            ->leftJoin('users', 'users.id', '=', 'activity_log.causer_id')
            ->leftJoin('activity_log_conversions', 'activity_log.conversion_id', '=', 'activity_log_conversions.id')
            ->paginate($perPageRecord);

        // dd($data);

        return view('panel.admin.activity_log', compact('data'));
    }


    public function insertCustomActivityLog(Request $request)
    {
        AppHelper::insertActivityLog($request);
    }
}
