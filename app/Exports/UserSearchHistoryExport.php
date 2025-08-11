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

class UserSearchHistoryExport implements FromArray, WithHeadings, ShouldAutoSize, WithEvents
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

        if (isset($queries['progress'])) {
            $searchProgress = explode(",", $get_array['progress'][0]);
            dd($searchProgress);
            foreach ($searchProgress as $progress) {
                $data = $data->orWhereJsonContains("json->progress", $progress)->where('search_type',  'filter');
            }
        }
        if (isset($queries['area'])) {
            $areas = explode(",", $get_array['area'][0]);
            // dd($areas);
            foreach ($areas as $area) {
                $data =  $data->orWhereJsonContains("json->area", $area)->where('search_type',  'filter');
            }
        }
        if (isset($queries['builder'])) {
            $builders = explode(",", $get_array['builder'][0]);
            foreach ($builders as $builder) {
                $data = $data->orWhereJsonContains("json->builder", $builder)->where('search_type',  'filter');
            }
        }
        if (isset($queries['type'])) {
            $types = explode(",", $get_array['type'][0]);
            foreach ($types as $type) {
                $data = $data->orWhereJsonContains("json->type", $type)->where('search_type',  'filter');
            }
        }
        if (isset($queries['minDownPayment'])) {
            $data = $data->where('minDP', ">=", $queries['minDownPayment']);
        }
        if (isset($queries['maxDownPayment'])) {
            $data = $data->where('maxDP', "<=", $queries['maxDownPayment']);
        }
        if (isset($queries['minMonthlyInstall'])) {
            $data = $data->where('minMI', ">=", $queries['minMonthlyInstall']);
        }
        // dd($data);
        if (isset($queries['maxMonthlyInstall'])) {
            $data = $data->where('maxMI', "<=", $queries['maxMonthlyInstall']);
        }
        if (isset($queries['minPrice'])) {
            $data = $data->where('minPrice', ">=", $queries['minPrice']);
        }
        if ($queries['maxPrice']) {
            $data = $data->where('maxPrice', "<=", $queries['maxPrice']);
        }
        if (isset($queries['from']) && isset($queries['to'])) {
            if (($queries['from']) != "" && $queries['to'] != "") {
                $data = $data->whereBetween("created_at", [$queries['from'], $queries['to']]);
            }
        }
        $data = $data->where('search_type', 'filter')->get();

        $arr = [];
        foreach ($data as $key => $datum) {
            $arr[$key]['created'] = $datum->created_at;
            // dd($datum);
            // $arr[$key]['id'] = $datum->id;
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
            //$arr[$key]['Hash'] = $datum->hash;
            if (str_contains($this->selectFields, 'Area')) $arr[$key]['area'] = json_decode($datum->json, true)['area'];
            if (str_contains($this->selectFields, 'Progress')) $arr[$key]['progress'] = json_decode($datum->json, true)['progress'];
            if (str_contains($this->selectFields, 'Type')) $arr[$key]['type'] = json_decode($datum->json, true)['type'];
            if (str_contains($this->selectFields, 'Minimum Down Payment')) $arr[$key]['minDP'] = json_decode($datum->json, true)['minDP'];
            if (str_contains($this->selectFields, 'Maxmimum Down Payment')) $arr[$key]['maxDP'] = json_decode($datum->json, true)['maxDP'];
            if (str_contains($this->selectFields, 'Minimum Monthly Installment')) $arr[$key]['minMI'] = json_decode($datum->json, true)['minMI'];
            if (str_contains($this->selectFields, 'Maximum Monthly Installment')) $arr[$key]['maxMI'] = json_decode($datum->json, true)['maxMI'];
            if (str_contains($this->selectFields, 'Minimum Price')) $arr[$key]['minPrice'] = json_decode($datum->json, true)['minPrice'];
            if (str_contains($this->selectFields, 'Maximum Price')) $arr[$key]['maxPrice'] = json_decode($datum->json, true)['maxPrice'];
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
