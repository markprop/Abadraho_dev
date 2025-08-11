<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Exports\PaymentScheduleExport;
use App\Models\PaymentSchedule;
use App\Http\Controllers\Controller;
use Faker\Provider\ar_SA\Payment;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Search;
use Illuminate\Support\Facades\Config;
use App\Models\Builder;
use App\Models\ProjectOwners;

class PaymentScheduleController extends Controller
{

    public function __construct()
    {
        // return $this->middleware('auth:admin');
        $this->middleware('manage_user_types');
    }
    public function index(Request $request)
    {
        // if($request['down_payment'])dd($request['down_payment']);
        
        $searchQuery = [];
        
        $paymentSchedules = PaymentSchedule::orderBy("created_at", "DESC");

        if (Auth::user()->user_type_id == Config::get("constants.UserTypeIds.Builder")) {
            $Builder = Builder::where("user_id", Auth::user()->id)->first();
            $BuilderProjectIds = ProjectOwners::where("builder_id", $Builder->id)->pluck("project_id");
            $paymentSchedules = $paymentSchedules->whereIn("project_id", $BuilderProjectIds->toArray());
        }

        if ($request['project_id']) {
            foreach($request['project_id'] as $project){
                $paymentSchedules = $paymentSchedules->where('project_id', $project);
            }
        }
        if ($request['unit_id']){ 
            foreach($request['unit_id'] as $unit){
                $paymentSchedules = $paymentSchedules->where('unit_id', $unit);
            }
        }
        if ($request['duration']){ 
            foreach($request['duration'] as $duration){
                // dd($duration);
                $paymentSchedules = $paymentSchedules->whereJsonContains('json->duration', $duration);
            }
        }
        if ($request['down_payment']) $paymentSchedules = $paymentSchedules->where('down_payment', "<=", $request['down_payment']);
        if ($request['monthly_installment']) $paymentSchedules = $paymentSchedules->where('monthly_installment', "<=", $request['monthly_installment']);
        if ($request['quarterly_installment']) $paymentSchedules = $paymentSchedules->where('quarterly_installment', "<=", $request['quarterly_installment']);
        if ($request['half_yearly_installment']) $paymentSchedules = $paymentSchedules->where('half_yearly_installment', "<=", $request['half_yearly_installment']);
        if ($request['yearly_installment']) $paymentSchedules = $paymentSchedules->where('yearly_installment', "<=", $request['yearly_installment']);
        if ($request['possession']) $paymentSchedules = $paymentSchedules->where('possession', "<=", $request['possession']);
        if ($request['loan_amount']) $paymentSchedules = $paymentSchedules->where('loan_amount', "<=", $request['loan_amount']);
        if ($request['slab_casting']) $paymentSchedules = $paymentSchedules->where('slab_casting', "<=", $request['slab_casting']);
        if ($request['plinth']) $paymentSchedules = $paymentSchedules->where('plinth', "<=", $request['plinth']);
        if ($request['colour']) $paymentSchedules = $paymentSchedules->where('colour', "<=", $request['colour']);
        if ($request['start_of_work']) $paymentSchedules = $paymentSchedules->where('start_of_work', "<=", $request['start_of_work']);
        if ($request['from'] != "" && $request['to'] != "") {
            $paymentSchedules = $paymentSchedules->whereBetween("created_at", [$request['from'], $request['to']]);
        }

        $searchQuery['project_id'] = $request['project_id'] ? $request['project_id'] : null;
        $searchQuery['unit_id'] = $request['unit_id'] ? $request['unit_id'] : null;
        $searchQuery['down_payment'] = $request['down_payment'] ? $request['down_payment'] : null;
        $searchQuery['monthly_installment'] = $request['monthly_installment'] ? $request['monthly_installment'] : null;
        $searchQuery['quarterly_installment'] = $request['quarterly_installment'] ? $request['quarterly_installment'] : null;
        $searchQuery['half_yearly_installment'] = $request['half_yearly_installment'] ? $request['half_yearly_installment'] : null;
        $searchQuery['yearly_installment'] = $request['yearly_installment'] ? $request['yearly_installment'] : null;
        $searchQuery['possession'] = $request['possession'] ? $request['possession'] : null;
        $searchQuery['loan_amount'] = $request['loan_amount'] ? $request['loan_amount'] : null;
        $searchQuery['slab_casting'] = $request['slab_casting'] ? $request['slab_casting'] : null;
        $searchQuery['plinth'] = $request['plinth'] ? $request['plinth'] : null;
        $searchQuery['colour'] = $request['colour'] ? $request['colour'] : null;
        $searchQuery['start_of_work'] = $request['start_of_work'] ? $request['start_of_work'] : null;
        $searchQuery['duration'] = $request['duration'] ? $request['duration'] : null;
        $searchQuery['from'] = $request['from'] ?? "";
        $searchQuery['to'] = $request['to'] ?? "";

        $paymentSchedules = $paymentSchedules->get();

        $paymentData = [];
        
        // foreach ($paymentSchedules as $paymentSchedule) {
        for ($i = 0; $i < count($paymentSchedules); $i++) {
            $arr = unserialize($paymentSchedules[$i]->json);
            $arr["created_at"] = $paymentSchedules->toArray()[$i]["created_at"];
            // dd($arr);
            array_push($paymentData , $arr);
            // $paymentData = unserialize($paymentSchedules[$i]->json);
        }
        // foreach ($paymentSchedules as $paymentSchedule) {
        //     // echo "<pre>";
        //     // return (($paymentSchedule->json));
        //     $paymentData[] = unserialize($paymentSchedule->json);
        //     dd($loop->index);
        //     // $paymentData[]["created_at"] = $paymentSchedule->created_at;

        // }

        // dd($paymentData);
        // dd(Auth::user());

        return view('panel.admin.payment_schedule.index', compact('paymentSchedules', 'paymentData', 'searchQuery'));
    }

    public function export()
    {
        $fileName = 'PaymentSchedule-' . date('Y-m-d-H-i-s') . '.xlsx';
        return Excel::download(new PaymentScheduleExport, $fileName);
    }

    public function show(PaymentSchedule $paymentSchedule)

    {
        $paymentSchedules = PaymentSchedule::where("id", $paymentSchedule->id)->first();
        $paymentData[] = unserialize($paymentSchedule->json);


        // dd(Auth::user());

        return view('panel.admin.payment_schedule.show', compact('paymentSchedule', 'paymentData'));
    }
}
?>
