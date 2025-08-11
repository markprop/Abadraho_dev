<?php

namespace App\Exports;

use App\Models\Unit;
use App\Models\User;
use App\Models\Project;
use App\Models\ZohoForm;
use App\Models\UserSearchHistory;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UserCalSearchHistoryExport implements FromArray, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */

    function __construct($obj, $query)
    {
        $this->selectFields = $obj;
        $this->searchQuery = $query;
    }

    public function array(): array
    {
        $searchQuery = base64_decode($this->searchQuery);
        parse_str($searchQuery, $get_array);
        $queries = $get_array;

        $data = UserSearchHistory::orderBy('created_at', 'DESC');


        if (isset($queries['maxBudget'])) $data = $data->where("maxBudget", "<=", $queries['maxBudget']);
        if (isset($queries['downPayment'])) $data = $data->where("downPayment", "<=", $queries['downPayment']);
        if (isset($queries['monthInstall'])) $data = $data->where("monthInstall", "<=", $queries['monthInstall']);
        if (isset($queries['yearlyInstall'])) $data = $data->where("yearlyInstall", "<=", $queries['yearlyInstall']);
        if (isset($queries['halfYearlyInstall'])) $data = $data->where("halfYearlyInstall", "<=", $queries['halfYearlyInstall']);
        if (isset($queries['quarterlyInstall'])) $data = $data->where("quarterlyInstall", "<=", $queries['quarterlyInstall']);
        if (isset($queries['possession'])) $data = $data->where("possession", "<=", $queries['possession']);
        if (isset($queries['projectType'])) $data = $data->whereJsonContains("json->projectType", $queries['projectType']);
        if (isset($queries['duration'])) {
            $durations = explode(",", $get_array['duration'][0]);
            foreach ($durations as $duration) {
                $data = $data->orWhereJsonContains("json->duration", $duration);
            }
        }
        if (isset($queries['slabCasting'])) $data = $data->where("slabCasting", "<=", $queries['slabCasting']);
        if (isset($queries['plinth'])) $data = $data->where("plinth", "<=", $queries['plinth']);
        if (isset($queries['colour'])) $data = $data->where("colour", "<=", $queries['colour']);
        if (isset($queries['area'])) {
            $areas = explode(",", $get_array['area'][0]);
            foreach ($areas as $area) {
                $data = $data->orWhereJsonContains("json->area", $area)->where('search_type',  'calculator');
            }
        }
        if (isset($queries['from']) && isset($queries['to'])) {
            if ($queries['from'] != "" && $queries['to'] != "") {
                $data = $data->whereBetween("created_at", [$queries['from'], $queries['to']]);
            }
        }

        $data = $data->where('search_type', 'calculator')->get();
        $arr = [];

        foreach ($data as $key => $datum) {
            // dd($datum);
            // $arr[$key]['id'] = $datum->id;
            $arr[$key]['created'] = $datum->created_at;
            if ($datum->user_id == 0) {
                $arr[$key]['name'] = 'Visitor';
                $arr[$key]['phone'] = '';
                $arr[$key]['email'] = '';
            } else {
                $user = User::where('id', $datum->user_id)->first();
                $arr[$key]['name'] = $user->first_name . ' ' . $user->last_name;
                $arr[$key]['phone'] = $user->phone_number;
                $arr[$key]['email'] = $user->email;
                // dd($arr[$key]['name']);
            }
            // $arr[$key]['Hash'] = $datum->hash;
            if (str_contains($this->selectFields, 'Area')) $arr[$key]['area'] = json_decode($datum->json, true)['area'];
            if (str_contains($this->selectFields, 'Budget')) $arr[$key]['maxBudget'] = json_decode($datum->json, true)['maxBudget'];
            if (str_contains($this->selectFields, 'Type')) $arr[$key]['projectType'] = json_decode($datum->json, true)['projectType'];
            if (str_contains($this->selectFields, 'Duration')) $arr[$key]['duration'] = json_decode($datum->json, true)['duration'];
            if (str_contains($this->selectFields, 'Down Payment')) $arr[$key]['downPayment'] = json_decode($datum->json, true)['downPayment'];
            if (str_contains($this->selectFields, 'Monthly Installment'))  $arr[$key]['monthInstall'] = json_decode($datum->json, true)['monthInstall'];
            if (str_contains($this->selectFields, 'Yearly Installment')) $arr[$key]['yearlyInstall'] = json_decode($datum->json, true)['yearlyInstall'];
            if (str_contains($this->selectFields, 'Half Yearly Installment')) $arr[$key]['halfYearlyInstall'] = json_decode($datum->json, true)['halfYearlyInstall'];
            if (str_contains($this->selectFields, 'Quarterly Installment')) $arr[$key]['quarterlyInstall'] = json_decode($datum->json, true)['quarterlyInstall'];
            if (str_contains($this->selectFields, 'Possession')) $arr[$key]['possession'] = json_decode($datum->json, true)['possession'];
            if (str_contains($this->selectFields, 'Slab')) $arr[$key]['slabCasting'] = json_decode($datum->json, true)['slabCasting'];
            if (str_contains($this->selectFields, 'Plinth')) $arr[$key]['plinth'] = json_decode($datum->json, true)['plinth'];
            if (str_contains($this->selectFields, 'Colour')) $arr[$key]['colour'] = json_decode($datum->json, true)['colour'];
        }


        return [$arr];
    }

    public function headings(): array
    {
        $arr = ['Date/Time', 'Name', 'Phone', 'Email'];
        $fieldsArray = explode(",", $this->selectFields);
        foreach ($fieldsArray as $fields) {
            array_push($arr, $fields);
        }
        return $arr;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A1:N1')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ]
                ]);
            },
        ];
    }
}
