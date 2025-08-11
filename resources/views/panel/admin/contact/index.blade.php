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
            <h5 class="text-dark font-weight-bold my-1 mr-5">Contact Inquiry Management</h5>
            <!--end::Page Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
              <li class="breadcrumb-item text-muted">
                <a href="" class="text-muted">Contact Inquiry Details</a>
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
                <h3 class="card-label">Contact Inquiry</h3>
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

                <div class="col-12">

                <section class="search-sec">
                      <div class="container">

                      <div class="card" style="margin-bottom: 2%;">
                          <div class="card-body">

                          <form method="POST" action="/admin/contact">
                          @csrf
                              <div class="form-row">
                                <div class="col-12 col-md-4 col-lg-4 col-xl-4">
                                <label class="search_heading">Contact Name</label>
                                <input class="form-control" type="text" placeholder="Name" name="name" value={{ $searchQuery['name'] }}>
                                </div>
                                <div class="col-12 col-md-4 col-lg-4 col-xl-4">

                                <label class="search_heading">Contact Email</label>
                                <input class="form-control" type="email" placeholder="Email" name="email" value={{ $searchQuery['email'] }}>
                                
                                </div>
                                <div class="col-12 col-md-4 col-lg-4 col-xl-4">
                                
                                <label class="search_heading">Phone</label>   
                                <input class="form-control" type="number" placeholder="Phone" name="phone" min="0" value={{ $searchQuery['phone'] }}>

                                </div>

                               

                              </div>

                              <div class="form-row" style="margin-top: 2%;">
                                <div class="col-12 col-md-3 col-lg-3 col-xl-3">
                                <label class="search_heading">Subject</label>   
                                <input class="form-control" type="text" placeholder="Subject" name="subject" value={{ $searchQuery['subject'] }}>
                                </div>
                                

                                <div class="col-12 col-md-3 col-lg-3 col-xl-3">
                                <label class="search_heading">Message</label><br>
                                <input class="form-control" type="text" placeholder="Message" name="message" value={{ $searchQuery['message'] }}>
                                </div>

                                <div class="col-12 col-md-2 col-lg-2 col-xl-2">
                                <label class="search_heading">Date Range From</label> <br>
                                <input type="date" name="from" max="3000-12-31" min="1000-01-01" class="form-control" value={{ $searchQuery['from'] }}> 
                                
                                </div>

                                <div class="col-12 col-md-2 col-lg-2 col-xl-2">
                                <label class="search_heading">Date Range To</label> <br>
                                <input type="date" name="to" max="3000-12-31" min="1000-01-01" class="form-control" value={{ $searchQuery['to'] }}>
                                
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

                    <select class="selectpicker col-6 col-lg-4" name="field[]" id="selectedFields" data-actions-box="true" multiple multiple multiple data-live-search="true" data-live-search-placeholder="Search">
                                  
                                    
                                  
                                    
                                  <option value="Name">Name</option>
                                  <option value="Email">Email</option>
                                  <option value="Phone">Phone</option>
                                  <option value="Message">Message</option>
                                  <option value="Subject">Subject</option>
                                          
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
                    <th>Subject</th>
                    <th>Message</th>
                    
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($contactus as $contact)
                    <tr>
                      <td>{{ $loop->index + 1 }}</td>
                      <td>
                      {{ $contact->created_at }}
                      </td>
                      <td>{{ $contact->name }}</td>
                      <td>{{ $contact->email }}</td>
                      <td>{{ $contact->phone }}</td>
                      
                      <td>{{ $contact->subject }}</td>
                      <td>
                      {{ $contact->message }}
                    </td>
                    
                    <td>
                      <a href="/admin/contact/{{ $contact->id }}"><i class="fa fa-eye ml-2"></i></a>
                      
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
      opens: 'center'
    }, function(start, end, label) {
      console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
    });
  });

  function downloadData(){
    let selectedFields = $("#selectedFields").val();
    window.open(`${window.location.origin}/admin/export/contact?fields=${selectedFields}`)
  }
  </script>
@endsection
