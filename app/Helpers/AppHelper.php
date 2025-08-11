<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Config;
use Illuminate\Support\Facades\DB;
use File;
use Jenssegers\Agent\Facades\Agent;
use Session;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Database\Eloquent\Builder as dbBuilder;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use App\Models\Activity_log_conversion;

class AppHelper
{
    public static function checkAppHelper()
    {
        return "AppHelper is working.";
    }

    public static function getImagePath($Attachment, $AllowedExtesionArr, $AttachmentPath, $AllowedFileSizwInMB = "2", $ExtarParams = null)
    {
        try {

            if ($Attachment == null) {
                return null;
            }
            if ($AllowedFileSizwInMB == "") {
                $AllowedFileSizwInMB = "2";
            }
            $exploded_file = explode(',', $Attachment);

            $decode_file = base64_decode($exploded_file[1]);
            $extension = "";
            foreach ($AllowedExtesionArr as $key => $value) {
                if (str_contains($exploded_file[0], $key)) {
                    $extension = $value;
                    break;
                }
            }

            if ($extension == "") {
                return array("Error" => "File type not supported. Please select these files [ " . implode(' , ', $AllowedExtesionArr) . " ].");
            }

            if ($ExtarParams != null && isset($ExtarParams["DomainPath"])) {
                $UploadDir = $ExtarParams["DomainPath"] . "/public" . $AttachmentPath;
            } else {
                $UploadDir = public_path() . $AttachmentPath;
            }

            if (!is_dir($UploadDir)) {
                $makeDirectory = File::makeDirectory($UploadDir, 0775, true);
            }

            $file_name = Str::random() . date("Ymdhisu") . '.' . $extension;
            $putFilePath = $UploadDir . '/' . $file_name;

            if (file_put_contents($putFilePath, $decode_file)) {

                return $AttachmentPath . '/' . $file_name;
            }
        } catch (Exception $e) {
            return array("Error" => "Error Occured while uploading file. Exception Msg: " . $e->getMessage());
        }
    }

    public static function SaveFileAndGetPath($Attachment, $AttachmentPath)
    {
        $ErrorMsg = "";
        try {
            if ($Attachment == null) {
                return null;
            }
            if ($ErrorMsg == "") {
                $AttachmentPath = $AttachmentPath . date("Y") . '/' . date("F");
                $extension = $Attachment->getClientOriginalExtension();
                $move_file_path = public_path() . $AttachmentPath;
                $move_file_name = Str::random() . date("Ymdhisu") . '.' . $extension;

                $SavingFilePath = $AttachmentPath . "/" . $move_file_name;
                $FileMoved = $Attachment->move($move_file_path, $move_file_name);
            }
        } catch (\Throwable $e) {
            $ErrorMsg = "Error Occured while uploading file. Exception Msg: " . $e->getMessage();
            return array("reply" => 0, "status" => false, "msg" => $ErrorMsg);
        }
        if ($ErrorMsg == "") {
            return array("reply" => 1, "status" => true, "msg" => "File Uploaded Successfully.", "path" => $SavingFilePath);
        } else {
            return array("reply" => 0, "status" => false, "msg" => $ErrorMsg);
        }
    }

    public static function GeneratRandomNumber($size = 4)
    {
        $random_number = '';
        $count = 0;
        while ($count < $size) {
            $random_digit = mt_rand(0, 9);
            $random_number .= $random_digit;
            $count++;
        }
        return $random_number;
    }

    public static function isArchiveRecord(dbBuilder $model)
    {
        $ErrorMsg = "";
        $data = [];

        DB::beginTransaction();
        try {
            // return $request->all();
            // return response()->json($data, 200);
            $currentyDBRecord = $model->first()->toArray();
            // dd($dbRecord["id"]);
            if ($ErrorMsg == "") {
                if (Auth::check()) {
                    $archiveRecord = $model->update([
                        "is_archive" => 1,
                        "is_archive_by" => Auth::user()->id,
                        "is_archive_at" => Carbon::now()->toDateTimeString(),
                    ]);
                    $data["status"] = true;
                    $data["message"] = "deleted successfully.";
                    $data["data"] = $currentyDBRecord;
                    // dd($archiveRecord);
                } else {
                    $ErrorMsg = "Session Expired: please logged in first.";
                }
            }
        } catch (\Throwable $e) {
            DB::rollback();
            $ErrorMsg = "Error Occurred while runing AppHelper::isArchiveRecord method. Exception Msg : " . $e->getMessage();
            $data["status"] = false;
            $data["message"] = $ErrorMsg;
        }
        if ($ErrorMsg == "") {
            DB::commit();
            // dd("eeeeeeeeeee");
            return $data;
        } else {
            $data["status"] = false;
            $data["message"] = $ErrorMsg;
            // $data["Obj"] = $request->all();
            // dd($ErrorMsg);
            return $data;
        }
    }

    public static function insertActivityLog(Request $request)
    {
        $ErrorMsg = "";
        $data = [];
        DB::beginTransaction();
        try {
            // $validator = Validator::make($request->all(), [
            //     'email' => 'required|email',
            //     'password' => 'required'
            // ]);

            // if ($validator->fails()) {
            //     $data["status"] = false;
            //     $data["message"] = "Some thing went wrong: Validation Error.";
            //     $data["error"] = $validator->errors();
            //     return response()->json($data, 200);
            // }
            // return response()->json($data, 200);
            if ($ErrorMsg == "") {


                // $arr
                // dd($request->cookie());

                // dd($request->userAgent());
                $arr = [
                    "log_name" => $request->log_name,
                    "description" => $request->description,
                    "duration_in_second" => $request->duration_in_second,
                    "page_url" => $request->path(),
                    "causer_type" => \App\Model\User::class,
                    "causer_id" => Auth::check() ? Auth::user()->id : null,
                    "ip" => $request->ip(),
                    "log_table" => "projects",
                    "properties" => $request->all(),
                    "properties" => date('Y-m-d'),
                ];

                // dd($arr);

                $GetConversion = Activity_log_conversion::where("id", $request->conversion_id)->first();

                // dd($GetConversion);

                $activity = activity()->log($request->description ? $request->description : "description not define");
                $activity->conversion_id = $request->conversion_id ? $request->conversion_id : NULL;
                $activity->conversion = $GetConversion ? $GetConversion->description : NULL;
                $activity->log_name = $request->log_name ? $request->log_name : NULL;
                $activity->log_table = $request->log_table ? $request->log_table : NULL;
                $activity->duration_in_second = $request->duration_in_second ? $request->duration_in_second : NULL;
                $activity->page_url = $request->page_url ? $request->page_url : NULL;
                $activity->objective = $request->objective ? $request->objective : NULL;
                $activity->subject_id = $request->subject_id ? $request->subject_id : NULL;
                $activity->subject_type = $request->subject_type ? $request->subject_type : NULL;
                $activity->causer_type = \App\Model\User::class;
                $activity->causer_id = Auth::check() ? Auth::user()->id : NULL;
                $activity->ip = $request->ip();
                $activity->properties = $request->all();
                $activity->created_date = date('Y-m-d');
                $activity->save();

                $data["status"] = true;
                $data["message"] = "Activity Log inserted successfully.";
                $data["data"] = $activity;
                // return true;
                // ddd(["status" => true]);
            }
        } catch (\Throwable $e) {
            DB::rollback();
            $ErrorMsg = "Error Occurred while insert activity log. Exception Msg : " . $e->getMessage();
            $data["status"] = false;
            $data["message"] = $ErrorMsg;
        }
        if ($ErrorMsg == "") {
            DB::commit();
            return response()->json($data, 200);
        } else {
            $data["status"] = false;
            $data["message"] = $ErrorMsg;
            // $data["Obj"] = $request->all();
            return response()->json($data, 200);
        }
    }

    public static function addActivityLog($args = [])
    {
        try {
            $GetConversion = Activity_log_conversion::where("id", $args['conversion_id'])->first();

            $activity = activity()->log($args['description'] ?: "description not define");
            $activity->conversion_id = $args['conversion_id'] ?: NULL;
            $activity->conversion = $GetConversion ? $GetConversion->description : NULL;
            $activity->log_name = $args['log_name'] ?: NULL;
            $activity->log_table = $args['log_table'] ?: NULL;
            $activity->duration_in_second = $args['duration_in_second'] ?: NULL;
            $activity->page_url = $args['page_url'] ?: NULL;
            $activity->objective = $args['objective'] ?: NULL;
            $activity->subject_id = $args['subject_id'] ?: NULL;
            $activity->subject_type = $args['subject_type'] ?: NULL;
            $activity->causer_type = \App\Model\User::class;
            $activity->causer_id = Auth::check() ? Auth::user()->id : NULL;
            $activity->ip = request()->ip();
            $activity->properties = $args;
            $activity->created_date = date('Y-m-d');
            $activity->save();
            return true;
        } catch (\Throwable $e) {
            return false;
        }
    }
}
