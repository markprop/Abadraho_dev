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
          <h5 class="text-dark font-weight-bold my-1 mr-5">Active Projects</h5>
          <!--end::Page Title-->
          <!--begin::Breadcrumb-->
          <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <!-- <li class="breadcrumb-item text-muted">
              <a href="" class="text-muted">Project Details</a>
            </li> -->
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
              <h3 class="card-label">Active Projects</h3>
            </div>
          </div>
          <!-- <div class="col-xs-6 text-xs-right">
            <a href="/admin/project/create" type="button" class="btn admin_ad_btn_red mr-2">ADD PROJECT</a>
          </div> -->
        </div>
        <div class="card-body">

          <div class="col-12 col-md-12 col-lg-12">

            <section class="search-sec">
              <div class="container">

                <div class="card" style="margin-bottom: 2%;">
                  <div class="card-body">

                    <form method="GET" action="/admin/active/project">
                      @csrf
                      <div class="form-row">
                        <div class="col-12 col-md-4 col-lg-4 col-xl-4">
                          <label class="search_heading">Project Name</label>
                          <select class="selectpicker" name="id[]" multiple multiple multiple data-live-search="true" size="5" data-actions-box="true" data-live-search-placeholder="Search">
                            @foreach($allProjects as $project)
                            <option value={{ $project['id'] }} @if($searchQuery['id']) @foreach($searchQuery['id'] as $obj) @if($project['id']==$obj) selected @endif @endforeach @endif>
                              {{ $project['name'] }}
                            </option>
                            @endforeach
                          </select>
                        </div>
                        <!-- <div class="col-12 col-md-4 col-lg-4 col-xl-4">

                                <label class="search_heading">Address</label>   
                                <select class="selectpicker col-12" name="tag_id[]" multiple multiple multiple data-live-search="true" data-live-search-placeholder="Search">
                                                            
                                  <option value="hello">
                                    asif1
                                  </option>

                                  <option value="hello">
                                    asif2
                                  </option>

                                  <option value="hello">
                                    asif3
                                  </option>
                                            
                                </select>
                                
                                </div> -->
                        <div class="col-12 col-md-4 col-lg-4 col-xl-4">

                          <label class="search_heading">Area</label>
                          <select class="selectpicker" name="areas[]" multiple multiple multiple data-live-search="true" data-actions-box="true" data-live-search-placeholder="Search">
                            @foreach(\App\Models\Area::get() as $area)
                            <option value={{ $area['id'] }} @if($searchQuery['areas']) @foreach($searchQuery['areas'] as $obj) @if($area['id']==$obj) selected @endif @endforeach @endif>
                              {{ $area['name'] }}
                            </option>
                            @endforeach
                          </select>

                        </div>
                        <div class="col-12 col-md-4 col-lg-4 col-xl-4">
                          <label class="search_heading">Progress</label>
                          <select class="selectpicker" name="progress[]" multiple multiple multiple data-live-search="true" data-actions-box="true" data-live-search-placeholder="Search">

                            <option value="Under Construction" @if($searchQuery['progress']) @foreach($searchQuery['progress'] as $obj) @if('Under Construction'==$obj) selected @endif @endforeach @endif>
                              Under Construction
                            </option>

                            <option value="Pre-Launch" @if($searchQuery['progress']) @foreach($searchQuery['progress'] as $obj) @if('Pre-Launch'==$obj) selected @endif @endforeach @endif>
                              Pre Launch
                            </option>

                            <option value="Ready for Possession" @if($searchQuery['progress']) @foreach($searchQuery['progress'] as $obj) @if('Ready for Possession'==$obj) selected @endif @endforeach @endif>
                              Ready for Possession
                            </option>

                          </select>
                        </div>

                      </div>

                      <div class="form-row" style="margin-top: 2%;">



                        <!-- <div class="col-12 col-md-4 col-lg-4 col-xl-4">
                                <label class="search_heading">Progress</label>   
                                <select class="selectpicker col-12" name="tag_id[]" multiple multiple multiple data-live-search="true" data-live-search-placeholder="Search">
                                                            
                                  <option value="hello">
                                    asif1
                                  </option>

                                  <option value="hello">
                                    asif2
                                  </option>

                                  <option value="hello">
                                    asif3
                                  </option>
                                            
                                </select>
                                </div> -->

                        

                        <div class="col-12 col-md-3 col-lg-3 col-xl-3">

                          <label class="search_heading">Date Range To</label> <br>
                          <input type="date" name="from" max="3000-12-31" min="1000-01-01" class="form-control" value={{ $searchQuery['from']}}>  
                        </div>

                        <div class="col-12 col-md-3 col-lg-3 col-xl-3">
                        <label class="search_heading">Date Range From</label>   
                        <input type="date" name="to" max="3000-12-31" min="1000-01-01" class="form-control" value={{ $searchQuery['to']}}>
                          
                        </div>


                        <div class="col-12 col-md-3 col-lg-3 col-xl-3">

                          <label class="search_heading">-</label><br>
                          <button type="submit" class="btn admin_ad_btn_red mb-2">Search</button>

                        </div>
                      </div>

                      <!-- <div class="form-row" style="margin-top: 2%;">
                               
                              <div class="col-12 col-md-4 col-lg-4 col-xl-4">
                                
                                <label class="search_heading">Date Range</label> <br>
                                <input class="form-control" type="text" name="daterange" value="01/01/2018 - 01/15/2018" />
                                </div>

                              <div class="col-12 col-md-4 col-lg-4 col-xl-4">

                                <label class="search_heading">-</label><br>   
                                <button type="submit" class="btn btn-danger mb-2">Search</button>
                                </div>


                              <div class="col-12 col-md-4 col-lg-4 col-xl-4">
                                
                                
                                </div>

                                
                               

                               
                                

                                

                              </div> -->

                    </form>

                  </div>

                </div>
            </section>

          </div>
          <!--begin: Search Form-->
          <!--begin::Search Form-->
          <div class="mb-7">
            <div class="row align-items-center">
              <div class="col-lg-9 col-xl-8">

              </div>
              <div class="col-lg-3 col-xl-4 mt-5 mt-lg-0">
                {{-- <a href="#" class="btn btn-light-primary px-6 font-weight-bold">Search</a> --}}
                <!-- <div class="input-icon" style="float: right">
                  <input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query" />
                  <span>
                    <i class="flaticon2-search-1 text-muted"></i>
                  </span>
                </div> -->
              </div>
            </div>
          </div>
          <!--end::Search Form-->
          <!--end: Search Form-->
          <!--begin: Datatable-->

          <div class="table_wrapper">

            <table class="datatable datatable-bordered datatable-head-custom table_wrapper table-bordered text-center" id="kt_datatable">
              <thead>
                <tr>
                  <th title="Field #1" style="width:20px">#</th>
                  <th title="Field #2">Project Name</th>
                  <th title="Field #3">Address</th>
                  <th title="Field #4">Area</th>
                  {{-- <th title="Field #5">Latitude</th> --}}
                  {{-- <th title="Field #6">Longitude</th> --}}

                  <th title="Field #8">Progress</th>
                  <th>status</th>
                  <th>Added By</th>
                  <th title="Field #9">Actions</th>
                </tr>
              </thead>
              <tbody> 
              @foreach ($projects as $project) 
              <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $project->name }}</td>
                <td>{{ $project->address }} Star</td>
                <td>
                  @foreach ($project->areas as $area)
                    {{ $area->Area->name ?? '' }} {{ !$loop->last ? ', ' : '' }}
                  @endforeach
                </td>
                {{-- <td>{{ $project->location->name }}</td> --}}
                <td>{{ $project->progress }}</td>
                <td>{{ $status[$project->status - 1] }}</td>
                <td>
                  {{ (count($project->users) > 0 ) ? $project->users[0]->name: "--" }}
                </td>
                <td><a href="/admin/project/{{ $project->slug }}"><i class="fa fa-eye"></i></a>
                  <a href="/admin/project/{{ $project->slug }}/edit"><i class="fa fa-edit ml-2"></i></a>
                  <!-- <a href="/admin/project/{{ $project->slug }}/delete" onclick="javascript: return confirm('Please confirm deletion');">
                    <i class="fa fa-trash ml-2"></i>
                  </a> -->
                  <a href="javascript:void(0)" onclick="deleteProjectIsArchive('{{ $project->id }}')">
                    <i class="fa fa-trash ml-2"></i>
                  </a>
                </td>
              </tr>
                @endforeach
              </tbody>
            </table>

          </div>

          <!--end: Datatable--
        </div>
      </div>
      <!- end::Card -->
        <!-- </div> --> <!-- Important line of foooter -->
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css" integrity="sha512-f8gN/IhfI+0E9Fc/LKtjVq4ywfhYAVeMGKsECzDUHcFJ5teVwvKTqizm+5a84FINhfrgdvjX8hEJbem2io1iTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css" integrity="sha512-hwwdtOTYkQwW2sedIsbuP1h0mWeJe/hFOfsvNKpRB3CkRxq8EW7QMheec1Sgd8prYxGm1OM9OZcGW7/GUud5Fw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @endsection

    @section('footer')
    <!--begin::Page Scripts(used by this page)-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js" integrity="sha512-MqEDqB7me8klOYxXXQlB4LaNf9V9S0+sG1i8LtPOYmHqICuEZ9ZLbyV3qIfADg2UJcLyCm4fawNiFvnYbcBJ1w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js" integrity="sha512-XVz1P4Cymt04puwm5OITPm5gylyyj5vkahvf64T8xlt/ybeTpz4oHqJVIeDtDoF5kSrXMOUmdYewE4JS/4RWAA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="assets/js/pages/custom/projects/add-project.js"></script>
    <script src="assets/js/pages/crud/ktdatatable/base/html-table.js"></script>
    <!--end::Page Scripts-->
    <script>
      $(function() {
        $('input[name="daterange"]').daterangepicker({
          opens: 'center'
        }, function(start, end, label) {
          console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
      });

      function deleteProjectIsArchive(project_id) {
        // let objProject = JSON.parse(project);
        console.log("deleteProjectIsArchive -> project -> id -> ", project_id);
        // ShowSweetAlert({
        //   title: 'Shortlisted!',
        //   text: 'Candidates are successfully shortlisted!',
        //   icon: 'success'
        // });
        if (parseInt(project_id)) {
          ShowSweetAlertConfirm({
            title: "Are you sure ?",
            text: "You want to delete this project!",
            icon: "warning",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: `Yes`,
            denyButtonText: `No`,
          }, function(result) {
            if (result.isConfirmed) {
              let requestRoute = "/admin/project/tarsh/delete";
              let requestParams = {
                project_id: project_id
              }
              CallLaravelAction(requestRoute, requestParams, function(response) {
                if (response.status) {
                  let SweetAlertParams = {
                    icon: "success",
                    title: response.message,
                    showConfirmButton: true,
                    timer: 10000,
                  };
                  ShowSweetAlert(SweetAlertParams);
                  location.reload();
                  // ShowSuccess(response.message);
                  HideLoader();
                } else {
                  var ErrorMsg = response.message;
                  if (typeof response.error !== "undefined") {
                    if (typeof response.error.project_id !== "undefined") {
                      ErrorMsg = response.error.project_id;
                    }
                    // if (typeof response.error.phone_number !== "undefined") {
                    //   ErrorMsg = response.error.phone_number;
                    // }
                  }
                  let SweetAlertParams = {
                    icon: "error",
                    title: ErrorMsg,
                    showConfirmButton: true,
                    timer: 20000,
                  };
                  ShowSweetAlert(SweetAlertParams);
                  // ShowError(ErrorMsg);
                  HideLoader();
                }
              });
            }
          });
        }
      }
    </script>
    @endsection