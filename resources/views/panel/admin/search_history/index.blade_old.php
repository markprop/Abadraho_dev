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
                <a href="" class="text-muted">Search History</a>
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
      <div class="container">
        <!--begin::Notice-->

        <!--end::Notice-->
        <!--begin::Card-->
        <div class="card card-custom">
          <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="col-xs-6">
              <div class="card-title">
                <h3 class="card-label">Search History</h3>
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

                      <form method="post" action="/admin/search-history">
                      @csrf
                          <div class="form-row" id="search-form">
                            <div class="col-12 col-md-3 col-lg-3 col-xl-3">
                            <label class="search_heading col-12">Area</label><br>  
                            <select class="selectpicker" name="area[]" multiple multiple multiple data-live-search="true" data-actions-box="true"
 data-live-search-placeholder="Search">
                                
                            @foreach(\App\Models\Area::get() as $obj){
                                <option value="{{ $obj['id'] }}" 
                                @if($searchQuery['area'])
                                  @foreach($searchQuery['area'] as $area)
                                    @if($obj->id == $area)
                                    selected
                                    @endif
                                  @endforeach
                                @endif
                                >
                                  {{ $obj['name'] }}
                                </option>
                              }
                            @endforeach

                                          
                              </select>
                            </div>
                            <div class="col-12 col-md-3 col-lg-3 col-xl-3">

                            <label class="search_heading col-12">Progress</label> <br>  
                            <select class="selectpicker" name="progress[]" multiple multiple multiple data-live-search="true" data-actions-box="true" data-live-search-placeholder="Search">
                                                        
                            @foreach(\App\Models\Progress::get() as $obj){
                                <option value="{{ $obj['progress_status_name'] }}"
                                @if($searchQuery['progress'])
                                  @foreach($searchQuery['progress'] as $progress)
                                    @if($obj->progress_status_name == $progress)
                                    selected
                                    @endif
                                  @endforeach
                                @endif
                                >
                                  {{ $obj['progress_status_name'] }}
                                </option>
                              }
                            @endforeach
                                        
                            </select>
                            
                            </div>
                            <div class="col-12 col-md-3 col-lg-3 col-xl-3">
                            
                            <label class="search_heading col-12">Type</label> <br>    
                            <select class="selectpicker" name="type[]" multiple multiple multiple data-live-search="true" data-actions-box="true" data-live-search-placeholder="Search">
                                                        
                            @foreach(\App\Models\ProjectType::get() as $obj){
                                <option value="{{ $obj['id'] }}"
                                @if($searchQuery['type'])
                                  @foreach($searchQuery['type'] as $type)
                                    @if($obj->id == $type)
                                    selected
                                    @endif
                                  @endforeach
                                @endif
                                >
                                  {{ $obj['title'] }}
                                </option>
                              }
                            @endforeach
                                        
                            </select>

                            </div>

                            <div class="col-12 col-md-3 col-lg-3 col-xl-3">

                            <label class="search_heading col-12">Builder</label><br>   
                            <select class="selectpicker" name="builder[]" multiple multiple multiple data-live-search="true" data-actions-box="true" data-live-search-placeholder="Search">
                                                        
                            @foreach(\App\Models\Builder::get() as $obj){
                                <option value="{{ $obj['id'] }}"
                                @if($searchQuery['builder'])
                                  @foreach($searchQuery['builder'] as $builder)
                                    @if($obj->id == $builder)
                                    selected
                                    @endif
                                  @endforeach
                                @endif
                                >
                                  {{ $obj['full_name'] }}
                                </option>
                              }
                            @endforeach
                                        
                            </select>
                            
                            </div>

                          </div>

                          <div class="form-row" style="margin-top: 3%;" id="input-fields">
                            <div class="col-12 col-md-3 col-lg-3 col-xl-3">
                            <label class="search_heading">Min Down Payment</label>   
                            <input class="form-control" name="minDownPayment" type="number" placeholder="Min Down Payment" min="0" value={{ $searchQuery['minDownPayment'] }}>
                            </div>
                            <div class="col-12 col-md-3 col-lg-3 col-xl-3">
                            <label class="search_heading">Max Down Payment</label>
                            <input class="form-control" name="maxDownPayment" type="number" placeholder="Max Down Payment" min="0" value={{ $searchQuery['maxDownPayment'] }}>
                            </div>
                            <div class="col-12 col-md-2 col-lg-2 col-xl-3">
                            <label class="search_heading">Min Monthly Installment</label>   
                            <input class="form-control" name="minMonthlyInstall" type="number" placeholder="Min Monthly Installment" min="0" value={{ $searchQuery['minMonthlyInstall'] }}>
                            </div>

                            <div class="col-12 col-md-2 col-lg-2 col-xl-3">
                            <label class="search_heading">Max Monthly Installment</label>   
                            <input class="form-control" name="maxMonthlyInstall" type="number" placeholder="Max Monthly Installment" min="0" value={{ $searchQuery['maxMonthlyInstall'] }}>
                            </div>

                          </div>
                          <div class="form-row" style="margin-top: 3%;" id="input-fields">
                            <div class="col-12 col-md-2 col-lg-2 col-xl-3">
                              <label class="search_heading">Min Price</label>   
                              <input class="form-control" name="minPrice" type="number" placeholder="Min Price" min="0" value={{ $searchQuery['minPrice'] }}>
                            </div>
                            <div class="col-12 col-md-2 col-lg-2 col-xl-3">
                              <label class="search_heading">Max Price</label>   
                              <input class="form-control" name="maxPrice" type="number" placeholder="Max Price" min="0" value={{ $searchQuery['maxPrice'] }}>
                            </div>
                            <div class="col-12 col-md-2 col-lg-2 col-xl-2">                            
                              <label class="search_heading">Start Date</label>
                              <input type="date" name="from" max="3000-12-31" min="1000-01-01" class="form-control" min="0" value={{ $searchQuery['from'] ?? '' }}>    
                            </div>
                            <div class="col-12 col-md-2 col-lg-2 col-xl-2">
                              <div class="form-group">
                                <label class="search_heading">End Date</label>   
                                <input type="date" name="to" max="3000-12-31" min="1000-01-01" class="form-control" min="0" value={{ $searchQuery['to'] ?? '' }}>  
                              </div>
                            </div>
                            <div class="col-12 col-md-2 col-lg-2 col-xl-2">
                              <label for="">-</label><br>
                              <button type="submit" id="search-results" class="btn admin_ad_btn_red mb-2">Search</button>
                            </div>
                          </div>

                        </form>
                      
                    </div>
                        
                  </div>
                </section>

                  
                  <select class="selectpicker col-6 col-lg-4" name="field[]" id="selectedFields" multiple multiple multiple data-live-search="true" data-live-search-placeholder="Search">
                                  
                                    
                                    <!-- <option value="Name">User Name</option> -->
                                    <option value="Area">Area</option>
                                    <option value="Progress">Progress</option>
                                    <option value="Type">Type</option>
                                    <!-- <option value="Builder">Builder</option> -->
                                    <option value="Minimum Down Payment">Min Down Payment</option>
                                    <option value="Maxmimum Down Payment">Max Down Payment</option>
                                    <option value="Minimum Monthly Installment">Min Monthly Installments</option>
                                    <option value="Maximum Monthly Installment">Max Monthly Installments</option>
                                    <option value="Minimum Price">Min Price</option>
                                    <option value="Maximum Price">Max Price</option>
                                    
                                            
                  </select>
                  <div class="dropdown dropdown-inline mr-2" style="float: right">

                    <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle"
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
                        <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">
                          Choose an option:
                        </li>

                        <li class="navi-item">
                          <a href="javascript:void(0)" onclick="downloadData()" class="navi-link">
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

            <div class="table_wrapper table_wrapper_payment">
            <table class="datatable datatable-bordered  table_wrapper table-bordered text-center" id="kt_datatable">
              <thead>
                <tr>
                  <th title="Field #1" style="width:20px">#</th>
                  <th title="Field #2">Date/Time</th>
                  <th title="Field #3">User Name</th>
                  <th title="Field #4">Phone</th>
                  <th title="Field #5">Email</th>
                  <th title="Field #6">area</th>
                  <th title="Field #7">progress</th>
                  <th title="Field #8">type</th>
                  <th title="Field #9">Builder</th>
                  <th title="Field #10">Min Down Payment</th>
                  <th title="Field #11">Max Down Payment</th>
                  <th title="Field #12">Min Monthly Installment</th>
                  <th title="Field #13">MaxMonthly Installment</th>
                  <th title="Field #14">Min Price</th>
                  <th title="Field #15">Max Price</th>
                    <th title="Field #16">Actions</th> 
                </tr>
              </thead>
              <tbody>
                @foreach ($userHistorys as $userHistory)
                  <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $userHistory->created_at ? $userHistory->created_at : "-" }}</td>
                    <td>
                      @if ($userHistory->user)
                        {{ $userHistory->user->first_name }} {{ $userHistory->user->last_name }}
                      @else
                        Visitor
                      @endif
                    </td>
                    <td>
                      @if ($userHistory->user)
                        {{ $userHistory->user->phone_number }}
                      @else
                        -
                      @endif
                    </td>
                    <td>
                      @if ($userHistory->user)
                        {{ $userHistory->user->email }} 
                      @else
                        -
                      @endif
                    </td>
                    <td>
                    @if($searchData[$loop->index]['area'])
                        @foreach($searchData[$loop->index]['area'] as $area)
                        {{ \App\Models\Area::where(['id' => $area])->pluck('name')->first() }} {{ !$loop->last ? ', ' : '' }}
                        @endforeach
                        @else
                              -
                    @endif
                    </td>
                    <td>
                      @if($searchData[$loop->index]['progress'])
                        @foreach($searchData[$loop->index]['progress'] as $progress)
                        {{ \App\Models\Progress::where(['progress_status_name' => $progress])->pluck('progress_status_name')->first() }} {{ !$loop->last ? ', ' : '' }}
                        @endforeach
                        @else
                              -
                      @endif
                    </td>
                    <td>
                    @if($searchData[$loop->index]['type'])
                        @foreach($searchData[$loop->index]['type'] as $type)
                        {{ \App\Models\ProjectType::where(['id' => $type])->pluck('title')->first() }} {{ !$loop->last ? ', ' : '' }}
                        @endforeach
                        @else
                              -
                      @endif
                    </td>

                    <td>
                    @if($searchData[$loop->index]['builder'])
                      @foreach($searchData[$loop->index]['builder'] as $builder)
                        {{ \App\Models\Builder::where(['id' => $builder])->pluck('full_name')->first() }} {{ !$loop->last ? ', ' : '' }}
                      @endforeach
                      @else
                              -
                    @endif
                    </td>
                    <td>{{ $searchData[$loop->index]['minDP'] ? number_format($searchData[$loop->index]['minDP']) : "-" }}</td>
                    <td>{{ $searchData[$loop->index]['maxDP'] ? number_format($searchData[$loop->index]['maxDP']) : "-" }}</td>
                    <td>{{ $searchData[$loop->index]['minMI'] ? number_format($searchData[$loop->index]['minMI']) : "-" }}</td>
                    <td>{{ $searchData[$loop->index]['maxMI'] ? number_format($searchData[$loop->index]['maxMI']) : "-" }}</td>
                    <td>{{ $searchData[$loop->index]['minPrice'] ? number_format($searchData[$loop->index]['minPrice']) : "-" }}</td>
                    <td>{{ $searchData[$loop->index]['maxPrice'] ? number_format($searchData[$loop->index]['maxPrice']) : "-" }}</td>
                   
                     <td>
                       <a href="/admin/search-history/{{ $userHistory->id }}">
                          <i class="fa fa-eye ml-2"></i>
                       </a>
                       
                     </td>
                  </tr>
                @endforeach
              </tbody>
            </table>

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

  function downloadData(){
    let inputs = $('form input');
    let selects = $('form select');
    let searchQuery = '';
    for(var i=0; i<selects.length ; i++){
      let val = $(selects[i]).val();
      if(val != ""){
        let name = $(selects[i]).attr('name');
        searchQuery += name + "=" + val + "&";
        console.log("Select", name + " - " + val);
      }
    }
    for(var i=0; i<inputs.length ; i++){
      let name = $(inputs[i]).attr("name");
      if(name && name != "_token"){
        let val = $(inputs[i]).val();
        if(val != ""){
          searchQuery += name + "=" + val + "&";
          console.log(name + "=" + val);
        }
      }
    }
    console.log("Input", btoa(searchQuery));
    // return;
    let selectedFields = $("#selectedFields").val();
    window.open(`${window.location.origin}/admin/searchHistory/export?fields=${selectedFields}&searchQuery=${btoa(searchQuery)}`)
  }
  </script>



@endsection
