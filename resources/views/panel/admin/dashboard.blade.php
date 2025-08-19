@extends('panel.layouts.master1')

@section('content')
    <!-- Begin: Main Content Container -->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!-- Begin: Subheader Section -->
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!-- Begin: Subheader Details -->
                <div class="d-flex align-items-center flex-wrap mr-2">
                    <!-- Begin: Page Title -->
                    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Admin Dashboard</h5>
                    <!-- End: Page Title -->

                    <!-- Begin: Separator -->
                    <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
                    <!-- End: Separator -->
                </div>
                <!-- End: Subheader Details -->
            </div>
        </div>
        <!-- End: Subheader Section -->

        <!-- Begin: Main Container for Dashboard Content -->
        <div class="container">
            <!-- Begin: Row for Dashboard Cards -->
            <div class="row">
                <!-- Begin: Projects Card -->
                <div class="col-sm-6 col-md-3">
                    <a href="/admin/project">
                        <div class="dashboard-report-card card purple">
                            <div class="card-content">
                                <span class="card-title">Projects</span>
                                <span class="card-amount">{{ $totalProjects }}</span>
                                <span class="card-desc">All Projects</span>
                            </div>
                            <div class="card-media">
                                <i class="fa fa-opencart"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- End: Projects Card -->

                @if($admin)
                    <!-- Begin: Builders Card -->
                    <div class="col-sm-6 col-md-3">
                        <a href="/admin/builder">
                            <div class="dashboard-report-card card pink">
                                <div class="card-content">
                                    <span class="card-title">Builders</span>
                                    <span class="card-amount">{{ $totalBuilders }}</span>
                                    <span class="card-desc">Total Builders</span>
                                </div>
                                <div class="card-media">
                                    <i class="fa fa-building-o" aria-hidden="true"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- End: Builders Card -->

                    <!-- Begin: Customers Card -->
                    <div class="col-sm-6 col-md-3">
                        <a href="/admin/cutomers">
                            <div class="dashboard-report-card card info">
                                <div class="card-content">
                                    <span class="card-title">Customers</span>
                                    <span class="card-amount">{{ $totalWebSiteUser }}</span>
                                    <span class="card-desc">Total Customers</span>
                                </div>
                                <div class="card-media">
                                    <i class="fa fa-user-o"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- End: Customers Card -->

                    <!-- Begin: Brokers Card -->
                    <div class="col-sm-6 col-md-3">
                        <a href="/admin/brokers">
                            <div class="dashboard-report-card card info">
                                <div class="card-content">
                                    <span class="card-title">Brokers</span>
                                    <span class="card-amount">{{ $totalBrokers }}</span>
                                    <span class="card-desc">Total Brokers</span>
                                </div>
                                <div class="card-media">
                                    <i class="fa fa-users"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- End: Brokers Card -->
                @endif

                <!-- Begin: Favorites Card -->
                <div class="col-sm-6 col-md-3">
                    <a href="/admin/favorites">
                        <div class="dashboard-report-card card success">
                            <div class="card-content">
                                <span class="card-title">Favorites</span>
                                <span class="card-amount">{{ $totalFavorites }}</span>
                                <span class="card-desc">Total Favorites</span>
                            </div>
                            <div class="card-media">
                                <i class="fa fa-heart"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- End: Favorites Card -->

                <!-- Begin: Pending Projects Card -->
                <div class="col-sm-6 col-md-3">
                    <a href="/admin/pending/project">
                        <div class="dashboard-report-card card info">
                            <div class="card-content">
                                <span class="card-title">Pending</span>
                                <span class="card-amount">{{ $totalPendingProjects }}</span>
                                <span class="card-desc">Total Pending Projects</span>
                            </div>
                            <div class="card-media">
                                <i class="fa fa-building-o"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- End: Pending Projects Card -->

                <!-- Begin: Active Projects Card -->
                <div class="col-sm-6 col-md-3">
                    <a href="/admin/active/project">
                        <div class="dashboard-report-card card info">
                            <div class="card-content">
                                <span class="card-title">Active</span>
                                <span class="card-amount">{{ $totalActiveProjects }}</span>
                                <span class="card-desc">Total Active Projects</span>
                            </div>
                            <div class="card-media">
                                <i class="fa fa-building-o"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- End: Active Projects Card -->
            </div>
            <!-- End: Row for Dashboard Cards -->
        </div>
        <!-- End: Main Container for Dashboard Content -->
    </div>
    <!-- End: Main Content Container -->
@endsection