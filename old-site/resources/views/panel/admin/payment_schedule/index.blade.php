@extends('panel.layouts.master1')

@section('content')
  <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
      <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
          <!--begin::Page Heading-->
          <div class="d-flex align-items-baseline flex-wrap mr-5">
            <!--begin::Page Title-->
            <h5 class="text-dark font-weight-bold my-1 mr-5">Dashboard</h5>
            <!--end::Page Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
              <li class="breadcrumb-item text-muted">
                <a href="" class="text-muted">User's Payment Schedule</a>
              </li>
            </ul>
            <!--end::Breadcrumb-->
          </div>
          <!--end::Page Heading-->
        </div>
        <!--end::Info-->
      </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
      <!--begin::Container-->
      <div class="container-fluid">
        <!--begin::Notice-->

        <!--end::Notice-->
        <!--begin::Card-->
        <div class="card card-custom">
          <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="col-xs-6">
              <div class="card-title">
                <h3 class="card-label">Payment Schedule Listing</h3>
              </div>
            </div>
          </div>
          <div class="card-body">
            <!--begin: Search Form-->
            <!--begin::Search Form-->
            <div class="mb-7">
              <div class="row align-items-center">
                <div class="col-lg-12">

                <section class="search-sec">
                      <div class="container">

                      <div class="card" style="margin-bottom: 2%;">
                          <div class="card-body">

                          <form method="POST" action="/admin/payment-schedules">
                          @csrf
                              <div class="form-row">
                                <div class="col-12 col-md-3 col-lg-3 col-xl-3">
                                <label class="search_heading">Project Name</label>
                                <select class="selectpicker" name="project_id[]" multiple multiple multiple data-live-search="true" data-actions-box="true" data-live-search-placeholder="Search">
                                  @foreach(\App\Models\Project::get() as $project)
                                    <option value={{ $project['id'] }}
                                    @if($searchQuery['project_id'])
                                      @foreach($searchQuery['project_id'] as $id)
                                        @if($project['id'] == $id)
                                          selected
                                        @endif
                                      @endforeach
                                    @endif
                                    >
                                      {{ $project['name'] }}
                                    </option>
                                  @endforeach           
                                </select>
                                </div>
                                <div class="col-12 col-md-3 col-lg-3 col-xl-3">

                                <label class="search_heading">Unit Name</label>   
                                <select class="selectpicker" name="unit_id[]" multiple multiple multiple data-live-search="true" data-actions-box="true" data-live-search-placeholder="Search">
                                  @foreach(\App\Models\Unit::get() as $unit)
                                    <option value={{ $unit['id'] }}
                                    @if($searchQuery['unit_id'])
                                    @foreach($searchQuery['unit_id'] as $id)
                                        @if($unit['id'] == $id)
                                          selected
                                        @endif
                                      @endforeach
                                    @endif
                                    >
                                      {{ $unit['title'] }}
                                    </option>
                                  @endforeach  
                                </select>
                                
                                </div>
                                <div class="col-12 col-md-3 col-lg-3 col-xl-3">
                                
                                <label class="search_heading">Duration</label><br>   
                                <select class="selectpicker" name="duration[]" multiple multiple multiple data-live-search="true" data-actions-box="true" data-live-search-placeholder="Search">
                                <!-- <option value="" selected disabled>Please Select</option>                       -->
                                <option value="1" 
                                @if($searchQuery['duration'])
                                @foreach($searchQuery['duration'] as $duration)
                                    @if("1" == $duration)
                                    selected
                                    @endif
                                  @endforeach
                                @endif
                                >1 Months</option>
                                <option value="3"
                                @if($searchQuery['duration'])
                                @foreach($searchQuery['duration'] as $duration)
                                    @if("3" == $duration)
                                    selected
                                    @endif
                                  @endforeach
                                @endif
                                >3 Months</option>
                                <option value="6"
                                @if($searchQuery['duration'])
                                @foreach($searchQuery['duration'] as $duration)
                                    @if("6" == $duration)
                                    selected
                                    @endif
                                  @endforeach
                                @endif
                                >6 Months</option>
                                <option value="9"
                                @if($searchQuery['duration'])
                                @foreach($searchQuery['duration'] as $duration)
                                    @if("9" == $duration)
                                    selected
                                    @endif
                                  @endforeach
                                @endif
                                >9 Months</option>
                                <option value="12"
                                @if($searchQuery['duration'])
                                @foreach($searchQuery['duration'] as $duration)
                                    @if("12" == $duration)
                                    selected
                                    @endif
                                  @endforeach
                                @endif
                                >12 Months</option>
                                <option value="24"
                                @if($searchQuery['duration'])
                                @foreach($searchQuery['duration'] as $duration)
                                    @if("24" == $duration)
                                    selected
                                    @endif
                                  @endforeach
                                @endif
                                >24 Months</option>
                                <option value="36"
                                @if($searchQuery['duration'])
                                @foreach($searchQuery['duration'] as $duration)
                                    @if("36" == $duration)
                                    selected
                                    @endif
                                  @endforeach
                                @endif
                                >36 Months</option>
                                <option value="48"
                                @if($searchQuery['duration'])
                                @foreach($searchQuery['duration'] as $duration)
                                    @if("48" == $duration)
                                    selected
                                    @endif
                                  @endforeach
                                @endif
                                >48 Months</option>
                                <option value="60"
                                @if($searchQuery['duration'])
                                @foreach($searchQuery['duration'] as $duration)
                                    @if("60" == $duration)
                                    selected
                                    @endif
                                  @endforeach
                                @endif
                                >60 Months</option>
                                            
                                </select>
                                </div>

                                <div class="col-12 col-md-3 col-lg-3 col-xl-3">

                                <label class="search_heading">Down Payment</label>   
                                <input class="form-control" type="number" name='down_payment' placeholder="Down Payment" min="0" value={{ $searchQuery['down_payment']}}>
                                
                                </div>

                              </div>

                              <div class="form-row" style="margin-top: 2%;">
                                <div class="col-12 col-md-3 col-lg-3 col-xl-3">
                                <label class="search_heading">Monthly Installments</label>   
                                <input class="form-control" type="number" name='monthly_installment' placeholder="Monthly Installments" min="0" value={{ $searchQuery['monthly_installment']}}>
                                </div>
                                

                                <div class="col-12 col-md-3 col-lg-3 col-xl-3">
                                <label class="search_heading">Quarterly Installment</label><br>
                                <input class="form-control" type="number" name='quarterly_installment' placeholder="Quarterly Installment" min="0" value={{ $searchQuery['quarterly_installment']}}>
                                </div>

                                <div class="col-12 col-md-3 col-lg-3 col-xl-3">
                                <label class="search_heading">Half Yearly Installment</label><br>
                                <input class="form-control" type="number" name='half_yearly_installment' placeholder="Half Yearly Installment" min="0" value={{ $searchQuery['half_yearly_installment']}}>
                                
                                </div>

                                <div class="col-12 col-md-3 col-lg-3 col-xl-3">
                                
                                <label class="search_heading">Yearly Installment</label>   
                                <input class="form-control" type="number" name='yearly_installment' placeholder="Yearly Installment" min="0" value={{ $searchQuery['yearly_installment']}}>

                                </div>

                              </div>
                              <div class="form-row" style="margin-top: 2%;">
                                <div class="col-12 col-md-3 col-lg-3 col-xl-3">
                                <label class="search_heading">Slab Casting</label>   
                                <input class="form-control" type="number" name='slab_casting' placeholder="Slab Casting" min="0" value={{ $searchQuery['slab_casting']}}>
                                </div>
                                

                                <div class="col-12 col-md-3 col-lg-3 col-xl-3">
                                <label class="search_heading">Plinth</label><br>
                                <input class="form-control" type="number" name='plinth' placeholder="Plinth" min="0" value={{ $searchQuery['plinth']}}>
                                </div>

                                <div class="col-12 col-md-3 col-lg-3 col-xl-3">
                                <label class="search_heading">Colour</label><br>
                                <input class="form-control" type="number" name='colour' placeholder="Colour" min="0" value={{ $searchQuery['colour']}}>
                                
                                </div>

                                <div class="col-12 col-md-3 col-lg-3 col-xl-3">
                                
                                <label class="search_heading">Start Of Work</label>   
                                <input class="form-control" type="number" name='start_of_work' placeholder="Start Of Work" min="0" value={{ $searchQuery['start_of_work']}}>

                                </div>

                              </div>

                              <div class="form-row" style="margin-top: 2%;">
                               
                                

                                <div class="col-12 col-md-3 col-lg-3 col-xl-3">

                                <label class="search_heading">Possession</label>   
                                <input class="form-control" type="number" name='possession' min="0" placeholder="Possession" value={{ $searchQuery['possession']}}>
                                
                                </div>

                                <div class="col-12 col-md-3 col-lg-3 col-xl-3">
                                
                                <label class="search_heading">Loan Amount</label>   
                                <input class="form-control" type="number" name='loan_amount' placeholder="Loan Amount" min="0" value={{ $searchQuery['loan_amount']}}>

                                </div>

                                <div class="col-12 col-md-2 col-lg-2 col-xl-2">
                      
                                <label class="search_heading">Start Date</label> <br>
                                <input type="date" name="from" max="3000-12-31" min="1000-01-01" class="form-control" min="0" value={{ $searchQuery['from'] ?? ""}}> 

                                </div>

                                <div class="col-12 col-md-2 col-lg-2 col-xl-2">
                      
                                <label class="search_heading">End Date</label> <br>
                                <input type="date" name="to" max="3000-12-31" min="1000-01-01" class="form-control" value={{ $searchQuery['to'] ?? ""}}>
                                
                                </div>

                                

                                <div class="col-12 col-md-2 col-lg-2 col-xl-2">

                                <label class="search_heading">-</label><br>   
                                <button type="submit" class="btn admin_ad_btn_red mb-2">Search</button>
                                </div>

                              </div>
                            
                            </form>
                          
                        </div>
                            
                      </div>
                    </section>
                  <select class="selectpicker col-6 col-lg-4" name="tag_id[]" multiple multiple multiple data-live-search="true" data-actions-box="true" data-live-search-placeholder="Search">
                    <option value="">User Name</option>
                    <option value="">Project Name</option>
                    <option value="">Unit Name</option>
                    <option value="">Duration</option>
                    <option value="">Down Payment</option>
                    <option value="">Monthly Installments</option>
                    <option value="">Quarterly Installments</option>
                    <option value="">Half-Yearly Installments</option>
                    <option value="">Yearly Installments</option>
                    <option value="">Possession</option>
                    <option value="">Loan Amount</option>
                  </select>
                  <div class="dropdown dropdown-inline mr-2" style="float: right">
                    <button type="button" class="btn export_btn font-weight-bolder dropdown-toggle"
                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <span class="svg-icon svg-icon-md">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                          height="24px" viewBox="0 0 24 24" version="1.1">
                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"></rect>
                            <path
                              d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z"
                              fill="#000000" opacity="0.3"></path>
                            <path
                              d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z"
                              fill="#000000"></path>
                          </g>
                        </svg>
                        <!--end::Svg Icon-->
                      </span>Export
                    </button>
                    <!--begin::Dropdown Menu-->
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                      <!--begin::Navigation-->
                      <ul class="navi flex-column navi-hover py-2">
                        <li class="navi-header font-weight-bolder text-uppercase font-size-sm  pb-2">
                          Choose an option:
                        </li>

                        <li class="navi-item">
                          <a href="{{ route('admin.payment_schedule.excel') }}" class="navi-link">
                            <span class="navi-icon">
                              <i class="la la-file-excel-o"></i>
                            </span>
                            <span class="navi-text">Excel</span>
                          </a>
                        </li>
                      </ul>
                      <!--end::Navigation-->
                    </div>
                    <!--end::Dropdown Menu-->
                  </div>
                </div>

              </div>
            </div>
            <!--end::Search Form-->
            <!--end: Search Form-->
            <!--begin: Datatable-->
            
            <div class="row">
              <div class="col-sm-12 table_wrapper_payment">
                <table class="datatable datatable-bordered datatable-head-custom table-bordered text-center" id="kt_datatable">
                  <thead>
                    <tr>
                      <th title="Field #1" style="width:20px">#</th>
                      <th title="Field #13">Date/Time</th>
                      <th title="Field #2">User Name</th>
                      <th title="Field #2">Phone</th>
                      <th title="Field #2">Email</th>
                      <th title="Field #3">Project Name</th>
                      <th title="Field #4">Unit Name</th>
                      <th title="Field #5">Duration</th>
                      <th title="Field #6">Down Payment</th>
                      <th title="Field #7">Monthly Installments</th>
                      <th title="Field #8">Quarterly Installments</th>
                      <th title="Field #9">Half-Yearly Installments</th>
                      <th title="Field #10">Yearly Installments</th>
                      <th title="Field #11">Possession</th>
                      <th title="Field #12">Loan Amount</th>
                      <th title="Field #13">Slab Casting</th>
                      <th title="Field #14">Plinth</th>
                      <th title="Field #15">Colour</th>
                      <th title="Field #16">Start Of Work</th>
                      <th title="Field #17">Actions</th> 
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($paymentSchedules as $paymentSchedule)
                      <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>
                        {{date('d-m-Y H:i:s', strtotime($paymentData[$loop->index]['created_at']))}}
                        </td>
                          {{--dd($paymentSchedule)--}}
                        <td>
                          @if ($paymentSchedule->user)
                            {{ $paymentSchedule->user->first_name }} {{ $paymentSchedule->user->last_name }}
                          @else
                            Visitor
                          @endif
                        </td>
                        <td>
                          @if ($paymentSchedule->user)
                            {{ $paymentSchedule->user->phone_number }}
                          @else
                            Visitor
                          @endif
                        </td>
                        <td>
                          @if ($paymentSchedule->user)
                            {{ $paymentSchedule->user->email }} 
                          @else
                            -
                          @endif
                        </td>
                      <td>{{ \App\Models\Project::where(['id' => $paymentSchedule->project_id])->pluck('name')[0] ?? ''}}</td> 
                        <td>
                          {{ optional($paymentSchedule->unit)->title }}
                        </td>
                        <td>{{ $paymentData[$loop->index]['duration'] ? $paymentData[$loop->index]['duration']." Months" : "-" }}</td>
                        <td>{{ $paymentData[$loop->index]['down_payment'] ?  number_format($paymentData[$loop->index]['down_payment']) : "-" }}</td>
                        <td>{{ $paymentData[$loop->index]['monthly_installment'] ? number_format($paymentData[$loop->index]['monthly_installment']) : "-" }}</td>
                        <td>{{ $paymentData[$loop->index]['quarterly_installment'] ? number_format($paymentData[$loop->index]['quarterly_installment']) : "-" }}</td>
                        <td>{{ $paymentData[$loop->index]['half_yearly_installment'] ? number_format($paymentData[$loop->index]['half_yearly_installment']) : "-" }}</td>
                        <td>{{ $paymentData[$loop->index]['yearly_installment'] ? number_format($paymentData[$loop->index]['yearly_installment']) : "-" }}</td>
                        <td>{{ $paymentData[$loop->index]['possession'] ? number_format($paymentData[$loop->index]['possession']) : "-" }}</td>
                        <td>{{ $paymentData[$loop->index]['loan_amount'] ? number_format($paymentData[$loop->index]['loan_amount']) : "-" }}</td>
                        <td>{{ $paymentData[$loop->index]['slab_casting'] ? number_format($paymentData[$loop->index]['slab_casting']) : "-" }}</td>
                        <td>{{ $paymentData[$loop->index]['plinth'] ? number_format($paymentData[$loop->index]['plinth']) : "-" }}</td>
                        <td>{{ $paymentData[$loop->index]['colour'] ? number_format($paymentData[$loop->index]['colour']) : "-" }}</td>
                        <td>{{ $paymentData[$loop->index]['start_of_work'] ? number_format($paymentData[$loop->index]['start_of_work']) : "-" }}</td>
                        <td>
                       <a href="/admin/payment-schedules/{{ $paymentSchedule->id }}">
                          <i class="fa fa-eye ml-2"></i>
                       </a>
                        
                       </a>
                     </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <!--end: Datatable-->
          </div>
        </div>
        <!--end::Card-->
      </div>
      <!--end::Container-->
    </div>
    <!--end::Entry-->
  </div>
@endsection

@section('header')
  <!--begin::Page Custom Styles(used by this page)-->
  {{-- <link href="{{ asset('assets/css/pages/wizard/wizard-1.css') }}" rel="stylesheet" type="text/css" /> --}}
  <!--end::Page Custom Styles-->
  <style>
    .datatable.datatable-default>.datatable-table>.datatable-head .datatable-row>.datatable-cell:nth-child(1)>span,
    .datatable.datatable-default>.datatable-table>.datatable-body .datatable-row>.datatable-cell:nth-child(1)>span {
      width: 20px !important;
    }
  </style>
@endsection

@section('footer')
  <!--begin::Page Scripts(used by this page)-->
  <script src="assets/js/pages/custom/projects/add-project.js"></script>
  <script src="assets/js/pages/crud/ktdatatable/base/html-table.js"></script>
  <!--end::Page Scripts-->
  <script>
    $(function() {
    $('input[name="daterange"]').daterangepicker({
      opens: 'left'
    }, function(start, end, label) {
      console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
    });
  });
  </script>
@endsection
