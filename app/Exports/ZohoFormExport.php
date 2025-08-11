<?php

namespace App\Exports;

use App\Models\Inquiry;
use App\Models\Project;
use App\Models\Unit;
use App\Models\ZohoForm;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use App\Models\Builder;
use App\Models\ProjectOwners;

class ZohoFormExport implements FromArray, WithHeadings, ShouldAutoSize, WithEvents
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
        // $data = Inquiry::orderBy('created_at', 'DESC');

        $inquiries = Inquiry::orderBy('created_at', 'DESC');

        if (Auth::user()->user_type_id == Config::get("constants.UserTypeIds.Builder")) {
            $Builder = Builder::where("user_id", Auth::user()->id)->first();
            $BuilderProjectIds = ProjectOwners::where("builder_id", $Builder->id)->pluck("project_id");

            $inquiries = $inquiries->whereIn("project_id", $BuilderProjectIds->toArray());
        }

        isset($queries['name']) && $inquiries =  $inquiries->where("name", "LIKE", $queries['name']);
        isset($queries['email']) && $inquiries =  $inquiries->where("email", "LIKE", $queries['email']);
        isset($queries['phone_number']) && $inquiries =  $inquiries->where("phone_number", "LIKE", $queries['phone_number']);
        isset($queries['address']) && $inquiries =  $inquiries->where("address", "LIKE", $queries['address']);
        if (isset($queries['project_id'])) {
            $project_ids = explode(",", $get_array['project_id'][0]);
            foreach ($project_ids as $project) {
                $inquiries =  $inquiries->where("project_id", "LIKE", $project);
            }
        }
        if (isset($queries['unit_id'])) {
            $unit_ids = explode(",", $get_array['unit_id'][0]);
            foreach ($unit_ids as $unit) {
                $inquiries =  $inquiries->where("unit_id", "LIKE", $unit);
            }
        }
        if (isset($queries['from']) && isset($queries['to'])) {
            if ($queries['from'] != "" && $queries['to'] != "") {
                $inquiries = $inquiries->whereBetween("created_at", [$queries['from'], $queries['to']]);
            }
        }

        $inquiries = $inquiries->get();

        $arr = [];
        foreach ($inquiries as $key => $datum) {
            $arr[$key]['created_at'] = $datum->created_at;
            $arr[$key]['name'] = $datum->name;
            $arr[$key]['email'] = $datum->email;
            $arr[$key]['phone_number'] = $datum->phone_number;
            $arr[$key]['address'] = $datum->address;
            $unit = Unit::where('id', $datum->unit_id)->first();
            $project = Project::where('id', $unit->project_id)->first();
            if (str_contains($this->selectFields, 'Unit Interested In')) $arr[$key]['project_id'] = $project->name;
            if (str_contains($this->selectFields, 'Project Interested In')) $arr[$key]['unit_id'] = $unit->title;
        }


        return [$arr];
    }

    public function headings(): array
    {
        $arr = ['Date/Time', 'Name', 'Email', 'Phone', 'Address'];
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
