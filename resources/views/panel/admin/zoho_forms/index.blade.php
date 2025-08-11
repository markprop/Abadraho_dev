@extends('panel.layouts.master1')

<style>
    .w-5 {
        width: 20px;
        height: 20px;
        display: initial;
    }

    nav.flex.items-center.justify-between {
        margin-top: 30px !important;
    }

    .flex.justify-between.flex-1.sm\:hidden {
        display: none;
    }

    p.text-sm.text-gray-700.leading-5 {
        float: right;
    }

    .datatable-pager-info.my-2.mb-sm-0 {
        display: none !important;
    }

    .datatable-pager.datatable-paging-loaded {
        margin-bottom: 15px !important;
    }

    .datatable-pager-nav {
        display: none !important;
    }
</style>

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
                                <a href="" class="text-muted">Zoho Forms</a>
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
                                <h3 class="card-label">Zoho Forms</h3>
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

                                                    <form method="GET" action="/admin/listing">
                                                        @csrf
                                                        <div class="form-row">
                                                            <div class="col-12 col-md-3 col-lg-3 col-xl-3">
                                                                <label class="search_heading">Name</label><br>
                                                                <input class="form-control" name="name" type="text"
                                                                    placeholder="Name" value={{ $searchQuery['name'] }}>
                                                            </div>
                                                            <div class="col-12 col-md-3 col-lg-3 col-xl-3">

                                                                <label class="search_heading">Email</label>
                                                                <input class="form-control" name="email" type="email"
                                                                    placeholder="Email" value={{ $searchQuery['email'] }}>

                                                            </div>
                                                            <div class="col-12 col-md-3 col-lg-3 col-xl-3">

                                                                <label class="search_heading">Phone</label> <br>
                                                                <input class="form-control" name="phone_number"
                                                                    type="number" placeholder="Phone" min="0"
                                                                    value={{ $searchQuery['phone_number'] }}>

                                                            </div>

                                                            <div class="col-12 col-md-3 col-lg-3 col-xl-3">

                                                                <label class="search_heading">Address</label><br>
                                                                <input class="form-control" name="address" type="text"
                                                                    placeholder="Address"
                                                                    value={{ $searchQuery['address'] }}>

                                                            </div>

                                                        </div>

                                                        <div class="form-row" style="margin-top: 3%;">
                                                            <div class="col-12 col-md-3 col-lg-3 col-xl-3">
                                                                <label class="search_heading">Project Interested In</label>
                                                                <br>
                                                                <select class="selectpicker"onChange="handleChange()"
                                                                    name="project_id[]" multiple multiple multiple
                                                                    data-live-search="true" data-actions-box="true"
                                                                    data-live-search-placeholder="Search">
                                                                    @foreach ($allProjects as $project)
                                                                        <option value={{ $project['id'] }}
                                                                            @if ($searchQuery['project_id']) @foreach ($searchQuery['project_id'] as $obj)
                                          @if ($obj == $project['id'])
                                          selected @endif
                                                                            @endforeach
                                                                    @endif
                                                                    >
                                                                    {{ $project['name'] }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-12 col-md-3 col-lg-3 col-xl-3">
                                                                <label class="search_heading">Unit Interested In</label>
                                                                <br>
                                                                <select class="selectpicker" name="unit_id[]" multiple
                                                                    multiple multiple data-live-search="true"
                                                                    data-actions-box="true"
                                                                    data-live-search-placeholder="Search">

                                                                    @foreach (\App\Models\Unit::get() as $unit)
                                                                        <option value={{ $unit['id'] }}
                                                                            @if ($searchQuery['unit_id']) @foreach ($searchQuery['unit_id'] as $obj)
                                          @if ($obj == $unit['id'])
                                          selected @endif
                                                                            @endforeach
                                                                    @endif
                                                                    >
                                                                    {{ $unit['title'] }}
                                                                    </option>
                                                                    @endforeach

                                                                </select>
                                                            </div>

                                                            <div class="col-12 col-md-2 col-lg-2 col-xl-2">
                                                                <label class="search_heading">Date Range From</label>
                                                                <input type="date" name="from" max="3000-12-31"
                                                                    min="1000-01-01" class="form-control"
                                                                    value={{ $searchQuery['from'] }}>
                                                            </div>

                                                            <div class="col-12 col-md-2 col-lg-2 col-xl-2">
                                                                <label class="search_heading">Date Range To</label>
                                                                <input type="date" name="to" max="3000-12-31"
                                                                    min="1000-01-01" class="form-control"
                                                                    value={{ $searchQuery['to'] }}>
                                                            </div>


                                                            <div class="col-12 col-md-2 col-lg-2 col-xl-2">
                                                                <label class="search_heading">-</label><br>
                                                                <button type="submit"
                                                                    class="btn admin_ad_btn_red mb-2">Search</button>
                                                            </div>



                                                        </div>

                                                    </form>

                                                </div>

                                            </div>
                                    </section>

                                    <select class="selectpicker col-6 col-lg-4" name="field[]" id="selectedFields" multiple
                                        multiple multiple data-live-search="true" data-live-search-placeholder="Search"
                                        data-actions-box="true">




                                        <option value="Project Interested In">Project Interested In</option>
                                        <option value="Unit Interested In">Unit Interested In</option>

                                    </select>
                                    <div class="dropdown dropdown-inline mr-2" style="float: right">
                                        <button type="button"
                                            class="btn btn-light-primary font-weight-bolder dropdown-toggle"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="svg-icon svg-icon-md">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                    height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none"
                                                        fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24"
                                                            height="24"></rect>
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
                                                <li
                                                    class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">
                                                    Choose an option:
                                                </li>

                                                <li class="navi-item">
                                                    <a href="javascript:void(0)" onclick="downloadData()"
                                                        class="navi-link">
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

                            <table class="datatable datatable-bordered datatable-head-custom table-bordered text-center"
                                id="kt_datatable">
                                <thead class="thead-dark">
                                    <tr>
                                        <th title="Field #1" style="width:20px">#</th>
                                        <th title="Field #7">Date/Time</th>
                                        <th title="Field #2">Name</th>
                                        <th title="Field #3">Email</th>
                                        <th title="Field #4">Phone Number</th>
                                        <th title="Field #5">Address</th>
                                        <th title="Field #5">Project Interested In</th>
                                        <th title="Field #6">Unit Interested In</th>
                                        <th title="Field #8">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($inquiries as $inquiry)
                                        <tr>
                                            <?php $paginationSerial = $inquiries->perPage() * ($inquiries->currentPage() - 1) + 1; ?>
                                            <td>{{ $paginationSerial + $loop->index }}</td>
                                            {{-- <td>{{ $loop->index + 1 }}</td> --}}
                                            <td>{{ $inquiry->created_at }}</td>
                                            <td>{{ $inquiry->name }}</td>
                                            <td>{{ $inquiry->email }}</td>
                                            <td>{{ $inquiry->phone_number }}</td>
                                            <td>{{ $inquiry->address }}</td>
                                            <td>{{ $inquiry->project->name ?? ''}}</td>
                                            <td>{{ $inquiry->unit->title }}</td>
                                            {{-- <td>{{ $units[$record->unit_id - 1]->title }}</td> --}}
                                            <td><a href="/admin/listing/{{ $inquiry->id }}"><i
                                                        class="fa fa-eye ml-2"></i></a>
                                                <!-- <a onclick="javascript: return confirm('Please confirm deletion');"
                                        href="/admin/inquiry/{{ $inquiry->id }}/delete"><i class="fa fa-trash ml-2"></i></a>-->
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $inquiries->links() }}
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
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end
                    .format('YYYY-MM-DD'));
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
            window.open(
                `${window.location.origin}/admin/export/listing?fields=${selectedFields}&searchQuery=${btoa(searchQuery)}`
            )
        }
    </script>
@endsection
