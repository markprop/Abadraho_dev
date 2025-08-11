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
            <h5 class="text-dark font-weight-bold my-1 mr-5">User Reviews Management</h5>
            <!--end::Page Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
              <li class="breadcrumb-item text-muted">
                <a href="" class="text-muted">User Reviews Details</a>
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
                <h3 class="card-label">User Reviews Details</h3>
              </div>
            </div>
            
            <div class="col-xs-6 text-xs-right">
              
            </div>
          
          </div>

          

          <div class="card-body">
            <!--begin: Search Form-->
            <!--begin::Search Form-->
            <div class="mb-7">
              <div class="row align-items-center">

                
                {{--<div class="col-lg-2 col-xl-2 mt-5 mt-lg-0">
                  <a href="#" class="btn btn-light-primary px-6 font-weight-bold">Search</a> 
                  <div class="input-icon" style="float: right">
                    <input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query" />
                    <span>
                      <i class="flaticon2-search-1 text-muted"></i>
                    </span>
                    
                  </div>
                  
                </div>--}}
                
              </div>
            </div>
            <!--end::Search Form-->
            <!--end: Search Form-->
            <!--begin: Datatable-->
            <div class="table_wrapper">

              <table class="datatable datatable-bordered datatable-head-custom table_wrapper table-bordered text-center" id="kt_datatable">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Date/Time</th>
                    <th>Name</th>
                    <th>email</th>
                    <th>Phone</th>
                    <th>Project Name</th>
                    <th>Ratings</th>
                    <th>Reviews</th>
                    
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($reviews as $review)
                    <tr>
                      <td>{{ $loop->index + 1 }}</td>
                      <td>
                      {{ $review->created_at }}
                      </td>
                      <td>{{ $review->user->first_name }}</td>
                      <td>{{ $review->user->email }}</td>
                      <td>{{ $review->user->phone_number }}</td>
                      <td>{{ $review->project->name }}</td>
                      <td>
                                              <?php $user_rated = $review->rating ?>
                                                <ul class="ml10">
                                                    @for($i=1; $i<= $user_rated; $i++)
                                                    <li class="list-inline-item"><a href="#"><i class="fa fa-star" style="color: #ffe400;"></i></a></li>
                                                    @endfor
                                                    @for($j = $user_rated+1; $j<=5; $j++)
                                                    <li class="list-inline-item"><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                    @endfor
                                                   
                                                </ul>
                      </td>
                      <td>
                      {{ $review->review }}
                    </td>
                    
                    <td>
                      <a href="/admin/projects/review/{{ $review->id }}"><i class="fa fa-eye ml-2"></i></a>
                      
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
  
@endsection
