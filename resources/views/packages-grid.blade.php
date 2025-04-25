<?php $page = 'packages-grid'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content">

            <div class="row">
                <div class="col-md-12">

                    <!-- Page Header -->
                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="page-title">Packages</h4>
                            </div>
                            <div class="col-4 text-end">
                                <div class="head-icons">
                                    <a href="{{url('cities')}}" data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-original-title="Refresh"><i class="ti ti-refresh-dot"></i></a>
                                    <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-original-title="Collapse" id="collapse-header"><i
                                            class="ti ti-chevrons-up"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->

                    <div class="row">

                        <!-- Total Plans -->
                        <div class="col-lg-3 col-md-6 d-flex">
                            <div class="card flex-fill">
                                <div class="card-body d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center overflow-hidden">
                                        <div>
                                            <p class="fs-12 fw-medium mb-1 text-truncate">Total Plans</p>
                                            <h4>08</h4>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="avatar avatar-lg bg-primary flex-shrink-0">
                                            <i class="ti ti-box fs-16"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Total Plans -->

                        <!-- Total Plans -->
                        <div class="col-lg-3 col-md-6 d-flex">
                            <div class="card flex-fill">
                                <div class="card-body d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center overflow-hidden">
                                        <div>
                                            <p class="fs-12 fw-medium mb-1 text-truncate">Active Plans</p>
                                            <h4>08</h4>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="avatar avatar-lg bg-success flex-shrink-0">
                                            <i class="ti ti-activity-heartbeat fs-16"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Total Plans -->

                        <!-- Inactive Plans -->
                        <div class="col-lg-3 col-md-6 d-flex">
                            <div class="card flex-fill">
                                <div class="card-body d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center overflow-hidden">
                                        <div>
                                            <p class="fs-12 fw-medium mb-1 text-truncate">Inactive Plans</p>
                                            <h4>0</h4>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="avatar avatar-lg bg-danger flex-shrink-0">
                                            <i class="ti ti-player-pause fs-16"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Inactive Companies -->

                        <!-- No of Plans  -->
                        <div class="col-lg-3 col-md-6 d-flex">
                            <div class="card flex-fill">
                                <div class="card-body d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center overflow-hidden">
                                        <div>
                                            <p class="fs-12 fw-medium mb-1 text-truncate">No of Plan Types</p>
                                            <h4>02</h4>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="avatar avatar-lg bg-skyblue flex-shrink-0">
                                            <i class="ti ti-mask fs-16"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /No of Plans -->

                    </div>

                    <div class="card">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5>Plans List</h5>
                                <div class="d-flex my-xl-auto right-content align-items-center flex-wrap row-gap-3">
                                    <div class="dropdown me-3">
                                        <a href="javascript:void(0);"
                                            class="dropdown-toggle btn btn-white d-inline-flex align-items-center"
                                            data-bs-toggle="dropdown">
                                            Select Plan
                                        </a>
                                        <ul class="dropdown-menu  dropdown-menu-end p-3">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item rounded-1">Basic</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item rounded-1">Advanced</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item rounded-1">Premium</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item rounded-1">Enterprise</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="dropdown me-2">
                                        <a href="javascript:void(0);"
                                            class="dropdown-toggle btn btn-white d-inline-flex align-items-center"
                                            data-bs-toggle="dropdown">
                                            Sort By : Last 7 Days
                                        </a>
                                        <ul class="dropdown-menu  dropdown-menu-end p-3">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item rounded-1">Recently
                                                    Added</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item rounded-1">Ascending</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item rounded-1">Desending</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item rounded-1">Last Month</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item rounded-1">Last 7
                                                    Days</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="view-icons">
                                        <a href="{{url('packages')}}"><i class="ti ti-list-tree"></i></a>
                                        <a href="{{url('packages-grid')}}" class="active"><i class="ti ti-grid-dots"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body pb-0">
                            <div class="d-flex justify-content-center align-items-center mb-4">
                                <p class="mb-0 me-2">Monthly</p>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                </div>
                                <p>Yearly</p>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-lg-3 col-md-6 col-sm-12 d-flex">
                                    <div class="card flex-fill">
                                        <div class="card-body">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4>Basic</h4>
                                                    <h1>$50<span class="fs-14 fw-normal text-gray">/monthly</span></h1>
                                                </div>
                                            </div>
                                            <div class="pricing-content rounded bg-light mb-3">
                                                <div class="price-hdr">
                                                    <h6 class="fs-14 fw-medium text-gray w-100">Features Includes</h6>
                                                </div>
                                                <div>
                                                    <span class="text-dark d-flex align-items-center mb-3"><i
                                                            class="ti ti-discount-check-filled text-success me-2"></i>10
                                                        Employees</span>
                                                    <span class="text-dark d-flex align-items-center mb-3"><i
                                                            class="ti ti-discount-check-filled text-success me-2"></i>50
                                                        Projects</span>
                                                    <span class="text-dark d-flex align-items-center mb-3"><i
                                                            class="ti ti-discount-check-filled text-success me-2"></i>50
                                                        Clients</span>
                                                    <span class="text-dark d-flex align-items-center mb-3"><i
                                                            class="ti ti-discount-check-filled text-success me-2"></i>50 GB
                                                        Storage</span>
                                                    <span class="text-dark d-flex align-items-center mb-3"><i
                                                            class="ti ti-circle-x-filled text-danger me-2"></i>Voice &
                                                        Video Chat</span>
                                                    <span class="text-dark d-flex align-items-center"><i
                                                            class="ti ti-circle-x-filled text-danger me-2"></i>CRM</span>
                                                </div>
                                            </div>
                                            <a href="#" class="btn btn-dark w-100">Choose Plan</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12 d-flex">
                                    <div class="card flex-fill">
                                        <div class="card-body">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4>Advanced</h4>
                                                    <h1>$200<span class="fs-14 fw-normal text-gray">/monthly</span></h1>
                                                </div>
                                            </div>
                                            <div class="pricing-content rounded bg-light mb-3">
                                                <div class="price-hdr">
                                                    <h6 class="fs-14 fw-medium text-gray w-100">Features Includes</h6>
                                                </div>
                                                <div>
                                                    <span class="text-dark d-flex align-items-center mb-3"><i
                                                            class="ti ti-discount-check-filled text-success me-2"></i>50
                                                        Employees</span>
                                                    <span class="text-dark d-flex align-items-center mb-3"><i
                                                            class="ti ti-discount-check-filled text-success me-2"></i>100
                                                        Projects</span>
                                                    <span class="text-dark d-flex align-items-center mb-3"><i
                                                            class="ti ti-discount-check-filled text-success me-2"></i>100
                                                        Clients</span>
                                                    <span class="text-dark d-flex align-items-center mb-3"><i
                                                            class="ti ti-discount-check-filled text-success me-2"></i>50 GB
                                                        Storage</span>
                                                    <span class="text-dark d-flex align-items-center mb-3"><i
                                                            class="ti ti-discount-check-filled text-success me-2"></i>Voice
                                                        & Video Chat</span>
                                                    <span class="text-dark d-flex align-items-center"><i
                                                            class="ti ti-circle-x-filled text-danger me-2"></i>CRM</span>
                                                </div>
                                            </div>
                                            <a href="#" class="btn btn-dark w-100">Choose Plan</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12 d-flex">
                                    <div class="card flex-fill">
                                        <div class="card-body">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4>Premium</h4>
                                                    <h1>$300<span class="fs-14 fw-normal text-gray">/monthly</span></h1>
                                                </div>
                                            </div>
                                            <div class="pricing-content rounded bg-light mb-3">
                                                <div class="price-hdr">
                                                    <h6 class="fs-14 fw-medium text-gray w-100">Features Includes</h6>
                                                </div>
                                                <div>
                                                    <span class="text-dark d-flex align-items-center mb-3"><i
                                                            class="ti ti-discount-check-filled text-success me-2"></i>100
                                                        Employees</span>
                                                    <span class="text-dark d-flex align-items-center mb-3"><i
                                                            class="ti ti-discount-check-filled text-success me-2"></i>200
                                                        Projects</span>
                                                    <span class="text-dark d-flex align-items-center mb-3"><i
                                                            class="ti ti-discount-check-filled text-success me-2"></i>100
                                                        Clients</span>
                                                    <span class="text-dark d-flex align-items-center mb-3"><i
                                                            class="ti ti-discount-check-filled text-success me-2"></i>100
                                                        GB Storage</span>
                                                    <span class="text-dark d-flex align-items-center mb-3"><i
                                                            class="ti ti-discount-check-filled text-success me-2"></i>Voice
                                                        & Video Chat</span>
                                                    <span class="text-dark d-flex align-items-center"><i
                                                            class="ti ti-circle-x-filled text-danger me-2"></i>CRM</span>
                                                </div>
                                            </div>
                                            <a href="#" class="btn btn-dark w-100">Choose Plan</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12 d-flex">
                                    <div class="card flex-fill">
                                        <div class="card-body">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4>Enterprise</h4>
                                                    <h1>$400<span class="fs-14 fw-normal text-gray">/monthly</span></h1>
                                                </div>
                                            </div>
                                            <div class="pricing-content rounded bg-light mb-3">
                                                <div class="price-hdr">
                                                    <h6 class="fs-14 fw-medium text-gray w-100">Features Includes</h6>
                                                </div>
                                                <div>
                                                    <span class="text-dark d-flex align-items-center mb-3"><i
                                                            class="ti ti-discount-check-filled text-success me-2"></i>Unlimited
                                                        Employees</span>
                                                    <span class="text-dark d-flex align-items-center mb-3"><i
                                                            class="ti ti-discount-check-filled text-success me-2"></i>Unlimited
                                                        Clients</span>
                                                    <span class="text-dark d-flex align-items-center mb-3"><i
                                                            class="ti ti-discount-check-filled text-success me-2"></i>Unlimited
                                                        Projects</span>
                                                    <span class="text-dark d-flex align-items-center mb-3"><i
                                                            class="ti ti-discount-check-filled text-success me-2"></i>Unlimited
                                                        Storage</span>
                                                    <span class="text-dark d-flex align-items-center mb-3"><i
                                                            class="ti ti-discount-check-filled text-success me-2"></i>Voice
                                                        & Video Chat</span>
                                                    <span class="text-dark d-flex align-items-center"><i
                                                            class="ti ti-discount-check-filled text-success me-2"></i>CRM</span>
                                                </div>
                                            </div>
                                            <a href="#" class="btn btn-dark w-100">Choose Plan</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <!-- /Page Wrapper -->
@endsection
