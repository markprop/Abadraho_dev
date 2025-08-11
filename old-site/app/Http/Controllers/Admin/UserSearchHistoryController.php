<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserSearchHistory;
use App\Models\Builder;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UserSearchHistoryExport;
use App\Exports\UserCalSearchHistoryExport;
use App\Models\Area;
use App\Models\ProjectType;
use App\Models\InstallmentType;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Search;

class UserSearchHistoryController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:admin');
        $this->middleware('manage_user_types');
    }
    public function index()
    {
        $userHistorys = UserSearchHistory::orderBy('created_at', 'DESC')->where('search_type', 'filter')->orWhere('search_type', NULL)->paginate(100);
        // dd($userHistorys->toArray());
        // $userHistorys = UserSearchHistory::orderBy('created_at', 'DESC')->whereRaw('JSON_CONTAINS(json, \'{"progress":"Under Construction"}\')')->get();

        $searchData = [];
        $searchQuery = [];
        $username = [];
        $builders = [];

        $searchQuery['area'] = [];
        $searchQuery['progress'] = [];
        $searchQuery['type'] = [];
        $searchQuery['builder'] = [];
        $searchQuery['minDownPayment'] = '';
        $searchQuery['maxDownPayment'] = '';
        $searchQuery['minMonthlyInstall'] = '';
        $searchQuery['maxMonthlyInstall'] = '';
        $searchQuery['minPrice'] = '';
        $searchQuery['maxPrice'] = '';

        // loop through data and store it in $searchData array
        foreach ($userHistorys as $userHistory) {
            $JsonToArr = json_decode($userHistory->json, true);
            $JsonToArr["created_at"] = $userHistory->toArray()["created_at"];
            // dd($userHistory->toArray()["created_at"]);
            // dd($JsonToArr);
            $searchData[] = $JsonToArr;
            // dd($searchData);
            $searchDataBuilder = json_decode($userHistory->json, true)['builder'];

            if ($userHistory->user_id != 0) {

                $username[] = $userHistory->user;
                // dd($userHistory->user);
                // $username[] = User::where('id', $userHistory->user_id)->first()->first_name . ' ' . User::where('id', $userHistory->user_id)->first()->last_name;
            } else {
                $username[] = 'Visitor';
            }
            if ($searchDataBuilder) {
                foreach ($searchDataBuilder as $builder) {
                    $builders[] = Builder::where("id", $builder)->get();
                }
            }
        }
        // dd($searchData);
        return view('panel.admin.search_history.index', compact('userHistorys', 'searchData', 'builders', 'username', 'searchQuery'));
    }

    public function adminUserSearchFilter(Request $request)
    {
        $userHistorys = UserSearchHistory::orderBy('created_at', 'DESC');
        $maxDP = UserSearchHistory::max("minDP");
        $maxMI = UserSearchHistory::max("minMI");
        $maxPrice = UserSearchHistory::max("minPrice");
        // if($request['area']){
        //     $searchArea = implode("|",$request['area']);
        //     $area = $request['area'] ? $userHistorys->where("area", "LIKE", "%".$searchArea."%") : null;
        // }
        // dd($request['maxDownPayment']);
        $searchObj = [];
        if ($request['progress']) {
            foreach ($request['progress'] as $progress) {
                $userHistorys = $userHistorys->orWhereJsonContains("json->progress", $progress)->where('search_type',  'filter');
            }
        }
        if ($request['area']) {
            foreach ($request['area'] as $area) {
                $userHistorys =  $userHistorys->orWhereJsonContains("json->area", $area)->where('search_type',  'filter');
            }
        }
        if ($request['builder']) {
            foreach ($request['builder'] as $builder) {
                $userHistorys = $userHistorys->orWhereJsonContains("json->builder", $builder)->where('search_type',  'filter');
            }
        }
        if ($request['type']) {
            foreach ($request['type'] as $type) {
                $userHistorys = $userHistorys->orWhereJsonContains("json->type", $type)->where('search_type',  'filter');
            }
        }
        if ($request['minDownPayment']) {
            $userHistorys = $userHistorys->where('minDP', ">=", $request['minDownPayment']);
        }
        if ($request['maxDownPayment']) {
            $userHistorys = $userHistorys->where('maxDP', "<=", $request['maxDownPayment']);
        }
        if ($request['minMonthlyInstall']) {
            $userHistorys = $userHistorys->where('minMI', ">=", $request['minMonthlyInstall']);
        }
        // dd($userHistorys);
        if ($request['maxMonthlyInstall']) {
            $userHistorys = $userHistorys->where('maxMI', "<=", $request['maxMonthlyInstall']);
        }
        if ($request['minPrice']) {
            $userHistorys = $userHistorys->where('minPrice', ">=", $request['minPrice']);
        }
        if ($request['maxPrice']) {
            $userHistorys = $userHistorys->where('maxPrice', "<=", $request['maxPrice']);
        }
        if ($request['from'] != "" && $request['to'] != "") {
            $userHistorys = $userHistorys->whereBetween("created_at", [$request['from'], $request['to']]);
        }

        $userHistorys = $userHistorys->where('search_type',  'filter');
        // dd($userHistorys);
        $userHistorys = $userHistorys->get();

        $searchData = [];
        $searchQuery = [];
        $username = [];
        $builders = [];

        $searchQuery['progress'] = $request['progress'] ? $request['progress'] : null;
        $searchQuery['area'] = $request['area'] ? $request['area'] : null;
        $searchQuery['builder'] = $request['builder'] ? $request['builder'] : null;
        $searchQuery['type'] = $request['type'] ? $request['type'] : null;
        $searchQuery['minDownPayment'] = $request['minDownPayment'] ? $request['minDownPayment'] : null;
        $searchQuery['maxDownPayment'] = $request['maxDownPayment'] ? $request['maxDownPayment'] : null;
        $searchQuery['minMonthlyInstall'] = $request['minMonthlyInstall'] ? $request['minMonthlyInstall'] : null;
        $searchQuery['maxMonthlyInstall'] = $request['maxMonthlyInstall'] ? $request['maxMonthlyInstall'] : null;
        $searchQuery['minPrice'] = $request['minPrice'] ? $request['minPrice'] : null;
        $searchQuery['maxPrice'] = $request['maxPrice'] ? $request['maxPrice'] : null;
        $searchQuery['from'] = $request['from'] ?? "";
        $searchQuery['to'] = $request['to'] ?? "";


        // foreach(array_keys($searchQuery) as $key=>$query){
        //     // dd($query);
        //     if($searchQuery[$query] != null){
        //         // dd($searchQuery[$query]);
        //         $userHistorys->where("json->$query", $searchQuery[$query]);
        //     }
        // }

        // loop through data and store it in $searchData array
        foreach ($userHistorys as $userHistory) {
            $searchData[] = json_decode($userHistory->json, true);
            $searchDataBuilder = json_decode($userHistory->json, true)['builder'];
            // dd($searchDataBuilder);

            if ($userHistory->user_id != 0) {

                $username[] = $userHistory->user;
                // dd($userHistory->user);
                // $username[] = User::where('id', $userHistory->user_id)->first()->first_name . ' ' . User::where('id', $userHistory->user_id)->first()->last_name;
            } else {
                $username[] = 'Visitor';
            }
            if ($searchDataBuilder) {

                foreach ($searchDataBuilder as $builder) {

                    $builders[] = Builder::where("id", $builder)->get();
                }
            }
        }
        return view('panel.admin.search_history.index', compact('userHistorys', 'searchData', 'builders', 'username', 'searchQuery'));
    }
    public function housingSearch(Request $request)
    {
        // Get All data from user search history table
        $perPageRecord = $request->perPageRecord ? $request->perPageRecord : config('constants.PageLimit');
        $userHistorys = UserSearchHistory::orderBy('created_at', 'DESC');

        $searchData = [];
        $username = [];
        $searchQuery = [];
        if ($request['maxBudget']) $userHistorys = $userHistorys->where("maxBudget", "<=", $request['maxBudget']);
        // $type = $request['type'] ? $userHistorys->whereJsonContains("json->type", $request['type']) : null;
        // dd($request['down_payment']);
        if ($request['downPayment']) $userHistorys = $userHistorys->where("downPayment", "<=", $request['downPayment']);
        if ($request['monthInstall']) $userHistorys = $userHistorys->where("monthInstall", "<=", $request['monthInstall']);
        if ($request['yearlyInstall']) $userHistorys = $userHistorys->where("yearlyInstall", "<=", $request['yearlyInstall']);
        if ($request['halfYearlyInstall']) $userHistorys = $userHistorys->where("halfYearlyInstall", "<=", $request['halfYearlyInstall']);
        if ($request['quarterlyInstall']) $userHistorys = $userHistorys->where("quarterlyInstall", "<=", $request['quarterlyInstall']);
        if ($request['possession']) $userHistorys = $userHistorys->where("possession", "<=", $request['possession']);
        if ($request['projectType']) $userHistorys = $userHistorys->whereJsonContains("json->projectType", $request['projectType']);
        if ($request['duration']) {
            foreach ($request['duration'] as $duration) {
                $userHistorys = $userHistorys->orWhereJsonContains("json->duration", $duration);
            }
        }
        if ($request['slabCasting']) $userHistorys = $userHistorys->where("slabCasting", "<=", $request['slabCasting']);
        if ($request['plinth']) $userHistorys = $userHistorys->where("plinth", "<=", $request['plinth']);
        if ($request['colour']) $userHistorys = $userHistorys->where("colour", "<=", $request['colour']);
        if ($request['area']) {
            foreach ($request['area'] as $area) {
                $userHistorys = $userHistorys->orWhereJsonContains("json->area", $area)->where('search_type',  'calculator');
            }
        }
        // if($request['daterange']){
        //     $from = explode("-", $request['daterange'])[0];
        //     $to = explode("-", $request['daterange'])[1];
        //     $area = $request['daterange'] ? $userHistorys->whereBetween("created_at", [$from, $to]) : null;
        // }
        if ($request['from'] != "" && $request['to'] != "") {
            $userHistorys = $userHistorys->whereBetween("created_at", [$request['from'], $request['to']]);
        }

        $userHistorys = $userHistorys->where('search_type', 'calculator')->paginate($perPageRecord);

        $searchQuery['maxBudget'] = $request['maxBudget'] ? $request['maxBudget'] : null;
        $searchQuery['area'] = $request['area'] ? $request['area'] : null;
        $searchQuery['projectType'] = $request['projectType'] ? $request['projectType'] : null;
        $searchQuery['duration'] = $request['duration'] ? $request['duration'] : null;
        $searchQuery['downPayment'] = $request['downPayment'] ? $request['downPayment'] : null;
        $searchQuery['slabCasting'] = $request['slabCasting'] ? $request['slabCasting'] : null;
        $searchQuery['plinth'] = $request['plinth'] ? $request['plinth'] : null;
        $searchQuery['colour'] = $request['colour'] ? $request['colour'] : null;
        $searchQuery['quarterlyInstall'] = $request['quarterlyInstall'] ? $request['quarterlyInstall'] : null;
        $searchQuery['halfYearlyInstall'] = $request['halfYearlyInstall'] ? $request['halfYearlyInstall'] : null;
        $searchQuery['yearlyInstall'] = $request['yearlyInstall'] ? $request['yearlyInstall'] : null;
        $searchQuery['possession'] = $request['possession'] ? $request['possession'] : null;
        $searchQuery['monthInstall'] = $request['monthInstall'] ? $request['monthInstall'] : null;
        $searchQuery['dateRange'] = $request['dateRange'] ? $request['dateRange'] : null;
        $searchQuery['from'] = $request['from'] ?? "";
        $searchQuery['to'] = $request['to'] ?? "";


        // loop through data and store it in $searchData array
        // dd($userHistorys[1]['json']);
        foreach ($userHistorys as $userHistory) {
            $JsonToArr = json_decode($userHistory->json, true);
            $JsonToArr["created_at"] = $userHistory->created_at;
            // dd($userHistory->toArray()["created_at"]);
            $searchData[] = $JsonToArr;
            if ($userHistory->user_id != 0) {

                $username[] = $userHistory->user;
                // dd($userHistory->user);
                // $username[] = User::where('id', $userHistory->user_id)->first()->first_name . ' ' . User::where('id', $userHistory->user_id)->first()->last_name;
            } else {
                $username[] = 'Visitor';
            }
            // $searchData[] = json_decode($userHistory->json, true);
        }
        // dd($searchData);



        return view('panel.admin.search_history.housing_calc_search', compact('userHistorys', 'searchData', 'username', 'searchQuery'));
    }
    public function export(Request $request)
    {
        $searchQuery = $request['searchQuery'];
        $fileName = 'User-Search-History-' . date('Y-m-d-H-i-s') . '.xlsx';
        $fields = $request['fields'];
        return Excel::download(new UserSearchHistoryExport($fields, $searchQuery), $fileName);
    }

    public function export2(Request $request)
    {
        $searchQuery = $request['searchQuery'];
        $fileName = 'User-Calculator-Search-History-' . date('Y-m-d-H-i-s') . '.xlsx';
        $fields = $request['fields'];
        return Excel::download(new UserCalSearchHistoryExport($fields, $searchQuery), $fileName);
    }

    public function advance_search_index()
    {
        $userHistorys = UserSearchHistory::orderBy('created_at', 'DESC')->get();

        foreach ($userHistorys as $userHistory) {

            $searchData[] = unserialize($userHistory->json);
        }
        return view('panel.admin.search_history.advance_search_index', compact('userHistorys', 'searchData'));
    }
    public function filter_advance_search_index(Request $request)
    {
        $userHistorys = UserSearchHistory::orderBy('created_at', 'DESC')->get();

        foreach ($userHistorys as $userHistory) {

            $searchData[] = unserialize($userHistory->json);
        }
        return view('panel.admin.search_history.advance_search_index', compact('userHistorys', 'searchData'));
    }

    public function show(UserSearchHistory $userHistory)
    {

        // $userHistorys = UserSearchHistory::where("id" , $userHistory->id)->orderBy('created_at', 'DESC')->where('search_type', 'filter')->orWhere('search_type', NULL)->get();
        $userHistorys = UserSearchHistory::where("id", $userHistory->id)
            ->with("user")
            ->first()
            ->toArray();

        $userHistorys["params"] = json_decode($userHistorys["json"], true);

        if ($userHistorys["params"]["area"] != null) {
            if (count($userHistorys["params"]["area"]) > 0) {
                $SearchHistoryArea = Area::whereIn("id", $userHistorys["params"]["area"])->get()->toArray();
                $userHistorys["params"]["area"] = $SearchHistoryArea;
            }
        }
        if ($userHistorys["params"]["type"] != null) {
            if (count($userHistorys["params"]["type"]) > 0) {
                $SearchHistoryType = ProjectType::whereIn("id", $userHistorys["params"]["type"])->get()->toArray();
                $userHistorys["params"]["type"] = $SearchHistoryType;
            }
        }




        $searchData = [];
        $username = [];



        // loop through data and store it in $searchData array
        // foreach ($userHistorys as $userHistory) {
        //     if ($userHistory->user_id != 0) {

        //         $username[] = $userHistory->user;
        //         // dd($userHistory->user);
        //         // $username[] = User::where('id', $userHistory->user_id)->first()->first_name . ' ' . User::where('id', $userHistory->user_id)->first()->last_name;
        //     } else {
        //         $username[] = 'Visitor';
        //     }
        //     $searchData[] = unserialize($userHistory->json);
        // }
        //dd($userHistorys);

        $data["userHistory"] = $userHistorys;
        $data["searchData"] = $searchData;
        $data["username"] = $username;
        // return view('panel.admin.search_history.show', compact('userHistory', 'searchData', 'username'));
        return view('panel.admin.search_history.show', $data);
    }
}
