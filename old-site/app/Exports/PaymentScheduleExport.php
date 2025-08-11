<?php

namespace App\Exports;

use App\Models\Unit;
use App\Models\User;
use App\Models\Project;
use App\Models\PaymentSchedule;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class PaymentScheduleExport implements FromArray, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
{
    $data = PaymentSchedule::all();
    // dd('test',$data);
    $arr = [];
    foreach ($data as $key => $datum) {
        // dd($datum);
        // $arr[$key]['id'] = $datum->id;
        $arr[$key]['created_at'] = $datum->created_at; 
        if($datum->user_id == 0){
            $arr[$key]['name'] = 'Visitor';
        }else{
            $user = User::where('id', $datum->user_id)->first();
            $arr[$key]['name'] = $user->first_name.' '.$user->last_name;
            // dd($arr[$key]['name']);
        }
        // $arr[$key]['Hash'] = $datum->hash;           
        $arr[$key]['duration'] = unserialize($datum->json)['duration'];
        $arr[$key]['down_payment'] = unserialize($datum->json)['down_payment'];
        $arr[$key]['monthly_installment'] = unserialize($datum->json)['monthly_installment'];
        $arr[$key]['quarterly_installment'] = unserialize($datum->json)['quarterly_installment'];
        $arr[$key]['half_yearly_installment'] = unserialize($datum->json)['half_yearly_installment'];
        $arr[$key]['yearly_installment'] = unserialize($datum->json)['yearly_installment'];
        $arr[$key]['possession'] = unserialize($datum->json)['possession'];
        $arr[$key]['loan_amount'] = unserialize($datum->json)['loan_amount'];

        

       

    }


    return [$arr];
}

public function headings(): array
{
    return [
        "Date/Time","Name","Duration", "Down Pyment", "Monthly Installment",
        "Quarterly Installment", "Half Yearly Installment", "Yearly Installment", "Possession", "Loan Amount"
    ];
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