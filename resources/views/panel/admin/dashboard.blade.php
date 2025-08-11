@extends('panel.layouts.master1')

@section('content')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Details-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Admin Dashboard</h5>


                <!--end::Title-->
                <!--begin::Separator-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>


                <!--end::Separator-->
            </div>
            <!--end::Details-->
        </div>
    </div>
    <!--end::Subheader-->

    <div class="container">

        <div class="row">
            <div class="col-sm-6 col-md-3">
                <a href="/admin/project">
                    <div class="dashboard-report-card card purple">
                        <div class="card-content">
                            <span class="card-title">Projects</span>
                            <span class="card-amount">{{$totalProjects}}</span>
                            <span class="card-desc">All Projects</span>
                        </div>
                        <div class="card-media">
                            <i class="fa fa-opencart"></i>
                        </div>
                    </div>
                </a>
            </div>
            @if($admin)
            <div class="col-sm-6 col-md-3">
                <a href="/admin/builder">
                    <div class="dashboard-report-card card pink">
                        <div class="card-content">
                            <span class="card-title">Builders</span>
                            <span class="card-amount">{{$totalBuilders}}</span>
                            <span class="card-desc">Total Builders</span>
                        </div>
                        <div class="card-media">
                            <i class="fa fa-building-o" aria-hidden="true"></i>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-md-3">
            <a href="/admin/cutomers">
                <div class="dashboard-report-card card info">
                    <div class="card-content">
                        <span class="card-title">Customers</span>
                        <span class="card-amount">{{$totalWebSiteUser}}</span>
                        <span class="card-desc">Total Customers</span>
                    </div>
                    <div class="card-media">
                        <i class="fa fa-user-o"></i>
                    </div>
                </div>
            </div>
            @endif
            <div class="col-sm-6 col-md-3">
            <a href="/admin/favorites">
                <div class="dashboard-report-card card success">
                    <div class="card-content">
                        <span class="card-title">Favorites</span>
                        <span class="card-amount">{{$totalFavorites}}</span>
                        <span class="card-desc">Total Favorites</span>
                    </div>
                    <div class="card-media">
                        <i class="fa fa-heart"></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <a href="/admin/pending/project">
                    <div class="dashboard-report-card card info">
                        <div class="card-content">
                            <span class="card-title">Pending</span>
                            <span class="card-amount">{{$totalPendingProjects}}</span>
                            <span class="card-desc">Total Pending Projects</span>
                        </div>
                        <div class="card-media">
                            <i class="fa fa-building-o"></i>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-md-3">
                <a href="/admin/active/project">
                    <div class="dashboard-report-card card info">
                        <div class="card-content">
                            <span class="card-title">Active</span>
                            <span class="card-amount">{{$totalActiveProjects}}</span>
                            <span class="card-desc">Total Active Projects</span>
                        </div>
                        <div class="card-media">
                            <i class="fa fa-building-o"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>

    </div>


</div>



@endsection