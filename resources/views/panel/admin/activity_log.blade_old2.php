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
              <a href="" class="text-muted">Activity Logs Details</a>
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
          <div class="col-xs-12">
            <div class="card-title">
              <h3 class="card-label">Welcome to Activity Logs</h3>
            </div>
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
                {{-- <a href="#" class="btn btn-light-primary px-6 font-weight-bold">Search</a> --}}
                <div class="input-icon" style="float: right">
                  <input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query" />
                  <span>
                    <i class="flaticon2-search-1 text-muted"></i>
                  </span>
                </div>
              </div>
            </div>
          </div>
          <!--end::Search Form-->
          <!--end: Search Form-->
          <!--begin: Datatable-->

          <!-- <div class="row">
            <div class="col-12 d-flex pt-4" class="li: { list-style: none; }">
              {!! $data->render('pagination::bootstrap-4') !!}
            </div>
          </div> -->

          <div class="col-md-12 display-flex mb-7">
            <div class="col-md-6">
            <!-- {!! $data->render('pagination::bootstrap-4') !!} -->
            </div>
            <div class="col-md-6 text-right b-600">
              <span style="">
                Showing {{ $data->firstItem() }} to {{ $data->lastItem() }} of {{ $data->total() }} results
              </span>
            </div>
          </div>

          <table class="table table-bordered" style="border-collapse:collapse;font-size:11px;font-weight: 600;" id="kt_datatable">
            <thead>
              <tr style="color: #ec1c24;" class="font-size-xl">
                <th>#</th>
                <th>Date/Time</th>
                <th>Users</th>
                <th>Conversions</th>
                <th>Description</th>
                <th>Duration</th>
                <th>IP</th>
                
              </tr>
            </thead>

            @foreach ($data as $datum)
            <tbody>

              <tr class="view font-size-lg" data-toggle="collapse" data-target="#demo-{{$loop->index}}">
                <?php $paginationSerial =  $data->perPage() * ($data->currentPage() - 1) + 1 ?>
                <td>{{$paginationSerial + $loop->index}}</td>
                <td>{{$datum->formated_created_at ? $datum->formated_created_at : '-'}}</td>
                <td>
                  <span>{{$datum->full_name ? $datum->full_name : '-'}}</span> <br>
                  <span>{{$datum->phone_number ? $datum->phone_number : '-'}}</span><br>
                  <span>{{$datum->email ? $datum->email : '-'}}</span>
                </td>
                <td><span>{{$datum->conversionDescription ? $datum->conversionDescription : '-'}}</span></td>
                <td>
                  <div style="max-width: 150px;">
                    <span>{{$datum->description ? $datum->description : '-'}}</span> <br>
                    <span>
                      @if($datum->page_url != null)
                      <a href="{{$datum->page_url ? $datum->page_url : '#'}}" class="" target="_blank"> {{$datum->page_url}}</a>
                      @endif
                    </span>
                  </div>

                </td>
                <td>{{$datum->duration_in_minutes ? $datum->duration_in_minutes : '-'}}</td>

                <td>{{$datum->ip ? $datum->ip : '-'}}</td>
                
              </tr>
              {{-- <tr id="demo-{{$loop->index}}" class="collapse">
              <td colspan="6" class="hiddenRow">
                <div>
                  <br>
                  <h3>User Details</h3>
                  <br>
                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>User Type</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>City</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>{{ $logProp[$loop->index]['attributes']['first_name']}}{{ $logProp[$loop->index]['attributes']['last_name']}}
                        </td>
                        <td>{{ $logProp[$loop->index]['attributes']['user_type_id']}}</td>
                        <td>{{ $logProp[$loop->index]['attributes']['phone_number']}}</td>
                        <td>{{ $logProp[$loop->index]['attributes']['email']}}</td>
                        <td>{{ $logProp[$loop->index]['attributes']['Address']}}</td>
                        <td>{{ $logProp[$loop->index]['attributes']['city']}}</td>

                      </tr>

                    </tbody>
                  </table>
                </div>
              </td>
              </tr> --}}
            </tbody>
            @endforeach

          </table>
          <!--end: Datatable-->
          <div class="col-md-12 display-flex">
            <div class="col-md-6">
            {!! $data->render('pagination::bootstrap-4') !!}
            </div>
            <div class="col-md-6 text-right b-600">
              <span style="">
                Showing {{ $data->firstItem() }} to {{ $data->lastItem() }} of {{ $data->total() }} results
              </span>
            </div>
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


  </style>
  @endsection

  @section('footer')

  <script>
    $(function() {
      $(".fold-table tr.view").on("click", function() {
        $(this).toggleClass("open").next(".fold").toggleClass("open");
      });
    });
  </script>
  @endsection