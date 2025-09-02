<?php



namespace App\Http\Controllers\FrontEnd;



use App\Helpers\AppHelper;

use Carbon\Carbon;

use App\Models\Tag;

use App\Models\Area;

use App\Models\Unit;

use App\Models\Project;
use App\Models\ProjectOwners;

use App\Models\Voucher;

use Carbon\Traits\Units;

use App\Models\ProjectType;

use App\Models\RecentViews;

use Illuminate\Http\Request;

use Illuminate\Http\Response;

use GuzzleHttp\Promise\Create;

use App\Models\InstallmentType;

use App\Models\PaymentSchedule;

use App\Models\UserSearchHistory;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Session\Session;

use App\Http\Controllers\API\BaseController;

use App\Models\Builder;

use App\Models\Progress;

use App\Models\Review;

use App\Models\User;

use App\Models\UserVoucher;

use BeyondCode\Vouchers\Facades\Vouchers;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Mail;

use Spatie\Activitylog\Models\Activity;

use PDF;

use Illuminate\Support\Str;



class ProjectController extends BaseController

{

    public $ProjectModel;



    public function __construct()

    {

        $this->ProjectModel = Project::query();

    }



    public function index()
    {
        $areas = Area::all();
        $progress = Progress::all();
        $projectTypes = ProjectType::all();
        $tags = Tag::all();
        $builders = Builder::select('id', 'full_name')->get();
        $featured_properties = $this->ProjectModel->orderBy('id', 'desc')->where('status', 1)->take(5)->get();
        $allProjects = Project::withoutGlobalScope('delete')->orderBy('name')->get(); // Define $allProjects here
        $projectDetails = [];
    
        foreach ($featured_properties as $Pkey => $project) {
            foreach ($project->project_unit_rooms->unique('id') as $Rkey => $roomType) {
                foreach ($project->units as $Ukey => $unit) {
                    $projectDetails[$Pkey][$Rkey][$Ukey] = count($unit->room->where('id', $roomType->id));
                }
            }
        }
        return view('home', compact('progress', 'builders', 'areas', 'projectTypes', 'featured_properties', 'tags', 'projectDetails', 'allProjects'));
    }

    public function detail(Request $request, $slug)
    {
        $auth_id = Auth::id();

        $project = $this->ProjectModel->with('units', 'owners', 'location', 'project_info')->where('slug', $slug)->first();
        $project_id = $project->id;

        $project_owners = ProjectOwners::where('project_id',$project_id)->first();
        
        $builderDetail = Builder::where('id', $project_owners->builder_id)->first();
        
        $voucher_available = Voucher::with('project', 'units_voucher.unit', 'user_voucher')
            ->where('project_id', $project->id)
            ->where('expires_at', '>', date('Y-m-d H:i:s'))
            ->whereDoesntHave('user_voucher', function ($query) use ($auth_id)  {
                $query->where('user_id', $auth_id);
            })
            ->get();

        $view_key = 'project_'.$project->id;
        if(!request()->session()->has($view_key))
        {
            Project::find($project->id)->increment('views');
            request()->session()->put($view_key, 1);
        }
        $ratings = Review::where('project_id', $project->id)->get();
        $rating_sum = Review::where('project_id', $project->id)->sum('rating');

        if($ratings->count() > 0) {
            $rating_value = $rating_sum/$ratings->count();
        } else {
            $rating_value = 0;
        }

        if ($project->added_time) {
            $added_ago = Carbon::parse($project->added_time);
            $project->added_time = $added_ago->diffForHumans();
        } else {
            $added_ago = Carbon::parse($project->created_at);
            $project->added_time = $added_ago->diffForHumans();
        }

        $project->min_price = $this->convertCurrency((int)$project->min_price);
        $recent_view_data = RecentViews::with('project')->whereDate('created_at', Carbon::today());
        $recent_view_data = $recent_view_data->where('project_id', '!=',  $project->id);
        $recent_view_data = [];

        // if(Auth::id())

        // {

        //     $recent_view_data = $recent_view_data->where('user_id', Auth::id())->get();

        //     $check_recent = $check_recent->where('user_id', Auth::id())->get();

            

        //     if (count($check_recent) == 0) {

        //         $recent_view = RecentViews::create([

        //             'user_id' => Auth::id(),

        //             'project_id' => $project->id

        //         ]);

        //         $recent_view->save();

        //     }

        // }


        $check_recent = RecentViews::whereDate('created_at', Carbon::today());
        $check_recent = $check_recent->where('project_id', '=',  $project->id);
        $total_months = $project->installment_length;
        $years = number_format(floor($total_months / 12));
        $months = number_format($total_months % 12);
        if ($months != 0) {
            $length = $years . ' Years ' . $months . ' Months';
        } else {
            $length = $years . ' Years';
        }
        $project->installment_length = $length;

        /* Get Similar Projects */
        $unit_type = array();
        foreach ($project->units as $key => $unit) {
            if ($unit->unit_type_id) {
                $type = ProjectType::where('id', $unit->unit_type_id)->first();
                if($type)
                {
                    $unit_type[$key]['id'] = $type->id;
                    $unit_type[$key]['title'] = $type->title;    
                }            
            }
        }
        $similar = $this->ProjectModel->with('units')->where('id', '!=', $project->id);
        $similar = $similar
            ->whereHas('units', function ($query) use ($unit_type) {
                $query->whereIn('unit_type_id', $unit_type);
            })
            ->orWhere('area', $project->area)
            ->orWhere('rooms', 'like', '%' . 'rooms' . '%');

        $installment_length = InstallmentType::all();
        return view('project.detail', compact('ratings', 'rating_value', 'project', 'similar', 'unit_type', 'installment_length', 'recent_view_data', 'total_months', 'voucher_available', 'auth_id', 'builderDetail'));
    }

    public function generate_voucher(Request $request)

    {



        $validated = $request->validate(

            ['voucher_id' => 'required',],

            ['voucher_id.required' => 'Invalid argument try again.']

        );



        do {

            $code = strtoupper(Str::random(3) . '-' . Str::random(3));

        } while (UserVoucher::where('code', $code)->exists());



        $voucher_id = $request->voucher_id;

        $voucher_data = explode(",", $voucher_id);

        $voucher_id = $voucher_data[0];

        $unit = $voucher_data[1];        

        $user = User::where('id', Auth::id())->first();

        $voucher = Voucher::with('project', 'units_voucher.unit')->where('id', $voucher_id)->first();



        $user_voucher = UserVoucher::create([

            'code'        =>   $code,

            'user_id'     =>   $user->id,

            'voucher_id'  =>   $voucher_id

        ]);

        

        $pdf = PDF::loadView('panel.admin.vouchers.coupon', compact('voucher', 'user', 'code', 'unit'));

        return $pdf->download('Coupon.pdf');



        // return $pdf->download('Coupon.pdf');

        // return view('panel.admin.vouchers.coupon', compact('voucher'));

        

        // $isDownload = $request['download'];

        // dd($isDownload);



        // $user = User::where('id', Auth::id())->first();

        // $project = Project::where('id', $id)->first();

        // dd($project);

       

        // $voucher = $project->createVoucher([

        //     'user_full_name' => $user->first_name . " " . $user->last_name,

        //     'user_email' => $user->email,

        //     'user_phone' => $user->phone_number,

        //     'project_name' => $project->name,

        //     'project_cover_img' => $project->project_cover_img,

        //     'project_discount' => $project->discount_price,

            

        // ], today()->addDays(7));

        // $code         = $voucher->code;

        // $user_full_name     = $voucher->data->get('user_full_name');

        // $user_email     = $voucher->data->get('user_email');

        // $user_phone     = $voucher->data->get('user_phone');

        // $project_name = $voucher->data->get('project_name');

        // $project_image = $voucher->data->get('project_cover_img');

        // $project_discount = $voucher->data->get('project_discount');

        // $expiry = $voucher->expires_at;

       



        // view()->share('voucher_code',$code);

        // view()->share('user_name',$user_full_name);

        // view()->share('user_email',$user_email);

        // view()->share('user_phone',$user_phone);

        // view()->share('project_name',$project_name);

        // view()->share('project_discount',$project_discount);

        // view()->share('project_image', $project_image);

        // view()->share('project_expiry',$expiry);

        // view()->share('isDownload',$isDownload);

        // view()->share('project_id',$id);



        // if(!$isDownload) {

        //     return view('panel.admin.vouchers.coupon');

        // } else {

        //     $UserVoucher = UserVoucher::create([

        //         'user_id'     => Auth::id(),

        //         'voucher_id'  => $id,

        //         'redeemed_at' => date('Y-m-d H:i:s'),

        //     ]);



        //     $pdf = PDF::loadView('panel.admin.vouchers.coupon');

        //     return $pdf->download('Coupon.pdf');

        // }



        // $pdf = PDF::loadView('panel.admin.vouchers.coupon');

        // return $pdf->stream('Coupon.pdf');

        

    }



    public static function convertCurrency($number)

    {

        $number = (int) $number;

        // Convert Price to Crores or Lakhs or Thousands

        $length = strlen($number);

        $currency = 'Rs. ';

        if ($length == 3) {

            // Thousand

            $number = $number / 1000;

            $number = round($number, 2);

            $ext = "Thousand";

            $currency = $number . " " . $ext;

        } elseif ($length == 4 || $length == 5) {

            // Thousand

            $number = $number / 1000;

            $number = round($number, 2);

            $ext = "Thousand";

            $currency = $number . " " . $ext;

        } elseif ($length == 6 || $length == 7) {

            // Lakhs

            $number = $number / 100000;

            $number = round($number, 2);

            $ext = "Lacs";

            $currency = $number . " " . $ext;

        } elseif ($length == 8 || $length == 9) {

            // Crores

            $number = $number / 10000000;

            $number = round($number, 2);

            $ext = "Cr";

            $currency = $number . ' ' . $ext;

        }

        return $currency;

    }



    public function getUnit(Request $request)

    {

        $data = Unit::where('id', $request->id)->first();

        if ($data) {

            return $this->sendResponse($data, 'Successfully.');

        } else {

            return $this->sendResponse($data, 'No Data Found');

        }

    }



    public function filter(Request $request)
    {
        $perPageRecord = 10;
        if (!Auth::guest()) {
            $user_id = Auth::id();
            UserSearchHistory::where("cookie", $request->cookie("XSRF-TOKEN"))->where("user_id", 0)->update(["user_id" => $user_id]);
        } else {
            $user_id = 0;
        }
    
        $area = $request->area;
        $progress = $request->progress ? $request->progress : [];
        $type_id = $request->type_id;
        $builder = $request->builder;
        $blderIDs = $request->builder ? $request->builder : [];
        $minDP = preg_match("/^[0-9,]+$/", $request->minDP) ? str_replace(",", "", $request->minDP) : $request->minDP;
        $maxDP = preg_match("/^[0-9,]+$/", $request->maxDP) ? str_replace(",", "", $request->maxDP) : $request->maxDP;
        $minMI = preg_match("/^[0-9,]+$/", $request->minMI) ? str_replace(",", "", $request->minMI) : $request->minMI;
        $maxMI = preg_match("/^[0-9,]+$/", $request->maxMI) ? str_replace(",", "", $request->maxMI) : $request->maxMI;
        $minPrice = preg_match("/^[0-9,]+$/", $request->minPrice) ? str_replace(",", "", $request->minPrice) : $request->minPrice;
        $maxPrice = preg_match("/^[0-9,]+$/", $request->maxPrice) ? str_replace(",", "", $request->maxPrice) : $request->maxPrice;
        $maxBudget = $request->maxBudget;
        $tag_id = $request->tag_id;
        $downPayment = $request->downPayment ? $request->downPayment : '0';
        $page = $request->page ? $request->page : '1';
        $reseller_id = $request->reseller_id;
        $project_name = $request->project_name; // Capture project_name from request
    
        // Save User Search History
        if (count($request->request) > 1) {
            if (!$maxBudget) {
                UserSearchHistory::create([
                    'user_id' => $user_id,
                    'hash' => 'HDfv6',
                    'search_type' => 'filter',
                    'minDP' => $minDP,
                    'maxDP' => $maxDP,
                    'minMI' => $minMI,
                    'maxMI' => $maxMI,
                    'minPrice' => $minPrice,
                    'maxPrice' => $maxPrice,
                    "cookie" => $request->cookie("XSRF-TOKEN"),
                    'json' => json_encode([
                        'area' => $request->area,
                        'progress' => $request->progress,
                        'type' => $request->type_id,
                        'builder' => $request->builder,
                        'minDP' => $minDP ?? 0,
                        'maxDP' => $maxDP ?? 0,
                        'minMI' => $minMI ?? 0,
                        'maxMI' => $maxMI ?? 0,
                        'minPrice' => $minPrice ?? 0,
                        'maxPrice' => $maxPrice ?? 0,
                        'maxBudget' => $maxBudget,
                        'tag' => $request->tag_id,
                        'project_name' => $request->project_name, // Add to search history
                    ])
                ]);
            } else {
                UserSearchHistory::create([
                    'user_id' => $user_id,
                    'hash' => 'HDfv6',
                    'search_type' => 'calculator',
                    'downPayment' => $request->downPayment,
                    'maxBudget' => $request->maxBudget,
                    'slabCasting' => $request->slabCasting,
                    'plinth' => $request->plinth,
                    'colour' => $request->colour,
                    'monthInstall' => $request->monthInstall,
                    'yearlyInstall' => $request->yearlyInstall,
                    'halfYearlyInstall' => $request->halfYearlyInstall,
                    'quarterlyInstall' => $request->quarterlyInstall,
                    'possession' => $request->possession,
                    "cookie" => $request->cookie("XSRF-TOKEN"),
                    'json' => json_encode([
                        'area' => $request->area,
                        'type' => $request->type,
                        'maxBudget' => $request->maxBudget,
                        'downPayment' => $request->downPayment,
                        'monthInstall' => $request->monthInstall,
                        'yearlyInstall' => $request->yearlyInstall,
                        'halfYearlyInstall' => $request->halfYearlyInstall,
                        'quarterlyInstall' => $request->quarterlyInstall,
                        'possession' => $request->possession,
                        'projectType' => $request->projectType,
                        'duration' => $request->duration,
                        'slabCasting' => $request->slabCasting,
                        'plinth' => $request->plinth,
                        'colour' => $request->colour
                    ], false),
                ]);
            }
        }
    
        // For Prefilled values on listings page
        $searchData['area'] = $area;
        $searchData['progress'] = $progress;
        $searchData['type_id'] = $type_id;
        $searchData['builder'] = $builder;
        $searchData['minDP'] = $minDP;
        $searchData['maxDP'] = $maxDP;
        $searchData['minMI'] = $minMI;
        $searchData['maxMI'] = $maxMI;
        $searchData['minPrice'] = $minPrice;
        $searchData['maxPrice'] = $maxPrice;
        $searchData['maxBudget'] = $maxBudget;
        $searchData['tag_id'] = $tag_id;
        $searchData['page'] = $page;
        $searchData['downPayment'] = $downPayment;
        $searchData['reseller_id'] = $reseller_id;
        $searchData['project_name'] = $project_name; // Add to searchData
        $searchData['monthInstall'] = $request->monthInstall ? $request->monthInstall : "";
        $searchData['yearlyInstall'] = $request->yearlyInstall ? $request->yearlyInstall : "";
        $searchData['halfYearlyInstall'] = $request->halfYearlyInstall ? $request->halfYearlyInstall : "";
        $searchData['quarterlyInstall'] = $request->quarterlyInstall ? $request->quarterlyInstall : "";
        $searchData['possession'] = $request->possession ? $request->possession : "";
        $searchData['calcSearch'] = $request->calcSearch ? $request->calcSearch : false;
    
        // Define $allProjects here to match the index() method
        $allProjects = Project::withoutGlobalScope('delete')->orderBy('name')->get();
    
        // Filter Start
        $projects = $this->ProjectModel
            ->with('units')
            ->with('owners')
            ->with('location')
            ->with('areas')
            ->with('tags');
    
        $projects = $projects->where("status", 1);
    
        // Filter by project name
        if ($project_name) {
            $projects = $projects->whereIn('id', $project_name);
        }
    
        // Filter by builder name
        if ($builder) {
            $projects = $projects->whereHas('owners', function ($query) use ($builder) {
                $query->whereIn('builder_id', $builder);
            });
        }
    
        // Filter By Areas
        if ($area) {
            $projects = $projects->whereHas('areas', function ($query) use ($area) {
                $query->whereIn('area_id', $area);
            });
        }
    
        // Filter by Progress
        if ($progress) {
            $projects = $projects->whereIn('progress', $progress);
        }
    
        // Filter by Project Type
        if ($type_id) {
            $projects = $projects->whereHas('units', function ($query) use ($type_id) {
                $query->whereIn('unit_type_id', $type_id);
            });
        }
    
        // Filter by Down Payment
        if ($minDP || $maxDP) {
            $minDP = $minDP ?? 0;
            $maxDP = $maxDP ?? Unit::max('down_payment');
    
            $projects = $projects->whereHas('units', function ($query) use ($minDP, $maxDP) {
                $query->whereBetween('down_payment', [$minDP, $maxDP]);
            });
        }
    
        // Filter by Monthly Installment
        if ($minMI || $maxMI) {
            $minMI = $minMI ?? 0;
            $maxMI = $maxMI ?? Unit::max('monthly_installment');
    
            $projects = $projects->whereHas('units', function ($query) use ($minMI, $maxMI) {
                $query->whereBetween('monthly_installment', [$minMI, $maxMI]);
            });
        }
    
        // Filter by Price
        if ($minPrice || $maxPrice) {
            $minPrice = $minPrice ?? 0;
            $maxPrice = $maxPrice ?? Unit::max('price');
            $projects = $projects->whereHas('units', function ($query) use ($minPrice, $maxPrice) {
                $query->whereBetween('total_unit_amount', [$minPrice, $maxPrice]);
            });
        }
    
        // Filter by Budget
        if ($minPrice || $maxBudget) {
            $minPrice = $minPrice ?? 0;
            $maxBudget = $maxBudget ?? Unit::max('price');
            $projects = $projects->whereHas('units', function ($query) use ($minPrice, $maxBudget) {
                $query->whereBetween('total_unit_amount', [$minPrice, $maxBudget]);
            });
        }
    
        if ($tag_id) {
            $projects = $projects->whereHas('tags', function ($query) use ($tag_id) {
                $query->whereIn('tag_id', $tag_id);
            });
        }
    
        $popular_projects = Activity::where('conversion', 'View Page')->pluck('conversion');
    
        if (!empty($request->reseller_id) && $request->reseller_id == "Latest") {
            $projects = $this->ProjectModel->orderBy('created_at', 'desc')->where("status", 1);
        } elseif (!empty($request->reseller_id) && $request->reseller_id == "popularity") {
            $projects = $this->ProjectModel->orderBy('views', 'desc')->where("status", 1);
        } elseif (!empty($request->reseller_id) && $request->reseller_id == "Oldest") {
            $projects = $this->ProjectModel->orderBy('created_at', 'asc')->where("status", 1);
        } elseif (!empty($request->reseller_id) && $request->reseller_id == "Highest_by_price") {
            $projects = $this->ProjectModel->orderBy('min_price', 'desc')->where("status", 1);
        } elseif (!empty($request->reseller_id) && $request->reseller_id == "Lowest_by_price") {
            $projects = $this->ProjectModel->orderBy('min_price', 'asc')->where("status", 1);
        } elseif (!empty($request->reseller_id) && $request->reseller_id == "Sort_by_progress") {
            $projects = $this->ProjectModel->orderBy('progress', 'asc')->where("status", 1);
        } elseif (!empty($request->reseller_id) && $request->reseller_id == "Sort_by_area") {
            $projects = $this->ProjectModel->orderBy('area', 'asc')->where("status", 1);
        }
    
        $projects = $projects->paginate($perPageRecord);
        $active_project = $this->ProjectModel->where('status', '=', 1)->count();
    
        $areas = Area::all();
        $progress = Progress::all();
        $tags = Tag::all();
        $builders = Builder::select('id', 'full_name')->get();
        $projectTypes = ProjectType::all();
        $recent_view_data = RecentViews::with('project')->whereDate('created_at', Carbon::today());
        $recent_view_data = $recent_view_data->where('user_id', Auth::id())->get();
    
        $projectDetails = [];
    
        if (!$request->calculatorResult) {
            if ($searchData['calcSearch']) {
                if (count($projects) < 1) {
                    $projects = $this->ProjectModel->with('progress', 'units', 'owners', 'location', 'areas', 'tags', 'project_unit_rooms')->where('status', 1);
                    $projects = $projects->paginate(10);
    
                    $areas = Area::all();
                    $progress = Progress::all();
                    $tags = Tag::all();
                    $builders = Builder::select('id', 'full_name')->get();
                    $projectTypes = ProjectType::all();
    
                    $recent_view_data = RecentViews::with('project')->whereDate('created_at', Carbon::today());
                    $recent_view_data = $recent_view_data->where('user_id', Auth::id())->get();
    
                    $projectDetails = [];
                }
            }
    
            return view('projects.index', compact('active_project', 'builders', 'page', 'blderIDs', 'minDP', 'downPayment', 'projects', 'progress', 'searchData', 'areas', 'projectTypes', 'recent_view_data', 'tags', 'projectDetails', 'allProjects'));
        } else {
            if (count($projects) < 1) {
                $projects = $this->ProjectModel->with('progress', 'units', 'owners', 'location', 'areas', 'tags', 'project_unit_rooms')->where('status', 1);
                $projects = $projects->paginate($perPageRecord);
    
                $areas = Area::all();
                $progress = Progress::all();
                $tags = Tag::all();
                $builders = Builder::select('id', 'full_name')->get();
                $projectTypes = ProjectType::all();
    
                $recent_view_data = RecentViews::with('project')->whereDate('created_at', Carbon::today());
                $recent_view_data = $recent_view_data->where('user_id', Auth::id())->get();
    
                $projectDetails = [];
            }
    
            return view('project.searchprojects', compact('active_project', 'builders', 'page', 'blderIDs', 'minDP', 'downPayment', 'projects', 'progress', 'searchData', 'areas', 'projectTypes', 'recent_view_data', 'tags', 'projectDetails', 'allProjects'));
        }
    }



    public function payment_schedule(Request $request)

    {

        // validation

        request()->validate([

            'unit_id' => 'required',

        ]);

        // dd($request);

        if ($request->possession) {

            $possession = str_replace(",", "", $request->possession);

            $possession = (int)$possession;

        }

        if ($request->loan_amount) {

            $loan_amount = str_replace(",", "", $request->loan_amount);

            $loan_amount = (int)$loan_amount;

        }

        if ($request->down_payment) {

            $down_payment = str_replace(",", "", $request->down_payment);

            $down_payment = (int)$down_payment;

        }

        if ($request->monthly_installment) {

            $monthly_installment = str_replace(",", "", $request->monthly_installment);

            $monthly_installment = (int)$monthly_installment;

        }

        if ($request->quarterly_installment) {

            $quarterly_installment = str_replace(",", "", $request->quarterly_installment);

            $quarterly_installment = (int)$quarterly_installment;

        }

        if ($request->half_yearly_installment) {

            $half_yearly_installment = str_replace(",", "", $request->half_yearly_installment);

            $half_yearly_installment = (int)$half_yearly_installment;

        }

        if ($request->yearly_installment) {

            $yearly_installment = str_replace(",", "", $request->yearly_installment);

            $yearly_installment = (int)$yearly_installment;

        }

        if ($request->start_of_work) {

            $start_of_work = str_replace(",", "", $request->start_of_work);

            $start_of_work = (int)$start_of_work;

        }

        if ($request->slab_casting) {

            $slab_casting = str_replace(",", "", $request->slab_casting);

            $slab_casting = (int)$slab_casting;

        }

        if ($request->plinth) {

            $plinth = str_replace(",", "", $request->plinth);

            $plinth = (int)$plinth;

        }

        if ($request->colour) {

            $colour = str_replace(",", "", $request->colour);

            $colour = (int)$colour;

        }



        // dd($request->construction_fields_added, $request->construction_added_field);

        // Save User Payment Schedule

        $data = PaymentSchedule::create([

            'user_id' => Auth::id(),

            'project_id' => $request->project_id ?? null,

            'unit_id' => $request->unit_id ?? null,

            'down_payment' => $down_payment ?? null,

            'monthly_installment' => $monthly_installment ?? null,

            'quarterly_installment' => $quarterly_installment ?? null,

            'half_yearly_installment' => $half_yearly_installment ?? null,

            'yearly_installment' => $yearly_installment ?? null,

            'possession' => $possession ?? null,

            'loan_amount' => $loan_amount ?? null,

            'start_of_work' => $start_of_work ?? null,

            'slab_casting' => $slab_casting ?? null,

            'plinth' => $plinth ?? null,

            'colour' => $colour ?? null,

            'json' => serialize([

                'duration' => $request->duration,

                'down_payment' => $down_payment ?? null,

                'booking' => $request->booking ?? null,

                'allocation' => $request->allocation ?? null,

                'confirmation' => $request->confirmation ?? null,

                'start_of_work' => $start_of_work ?? null,

                'slab_casting' => $slab_casting ?? null,

                'plinth' => $plinth ?? null,

                'colour' => $colour ?? null,

                'construction_added_field' => $request->construction_added_field ?? null,

                'monthly_installment' => $monthly_installment ?? null,

                'quarterly_installment' => $quarterly_installment ?? null,

                'half_yearly_installment' => $half_yearly_installment ?? null,

                'yearly_installment' => $yearly_installment ?? null,

                'possession' => $possession ?? null,

                'loan_amount' => $loan_amount ?? null,

            ])

        ]);



        return $data;

    }



    public function GetUnitMinimumPrice($arrUnits = [])

    {

        $a[] = array('name' => 'kokopiko', 'price' => 34);

        // $a[] = array('name' => 'kokospiko2', 'price' => 234);

        // $a[] = array('name' => 'kokospiko3', 'price' => 4);



        $largestElement = null;



        array_walk($arr, function (&$item, $key) use (&$largestElement) {

            if (!is_array($largestElement) || $largestElement["Total"] < $item["Total"]) {

                $largestElement = $item;

            }

        });



        $minmax = array_reduce($a, function ($result, $item) {



            if (!isset($result['min'])) {

                $result['min'] = $item;

            }

            if ($result['min']['price'] > $item['price']) {

                $result['min'] = $item;

            }



            if (!isset($result['max'])) {

                $result['max'] = $item;

            }

            if ($result['max']['price'] < $item['price']) {

                $result['max'] = $item;

            }

        });



        $init = array('min' => $a[0], 'max' => $a[0]);



        $minmax = array_reduce($a, function ($result, $item) {

            ($result['min']['price'] < $item['price']) ?: $result['min'] = $item;

            ($result['max']['price'] > $item['price']) ?: $result['max'] = $item;

            return $result;

        }, $init);



        $out = array();

        foreach ($arrUnits as $item) {

            $out[] = $item['Total'];

        }



        echo max($out); //117



        unset($out, $item);



        return $init;

    }

}

