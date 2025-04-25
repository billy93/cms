<?php $page = 'subscription'; ?>
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
                                <h4 class="page-title">Subscription<span class="count-title">123</span></h4>
                            </div>
                            <div class="col-4 text-end">
                                <div class="head-icons">
                                    <a href="{{url('companies')}}" data-bs-toggle="tooltip" data-bs-placement="top"
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
                        <div class="col-xl-3 col-md-6 d-flex">
                            <div class="card flex-fill">
                                <div class="card-body ">
                                    <div class="border-bottom pb-3 mb-3">
                                        <div class="row align-items-center">
                                            <div class="col-7">
                                                <div>
                                                    <span class="fs-14 fw-normal text-truncate mb-1">Total
                                                        Transaction</span>
                                                    <h5>$5,340</h5>
                                                </div>
                                            </div>
                                            <div class="col-5">
                                                <div>
                                                    <span class="subscription-line-1"
                                                        data-width="100%">6,2,8,4,3,8,1,3,6,5,9,2,8,1,4,8,9,8,2,1</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <p class="fs-12 fw-normal d-flex align-items-center text-truncate">
                                            <span class="text-primary fs-12 d-flex align-items-center me-1">
                                                <i class="ti ti-arrow-wave-right-up me-1"></i>+19.01%</span>from
                                            last week
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 d-flex">
                            <div class="card flex-fill">
                                <div class="card-body ">
                                    <div class="border-bottom pb-3 mb-3">
                                        <div class="row align-items-center">
                                            <div class="col-7">
                                                <div>
                                                    <span class="fs-14 fw-normal text-truncate mb-1">Total
                                                        Subscribers</span>
                                                    <h5>600</h5>
                                                </div>
                                            </div>
                                            <div class="col-5">
                                                <div>
                                                    <span class="subscription-line-2"
                                                        data-width="100%">6,2,8,4,3,8,1,3,6,5,9,2,8,1,4,8,9,8,2,1</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <p class="fs-12 fw-normal d-flex align-items-center text-truncate">
                                            <span class="text-primary fs-12 d-flex align-items-center me-1">
                                                <i class="ti ti-arrow-wave-right-up me-1"></i>+19.01%</span>from
                                            last week
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 d-flex">
                            <div class="card flex-fill">
                                <div class="card-body ">
                                    <div class="border-bottom pb-3 mb-3">
                                        <div class="row align-items-center">
                                            <div class="col-7">
                                                <div>
                                                    <span class="fs-14 fw-normal text-truncate mb-1">Active
                                                        Subscribers</span>
                                                    <h5>560</h5>
                                                </div>
                                            </div>
                                            <div class="col-5">
                                                <div>
                                                    <span class="subscription-line-3"
                                                        data-width="100%">6,2,8,4,3,8,1,3,6,5,9,2,8,1,4,8,9,8,2,1</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <p class="fs-12 fw-normal d-flex align-items-center text-truncate">
                                            <span class="text-primary fs-12 d-flex align-items-center me-1">
                                                <i class="ti ti-arrow-wave-right-up me-1"></i>+19.01%</span>from
                                            last week
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 d-flex">
                            <div class="card flex-fill">
                                <div class="card-body ">
                                    <div class="border-bottom pb-3 mb-3">
                                        <div class="row align-items-center">
                                            <div class="col-7">
                                                <div>
                                                    <span class="fs-14 fw-normal text-truncate mb-1">Expired
                                                        Subscribers</span>
                                                    <h5>40</h5>
                                                </div>
                                            </div>
                                            <div class="col-5">
                                                <div>
                                                    <span class="subscription-line-4"
                                                        data-width="100%">6,2,8,4,3,8,1,3,6,5,9,2,8,1,4,8,9,8,2,1</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <p class="fs-12 fw-normal d-flex align-items-center text-truncate">
                                            <span class="text-primary fs-12 d-flex align-items-center me-1">
                                                <i class="ti ti-arrow-wave-right-up me-1"></i>+19.01%</span>from
                                            last week
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card ">
                        <div class="card-header">
                            <!-- Search -->
                            <div class="row align-items-center">
                                <div class="col-sm-4">
                                    <div class="icon-form mb-3 mb-sm-0">
                                        <span class="form-icon"><i class="ti ti-search"></i></span>
                                        <input type="text" class="form-control" placeholder="Search">
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
                                        <a href="javascript:void(0);" class="dropdown-toggle"
                                            data-bs-toggle="dropdown"><i class="ti ti-sort-ascending-2 me-2"></i>Sort </a>
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
                                                            class="ti ti-grip-vertical me-2"></i>Subscriber</p>
                                                    <div class="status-toggle">
                                                        <input type="checkbox" id="col-name" class="check">
                                                        <label for="col-name" class="checktoggle"></label>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between mb-3">
                                                    <p class="mb-0 d-flex align-items-center"><i
                                                            class="ti ti-grip-vertical me-2"></i>Plan</p>
                                                    <div class="status-toggle">
                                                        <input type="checkbox" id="col-phone" class="check">
                                                        <label for="col-phone" class="checktoggle"></label>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between mb-3">
                                                    <p class="mb-0 d-flex align-items-center"><i
                                                            class="ti ti-grip-vertical me-2"></i>Payment</p>
                                                    <div class="status-toggle">
                                                        <input type="checkbox" id="col-email" class="check">
                                                        <label for="col-email" class="checktoggle"></label>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between mb-3">
                                                    <p class="mb-0 d-flex align-items-center"><i
                                                            class="ti ti-grip-vertical me-2"></i>Status</p>
                                                    <div class="status-toggle">
                                                        <input type="checkbox" id="col-tag" class="check">
                                                        <label for="col-tag" class="checktoggle"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-sorts dropdown">
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
                                                                                Paid
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="filter-checks">
                                                                            <label class="checkboxs">
                                                                                <input type="checkbox">
                                                                                <span class="checkmarks"></span>
                                                                                Unpaid
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
                                                                data-bs-target="#collapseOne" aria-expanded="false"
                                                                aria-controls="collapseOne">Payment</a>
                                                        </div>
                                                        <div class="filter-set-contents accordion-collapse collapse"
                                                            id="collapseOne" data-bs-parent="#accordionExample">
                                                            <div class="filter-content-list">
                                                                <ul>
                                                                    <li>
                                                                        <div class="filter-checks">
                                                                            <label class="checkboxs">
                                                                                <input type="checkbox" checked>
                                                                                <span class="checkmarks"></span>
                                                                                Credit Card
                                                                            </label>
                                                                        </div>

                                                                    </li>
                                                                    <li>
                                                                        <div class="filter-checks">
                                                                            <label class="checkboxs">
                                                                                <input type="checkbox">
                                                                                <span class="checkmarks"></span>
                                                                                Paypal
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="filter-checks">
                                                                            <label class="checkboxs">
                                                                                <input type="checkbox">
                                                                                <span class="checkmarks"></span>
                                                                                Debit Card
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
                                                                data-bs-target="#collapseThree" aria-expanded="false"
                                                                aria-controls="collapseThree">Plan</a>
                                                        </div>
                                                        <div class="filter-set-contents accordion-collapse collapse"
                                                            id="collapseThree" data-bs-parent="#accordionExample">
                                                            <div class="filter-content-list">
                                                                <ul>
                                                                    <li>
                                                                        <div class="filter-checks">
                                                                            <label class="checkboxs">
                                                                                <input type="checkbox" checked>
                                                                                <span class="checkmarks"></span>
                                                                                Enterprise
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="filter-checks">
                                                                            <label class="checkboxs">
                                                                                <input type="checkbox">
                                                                                <span class="checkmarks"></span>
                                                                                Advanced
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="filter-checks">
                                                                            <label class="checkboxs">
                                                                                <input type="checkbox">
                                                                                <span class="checkmarks"></span>
                                                                                Basic
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
                                                            <a href="{{url('subscription')}}" class="btn btn-primary">Filter</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Filter -->

                            <!-- Contact List -->
                            <div class="table-responsive custom-table">
                                <table class="table datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="no-sort">
                                                <label class="checkboxs"><input type="checkbox" id="select-all"><span
                                                        class="checkmarks"></span></label>
                                            </th>
                                            <th class="no-sort"></th>
                                            <th>Subscriber</th>
                                            <th>Plan</th>
                                            <th>Billing Cycle</th>
                                            <th>Payment Method</th>
                                            <th>Amount</th>
                                            <th>Created Date</th>
                                            <th>Expiring On</th>
                                            <th>Status</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><label class="checkboxs"><input type="checkbox"><span
                                                        class="checkmarks"></span></label></td>
                                            <td>
                                                <div class="set-star rating-select"><i class="fa fa-star"></i></div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="javascript:void(0);"
                                                        class="avatar avatar-sm border rounded p-1 me-2">
                                                        <img class="w-auto h-auto"
                                                            src="{{ URL::asset('build/img/icons/company-icon-01.svg') }}" alt="User Image">
                                                    </a>
                                                    <a href="javascript:void(0);"
                                                        class="d-flex flex-column fw-medium">NovaWave LLC</a>
                                                </div>
                                            </td>
                                            <td>Advanced (Monthly)</td>
                                            <td>30 Days</td>
                                            <td>Credit Card</td>
                                            <td>$200</td>
                                            <td>12 Sep 2024</td>
                                            <td>11 Oct 2024</td>
                                            <td><span class="badge badge-pill badge-status bg-success">Paid</span></td>
                                            <td>
                                                <div class="dropdown table-action">
                                                    <a href="#" class="action-icon "
                                                        data-bs-toggle="dropdown"aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#view_invoice"><i
                                                                class="ti ti-eye text-blue-light"></i> Preview</a>
                                                        <a class="dropdown-item" href="#">
                                                            <i class="ti ti-download text-blue"></i>Download
                                                        </a>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#delete_company">
                                                            <i class="ti ti-trash text-danger"></i>Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="checkboxs"><input type="checkbox"><span
                                                        class="checkmarks"></span></label></td>
                                            <td>
                                                <div class="set-star rating-select"><i class="fa fa-star"></i></div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="javascript:void(0);"
                                                        class="avatar avatar-sm border rounded p-1 me-2">
                                                        <img class="w-auto h-auto"
                                                            src="{{ URL::asset('build/img/icons/company-icon-02.svg') }}" alt="User Image">
                                                    </a>
                                                    <a href="javascript:void(0);"
                                                        class="d-flex flex-column fw-medium">BlueSky Industries</a>
                                                </div>
                                            </td>
                                            <td>Basic (Yearly)</td>
                                            <td>365 Days</td>
                                            <td>Paypal</td>
                                            <td>$600</td>
                                            <td>24 Oct 2024</td>
                                            <td>23 Oct 2025</td>
                                            <td><span class="badge badge-pill badge-status bg-danger">Unpaid</span></td>
                                            <td>
                                                <div class="dropdown table-action">
                                                    <a href="#" class="action-icon "
                                                        data-bs-toggle="dropdown"aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#view_invoice"><i
                                                                class="ti ti-eye text-blue-light"></i> Preview</a>
                                                        <a class="dropdown-item" href="#">
                                                            <i class="ti ti-download text-blue"></i>Download
                                                        </a>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#delete_company">
                                                            <i class="ti ti-trash text-danger"></i>Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="checkboxs"><input type="checkbox"><span
                                                        class="checkmarks"></span></label></td>
                                            <td>
                                                <div class="set-star rating-select"><i class="fa fa-star"></i></div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="javascript:void(0);"
                                                        class="avatar avatar-sm border rounded p-1 me-2">
                                                        <img class="w-auto h-auto"
                                                            src="{{ URL::asset('build/img/icons/company-icon-03.svg') }}" alt="User Image">
                                                    </a>
                                                    <a href="javascript:void(0);"
                                                        class="d-flex flex-column fw-medium">Silver Hawk</a>
                                                </div>
                                            </td>
                                            <td>Advanced (Monthly)</td>
                                            <td>30 Days</td>
                                            <td>Debit Card</td>
                                            <td>$200</td>
                                            <td>18 Feb 2024</td>
                                            <td>17 Mar 2024</td>
                                            <td><span class="badge badge-pill badge-status bg-success">Paid</span></td>
                                            <td>
                                                <div class="dropdown table-action">
                                                    <a href="#" class="action-icon "
                                                        data-bs-toggle="dropdown"aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#view_invoice"><i
                                                                class="ti ti-eye text-blue-light"></i> Preview</a>
                                                        <a class="dropdown-item" href="#">
                                                            <i class="ti ti-download text-blue"></i>Download
                                                        </a>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#delete_company">
                                                            <i class="ti ti-trash text-danger"></i>Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="checkboxs"><input type="checkbox"><span
                                                        class="checkmarks"></span></label></td>
                                            <td>
                                                <div class="set-star rating-select"><i class="fa fa-star"></i></div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="javascript:void(0);"
                                                        class="avatar avatar-sm border rounded p-1 me-2">
                                                        <img class="w-auto h-auto"
                                                            src="{{ URL::asset('build/img/icons/company-icon-04.svg') }}" alt="User Image">
                                                    </a>
                                                    <a href="javascript:void(0);"
                                                        class="d-flex flex-column fw-medium">Summit Peak</a>
                                                </div>
                                            </td>
                                            <td>Advanced (Monthly)</td>
                                            <td>30 Days</td>
                                            <td>Paypal</td>
                                            <td>$200</td>
                                            <td>17 Oct 2024</td>
                                            <td>16 Nov 2024</td>
                                            <td><span class="badge badge-pill badge-status bg-success">Paid</span></td>
                                            <td>
                                                <div class="dropdown table-action">
                                                    <a href="#" class="action-icon "
                                                        data-bs-toggle="dropdown"aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#view_invoice"><i
                                                                class="ti ti-eye text-blue-light"></i> Preview</a>
                                                        <a class="dropdown-item" href="#">
                                                            <i class="ti ti-download text-blue"></i>Download
                                                        </a>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#delete_company">
                                                            <i class="ti ti-trash text-danger"></i>Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="checkboxs"><input type="checkbox"><span
                                                        class="checkmarks"></span></label></td>
                                            <td>
                                                <div class="set-star rating-select"><i class="fa fa-star"></i></div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="javascript:void(0);"
                                                        class="avatar avatar-sm border rounded p-1 me-2">
                                                        <img class="w-auto h-auto"
                                                            src="{{ URL::asset('build/img/icons/company-icon-05.svg') }}" alt="User Image">
                                                    </a>
                                                    <a href="javascript:void(0);"
                                                        class="d-flex flex-column fw-medium">RiverStone Ventur</a>
                                                </div>
                                            </td>
                                            <td>Enterprise (Monthly)</td>
                                            <td>30 Days</td>
                                            <td>Credit Card</td>
                                            <td>$400</td>
                                            <td>20 Jul 2024</td>
                                            <td>19 Aug 2024</td>
                                            <td><span class="badge badge-pill badge-status bg-success">Paid</span></td>
                                            <td>
                                                <div class="dropdown table-action">
                                                    <a href="#" class="action-icon "
                                                        data-bs-toggle="dropdown"aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#view_invoice"><i
                                                                class="ti ti-eye text-blue-light"></i> Preview</a>
                                                        <a class="dropdown-item" href="#">
                                                            <i class="ti ti-download text-blue"></i>Download
                                                        </a>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#delete_company">
                                                            <i class="ti ti-trash text-danger"></i>Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="checkboxs"><input type="checkbox"><span
                                                        class="checkmarks"></span></label></td>
                                            <td>
                                                <div class="set-star rating-select"><i class="fa fa-star"></i></div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="javascript:void(0);"
                                                        class="avatar avatar-sm border rounded p-1 me-2">
                                                        <img class="w-auto h-auto"
                                                            src="{{ URL::asset('build/img/icons/company-icon-06.svg') }}" alt="User Image">
                                                    </a>
                                                    <a href="javascript:void(0);"
                                                        class="d-flex flex-column fw-medium">Bright Bridge Grp</a>
                                                </div>
                                            </td>
                                            <td>Advanced (Monthly)</td>
                                            <td>30 Days</td>
                                            <td>Paypal</td>
                                            <td>$200</td>
                                            <td>10 Apr 2024</td>
                                            <td>19 Aug 2024</td>
                                            <td><span class="badge badge-pill badge-status bg-success">Paid</span></td>
                                            <td>
                                                <div class="dropdown table-action">
                                                    <a href="#" class="action-icon "
                                                        data-bs-toggle="dropdown"aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#view_invoice"><i
                                                                class="ti ti-eye text-blue-light"></i> Preview</a>
                                                        <a class="dropdown-item" href="#">
                                                            <i class="ti ti-download text-blue"></i>Download
                                                        </a>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#delete_company">
                                                            <i class="ti ti-trash text-danger"></i>Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="checkboxs"><input type="checkbox"><span
                                                        class="checkmarks"></span></label></td>
                                            <td>
                                                <div class="set-star rating-select"><i class="fa fa-star"></i></div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="javascript:void(0);"
                                                        class="avatar avatar-sm border rounded p-1 me-2">
                                                        <img class="w-auto h-auto"
                                                            src="{{ URL::asset('build/img/icons/company-icon-07.svg') }}" alt="User Image">
                                                    </a>
                                                    <a href="javascript:void(0);"
                                                        class="d-flex flex-column fw-medium">CoastalStar Co.</a>
                                                </div>
                                            </td>
                                            <td>Enterprise (Yearly)</td>
                                            <td>365 Days</td>
                                            <td>Credit Card</td>
                                            <td>$4800</td>
                                            <td>29 Aug 2024</td>
                                            <td>28 Aug 2025</td>
                                            <td><span class="badge badge-pill badge-status bg-success">Paid</span></td>
                                            <td>
                                                <div class="dropdown table-action">
                                                    <a href="#" class="action-icon "
                                                        data-bs-toggle="dropdown"aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#view_invoice"><i
                                                                class="ti ti-eye text-blue-light"></i> Preview</a>
                                                        <a class="dropdown-item" href="#">
                                                            <i class="ti ti-download text-blue"></i>Download
                                                        </a>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#delete_company">
                                                            <i class="ti ti-trash text-danger"></i>Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="checkboxs"><input type="checkbox"><span
                                                        class="checkmarks"></span></label></td>
                                            <td>
                                                <div class="set-star rating-select"><i class="fa fa-star"></i></div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="javascript:void(0);"
                                                        class="avatar avatar-sm border rounded p-1 me-2">
                                                        <img class="w-auto h-auto"
                                                            src="{{ URL::asset('build/img/icons/company-icon-08.svg') }}" alt="User Image">
                                                    </a>
                                                    <a href="javascript:void(0);"
                                                        class="d-flex flex-column fw-medium">HarborView</a>
                                                </div>
                                            </td>
                                            <td>Basic (Monthly)</td>
                                            <td>30 Days</td>
                                            <td>Credit Card</td>
                                            <td>$50</td>
                                            <td>22 Feb 2024</td>
                                            <td>21 Mar 2024</td>
                                            <td><span class="badge badge-pill badge-status bg-success">Paid</span></td>
                                            <td>
                                                <div class="dropdown table-action">
                                                    <a href="#" class="action-icon "
                                                        data-bs-toggle="dropdown"aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#view_invoice"><i
                                                                class="ti ti-eye text-blue-light"></i> Preview</a>
                                                        <a class="dropdown-item" href="#">
                                                            <i class="ti ti-download text-blue"></i>Download
                                                        </a>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#delete_company">
                                                            <i class="ti ti-trash text-danger"></i>Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="checkboxs"><input type="checkbox"><span
                                                        class="checkmarks"></span></label></td>
                                            <td>
                                                <div class="set-star rating-select"><i class="fa fa-star"></i></div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="javascript:void(0);"
                                                        class="avatar avatar-sm border rounded p-1 me-2">
                                                        <img class="w-auto h-auto"
                                                            src="{{ URL::asset('build/img/icons/company-icon-09.svg') }}" alt="User Image">
                                                    </a>
                                                    <a href="javascript:void(0);"
                                                        class="d-flex flex-column fw-medium">Golden Gate Ltd</a>
                                                </div>
                                            </td>
                                            <td>Basic (Yearly)</td>
                                            <td>365 Days</td>
                                            <td>Paypal</td>
                                            <td>$600</td>
                                            <td>03 Nov 2024</td>
                                            <td>02 Nov 2025</td>
                                            <td><span class="badge badge-pill badge-status bg-success">Paid</span></td>
                                            <td>
                                                <div class="dropdown table-action">
                                                    <a href="#" class="action-icon "
                                                        data-bs-toggle="dropdown"aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#view_invoice"><i
                                                                class="ti ti-eye text-blue-light"></i> Preview</a>
                                                        <a class="dropdown-item" href="#">
                                                            <i class="ti ti-download text-blue"></i>Download
                                                        </a>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#delete_company">
                                                            <i class="ti ti-trash text-danger"></i>Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="checkboxs"><input type="checkbox"><span
                                                        class="checkmarks"></span></label></td>
                                            <td>
                                                <div class="set-star rating-select"><i class="fa fa-star"></i></div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="javascript:void(0);"
                                                        class="avatar avatar-sm border rounded p-1 me-2">
                                                        <img class="w-auto h-auto"
                                                            src="{{ URL::asset('build/img/icons/company-icon-10.svg') }}" alt="User Image">
                                                    </a>
                                                    <a href="javascript:void(0);"
                                                        class="d-flex flex-column fw-medium">Redwood Inc</a>
                                                </div>
                                            </td>
                                            <td>Advanced (Monthly)</td>
                                            <td>30 Days</td>
                                            <td>Credit Card</td>
                                            <td>$200</td>
                                            <td>17 Dec 2024</td>
                                            <td>16 Jan 2024</td>
                                            <td><span class="badge badge-pill badge-status bg-success">Paid</span></td>
                                            <td>
                                                <div class="dropdown table-action">
                                                    <a href="#" class="action-icon "
                                                        data-bs-toggle="dropdown"aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#view_invoice"><i
                                                                class="ti ti-eye text-blue-light"></i> Preview</a>
                                                        <a class="dropdown-item" href="#">
                                                            <i class="ti ti-download text-blue"></i>Download
                                                        </a>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#delete_company">
                                                            <i class="ti ti-trash text-danger"></i>Delete
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
                            <!-- /Contact List -->

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <!-- /Page Wrapper -->

    <!-- View Invoice -->
    <div class="modal fade" id="view_invoice">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body p-5">
                    <div class="row justify-content-between align-items-center mb-3">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <img src="{{ URL::asset('build/img/logo.svg') }}" class="img-fluid" alt="logo">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class=" text-end mb-3">
                                <h5 class="text-dark mb-1">Invoice</h5>
                                <p class="mb-1 fw-normal"><i class="ti ti-file-invoice me-1"></i>INV0287</p>
                                <p class="mb-1 fw-normal"><i class="ti ti-calendar me-1"></i>Issue date : 12 Sep 2024 </p>
                                <p class="fw-normal"><i class="ti ti-calendar me-1"></i>Due date : 12 Oct 2024 </p>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3 d-flex justify-content-between">
                        <div class="col-md-7">
                            <p class="text-dark mb-2 fw-medium fs-16">Invoice From :</p>
                            <div>
                                <p class="mb-1">Crms</p>
                                <p class="mb-1">367 Hillcrest Lane, Irvine, California,
                                    United States</p>
                                <p class="mb-1">crms@example.com</p>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <p class="text-dark mb-2 fw-medium fs-16">Invoice To :</p>
                            <div>
                                <p class="mb-1">BrightWave Innovations</p>
                                <p class="mb-1">367 Hillcrest Lane, Irvine, California,
                                    United States</p>
                                <p class="mb-1">michael@example.com</p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="table-responsive mb-3">
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Plan</th>
                                        <th>Billing Cycle</th>
                                        <th>Created Date</th>
                                        <th>Expiring On</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Advanced (Monthly)</td>
                                        <td>30 Days</td>
                                        <td>12 Sep 2024</td>
                                        <td>12 Oct 2024</td>
                                        <td>$200</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row mb-3 d-flex justify-content-between">
                        <div class="col-md-4">
                            <div>
                                <h6 class="mb-4">Payment info:</h6>
                                <p class="mb-0">Credit Card - 123***********789</p>
                                <div class="d-flex justify-content-between align-items-center mb-2 pe-3">
                                    <p class="mb-0">Amount</p>
                                    <p class="text-dark fw-medium mb-2">$200.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex justify-content-between align-items-center pe-3">
                                <p class="text-dark fw-medium mb-0">Sub Total</p>
                                <p class="mb-2">$200.00</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center pe-3">
                                <p class="text-dark fw-medium mb-0">Tax </p>
                                <p class="mb-2">$0.00</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center pe-3">
                                <p class="text-dark fw-medium mb-0">Total</p>
                                <p class="text-dark fw-medium mb-2">$200.00</p>
                            </div>
                        </div>
                    </div>
                    <div class="card border mb-0">
                        <div class="card-body">
                            <p class="text-dark fw-medium mb-2">Terms & Conditions:</p>
                            <p class="fs-12 fw-normal d-flex align-items-baseline mb-2"><i
                                    class="ti ti-point-filled text-primary me-1"></i>All payments must be made according to
                                the agreed schedule. Late payments may incur additional fees.</p>
                            <p class="fs-12 fw-normal d-flex align-items-baseline"><i
                                    class="ti ti-point-filled text-primary me-1"></i>We are not liable for any indirect,
                                incidental, or consequential damages, including loss of profits, revenue, or data.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /View Invoice -->

    <!-- Delete Company -->
    <div class="modal fade" id="delete_company" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="text-center">
                        <div class="avatar avatar-xl bg-danger-light rounded-circle mb-3">
                            <i class="ti ti-trash-x fs-36 text-danger"></i>
                        </div>
                        <h4 class="mb-2">Remove Subscription?</h4>
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
