<?php $page = 'invoice'; ?>
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
                            <div class="col-4">
                                <h4 class="page-title">Invoice</h4>
                            </div>
                            <div class="col-8 text-end">
                                <div class="head-icons">
                                    <a href="{{url('invoices')}}" data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-original-title="Refresh">
                                        <i class="ti ti-refresh-dot"></i>
                                    </a>
                                    <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-original-title="Collapse" id="collapse-header">
                                        <i class="ti ti-chevrons-up"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->

                    <div class="card ">
                        <div class="card-header">
                            <!-- Search -->
                            <div class="row align-items-center">
                                <div class="col-sm-4">
                                    <div class="icon-form mb-3 mb-sm-0">
                                        <span class="form-icon"><i class="ti ti-search"></i></span>
                                        <input type="text" class="form-control" placeholder="Search Invoices">
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
                                                                class="ti ti-file-type-pdf text-danger me-1"></i>Export as
                                                            PDF</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);" class="dropdown-item"><i
                                                                class="ti ti-file-type-xls text-green me-1"></i>Export as
                                                            Excel </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="offcanvas"
                                            data-bs-target="#offcanvas_add"><i
                                                class="ti ti-square-rounded-plus me-2"></i>Add New Invoices</a>
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
                                            <p class="mb-3">Please drag and drop your column to reorder your table and
                                                enable see option as you want.</p>
                                            <div class="border-top pt-3">
                                                <div class="d-flex align-items-center justify-content-between mb-3">
                                                    <p class="mb-0 d-flex align-items-center"><i
                                                            class="ti ti-grip-vertical me-2"></i>invoices.html</p>
                                                    <div class="status-toggle">
                                                        <input type="checkbox" id="col-name" class="check">
                                                        <label for="col-name" class="checktoggle"></label>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between mb-3">
                                                    <p class="mb-0 d-flex align-items-center"><i
                                                            class="ti ti-grip-vertical me-2"></i>Date</p>
                                                    <div class="status-toggle">
                                                        <input type="checkbox" id="col-phone" class="check">
                                                        <label for="col-phone" class="checktoggle"></label>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between mb-3">
                                                    <p class="mb-0 d-flex align-items-center"><i
                                                            class="ti ti-grip-vertical me-2"></i>Customer</p>
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
                                                <div class="d-flex align-items-center justify-content-between mb-3">
                                                    <p class="mb-0 d-flex align-items-center"><i
                                                            class="ti ti-grip-vertical me-2"></i>Action</p>
                                                    <div class="status-toggle">
                                                        <input type="checkbox" id="col-loc" class="check">
                                                        <label for="col-loc" class="checktoggle"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-sorts dropdown">
                                        <a href="javascript:void(0);" data-bs-toggle="dropdown"
                                            data-bs-auto-close="outside"><i class="ti ti-filter-share"></i>Filter</a>
                                        <div class="filter-dropdown-menu dropdown-menu  dropdown-menu-md-end p-4">
                                            <div class="filter-set-view">
                                                <div class="filter-set-head">
                                                    <h4><i class="ti ti-filter-share"></i>Filter</h4>
                                                </div>
                                                <div class="accordion" id="accordionExample">

                                                    <div class="filter-set-content">
                                                        <div class="filter-set-content-head">
                                                            <a href="#" class="collapsed" data-bs-toggle="collapse"
                                                                data-bs-target="#owner" aria-expanded="false"
                                                                aria-controls="owner">Invoice No</a>
                                                        </div>
                                                        <div class="filter-set-contents accordion-collapse collapse"
                                                            id="owner" data-bs-parent="#accordionExample">
                                                            <div class="filter-content-list">
                                                                <div class="mb-2 icon-form">
                                                                    <span class="form-icon"><i
                                                                            class="ti ti-search"></i></span>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Search Invoice No">
                                                                </div>
                                                                <ul>
                                                                    <li>
                                                                        <div class="filter-checks">
                                                                            <label class="checkboxs">
                                                                                <input type="checkbox" checked>
                                                                                <span class="checkmarks"></span>
                                                                                702501
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="filter-checks">
                                                                            <label class="checkboxs">
                                                                                <input type="checkbox">
                                                                                <span class="checkmarks"></span>
                                                                                702502
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="filter-checks">
                                                                            <label class="checkboxs">
                                                                                <input type="checkbox">
                                                                                <span class="checkmarks"></span>
                                                                                702503
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="filter-checks">
                                                                            <label class="checkboxs">
                                                                                <input type="checkbox">
                                                                                <span class="checkmarks"></span>
                                                                                702504
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="filter-checks">
                                                                            <label class="checkboxs">
                                                                                <input type="checkbox">
                                                                                <span class="checkmarks"></span>
                                                                                702505
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
                                                                aria-controls="collapseThree">Customer</a>
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
                                                                                NovaWave LLC
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="filter-checks">
                                                                            <label class="checkboxs">
                                                                                <input type="checkbox">
                                                                                <span class="checkmarks"></span>
                                                                                BlueSky Industries
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="filter-checks">
                                                                            <label class="checkboxs">
                                                                                <input type="checkbox">
                                                                                <span class="checkmarks"></span>
                                                                                Silver Hawk
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="filter-checks">
                                                                            <label class="checkboxs">
                                                                                <input type="checkbox">
                                                                                <span class="checkmarks"></span>
                                                                                Summit Peak
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
                                                                data-bs-target="#collapsethree" aria-expanded="false"
                                                                aria-controls="collapsethree">Status</a>
                                                        </div>
                                                        <div class="filter-set-contents accordion-collapse collapse"
                                                            id="collapsethree" data-bs-parent="#accordionExample">
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
                                                                    <li>
                                                                        <div class="filter-checks">
                                                                            <label class="checkboxs">
                                                                                <input type="checkbox">
                                                                                <span class="checkmarks"></span>
                                                                                Pending
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="filter-checks">
                                                                            <label class="checkboxs">
                                                                                <input type="checkbox">
                                                                                <span class="checkmarks"></span>
                                                                                Overdue
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
                                                                data-bs-target="#collapsefour" aria-expanded="false"
                                                                aria-controls="collapsefour">Date</a>
                                                        </div>
                                                        <div class="filter-set-contents accordion-collapse collapse"
                                                            id="collapsefour" data-bs-parent="#accordionExample">
                                                            <div class="filter-content-list">
                                                                <ul>
                                                                    <li>
                                                                        <div class="filter-checks">
                                                                            <label class="checkboxs">
                                                                                <input type="checkbox" checked>
                                                                                <span class="checkmarks"></span>
                                                                                21 May 2024
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="filter-checks">
                                                                            <label class="checkboxs">
                                                                                <input type="checkbox">
                                                                                <span class="checkmarks"></span>
                                                                                19 Oct 2023
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="filter-checks">
                                                                            <label class="checkboxs">
                                                                                <input type="checkbox">
                                                                                <span class="checkmarks"></span>
                                                                                24 Oct 2023
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="filter-checks">
                                                                            <label class="checkboxs">
                                                                                <input type="checkbox">
                                                                                <span class="checkmarks"></span>
                                                                                10 Nov 2023
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
                                                            <a href="{{url('invoice')}}" class="btn btn-primary">Filter</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Filter -->

                            <!-- Projects List -->
                            <div class="table-responsive custom-table">
                                <table class="table datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="no-sort">
                                                <label class="checkboxs"><input type="checkbox" id="select-all"><span
                                                        class="checkmarks"></span></label>
                                            </th>
                                            <th></th>
                                            <th>Invoice ID</th>
                                            <th>Customer</th>
                                            <th>Created Date</th>
                                            <th>Total</th>
                                            <th>Amount Due</th>
                                            <th>Due Date</th>
                                            <th>Status</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><label class="checkboxs"><input type="checkbox"><span
                                                        class="checkmarks"></span></label>
                                            </td>
                                            <td>
                                                <div class="set-star rating-select"><i class="fa fa-star"></i></div>
                                            </td>
                                            <td><a href="{{url('invoice-details')}}" class="title-name">#702501</a></td>
                                            <td>NovaWave LLC</td>
                                            <td>25 Sep 2024</td>
                                            <td>$300</td>
                                            <td>$0</td>
                                            <td>25 Sep 2023</td>
                                            <td><span class="badge badge-pill badge-status bg-success">Paid</span></td>
                                            <td>
                                                <div class="dropdown table-action">
                                                    <a href="#" class="action-icon "
                                                        data-bs-toggle="dropdown"aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#"
                                                            data-bs-toggle="offcanvas"data-bs-target="#offcanvas_edit">
                                                            <i class="ti ti-edit text-blue"></i>Edit
                                                        </a>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#delete_invoices">
                                                            <i class="ti ti-trash text-danger"></i>Delete
                                                        </a>
                                                        <a class="dropdown-item" href="{{url('invoice-details')}}">
                                                            <i class="ti ti-clipboard-copy text-green"></i> View Invoices
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="checkboxs"><input type="checkbox"><span
                                                        class="checkmarks"></span></label>
                                            </td>
                                            <td>
                                                <div class="set-star rating-select"><i class="fa fa-star"></i></div>
                                            </td>
                                            <td><a href="{{url('invoice-details')}}" class="title-name">#702502</a></td>
                                            <td>BlueSky Industries </td>
                                            <td>27 Sep 2024</td>
                                            <td>$547</td>
                                            <td>$547</td>
                                            <td>27 Sep 2024</td>
                                            <td><span class="badge badge-pill badge-status bg-danger">Unpaid</span></td>
                                            <td>
                                                <div class="dropdown table-action">
                                                    <a href="#" class="action-icon "
                                                        data-bs-toggle="dropdown"aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#"
                                                            data-bs-toggle="offcanvas"data-bs-target="#offcanvas_edit">
                                                            <i class="ti ti-edit text-blue"></i>Edit
                                                        </a>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#delete_invoices">
                                                            <i class="ti ti-trash text-danger"></i>Delete
                                                        </a>
                                                        <a class="dropdown-item" href="{{url('invoice-details')}}">
                                                            <i class="ti ti-clipboard-copy text-green"></i> View Invoices
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="checkboxs"><input type="checkbox"><span
                                                        class="checkmarks"></span></label>
                                            </td>
                                            <td>
                                                <div class="set-star rating-select"><i class="fa fa-star"></i></div>
                                            </td>
                                            <td><a href="{{url('invoice-details')}}" class="title-name">#702503</a></td>
                                            <td>Silver Hawk</td>
                                            <td>02 Oct 2024</td>
                                            <td>$325</td>
                                            <td>$65</td>
                                            <td>02 Oct 2024</td>
                                            <td><span class="badge badge-pill badge-status bg-purple">Pending</span></td>
                                            <td>
                                                <div class="dropdown table-action">
                                                    <a href="#" class="action-icon "
                                                        data-bs-toggle="dropdown"aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#"
                                                            data-bs-toggle="offcanvas"data-bs-target="#offcanvas_edit">
                                                            <i class="ti ti-edit text-blue"></i>Edit
                                                        </a>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#delete_invoices">
                                                            <i class="ti ti-trash text-danger"></i>Delete
                                                        </a>
                                                        <a class="dropdown-item" href="{{url('invoice-details')}}">
                                                            <i class="ti ti-clipboard-copy text-green"></i> View Invoices
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="checkboxs"><input type="checkbox"><span
                                                        class="checkmarks"></span></label>
                                            </td>
                                            <td>
                                                <div class="set-star rating-select"><i class="fa fa-star"></i></div>
                                            </td>
                                            <td><a href="{{url('invoice-details')}}" class="title-name">#702504</a></td>
                                            <td>Summit Peak</td>
                                            <td>14 Oct 2024</td>
                                            <td>$471</td>
                                            <td>$0</td>
                                            <td>14 Oct 2024</td>
                                            <td><span class="badge badge-pill badge-status bg-success">Paid</span></td>
                                            <td>
                                                <div class="dropdown table-action">
                                                    <a href="#" class="action-icon "
                                                        data-bs-toggle="dropdown"aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#"
                                                            data-bs-toggle="offcanvas"data-bs-target="#offcanvas_edit">
                                                            <i class="ti ti-edit text-blue"></i>Edit
                                                        </a>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#delete_invoices">
                                                            <i class="ti ti-trash text-danger"></i>Delete
                                                        </a>
                                                        <a class="dropdown-item" href="{{url('invoice-details')}}">
                                                            <i class="ti ti-clipboard-copy text-green"></i> View Invoices
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="checkboxs"><input type="checkbox"><span
                                                        class="checkmarks"></span></label>
                                            </td>
                                            <td>
                                                <div class="set-star rating-select"><i class="fa fa-star"></i></div>
                                            </td>
                                            <td><a href="{{url('invoice-details')}}" class="title-name">#702505</a></td>
                                            <td>RiverStone Ventur</td>
                                            <td>16 Oct 2024</td>
                                            <td>$461</td>
                                            <td>$32</td>
                                            <td>16 Oct 2024</td>
                                            <td><span class="badge badge-pill badge-status bg-warning">Overdue</span></td>
                                            <td>
                                                <div class="dropdown table-action">
                                                    <a href="#" class="action-icon "
                                                        data-bs-toggle="dropdown"aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#"
                                                            data-bs-toggle="offcanvas"data-bs-target="#offcanvas_edit">
                                                            <i class="ti ti-edit text-blue"></i>Edit
                                                        </a>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#delete_invoices">
                                                            <i class="ti ti-trash text-danger"></i>Delete
                                                        </a>
                                                        <a class="dropdown-item" href="{{url('invoice-details')}}">
                                                            <i class="ti ti-clipboard-copy text-green"></i> View Invoices
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="checkboxs"><input type="checkbox"><span
                                                        class="checkmarks"></span></label>
                                            </td>
                                            <td>
                                                <div class="set-star rating-select"><i class="fa fa-star"></i></div>
                                            </td>
                                            <td><a href="{{url('invoice-details')}}" class="title-name">#702506</a></td>
                                            <td>Bright Bridge Grp</td>
                                            <td>20 Oct 2024</td>
                                            <td>$400</td>
                                            <td>$0</td>
                                            <td>20 Oct 2024</td>
                                            <td><span class="badge badge-pill badge-status bg-success">Paid</span></td>
                                            <td>
                                                <div class="dropdown table-action">
                                                    <a href="#" class="action-icon "
                                                        data-bs-toggle="dropdown"aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#"
                                                            data-bs-toggle="offcanvas"data-bs-target="#offcanvas_edit">
                                                            <i class="ti ti-edit text-blue"></i>Edit
                                                        </a>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#delete_invoices">
                                                            <i class="ti ti-trash text-danger"></i>Delete
                                                        </a>
                                                        <a class="dropdown-item" href="{{url('invoice-details')}}">
                                                            <i class="ti ti-clipboard-copy text-green"></i> View Invoices
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="checkboxs"><input type="checkbox"><span
                                                        class="checkmarks"></span></label>
                                            </td>
                                            <td>
                                                <div class="set-star rating-select"><i class="fa fa-star"></i></div>
                                            </td>
                                            <td><a href="{{url('invoice-details')}}" class="title-name">#702507</a></td>
                                            <td>CoastalStar Co.</td>
                                            <td>22 Oct 2024</td>
                                            <td>$500</td>
                                            <td>$50</td>
                                            <td>22 Oct 2024</td>
                                            <td><span class="badge badge-pill badge-status bg-purple">Pending</span></td>
                                            <td>
                                                <div class="dropdown table-action">
                                                    <a href="#" class="action-icon "
                                                        data-bs-toggle="dropdown"aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#"
                                                            data-bs-toggle="offcanvas"data-bs-target="#offcanvas_edit">
                                                            <i class="ti ti-edit text-blue"></i>Edit
                                                        </a>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#delete_invoices">
                                                            <i class="ti ti-trash text-danger"></i>Delete
                                                        </a>
                                                        <a class="dropdown-item" href="{{url('invoice-details')}}">
                                                            <i class="ti ti-clipboard-copy text-green"></i> View Invoices
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="checkboxs"><input type="checkbox"><span
                                                        class="checkmarks"></span></label>
                                            </td>
                                            <td>
                                                <div class="set-star rating-select"><i class="fa fa-star"></i></div>
                                            </td>
                                            <td><a href="{{url('invoice-details')}}" class="title-name">#702508</a></td>
                                            <td>HarborView</td>
                                            <td>25 Oct 2024</td>
                                            <td>$654</td>
                                            <td>$654</td>
                                            <td>25 Oct 2024</td>
                                            <td><span class="badge badge-pill badge-status bg-danger">Unpaid</span></td>
                                            <td>
                                                <div class="dropdown table-action">
                                                    <a href="#" class="action-icon "
                                                        data-bs-toggle="dropdown"aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#"
                                                            data-bs-toggle="offcanvas"data-bs-target="#offcanvas_edit">
                                                            <i class="ti ti-edit text-blue"></i>Edit
                                                        </a>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#delete_invoices">
                                                            <i class="ti ti-trash text-danger"></i>Delete
                                                        </a>
                                                        <a class="dropdown-item" href="{{url('invoice-details')}}">
                                                            <i class="ti ti-clipboard-copy text-green"></i> View Invoices
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="checkboxs"><input type="checkbox"><span
                                                        class="checkmarks"></span></label>
                                            </td>
                                            <td>
                                                <div class="set-star rating-select"><i class="fa fa-star"></i></div>
                                            </td>
                                            <td><a href="{{url('invoice-details')}}" class="title-name">#702509</a></td>
                                            <td>Golden Gate Ltd</td>
                                            <td>10 Nov 2024</td>
                                            <td>$980</td>
                                            <td>$0</td>
                                            <td>10 Nov 2024</td>
                                            <td><span class="badge badge-pill badge-status bg-success">Paid</span></td>
                                            <td>
                                                <div class="dropdown table-action">
                                                    <a href="#" class="action-icon "
                                                        data-bs-toggle="dropdown"aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#"
                                                            data-bs-toggle="offcanvas"data-bs-target="#offcanvas_edit">
                                                            <i class="ti ti-edit text-blue"></i>Edit
                                                        </a>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#delete_invoices">
                                                            <i class="ti ti-trash text-danger"></i>Delete
                                                        </a>
                                                        <a class="dropdown-item" href="{{url('invoice-details')}}">
                                                            <i class="ti ti-clipboard-copy text-green"></i> View Invoices
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="checkboxs"><input type="checkbox"><span
                                                        class="checkmarks"></span></label>
                                            </td>
                                            <td>
                                                <div class="set-star rating-select"><i class="fa fa-star"></i></div>
                                            </td>
                                            <td><a href="{{url('invoice-details')}}" class="title-name">#702510</a></td>
                                            <td>Redwood Inc</td>
                                            <td>20 Nov 2024</td>
                                            <td>$365</td>
                                            <td>$200</td>
                                            <td>20 Nov 2024</td>
                                            <td><span class="badge badge-pill badge-status bg-warning">Overdue</span></td>
                                            <td>
                                                <div class="dropdown table-action">
                                                    <a href="#" class="action-icon "
                                                        data-bs-toggle="dropdown"aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#"
                                                            data-bs-toggle="offcanvas"data-bs-target="#offcanvas_edit">
                                                            <i class="ti ti-edit text-blue"></i>Edit
                                                        </a>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#delete_invoices">
                                                            <i class="ti ti-trash text-danger"></i>Delete
                                                        </a>
                                                        <a class="dropdown-item" href="{{url('invoice-details')}}">
                                                            <i class="ti ti-clipboard-copy text-green"></i> View Invoices
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
                            <!-- /Projects List -->

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <!-- /Page Wrapper -->

    <!-- Add New Invoices -->
    <div class="offcanvas offcanvas-end offcanvas-large" tabindex="-1" id="offcanvas_add">
        <div class="offcanvas-header border-bottom">
            <h4>Add New Invoice</h4>
            <button type="button"
                class="btn-close custom-btn-close border p-1 me-0 d-flex align-items-center justify-content-center rounded-circle"
                data-bs-dismiss="offcanvas" aria-label="Close">
                <i class="ti ti-x"></i>
            </button>
        </div>
        <div class="offcanvas-body">
            <form action="{{url('invoices')}}">
                <div>
                    <div class="row">
                        <div class="mb-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <label class="col-form-label">Client</label>
                                <a href="#" class="label-add" data-bs-toggle="modal" data-bs-target="#add_deal"><i
                                        class="ti ti-square-rounded-plus"></i>Add New</a>
                            </div>
                            <select class="select">
                                <option>Choose</option>
                                <option>NovaWave LLC</option>
                                <option>BlueSky Industries</option>
                                <option>ASilver Hawkdams</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="col-form-label">Bill To<span class="text-danger"> *</span></label>
                                <input class="form-control" type="text">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="col-form-label">Ship To<span class="text-danger"> *</span></label>
                                <input class="form-control" type="text">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <label class="col-form-label">Project</label>
                                <a href="#" class="label-add" data-bs-toggle="modal" data-bs-target="#add_deal"><i
                                        class="ti ti-square-rounded-plus"></i>Add New</a>
                            </div>
                            <select class="select">
                                <option>Choose</option>
                                <option>Truelysell</option>
                                <option>Dreamschat</option>
                                <option>Servbook</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="col-form-label">Amount<span class="text-danger"> *</span></label>
                                <input class="form-control" type="text">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="col-form-label">Currency</label>
                                <select class="select2">
                                    <option>Choose</option>
                                    <option>$</option>
                                    <option>INR</option>
                                    <option>Euro</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="col-form-label">Invoice Date <span class="text-danger">*</span></label>
                                <div class="icon-form">
                                    <span class="form-icon"><i class="ti ti-calendar-check"></i></span>
                                    <input type="text" class="form-control datetimepicker" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="col-form-label">Due Date<span class="text-danger">*</span></label>
                                <div class="icon-form">
                                    <span class="form-icon"><i class="ti ti-calendar-check"></i></span>
                                    <input type="text" class="form-control datetimepicker" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="col-form-label">Payment Method</label>
                                <select class="select">
                                    <option>Choose</option>
                                    <option>Active</option>
                                    <option>Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="col-form-label">Status</label>
                                <select class="select">
                                    <option>Choose</option>
                                    <option>Active</option>
                                    <option>Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="col-form-label">Description <span class="text-danger">*</span></label>
                                <div class="summernote"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <label class="col-form-label">Project</label>
                                <a href="#" class="label-add" data-bs-toggle="modal" data-bs-target="#add_deal"><i
                                        class="ti ti-square-rounded-plus"></i>Add New</a>
                            </div>
                            <select class="select">
                                <option>Choose</option>
                                <option>NovaWave LLC</option>
                                <option>BlueSky Industries</option>
                                <option>ASilver Hawkdams</option>
                            </select>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-view">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Discount</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="input-table input-table-descripition">
                                                <input type="text">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-table">
                                                <input type="text">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-table">
                                                <input type="text">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-table">
                                                <select>
                                                    <option>%</option>
                                                    <option>5%</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-table">
                                                <input type="text">
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-success-light">
                                                <i class="ti ti-check"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="subtotal-div mb-3">
                            <ul class="mb-3">
                                <li>
                                    <h5>Subtotal</h5>
                                    <h6>$0.00</h6>
                                </li>
                                <li>
                                    <h5>Discount 2%</h5>
                                    <h6>$0.00</h6>
                                </li>
                                <li>
                                    <h5>Extra Discount 0%</h5>
                                    <h6>$0.00</h6>
                                </li>
                                <li>
                                    <h5>Tax</h5>
                                    <h6>$0.00</h6>
                                </li>
                                <li>
                                    <h5>Total</h5>
                                    <h6>$0.00</h6>
                                </li>
                            </ul>
                            <div class="row">
                                <div class="mb-3">
                                    <label class="col-form-label">Signature Name</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label">Signature Image</label>
                                    <div class="upload-signature">
                                        <input type="file">
                                        <a href="#">Upload Signature</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="col-form-label">Notes<span class="text-danger"> *</span></label>
                                <textarea class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="col-form-label">Terms & Conditions<span class="text-danger">
                                        *</span></label>
                                <textarea class="form-control" rows="5"></textarea>
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
    <!-- /Add New Invoices -->

    <!-- Edit Invoices -->
    <div class="offcanvas offcanvas-end offcanvas-large" tabindex="-1" id="offcanvas_edit">
        <div class="offcanvas-header border-bottom">
            <h4>Edit Invoice</h4>
            <button type="button"
                class="btn-close custom-btn-close border p-1 me-0 d-flex align-items-center justify-content-center rounded-circle"
                data-bs-dismiss="offcanvas" aria-label="Close">
                <i class="ti ti-x"></i>
            </button>
        </div>
        <div class="offcanvas-body">
            <form action="{{url('invoices')}}">
                <div>
                    <div class="row">
                        <div class="mb-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <label class="col-form-label">Client</label>
                                <a href="#" class="label-add" data-bs-toggle="modal" data-bs-target="#add_deal"><i
                                        class="ti ti-square-rounded-plus"></i>Add New</a>
                            </div>
                            <select class="select">
                                <option>Choose</option>
                                <option selected>NovaWave LLC</option>
                                <option>BlueSky Industries</option>
                                <option>ASilver Hawkdams</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="col-form-label">Bill To<span class="text-danger"> *</span></label>
                                <input class="form-control" type="text">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="col-form-label">Ship To<span class="text-danger"> *</span></label>
                                <input class="form-control" type="text">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <label class="col-form-label">Project</label>
                                <a href="#" class="label-add" data-bs-toggle="modal" data-bs-target="#add_deal"><i
                                        class="ti ti-square-rounded-plus"></i>Add New</a>
                            </div>
                            <select class="select">
                                <option>Choose</option>
                                <option selected>Truelysell</option>
                                <option>Dreamschat</option>
                                <option>Servbook</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="col-form-label">Amount<span class="text-danger"> *</span></label>
                                <input class="form-control" type="text" value="2,15,000">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="col-form-label">Currency</label>
                                <select class="select2">
                                    <option>Choose</option>
                                    <option>$</option>
                                    <option>INR</option>
                                    <option>Euro</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="col-form-label">Invoice Date <span class="text-danger">*</span></label>
                                <div class="icon-form">
                                    <span class="form-icon"><i class="ti ti-calendar-check"></i></span>
                                    <input type="text" class="form-control datetimepicker" value="15 Oct 2023">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="col-form-label">Due Date<span class="text-danger">*</span></label>
                                <div class="icon-form">
                                    <span class="form-icon"><i class="ti ti-calendar-check"></i></span>
                                    <input type="text" class="form-control datetimepicker" value="20 Oct 2023">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="col-form-label">Payment Method</label>
                                <select class="select">
                                    <option>Choose</option>
                                    <option>Active</option>
                                    <option>Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="col-form-label">Status</label>
                                <select class="select">
                                    <option>Choose</option>
                                    <option>Active</option>
                                    <option>Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="col-form-label">Description <span class="text-danger">*</span></label>
                                <div class="summernote"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <label class="col-form-label">Project</label>
                                <a href="#" class="label-add" data-bs-toggle="modal" data-bs-target="#add_deal"><i
                                        class="ti ti-square-rounded-plus"></i>Add New</a>
                            </div>
                            <select class="select">
                                <option>Choose</option>
                                <option>NovaWave LLC</option>
                                <option>BlueSky Industries</option>
                                <option>ASilver Hawkdams</option>
                            </select>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-view">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Discount</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="input-table input-table-descripition">
                                                <input type="text">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-table">
                                                <input type="text">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-table">
                                                <input type="text">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-table">
                                                <select>
                                                    <option>%</option>
                                                    <option>5%</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-table">
                                                <input type="text">
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-success-light">
                                                <i class="ti ti-check"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-view">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Discount</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="input-table input-table-descripition">
                                                <input type="text" value="Web Design">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-table">
                                                <input type="text" value="1">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-table">
                                                <input type="text" value="$200">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-table">
                                                <select>
                                                    <option>2%</option>
                                                    <option>5%</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-table">
                                                <input type="text" value="$196">
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-danger-light">
                                                <i class="ti ti-x"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="subtotal-div mb-3">
                            <ul class="mb-3">
                                <li>
                                    <h5>Subtotal</h5>
                                    <h6>$196.00</h6>
                                </li>
                                <li>
                                    <h5>Discount 2%</h5>
                                    <h6>$4.00</h6>
                                </li>
                                <li>
                                    <h5>Extra Discount 0%</h5>
                                    <h6>$0.00</h6>
                                </li>
                                <li>
                                    <h5>Tax</h5>
                                    <h6>$0.00</h6>
                                </li>
                                <li>
                                    <h5>Total</h5>
                                    <h6>$192.00</h6>
                                </li>
                            </ul>
                            <div class="row">
                                <div class="mb-3">
                                    <label class="col-form-label">Signature Name</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="mb-0">
                                    <label class="col-form-label">Signature Image</label>
                                    <div class="upload-signature ">
                                        <input type="file">
                                        <a href="#" class="text-start">
                                            <img src="{{ URL::asset('build/img/signature.png') }}" alt="img">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="col-form-label">Notes<span class="text-danger"> *</span></label>
                                <textarea class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="col-form-label">Terms & Conditions<span class="text-danger">
                                        *</span></label>
                                <textarea class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-end">
                    <button type="button" data-bs-dismiss="offcanvas" class="btn btn-light me-2">Cancel</button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#create_success">Create</button>
                </div>
            </form>
        </div>
    </div>
    <!-- /Edit Invoices -->

    <!-- Delete Invoices -->
    <div class="modal fade" id="delete_invoices" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="text-center">
                        <div class="avatar avatar-xl bg-danger-light rounded-circle mb-3">
                            <i class="ti ti-trash-x fs-36 text-danger"></i>
                        </div>
                        <h4 class="mb-2">Remove Invoice?</h4>
                        <p class="mb-0">Are you sure you want to remove <br> invoice you selected.</p>
                        <div class="d-flex align-items-center justify-content-center mt-4">
                            <a href="#" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</a>
                            <a href="{{url('invoice')}}" class="btn btn-danger">Yes, Delete it</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Delete Invoices -->

    <!-- Add New View -->
    <div class="modal custom-modal fade" id="add_deal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{url('invoices')}}">
                        <div class="mb-3">
                            <label class="col-form-label">Name</label>
                            <input type="text" class="form-control" placeholder="Enter Name">
                        </div>
                        <div class="modal-btn text-end">
                            <a href="#" class="btn btn-light" data-bs-dismiss="modal">Cancel</a>
                            <button type="submit" class="btn btn-danger">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Add New View -->
@endsection
