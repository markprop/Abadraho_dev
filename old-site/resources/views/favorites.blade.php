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
          <h5 class="text-dark font-weight-bold my-1 mr-5">Favorites</h5>
          <!--end::Page Title-->
          <!--begin::Breadcrumb-->
          <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item text-muted">
             
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
              <h3 class="card-label">User who like the projects</h3>
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
              <div class="col-lg-9 col-xl-8">

              </div>
              <div class="col-lg-3 col-xl-4 mt-5 mt-lg-0">
               
                <div class="input-icon" style="float: right">
                </div>
              </div>
            </div>
          </div>
          <!--end::Search Form-->
          <!--end: Search Form-->
          <!--begin: Datatable-->
          <table class="datatable datatable-bordered datatable-head-custom table-bordered text-center" id="kt_datatable">
            <thead>
              <tr>
                <th title="Field #1" style="width:20px">#</th>
                <th title="Field #2">Username</th>
                <th title="Field #4">Project name</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($fav as $favs)
              <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>
                  @if(isset($favs->users))
                    {{ $favs->users->username }}  
                  @endif
                <td>
                  @if(isset($favs->projects))
                    {{ $favs->projects->name }}  
                  @endif
                </td>    
              </tr>
            @endforeach
            </tbody>
          </table>
          
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
<!-- <script src="assets/js/pages/custom/projects/add-project.js"></script> -->
<script src="assets/js/pages/crud/ktdatatable/base/html-table.js"></script>
<!--end::Page Scripts-->

@endsection