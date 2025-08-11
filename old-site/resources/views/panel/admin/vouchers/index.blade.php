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
                                <a href="admin/voucher" class="text-muted">Vouchers</a>
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
                                <h3 class="card-label">Vouchers</h3>
                            </div>
                        </div>
                        <div class="col-xs-6 text-xs-right">
                            <a href="/admin/voucher/create" type="button" class="btn admin_ad_btn_red mr-2">Add Voucher</a>
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
                                    <!-- <a href="#" class="btn btn-light-primary px-6 font-weight-bold">Search</a> -->
                                    <div class="input-icon" style="float: right">
                                        <input type="text" class="form-control" placeholder="Search..."
                                            id="kt_datatable_search_query" />
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
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th title="Field #1" style="width:20px">#</th>
                                    {{-- <th title="Field #2">Code</th> --}}
                                    <th title="Field #3">Name</th>
                                    <th title="Field #4">Project</th>
                                    <th title="Field #5">Discount</th>
                                    <th title="Field #6">Created Date</th>
                                    <th title="Field #7">Expiry Date</th>
                                    <th title="Field #8">Status</th>
                                    <th title="Field #9">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vouchers as $key => $voucher)
                                    <tr>
                                      <input type="hidden" class="serdelete_val" value="{{ $voucher->id }}">
                                      <td>{{ $loop->index + 1 }}</td>
                                      {{-- <td>{{ $voucher->code }}</td> --}}
                                      <td>{{ $voucher->name }}</td>
                                      <td>{{ $voucher->project->name ?? '' }}
                                        @if($voucher->discount_applied == 'unit')
                                        <br>
                                          @foreach ( $voucher->units_voucher as $selected_unit)
                                            <span class="units-span">{{ $selected_unit->unit->title }}</span>
                                          @endforeach
                                        @endif
                                      </td>
                                      <td>{{ $voucher->discount_by == 'amount' ? 'PKR.' : '' }}
                                          {{ $voucher->discount_value }}
                                          {{ $voucher->discount_by == 'percentage' ? ' %' :'' }}
                                      </td>
                                      <td>{{ $voucher->created_at }}</td>
                                      <td>{{ $voucher->expires_at }}</td>
                                      <td>{{ $status[$voucher->status] }}</td>
                                      <td>
                                          <a href="/admin/voucher/{{ $voucher->id }}/edit"><i class="fa fa-edit ml-2"></i></a>
                                          <a href="/admin/voucher/delete/{{ $voucher->id }}"><i class="fa fa-trash servicedeletebutton"></i></a>
                                      </td>
                                    </tr>
                                @endforeach
                                @if (count($vouchers) == 0)
                                <tr>
                                    <td colspan="9" style="text-align: center;">
                                        <span class="datatable-error">No records found</span>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                        <!--end: Datatable-->
                        {{$vouchers->links()}}
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
    <!-- <link href="{{ asset('assets/css/pages/wizard/wizard-1.css') }}" rel="stylesheet" type="text/css" /> -->
    <!--end::Page Custom Styles-->
    <style>
        .datatable.datatable-default>.datatable-table>.datatable-head .datatable-row>.datatable-cell:nth-child(1)>span,
        .datatable.datatable-default>.datatable-table>.datatable-body .datatable-row>.datatable-cell:nth-child(1)>span {
            width: 40px !important;
        }
        .units-span{
            padding: 2px 6px;
            line-height: 24px;
            border-radius: 4px;
            background-color: #eb1f29;
            color: #fff;
            font-weight: 700;
            font-size: 12px;
            position: relative;
            white-space: pre;
        }
    </style>
@endsection

@section('footer')
    <!--begin::Page Scripts(used by this page)-->
    <script src="assets/js/pages/custom/projects/add-project.js"></script>
    <script src="assets/js/pages/crud/ktdatatable/base/html-table.js"></script>
    <!--end::Page Scripts-->

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.servicedeletebutton').click(function(e) {
                e.preventDefault();
                var delete_id = $(this).closest("tr").find('.serdelete_val').val();
                //alert(delete_id);
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover your data!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                        buttons: ['No', 'Yes']
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            var data = {
                                "_token": $('input[name= _token]').val(),
                                "id": delete_id,
                            }
                            $.ajax({
                                type: "DELETE",
                                url: 'admin/voucher/delete/' + delete_id,
                                data: data,
                                success: function(response) {
                                    swal(response.status, {
                                            icon: "success",
                                        })
                                        .then((result) => {
                                            location.reload();
                                        });
                                }
                            });
                        }
                    });
            });
        });
    </script>

    <!-- <script>
        function deletetIsArchive(voucher_id) {
            if (parseInt(voucher_id)) {
                ShowSweetAlertConfirm({
                    title: "Are you sure?",
                    text: "You want to delete this Voucher!",
                    icon: "warning",
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: `Yes`,
                    denyButtonText: `No`,
                }, function(result) {
                    if (result.isConfirmed) {
                        let requestRoute = "/admin/voucher/delete";
                        let requestParams = {
                            voucher_id: voucher_id
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
                                HideLoader();
                            } else {
                                var ErrorMsg = response.message;
                                if (typeof response.error !== "undefined") {
                                    if (typeof response.error.voucher_id !== "undefined") {
                                        ErrorMsg = response.error.voucher_id;
                                    }
                                }
                                let SweetAlertParams = {
                                    icon: "error",
                                    title: ErrorMsg,
                                    showConfirmButton: true,
                                    timer: 20000,
                                };
                                ShowSweetAlert(SweetAlertParams);
                                HideLoader();
                            }
                        });
                    }
                });
            }
        }
    </script> -->
@endsection
