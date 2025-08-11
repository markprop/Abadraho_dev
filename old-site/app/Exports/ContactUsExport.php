<?php

namespace App\Exports;

use App\Models\ContactUS;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ContactUsExport implements FromArray, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return ContactUS::all();
    // }

    public function array(): array
    {
        $data = ContactUS::all();

        $arr = [];
        foreach ($data as $key => $datum) {
           // $arr[$key]['id'] = $datum->id;
           $arr[$key]['created_at'] = $datum->created_at;
            $arr[$key]['name'] = $datum->name;
            $arr[$key]['email'] = $datum->email;
            $arr[$key]['phone'] = $datum->phone;
            $arr[$key]['subject'] = $datum->subject;
            $arr[$key]['message'] = $datum->message;
            
            // $unit = Unit::where('id', $datum->unit_id)->first();
            // $project = Project::where('id', $unit->project_id)->first();
            //$arr[$key]['unit_id'] = $unit->title;
            //$arr[$key]['project_id'] = $project->name;
            //$arr[$key]['created_at'] = $datum->created_at;
            //$arr[$key]['updated_at'] = $datum->updated_at;
            // if(str_contains($this->selectFields, 'Unit Interested In')) $arr[$key]['project_id'] = $project->name;
            // if(str_contains($this->selectFields, 'Project Interested In')) $arr[$key]['unit_id'] = $unit->title;
           
        }


        return [$arr];
    }

    public function headings(): array
    {
        $arr = ['Date/Time','Name', 'Email', 'Phone', 'Subject', 'Message'];
        // $fieldsArray = explode(",",$this->selectFields);
        // foreach($fieldsArray as $fields){
        //     array_push($arr, $fields);
        // }
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
