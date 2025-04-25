<?php $page = 'packages'; ?>
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

                        <div class="card-header">
                            <!-- Search -->
                            <div class="row align-items-center">
                                <div class="col-sm-4">
                                    <div class="icon-form mb-3 mb-sm-0">
                                        <span class="form-icon"><i class="ti ti-search"></i></span>
                                        <input type="text" class="form-control" placeholder="Search User">
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="d-flex align-items-center flex-wrap row-gap-2 justify-content-sm-end">
                                        <div class="dropdown me-2">
                                            <a href="javascript:void(0);" class="dropdown-toggle"
                                                data-bs-toggle="dropdown"><i
                                                    class="ti ti-package-export me-2"></i>Export</a>
                                            <div class="dropdown-menu  dropdown-menu-end">
                                                <ul>
                                                    <li>
                                                        <a href="javascript:void(0);" class="dropdown-item"><i
                                                                class="ti ti-file-type-pdf text-danger me-1"></i>Export
                                                            as PDF</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);" class="dropdown-item"><i
                                                                class="ti ti-file-type-xls text-green me-1"></i>Export
                                                            as Excel </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="offcanvas"
                                            data-bs-target="#offcanvas_add"><i
                                                class="ti ti-square-rounded-plus me-2"></i>Add New Plan</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /Search -->
                        </div>

                        <div class="card-body">

                            <!-- Filter -->
                            <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-2 mb-4">
                                <div class="d-flex align-items-center flex-wrap row-gap-2">
                                    <div class="dropdown me-2">
                                        <a href="javascript:void(0);" class="dropdown-toggle" data-bs-toggle="dropdown"><i
                                                class="ti ti-sort-ascending-2 me-2"></i>Sort </a>
                                        <div class="dropdown-menu  dropdown-menu-start">
                                            <ul>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">
                                                        <i class="ti ti-circle-chevron-right me-1"></i>Ascending
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">
                                                        <i class="ti ti-circle-chevron-right me-1"></i>Descending
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">
                                                        <i class="ti ti-circle-chevron-right me-1"></i>Recently
                                                        Viewed
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">
                                                        <i class="ti ti-circle-chevron-right me-1"></i>Recently
                                                        Added
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="icon-form">
                                        <span class="form-icon"><i class="ti ti-calendar"></i></span>
                                        <input type="text" class="form-control bookingrange" placeholder="">
                                    </div>
                                </div>
                                <div class="d-flex align-items-center flex-wrap row-gap-2">
                                    <div class="dropdown me-2">
                                        <a href="javascript:void(0);" class="btn bg-soft-purple text-purple"
                                            data-bs-toggle="dropdown" data-bs-auto-close="outside"><i
                                                class="ti ti-columns-3 me-2"></i>Manage Columns</a>
                                        <div class="dropdown-menu  dropdown-menu-md-end dropdown-md p-3">
                                            <h4 class="mb-2 fw-semibold">Want to manage datatables?</h4>
                                            <p class="mb-3">Please drag and drop your column to reorder your table
                                                and enable see option as you want.</p>
                                            <div class="border-top pt-3">
                                                <div class="d-flex align-items-center justify-content-between mb-3">
                                                    <p class="mb-0 d-flex align-items-center"><i
                                                            class="ti ti-grip-vertical me-2"></i>Plan Name</p>
                                                    <div class="status-toggle">
                                                        <input type="checkbox" id="col-name" class="check">
                                                        <label for="col-name" class="checktoggle"></label>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between mb-3">
                                                    <p class="mb-0 d-flex align-items-center"><i
                                                            class="ti ti-grip-vertical me-2"></i>Plan Type</p>
                                                    <div class="status-toggle">
                                                        <input type="checkbox" id="col-phone" class="check">
                                                        <label for="col-phone" class="checktoggle"></label>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between mb-3">
                                                    <p class="mb-0 d-flex align-items-center"><i
                                                            class="ti ti-grip-vertical me-2"></i>Total Subscribers</p>
                                                    <div class="status-toggle">
                                                        <input type="checkbox" id="col-email" class="check">
                                                        <label for="col-email" class="checktoggle"></label>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between mb-3">
                                                    <p class="mb-0 d-flex align-items-center"><i
                                                            class="ti ti-grip-vertical me-2"></i>Price</p>
                                                    <div class="status-toggle">
                                                        <input type="checkbox" id="col-tag" class="check">
                                                        <label for="col-tag" class="checktoggle"></label>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between mb-3">
                                                    <p class="mb-0 d-flex align-items-center"><i
                                                            class="ti ti-grip-vertical me-2"></i>Created Date</p>
                                                    <div class="status-toggle">
                                                        <input type="checkbox" id="col-date" class="check">
                                                        <label for="col-date" class="checktoggle"></label>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between mb-3">
                                                    <p class="mb-0 d-flex align-items-center"><i
                                                            class="ti ti-grip-vertical me-2"></i>Status</p>
                                                    <div class="status-toggle">
                                                        <input type="checkbox" id="col-activity" class="check">
                                                        <label for="col-activity" class="checktoggle"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-sorts dropdown me-2">
                                        <a href="javascript:void(0);" data-bs-toggle="dropdown"
                                            data-bs-auto-close="outside"><i class="ti ti-filter-share"></i>Filter</a>
                                        <div class="filter-dropdown-menu dropdown-menu  dropdown-menu-md-end p-3">
                                            <div class="filter-set-view">
                                                <div class="filter-set-head">
                                                    <h4><i class="ti ti-filter-share"></i>Filter</h4>
                                                </div>
                                                <div class="accordion" id="accordionExample">
                                                    <div class="filter-set-content">
                                                        <div class="filter-set-content-head">
                                                            <a href="#" class="collapsed" data-bs-toggle="collapse"
                                                                data-bs-target="#location" aria-expanded="false"
                                                                aria-controls="location">Select Plan</a>
                                                        </div>
                                                        <div class="filter-set-contents accordion-collapse collapse"
                                                            id="location" data-bs-parent="#accordionExample">
                                                            <div class="filter-content-list">
                                                                <ul>
                                                                    <li>
                                                                        <div class="filter-checks">
                                                                            <label class="checkboxs">
                                                                                <input type="checkbox" checked>
                                                                                <span class="checkmarks"></span>
                                                                                Monthly
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="filter-checks">
                                                                            <label class="checkboxs">
                                                                                <input type="checkbox" checked>
                                                                                <span class="checkmarks"></span>
                                                                                Yearly
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="filter-set-content">
                                                        <div class="filter-set-content-head">
                                                            <a href="#" class="collapsed" data-bs-toggle="collapse"
                                                                data-bs-target="#Status" aria-expanded="false"
                                                                aria-controls="Status">Status</a>
                                                        </div>
                                                        <div class="filter-set-contents accordion-collapse collapse"
                                                            id="Status" data-bs-parent="#accordionExample">
                                                            <div class="filter-content-list">
                                                                <ul>
                                                                    <li>
                                                                        <div class="filter-checks">
                                                                            <label class="checkboxs">
                                                                                <input type="checkbox" checked>
                                                                                <span class="checkmarks"></span>
                                                                                Active
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="filter-checks">
                                                                            <label class="checkboxs">
                                                                                <input type="checkbox" checked>
                                                                                <span class="checkmarks"></span>
                                                                                Inactive
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="filter-reset-btns">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <a href="#" class="btn btn-light">Reset</a>
                                                        </div>
                                                        <div class="col-6">
                                                            <a href="{{url('packages')}}" class="btn btn-primary">Filter</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="view-icons">
                                        <a href="{{url('packages')}}" class="active"><i class="ti ti-list-tree"></i></a>
                                        <a href="{{url('packages-grid')}}"><i class="ti ti-grid-dots"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!-- /Filter -->

                            <!-- Manage Users List -->
                            <div class="table-responsive custom-table">
                                <table class="table datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="no-sort">
                                                <label class="checkboxs">
                                                    <input type="checkbox" id="select-all"><span
                                                        class="checkmarks"></span>
                                                </label>
                                            </th>
                                            <th class="no-sort"></th>
                                            <th>Plan Name</th>
                                            <th>Plan Type</th>
                                            <th>Total Subscribers</th>
                                            <th>Price</th>
                                            <th>Created Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <label class="checkboxs"><input type="checkbox"><span
                                                        class="checkmarks"></span></label>
                                            </td>
                                            <td>
                                                <div class="set-star rating-select"><i class="fa fa-star"></i></div>
                                            </td>
                                            <td>
                                                <h6 class="fw-medium"><a href="#">Basic</a></h6>
                                            </td>
                                            <td>Monthly</td>
                                            <td>56</td>
                                            <td>$50</td>
                                            <td>14 Jan 2024</td>
                                            <td>
                                                <span class="badge badge-pill badge-status bg-success">Active</span>
                                            </td>
                                            <td>
                                                <div class="dropdown table-action">
                                                    <a href="#" class="action-icon " data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#"
                                                            data-bs-toggle="offcanvas" data-bs-target="#offcanvas_edit">
                                                            <i class="ti ti-edit text-blue"></i>
                                                            Edit
                                                        </a>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#delete_invoices">
                                                            <i class="ti ti-trash text-danger"></i>
                                                            Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkboxs"><input type="checkbox"><span
                                                        class="checkmarks"></span></label>
                                            </td>
                                            <td>
                                                <div class="set-star rating-select"><i class="fa fa-star"></i></div>
                                            </td>
                                            <td>
                                                <h6 class="fw-medium"><a href="#">Advanced</a></h6>
                                            </td>
                                            <td>Monthly</td>
                                            <td>99</td>
                                            <td>$200</td>
                                            <td>21 Jan 2024</td>
                                            <td>
                                                <span class="badge badge-pill badge-status bg-success">Active</span>
                                            </td>
                                            <td>
                                                <div class="dropdown table-action">
                                                    <a href="#" class="action-icon " data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#"
                                                            data-bs-toggle="offcanvas" data-bs-target="#offcanvas_edit">
                                                            <i class="ti ti-edit text-blue"></i>
                                                            Edit
                                                        </a>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#delete_invoices">
                                                            <i class="ti ti-trash text-danger"></i>
                                                            Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkboxs"><input type="checkbox"><span
                                                        class="checkmarks"></span></label>
                                            </td>
                                            <td>
                                                <div class="set-star rating-select"><i class="fa fa-star"></i></div>
                                            </td>
                                            <td>
                                                <h6 class="fw-medium"><a href="#">Premium</a></h6>
                                            </td>
                                            <td>Monthly</td>
                                            <td>58</td>
                                            <td>$300</td>
                                            <td>10 Feb 2024</td>
                                            <td>
                                                <span class="badge badge-pill badge-status bg-success">Active</span>
                                            </td>
                                            <td>
                                                <div class="dropdown table-action">
                                                    <a href="#" class="action-icon " data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#"
                                                            data-bs-toggle="offcanvas" data-bs-target="#offcanvas_edit">
                                                            <i class="ti ti-edit text-blue"></i>
                                                            Edit
                                                        </a>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#delete_invoices">
                                                            <i class="ti ti-trash text-danger"></i>
                                                            Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkboxs"><input type="checkbox"><span
                                                        class="checkmarks"></span></label>
                                            </td>
                                            <td>
                                                <div class="set-star rating-select"><i class="fa fa-star"></i></div>
                                            </td>
                                            <td>
                                                <h6 class="fw-medium"><a href="#">Enterprise</a></h6>
                                            </td>
                                            <td>Monthly</td>
                                            <td>67</td>
                                            <td>$400</td>
                                            <td>18 Feb 2024</td>
                                            <td>
                                                <span class="badge badge-pill badge-status bg-success">Active</span>
                                            </td>
                                            <td>
                                                <div class="dropdown table-action">
                                                    <a href="#" class="action-icon " data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#"
                                                            data-bs-toggle="offcanvas" data-bs-target="#offcanvas_edit">
                                                            <i class="ti ti-edit text-blue"></i>
                                                            Edit
                                                        </a>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#delete_invoices">
                                                            <i class="ti ti-trash text-danger"></i>
                                                            Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkboxs"><input type="checkbox"><span
                                                        class="checkmarks"></span></label>
                                            </td>
                                            <td>
                                                <div class="set-star rating-select"><i class="fa fa-star"></i></div>
                                            </td>
                                            <td>
                                                <h6 class="fw-medium"><a href="#">Basic</a></h6>
                                            </td>
                                            <td>Yearly</td>
                                            <td>78</td>
                                            <td>$600</td>
                                            <td>15 Mar 2024</td>
                                            <td>
                                                <span class="badge badge-pill badge-status bg-success">Active</span>
                                            </td>
                                            <td>
                                                <div class="dropdown table-action">
                                                    <a href="#" class="action-icon " data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#"
                                                            data-bs-toggle="offcanvas" data-bs-target="#offcanvas_edit">
                                                            <i class="ti ti-edit text-blue"></i>
                                                            Edit
                                                        </a>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#delete_invoices">
                                                            <i class="ti ti-trash text-danger"></i>
                                                            Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkboxs"><input type="checkbox"><span
                                                        class="checkmarks"></span></label>
                                            </td>
                                            <td>
                                                <div class="set-star rating-select"><i class="fa fa-star"></i></div>
                                            </td>
                                            <td>
                                                <h6 class="fw-medium"><a href="#">Advanced</a></h6>
                                            </td>
                                            <td>Yearly</td>
                                            <td>99</td>
                                            <td>$2400</td>
                                            <td>26 Mar 2024</td>
                                            <td>
                                                <span class="badge badge-pill badge-status bg-success">Active</span>
                                            </td>
                                            <td>
                                                <div class="dropdown table-action">
                                                    <a href="#" class="action-icon " data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#"
                                                            data-bs-toggle="offcanvas" data-bs-target="#offcanvas_edit">
                                                            <i class="ti ti-edit text-blue"></i>
                                                            Edit
                                                        </a>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#delete_invoices">
                                                            <i class="ti ti-trash text-danger"></i>
                                                            Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkboxs"><input type="checkbox"><span
                                                        class="checkmarks"></span></label>
                                            </td>
                                            <td>
                                                <div class="set-star rating-select"><i class="fa fa-star"></i></div>
                                            </td>
                                            <td>
                                                <h6 class="fw-medium"><a href="#">Premium</a></h6>
                                            </td>
                                            <td>Yearly</td>
                                            <td>48</td>
                                            <td>$3600</td>
                                            <td>05 Apr 2024</td>
                                            <td>
                                                <span class="badge badge-pill badge-status bg-success">Active</span>
                                            </td>
                                            <td>
                                                <div class="dropdown table-action">
                                                    <a href="#" class="action-icon " data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#"
                                                            data-bs-toggle="offcanvas" data-bs-target="#offcanvas_edit">
                                                            <i class="ti ti-edit text-blue"></i>
                                                            Edit
                                                        </a>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#delete_invoices">
                                                            <i class="ti ti-trash text-danger"></i>
                                                            Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="checkboxs"><input type="checkbox"><span
                                                        class="checkmarks"></span></label>
                                            </td>
                                            <td>
                                                <div class="set-star rating-select"><i class="fa fa-star"></i></div>
                                            </td>
                                            <td>
                                                <h6 class="fw-medium"><a href="#">Enterprise</a></h6>
                                            </td>
                                            <td>Yearly</td>
                                            <td>17</td>
                                            <td>$4800</td>
                                            <td>16 Apr 2024</td>
                                            <td>
                                                <span class="badge badge-pill badge-status bg-success">Active</span>
                                            </td>
                                            <td>
                                                <div class="dropdown table-action">
                                                    <a href="#" class="action-icon " data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#"
                                                            data-bs-toggle="offcanvas" data-bs-target="#offcanvas_edit">
                                                            <i class="ti ti-edit text-blue"></i>
                                                            Edit
                                                        </a>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#delete_invoices">
                                                            <i class="ti ti-trash text-danger"></i>
                                                            Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="datatable-length"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="datatable-paginate"></div>
                                </div>
                            </div>
                            <!-- /Manage Users List -->

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <!-- /Page Wrapper -->

    <!-- Add Plan -->
    <div class="offcanvas offcanvas-end offcanvas-large" tabindex="-1" id="offcanvas_add">
        <div class="offcanvas-header border-bottom">
            <h5 class="fw-semibold">Add New Plan</h5>
            <button type="button"
                class="btn-close custom-btn-close border p-1 me-0 d-flex align-items-center justify-content-center rounded-circle"
                data-bs-dismiss="offcanvas" aria-label="Close">
                <i class="ti ti-x"></i>
            </button>
        </div>
        <div class="offcanvas-body">
            <form action="{{url('packages')}}">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <div class="profile-upload">
                                        <div class="profile-upload-img">
                                            <span><i class="ti ti-photo"></i></span>
                                            <img src="{{ URL::asset('build/img/profiles/avatar-20.jpg') }}" alt="img" class="preview1">
                                            <button type="button" class="profile-remove">
                                                <i class="ti ti-x"></i>
                                            </button>
                                        </div>
                                        <div class="profile-upload-content">
                                            <label class="profile-upload-btn">
                                                <i class="ti ti-file-broken"></i> Upload File
                                                <input type="file" class="input-img">
                                            </label>
                                            <p>JPG, GIF or PNG. Max size of 800K</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 ">
                                    <label class="form-label">Plan Name<span class="text-danger"> *</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Advanced</option>
                                        <option>Basic</option>
                                        <option>Enterprise</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 ">
                                    <label class="form-label">Plan Type<span class="text-danger"> *</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Monthly</option>
                                        <option>Yearly</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 ">
                                    <label class="form-label">Plan Position<span class="text-danger"> *</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 ">
                                    <label class="form-label">Plan Currency<span class="text-danger"> *</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>USD</option>
                                        <option>EURO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between">
                                        <label class="form-label">Plan Currency<span class="text-danger"> *</span></label>
                                        <span class="text-primary"><i class="fa-solid fa-circle-exclamation me-2"></i>Set
                                            0 for free</span>
                                    </div>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Fixed</option>
                                        <option>Percentage</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3 ">
                                    <label class="form-label">Discount Type<span class="text-danger"> *</span></label>
                                    <div class="pass-group">
                                        <select class="select">
                                            <option>Select</option>
                                            <option>Fixed</option>
                                            <option>Percentage</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3 ">
                                    <label class="form-label">Discount<span class="text-danger"> *</span></label>
                                    <div class="pass-group">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label class="form-label">Limitations Invoices</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label class="form-label">Max Customers</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label class="form-label">Product</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label class="form-label">Supplier</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <h6>Plan Modules</h6>
                                    <div class="form-check d-flex align-items-center">
                                        <label class="form-check-label mt-0 text-dark fw-medium">
                                            <input class="form-check-input" type="checkbox">
                                            Select All
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-sm-6">
                                    <div class="form-check d-flex align-items-center mb-3">
                                        <label class="form-check-label mt-0 text-dark fw-medium">
                                            <input class="form-check-input" type="checkbox">
                                            Employees
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="form-check d-flex align-items-center mb-3">
                                        <label class="form-check-label mt-0 text-dark fw-medium">
                                            <input class="form-check-input" type="checkbox">
                                            Invoices
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="form-check d-flex align-items-center mb-3">
                                        <label class="form-check-label mt-0 text-dark fw-medium">
                                            <input class="form-check-input" type="checkbox">
                                            Reports
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="form-check d-flex align-items-center mb-3">
                                        <label class="form-check-label mt-0 text-dark fw-medium">
                                            <input class="form-check-input" type="checkbox">
                                            Contacts
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="form-check d-flex align-items-center mb-3">
                                        <label class="form-check-label mt-0 text-dark fw-medium">
                                            <input class="form-check-input" type="checkbox">
                                            Clients
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="form-check d-flex align-items-center mb-3">
                                        <label class="form-check-label mt-0 text-dark fw-medium">
                                            <input class="form-check-input" type="checkbox">
                                            Estimates
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="form-check d-flex align-items-center mb-3">
                                        <label class="form-check-label mt-0 text-dark fw-medium">
                                            <input class="form-check-input" type="checkbox">
                                            Goals
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="form-check d-flex align-items-center mb-3">
                                        <label class="form-check-label mt-0 text-dark fw-medium">
                                            <input class="form-check-input" type="checkbox">
                                            Deals
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="form-check d-flex align-items-center mb-3">
                                        <label class="form-check-label mt-0 text-dark fw-medium">
                                            <input class="form-check-input" type="checkbox">
                                            Projects
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="form-check d-flex align-items-center mb-3">
                                        <label class="form-check-label mt-0 text-dark fw-medium">
                                            <input class="form-check-input" type="checkbox">
                                            Payments
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="form-check d-flex align-items-center mb-3">
                                        <label class="form-check-label mt-0 text-dark fw-medium">
                                            <input class="form-check-input" type="checkbox">
                                            Assets
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="form-check d-flex align-items-center mb-3">
                                        <label class="form-check-label mt-0 text-dark fw-medium">
                                            <input class="form-check-input" type="checkbox">
                                            Leads
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="form-check d-flex align-items-center mb-3">
                                        <label class="form-check-label mt-0 text-dark fw-medium">
                                            <input class="form-check-input" type="checkbox">
                                            Tickets
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="form-check d-flex align-items-center mb-3">
                                        <label class="form-check-label mt-0 text-dark fw-medium">
                                            <input class="form-check-input" type="checkbox">
                                            Taxes
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="form-check d-flex align-items-center mb-3">
                                        <label class="form-check-label mt-0 text-dark fw-medium">
                                            <input class="form-check-input" type="checkbox">
                                            Activities
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="form-check d-flex align-items-center mb-3">
                                        <label class="form-check-label mt-0 text-dark fw-medium">
                                            <input class="form-check-input" type="checkbox">
                                            Pipelines
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center mb-3">
                                        <label class="form-check-label mt-0 me-2 text-dark fw-medium">
                                            Access Trial
                                        </label>
                                        <div class="form-check form-switch me-2">
                                            <input class="form-check-input me-2" type="checkbox" role="switch">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center gx-3">
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="flex-fill">
                                            <label class="form-label">Trial Days</label>
                                            <input type="text" class="form-control">
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="d-block align-items-center ms-3">
                                        <label class="form-check-label mt-0 me-2 text-dark">
                                            Is Recommended
                                        </label>
                                        <div class="form-check form-switch me-2">
                                            <input class="form-check-input me-2" type="checkbox" role="switch">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="mb-3 ">
                                        <label class="form-label">Status<span class="text-danger"> *</span></label>
                                        <select class="select">
                                            <option>Select</option>
                                            <option>Active</option>
                                            <option>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-end">
                    <button type="button" data-bs-dismiss="offcanvas" class="btn btn-light me-2">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
    <!-- /Add Plan -->

    <!-- Edit Plan -->
    <div class="offcanvas offcanvas-end offcanvas-large" tabindex="-1" id="offcanvas_edit">
        <div class="offcanvas-header border-bottom">
            <h5 class="fw-semibold">Edit Plan</h5>
            <button type="button"
                class="btn-close custom-btn-close border p-1 me-0 d-flex align-items-center justify-content-center rounded-circle"
                data-bs-dismiss="offcanvas" aria-label="Close">
                <i class="ti ti-x"></i>
            </button>
        </div>
        <div class="offcanvas-body">
            <form action="{{url('packages')}}">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <div class="profile-upload">
                                        <div class="profile-upload-img">
                                            <span><i class="ti ti-photo"></i></span>
                                            <img src="{{ URL::asset('build/img/profiles/avatar-20.jpg') }}" alt="img" class="preview1">
                                            <button type="button" class="profile-remove">
                                                <i class="ti ti-x"></i>
                                            </button>
                                        </div>
                                        <div class="profile-upload-content">
                                            <label class="profile-upload-btn">
                                                <i class="ti ti-file-broken"></i> Upload File
                                                <input type="file" class="input-img">
                                            </label>
                                            <p>JPG, GIF or PNG. Max size of 800K</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 ">
                                    <label class="form-label">Plan Name<span class="text-danger"> *</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option selected>Advanced</option>
                                        <option>Basic</option>
                                        <option>Enterprise</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 ">
                                    <label class="form-label">Plan Type<span class="text-danger"> *</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option selected>Monthly</option>
                                        <option>Yearly</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 ">
                                    <label class="form-label">Plan Position<span class="text-danger"> *</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>1</option>
                                        <option selected>2</option>
                                        <option>3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 ">
                                    <label class="form-label">Plan Currency<span class="text-danger"> *</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option selected>USD</option>
                                        <option>EURO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between">
                                        <label class="form-label">Plan Currency<span class="text-danger"> *</span></label>
                                        <span class="text-primary"><i class="fa-solid fa-circle-exclamation me-2"></i>Set
                                            0 for free</span>
                                    </div>
                                    <select class="select">
                                        <option>Select</option>
                                        <option selected>Fixed</option>
                                        <option>Percentage</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3 ">
                                    <label class="form-label">Discount Type<span class="text-danger"> *</span></label>
                                    <div class="pass-group">
                                        <select class="select">
                                            <option>Select</option>
                                            <option selected>Fixed</option>
                                            <option>Percentage</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3 ">
                                    <label class="form-label">Discount<span class="text-danger"> *</span></label>
                                    <div class="pass-group">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label class="form-label">Limitations Invoices</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label class="form-label">Max Customers</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label class="form-label">Product</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label class="form-label">Supplier</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <h6>Plan Modules</h6>
                                    <div class="form-check d-flex align-items-center">
                                        <label class="form-check-label mt-0 text-dark fw-medium">
                                            <input class="form-check-input" type="checkbox">
                                            Select All
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-sm-6">
                                    <div class="form-check d-flex align-items-center mb-3">
                                        <label class="form-check-label mt-0 text-dark fw-medium">
                                            <input class="form-check-input" type="checkbox">
                                            Employees
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="form-check d-flex align-items-center mb-3">
                                        <label class="form-check-label mt-0 text-dark fw-medium">
                                            <input class="form-check-input" type="checkbox">
                                            Invoices
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="form-check d-flex align-items-center mb-3">
                                        <label class="form-check-label mt-0 text-dark fw-medium">
                                            <input class="form-check-input" type="checkbox">
                                            Reports
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="form-check d-flex align-items-center mb-3">
                                        <label class="form-check-label mt-0 text-dark fw-medium">
                                            <input class="form-check-input" type="checkbox">
                                            Contacts
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="form-check d-flex align-items-center mb-3">
                                        <label class="form-check-label mt-0 text-dark fw-medium">
                                            <input class="form-check-input" type="checkbox">
                                            Clients
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="form-check d-flex align-items-center mb-3">
                                        <label class="form-check-label mt-0 text-dark fw-medium">
                                            <input class="form-check-input" type="checkbox">
                                            Estimates
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="form-check d-flex align-items-center mb-3">
                                        <label class="form-check-label mt-0 text-dark fw-medium">
                                            <input class="form-check-input" type="checkbox">
                                            Goals
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="form-check d-flex align-items-center mb-3">
                                        <label class="form-check-label mt-0 text-dark fw-medium">
                                            <input class="form-check-input" type="checkbox">
                                            Deals
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="form-check d-flex align-items-center mb-3">
                                        <label class="form-check-label mt-0 text-dark fw-medium">
                                            <input class="form-check-input" type="checkbox">
                                            Projects
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="form-check d-flex align-items-center mb-3">
                                        <label class="form-check-label mt-0 text-dark fw-medium">
                                            <input class="form-check-input" type="checkbox">
                                            Payments
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="form-check d-flex align-items-center mb-3">
                                        <label class="form-check-label mt-0 text-dark fw-medium">
                                            <input class="form-check-input" type="checkbox">
                                            Assets
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="form-check d-flex align-items-center mb-3">
                                        <label class="form-check-label mt-0 text-dark fw-medium">
                                            <input class="form-check-input" type="checkbox">
                                            Leads
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="form-check d-flex align-items-center mb-3">
                                        <label class="form-check-label mt-0 text-dark fw-medium">
                                            <input class="form-check-input" type="checkbox">
                                            Tickets
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="form-check d-flex align-items-center mb-3">
                                        <label class="form-check-label mt-0 text-dark fw-medium">
                                            <input class="form-check-input" type="checkbox">
                                            Taxes
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="form-check d-flex align-items-center mb-3">
                                        <label class="form-check-label mt-0 text-dark fw-medium">
                                            <input class="form-check-input" type="checkbox">
                                            Activities
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="form-check d-flex align-items-center mb-3">
                                        <label class="form-check-label mt-0 text-dark fw-medium">
                                            <input class="form-check-input" type="checkbox">
                                            Pipelines
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center mb-3">
                                        <label class="form-check-label mt-0 me-2 text-dark fw-medium">
                                            Access Trial
                                        </label>
                                        <div class="form-check form-switch me-2">
                                            <input class="form-check-input me-2" type="checkbox" role="switch">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center gx-3">
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="flex-fill">
                                            <label class="form-label">Trial Days</label>
                                            <input type="text" class="form-control">
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="d-block align-items-center ms-3">
                                        <label class="form-check-label mt-0 me-2 text-dark">
                                            Is Recommended
                                        </label>
                                        <div class="form-check form-switch me-2">
                                            <input class="form-check-input me-2" type="checkbox" role="switch">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="mb-3 ">
                                        <label class="form-label">Status<span class="text-danger"> *</span></label>
                                        <select class="select">
                                            <option>Select</option>
                                            <option>Active</option>
                                            <option>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-end">
                    <button type="button" data-bs-dismiss="offcanvas" class="btn btn-light me-2">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
    <!-- /Edit Plan -->

    <!-- Delete Company -->
    <div class="modal fade" id="delete_invoices" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="text-center">
                        <div class="avatar avatar-xl bg-danger-light rounded-circle mb-3">
                            <i class="ti ti-trash-x fs-36 text-danger"></i>
                        </div>
                        <h4 class="mb-2">Remove Plan?</h4>
                        <p class="mb-0">Are you sure you want to remove <br> company you selected.</p>
                        <div class="d-flex align-items-center justify-content-center mt-4">
                            <a href="#" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</a>
                            <a href="{{url('company')}}" class="btn btn-danger">Yes, Delete it</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Delete Company -->
@endsection
