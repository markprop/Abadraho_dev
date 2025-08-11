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
              <a href="" class="text-muted">Housing Calculator Search History</a>
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

                        <form method="post" action="/admin/housing-calc-search-history">
                          @csrf
                          <div class="form-row">
                            <div class="col-12 col-md-3 col-lg-3 col-xl-3">
                              <label class="search_heading">Budget</label>
                              <input class="form-control" type="number" name="maxBudget" placeholder="Budget" min="0" value={{ $searchQuery['maxBudget'] }}>
                            </div>
                            <div class="col-12 col-md-3 col-lg-3 col-xl-3">

                              <label class="search_heading">Project Type</label><br>
                              <select class="selectpicker" name="projectType">
                                <option value="" selected>Please Select</option>
                                <option value="Construction" @if($searchQuery['projectType']) @if($searchQuery['projectType']=='Construction' ) selected @endif @endif>Construction</option>
                                <option value="Flat" @if($searchQuery['projectType']) @if($searchQuery['projectType']=='Flat' ) selected @endif @endif>Flat</option>

                              </select>

                            </div>
                            <div class="col-12 col-md-3 col-lg-3 col-xl-3">

                              <label class="search_heading">Duration</label><br>
                              <select class="selectpicker" name="duration[]" multiple multiple multiple data-live-search="true" data-actions-box="true" data-live-search-placeholder="Search">

                                <option value="1" @if($searchQuery['duration']) @foreach($searchQuery['duration'] as $duration) @if("1"==$duration) selected @endif @endforeach @endif>1 Months</option>
                                <option value="3" @if($searchQuery['duration']) @foreach($searchQuery['duration'] as $duration) @if("3"==$duration) selected @endif @endforeach @endif>3 Months</option>
                                <option value="6" @if($searchQuery['duration']) @foreach($searchQuery['duration'] as $duration) @if("6"==$duration) selected @endif @endforeach @endif>6 Months</option>
                                <option value="9" @if($searchQuery['duration']) @foreach($searchQuery['duration'] as $duration) @if("9"==$duration) selected @endif @endforeach @endif>9 Months</option>
                                <option value="12" @if($searchQuery['duration']) @foreach($searchQuery['duration'] as $duration) @if("12"==$duration) selected @endif @endforeach @endif>12 Months</option>
                                <option value="24" @if($searchQuery['duration']) @foreach($searchQuery['duration'] as $duration) @if("24"==$duration) selected @endif @endforeach @endif>24 Months</option>
                                <option value="36" @if($searchQuery['duration']) @foreach($searchQuery['duration'] as $duration) @if("36"==$duration) selected @endif @endforeach @endif>36 Months</option>
                                <option value="48" @if($searchQuery['duration']) @foreach($searchQuery['duration'] as $duration) @if("48"==$duration) selected @endif @endforeach @endif>48 Months</option>
                                <option value="60" @if($searchQuery['duration']) @foreach($searchQuery['duration'] as $duration) @if("60"==$duration) selected @endif @endforeach @endif>60 Months</option>
                              </select>
                            </div>

                            <div class="col-12 col-md-3 col-lg-3 col-xl-3">

                              <label class="search_heading">Down Payment</label>
                              <input class="form-control" type="number" name="downPayment" placeholder="Down Payment" min="0" value={{ $searchQuery['downPayment'] }}>

                            </div>

                          </div>

                          <div class="form-row" style="margin-top: 2%;">
                            <div class="col-12 col-md-3 col-lg-3 col-xl-3">
                              <label class="search_heading">Slab Casting</label>
                              <input class="form-control" type="number" name="slabCasting" placeholder="Slab Casting" min="0" value={{ $searchQuery['slabCasting'] }}>
                            </div>
                            <div class="col-12 col-md-3 col-lg-3 col-xl-3">
                              <label class="search_heading">Plinth</label>
                              <input class="form-control" type="number" name="plinth" placeholder="Plinth" min="0" value={{ $searchQuery['plinth'] }}>
                            </div>
                            <div class="col-12 col-md-3 col-lg-3 col-xl-3">
                              <label class="search_heading">Color</label>
                              <input class="form-control" type="number" name="colour" placeholder="Color" min="0" value={{ $searchQuery['colour'] }}>
                            </div>

                            <div class="col-12 col-md-3 col-lg-3 col-xl-3">
                              <label class="search_heading">Quarterly Installment</label><br>
                              <input class="form-control" type="number" name="quarterlyInstall" placeholder="Quarterly Installment" min="0" value={{ $searchQuery['quarterlyInstall'] }}>
                            </div>

                          </div>

                          <div class="form-row" style="margin-top: 2%;">
                            <div class="col-12 col-md-3 col-lg-3 col-xl-3">
                              <label class="search_heading">Half Yearly Installment</label><br>
                              <input class="form-control" type="number" name="halfYearlyInstall" placeholder="Half Yearly Installment" min="0" value={{ $searchQuery['halfYearlyInstall'] }}>

                            </div>
                            <div class="col-12 col-md-3 col-lg-3 col-xl-3">

                              <label class="search_heading">Yearly Installment</label>
                              <input class="form-control" type="number" name="yearlyInstall" placeholder="Yearly Installment" min="0" value={{ $searchQuery['yearlyInstall'] }}>

                            </div>

                            <div class="col-12 col-md-2 col-lg-3 col-xl-3">

                              <label class="search_heading">Possession</label>
                              <input class="form-control" type="number" name="possession" placeholder="Possession" min="0" value={{ $searchQuery['possession'] }}>

                            </div>

                            <div class="col-12 col-md-3 col-lg-3 col-xl-3">
                              <label class="search_heading col-12">Area</label><br>
                              <select class="selectpicker" name="area[]" multiple multiple multiple data-live-search="true" data-actions-box="true" data-live-search-placeholder="Search">

                                @foreach(\App\Models\Area::get() as $obj){
                                <option value="{{ $obj['id'] }}" @if($searchQuery['area']) @foreach($searchQuery['area'] as $area) @if($obj->id == $area)
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

                          </div>

                          <div class="row" style="margin-top: 2%;">

                            <div class="col-12 col-md-3 col-lg-3 col-xl-3">
                              <label class="search_heading">Monthly Installment</label>
                              <input class="form-control" type="number" name="monthInstall" placeholder="Monthly" min="0" value={{ $searchQuery['monthInstall'] }}>

                            </div>

                            <div class="col-12 col-md-3 col-lg-3 col-xl-3">
                              <label class="search_heading">Start Date</label>
                              <input type="date" name="from" max="3000-12-31" min="1000-01-01" class="form-control" value={{ $searchQuery['from'] ?? '' }}>

                            </div>

                            <div class="col-12 col-md-3 col-lg-3 col-xl-3">

                              <label class="search_heading">End Date</label>
                              <input type="date" name="to" max="3000-12-31" min="1000-01-01" class="form-control" value={{ $searchQuery['to'] ?? '' }}>

                            </div>

                            <div class="col-12 col-md-3 col-lg-3 col-xl-3">

                              <label for="">-</label><br>
                              <button type="submit" id="search-results" class="btn admin_ad_btn_red mb-2">Search</button>

                            </div>

                          </div>

                        </form>

                      </div>

                    </div>
                </section>

                <!-- <div class="input-icon" style="float: right">
                  <input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query" />
                  <span>
                    <i class="flaticon2-search-1 text-muted"></i>
                  </span>
                </div> -->
                <select class="selectpicker col-6 col-lg-4" name="field[]" id="selectedFields" data-actions-box="true" multiple multiple multiple data-live-search="true" data-live-search-placeholder="Search">
                  <option value="Area">Area</option>
                  <option value="Budget">Budget</option>
                  <option value="Type">Project Type</option>
                  <option value="Duration">Duration</option>
                  <option value="Down Payment">Down Payment</option>
                  <option value="Monthly Installment">Monthly Installments</option>
                  <option value="Quarterly Installment">Quarterly Installments</option>
                  <option value="Half Yearly Installment">Half-Yearly Installments</option>
                  <option value="Yearly Installment">Yearly Installments</option>
                  <option value="Possession">Possession</option>
                  <option value="Slab">Slab Casting</option>
                  <option value="Plinth">Plinth</option>
                  <option value="Colour">Colour</option>
                </select>
                <div class="dropdown dropdown-inline mr-2" style="float: right">
                  <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="svg-icon svg-icon-md">
                      <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
                      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <rect x="0" y="0" width="24" height="24"></rect>
                          <path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3"></path>
                          <path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000"></path>
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

            <table class="datatable datatable-bordered datatable-head-custom table_wrapper table-bordered text-center" id="kt_datatable">
              <thead>
                <tr>
                  <th title="Field #1" style="width:20px">#</th>
                  <th title="Field #16">Date/Time</th>
                  <th title="Field #2">User Name</th>
                  <th title="Field #2">Phone</th>
                  <th title="Field #2">Email</th>
                  <th title="Field #3">Area</th>
                  <th title="Field #4">Budget</th>
                  <th title="Field #5">Project Type</th>
                  <th title="Field #6">Duration</th>
                  <th title="Field #7">Down Payment</th>
                  <th title="Field #8">Slab Casting</th>
                  <th title="Field #9">Plinth</th>
                  <th title="Field #10">Colour</th>
                  <th title="Field #11">Monthly Installment</th>
                  <th title="Field #12">Quarterly Installment</th>
                  <th title="Field #13">Half Yearly Installment</th>
                  <th title="Field #14">Yearly Installment</th>
                  <th title="Field #15">Possession</th>

                  <th title="Field #17">Actions</th>

                  <!-- <th title="Field #12">Actions</th> -->
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
                  <td>{{ $searchData[$loop->index]['maxBudget'] ? number_format($searchData[$loop->index]['maxBudget']) : "-"}}</td>
                  <td>{{ $searchData[$loop->index]['projectType'] ?? "-" }}</td>
                  <td>{{ $searchData[$loop->index]['duration'] ? $searchData[$loop->index]['duration']." Months" : "-" }}</td>
                  <td>{{ $searchData[$loop->index]['downPayment'] ? number_format($searchData[$loop->index]['downPayment']) : "-" }}</td>
                  <td>{{ $searchData[$loop->index]['slabCasting'] ?? "-" }}</td>
                  <td>{{ $searchData[$loop->index]['plinth'] ? $searchData[$loop->index]['plinth'] : "-" }}</td>
                  <td>{{ $searchData[$loop->index]['colour'] ? $searchData[$loop->index]['colour'] : "-" }}</td>
                  <td>{{ $searchData[$loop->index]['monthInstall'] ? number_format($searchData[$loop->index]['monthInstall']) : "-" }}</td>
                  <td>{{ $searchData[$loop->index]['quarterlyInstall'] ? number_format($searchData[$loop->index]['quarterlyInstall']) : "-" }}</td>
                  <td>{{ $searchData[$loop->index]['halfYearlyInstall'] ? number_format($searchData[$loop->index]['halfYearlyInstall']) : "-" }}</td>
                  <td>{{ $searchData[$loop->index]['yearlyInstall'] ? number_format($searchData[$loop->index]['yearlyInstall']) : "-" }}</td>
                  <td>{{ $searchData[$loop->index]['possession'] ? number_format($searchData[$loop->index]['possession']) : "-" }}</td>



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

  function downloadData() {
    let inputs = $('form input');
    let selects = $('form select');
    let searchQuery = '';
    for (var i = 0; i < selects.length; i++) {
      let val = $(selects[i]).val();
      if (val != "") {
        let name = $(selects[i]).attr('name');
        searchQuery += name + "=" + val + "&";
        console.log("Select", name + " - " + val);
      }
    }
    for (var i = 0; i < inputs.length; i++) {
      let name = $(inputs[i]).attr("name");
      if (name && name != "_token") {
        let val = $(inputs[i]).val();
        if (val != "") {
          searchQuery += name + "=" + val + "&";
          console.log(name + "=" + val);
        }
      }
    }
    console.log("Input", btoa(searchQuery));
    // return;
    let selectedFields = $("#selectedFields").val();
    window.open(`${window.location.origin}/admin/calSearchHistory/export?fields=${selectedFields}&searchQuery=${btoa(searchQuery)}`)
  }
</script>

@endsection