@extends('admin.layout.master')
@section('content')
<style>
    .hvr-underline-from-left {
        display: block;
    }
</style>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Dashboard</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">BFC</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">


                <div class="col-md-4">
                    <a href="{{ route('admin.show') }}">
                        <div class="card hvr-underline-from-left">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-1 overflow-hidden">
                                        <p class="text-truncate font-size-14 mb-2">All Shows</p>
                                        <h4 class="mb-0">{{ $showCount }}</h4>
                                    </div>
                                    <div class="text-primary ms-auto">
                                        <i class="ri-layout-3-line font-size-24"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body border-top py-3">
                                <div class="text-truncate">
                                    <!-- <span class="badge bg-success-subtle text-success  font-size-11"><i class="mdi mdi-menu-up"> </i> 2.4% </span> -->
                                    <span class="text-muted ms-2">Total active shows</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('admin.showtype') }}">
                        <div class="card hvr-underline-from-left">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-1 overflow-hidden">
                                        <p class="text-truncate font-size-14 mb-2">All Shows Type</p>
                                        <h4 class="mb-0">{{ $showtypeCount }}</h4>
                                    </div>
                                    <div class="text-danger ms-auto">
                                        <!-- <i class="ri-store-2-line font-size-24"></i> -->
                                        <i class="ri-image-fill text-danger font-size-24"></i>

                                    </div>
                                </div>
                            </div>
                            <div class="card-body border-top py-3">
                                <div class="text-truncate">
                                    <!-- <span class="badge bg-success-subtle text-success  font-size-11"><i class="mdi mdi-menu-up"> </i> 2.4% </span> -->
                                    <span class="text-muted ms-2">Total active show type</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('admin.showassign') }}">
                        <div class="card hvr-underline-from-left">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-1 overflow-hidden">
                                        <p class="text-truncate font-size-14 mb-2">All Assign Shows</p>
                                        <h4 class="mb-0">{{ $showassignCount }}</h4>
                                    </div>
                                    <div class="text-primary ms-auto">
                                        <!-- <i class="ri-briefcase-4-line font-size-24"></i> -->
                                        <i class="ri-newspaper-line text-warning font-size-24"></i>

                                    </div>
                                </div>
                            </div>
                            <div class="card-body border-top py-3">
                                <div class="text-truncate">
                                    <!-- <span class="badge bg-success-subtle text-success  font-size-11"><i class="mdi mdi-menu-up"> </i> 2.4% </span> -->
                                    <span class="text-muted ms-2">Total active show assign</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('admin.shorts') }}">
                        <div class="card hvr-underline-from-left">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-1 overflow-hidden">
                                        <p class="text-truncate font-size-14 mb-2">All Shorts</p>
                                        <h4 class="mb-0">{{ $shortsCount }}</h4>
                                    </div>
                                    <div class="text-primary ms-auto">
                                        <!-- <i class="ri-briefcase-4-line font-size-24"></i> -->
                                        <i class="ri-profile-line text-info font-size-24"></i>

                                    </div>
                                </div>
                            </div>
                            <div class="card-body border-top py-3">
                                <div class="text-truncate">
                                    <!-- <span class="badge bg-success-subtle text-success  font-size-11"><i class="mdi mdi-menu-up"> </i> 2.4% </span> -->
                                    <span class="text-muted ms-2">Total Shorts</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('admin.contact') }}">
                        <div class="card hvr-underline-from-left">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-1 overflow-hidden">
                                        <p class="text-truncate font-size-14 mb-2">All Contacts</p>
                                        <h4 class="mb-0">{{ $contactCount }}</h4>
                                    </div>
                                    <div class="text-primary ms-auto">
                                        <!-- <i class="ri-briefcase-4-line font-size-24"></i> -->
                                        <i class="ri-pencil-ruler-2-line text-success font-size-24"></i>

                                    </div>
                                </div>
                            </div>
                            <div class="card-body border-top py-3">
                                <div class="text-truncate">
                                    <!-- <span class="badge bg-success-subtle text-success  font-size-11"><i class="mdi mdi-menu-up"> </i> 2.4% </span> -->
                                    <span class="text-muted ms-2">Total Contact</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-4">
                    <a href="{{ route('admin.teammember') }}">
                        <div class="card hvr-underline-from-left">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-1 overflow-hidden">
                                        <p class="text-truncate font-size-14 mb-2">All Team Members</p>
                                        <h4 class="mb-0">{{ $MemberCount }}</h4>
                                    </div>
                                    <div class="text-primary ms-auto">
                                        <!-- <i class="ri-briefcase-4-line font-size-24"></i> -->
                                        <i class="fa fa-users font-size-24"></i>

                                    </div>
                                </div>
                            </div>
                            <div class="card-body border-top py-3">
                                <div class="text-truncate">
                                    <!-- <span class="badge bg-success-subtle text-success  font-size-11"><i class="mdi mdi-menu-up"> </i> 2.4% </span> -->
                                    <span class="text-muted ms-2">Total Team Memebers</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- end row -->


            </div>

            <!-- end row -->



        </div>
        <!-- End Page-content -->



    </div>
</div>
<!-- end main content-->
@endsection