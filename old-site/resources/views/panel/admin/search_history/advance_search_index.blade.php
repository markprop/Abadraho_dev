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

                  <div class="input-icon" style="float: right">
                    <input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query" />
                    <span>
                      <i class="flaticon2-search-1 text-muted"></i>
                    </span>
                  </div>
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
                          <a href="{{ route('admin.search_history.excel') }}" class="navi-link">
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
            <table class="datatable datatable-bordered datatable-head-custom" id="kt_datatable">
              <thead>
                <tr>
                  <th title="Field #1" style="width:20px">#</th>
                  <th title="Field #2">User Name</th>
                  <th title="Field #3">area</th>
                  <th title="Field #4">progress</th>
                  <th title="Field #5">type</th>
                  <th title="Field #5">Builder</th>
                  <th title="Field #6">Down Payment</th>
                  <th title="Field #7">Monthly Installment</th>
                  <th title="Field #8">Price</th>
                  {{-- <th title="Field #7">Actions</th> --}}
                </tr>
              </thead>
              <tbody>
                @foreach ($userHistorys as $userHistory)
                  <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>
                      @if ($userHistory->user)
                        {{ $userHistory->user->first_name }} {{ $userHistory->user->last_name }}
                      @else
                        Visitor
                      @endif
                    </td>
                    <td>
                      @if (is_array($searchData[$loop->index]['area']))
                        @foreach ($searchData[$loop->index]['area'] as $area)
                          {{-- {{ $area }} --}}
                          {{ \App\Models\Area::where(['id' => $area])->pluck('name')->first() }}
                          <br>
                        @endforeach
                      @else
                        {{ $searchData[$loop->index]['area'] }}
                      @endif
                    </td>
                    <td>
                      @if (is_array($searchData[$loop->index]['progress']))
                        @foreach ($searchData[$loop->index]['progress'] as $progress)
                          {{ $progress }}
                          {{-- {{ \App\Models\Area::where(['id' => $progress])->pluck('name')->first() }} --}}
                          <br>
                        @endforeach
                      @else
                        {{ $searchData[$loop->index]['progress'] }}
                      @endif
                    </td>
                    <td>
                      @if (is_array($searchData[$loop->index]['type']))
                        @foreach ($searchData[$loop->index]['type'] as $type)
                          {{-- {{ $type }} --}}
                          {{ \App\Models\ProjectType::where(['id' => $type])->pluck('title')->first() }}
                          <br>
                        @endforeach
                      @else
                        {{ $searchData[$loop->index]['type'] }}
                      @endif
                    </td>

                    <td> @if (is_array($searchData[$loop->index]['builder']))
                        @foreach ($searchData[$loop->index]['builder'] as $builder)
                          {{-- {{ $builder }} --}}
                          {{ \App\Models\Builder::where(['id' => $builder])->pluck('full_name')->first() }}
                          <br>
                        @endforeach
                      @else
                        {{ $searchData[$loop->index]['builder'] }}
                      @endif</td>
                    <td>{{ $searchData[$loop->index]['minDP'] }} - {{ $searchData[$loop->index]['maxDP'] }}</td>
                    <td>{{ $searchData[$loop->index]['minMI'] }} - {{ $searchData[$loop->index]['maxMI'] }}</td>
                    <td>{{ $searchData[$loop->index]['minPrice'] }} - {{ $searchData[$loop->index]['maxPrice'] }}
                    </td>
                    {{-- <td>
                                        <a href="/admin/listing/{{ $record->id }}">
                                            <i class="fa fa-eye ml-2"></i>
                                        </a>
                                        <a href="/admin/record/{{ $record->id }}/delete">
                                            <i class="fa fa-trash ml-2"></i>
                                        </a>
                                    </td> --}}
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
  <script src="assets/js/pages/custom/projects/add-project.js"></script>
  <script src="assets/js/pages/crud/ktdatatable/base/html-table.js"></script>
  <!--end::Page Scripts-->
@endsection
