<?php $page = 'domain'; ?>
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
                                <h4 class="page-title">Domain<span class="count-title">123</span></h4>
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
                                                            class="ti ti-grip-vertical me-2"></i>Name</p>
                                                    <div class="status-toggle">
                                                        <input type="checkbox" id="col-name" class="check">
                                                        <label for="col-name" class="checktoggle"></label>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between mb-3">
                                                    <p class="mb-0 d-flex align-items-center"><i
                                                            class="ti ti-grip-vertical me-2"></i>Domain Url</p>
                                                    <div class="status-toggle">
                                                        <input type="checkbox" id="col-phone" class="check">
                                                        <label for="col-phone" class="checktoggle"></label>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between mb-3">
                                                    <p class="mb-0 d-flex align-items-center"><i
                                                            class="ti ti-grip-vertical me-2"></i>Plan</p>
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
                                                                                Approved
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
                                                                                Rejected
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
                                            <th>Name</th>
                                            <th>Domain URL</th>
                                            <th>Plan</th>
                                            <th>Created Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
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
                                            <td>bwi.example.com</td>
                                            <td>Advanced (Monthly)</td>
                                            <td>12 Sep 2024</td>
                                            <td><span class="badge badge-pill badge-status bg-success">Approved</span></td>
                                            <td>
                                                <div class="dropdown table-action">
                                                    <a href="#" class="action-icon "
                                                        data-bs-toggle="dropdown"aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#domain_approved"><i
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
                                            <td>sd.example.com</td>
                                            <td>Basic (Yearly)</td>
                                            <td>24 Oct 2024</td>
                                            <td><span class="badge badge-pill badge-status bg-info">pending</span></td>
                                            <td>
                                                <div class="dropdown table-action">
                                                    <a href="#" class="action-icon "
                                                        data-bs-toggle="dropdown"aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#domain_pending"><i
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
                                            <td>qn.example.com</td>
                                            <td>Advanced (Monthly)</td>
                                            <td>18 Feb 2024</td>
                                            <td><span class="badge badge-pill badge-status bg-danger">Rejected</span></td>
                                            <td>
                                                <div class="dropdown table-action">
                                                    <a href="#" class="action-icon "
                                                        data-bs-toggle="dropdown"aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#domain_rejected"><i
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
                                            <td>eve.example.com</td>
                                            <td>Advanced (Monthly)</td>
                                            <td>17 Oct 2024</td>
                                            <td><span class="badge badge-pill badge-status bg-success">Approved</span></td>
                                            <td>
                                                <div class="dropdown table-action">
                                                    <a href="#" class="action-icon "
                                                        data-bs-toggle="dropdown"aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#domain_approved"><i
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
                                            <td>at.example.com</td>
                                            <td>Enterprise (Monthly)</td>
                                            <td>20 Jul 2024</td>
                                            <td><span class="badge badge-pill badge-status bg-success">Approved</span></td>
                                            <td>
                                                <div class="dropdown table-action">
                                                    <a href="#" class="action-icon "
                                                        data-bs-toggle="dropdown"aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#domain_approved"><i
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
                                            <td>bsv.example.com</td>
                                            <td>Advanced (Monthly)</td>
                                            <td>10 Apr 2024</td>
                                            <td><span class="badge badge-pill badge-status bg-info">Pending</span></td>
                                            <td>
                                                <div class="dropdown table-action">
                                                    <a href="#" class="action-icon "
                                                        data-bs-toggle="dropdown"aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#domain_pending"><i
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
                                            <td>tfe.example.com</td>
                                            <td>Enterprise (Yearly)</td>
                                            <td>29 Aug 2024</td>
                                            <td><span class="badge badge-pill badge-status bg-success">Approved</span></td>
                                            <td>
                                                <div class="dropdown table-action">
                                                    <a href="#" class="action-icon "
                                                        data-bs-toggle="dropdown"aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#domain_approved"><i
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
                                            <td>upd.example.com</td>
                                            <td>Basic (Monthly)</td>
                                            <td>22 Feb 2024</td>
                                            <td><span class="badge badge-pill badge-status bg-danger">Rejected</span></td>
                                            <td>
                                                <div class="dropdown table-action">
                                                    <a href="#" class="action-icon "
                                                        data-bs-toggle="dropdown"aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#domain_rejected"><i
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
                                            <td>nn.example.com</td>
                                            <td>Basic (Yearly)</td>
                                            <td>03 Nov 2024</td>
                                            <td><span class="badge badge-pill badge-status bg-success">Approved</span></td>
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
                                            <td>ed.example.com</td>
                                            <td>Advanced (Monthly)</td>
                                            <td>17 Dec 2024</td>
                                            <td><span class="badge badge-pill badge-status bg-success">Approved</span></td>
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

    <!-- Domain Details -->
    <div class="modal fade" id="domain_approved">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title d-flex align-items-center">
                        Domain Detail
                        <span class="badge bg-outline-success d-inline-flex align-items-center badge-xs ms-2">
                            <i class="ti ti-point-filled"></i>Approved
                        </span>
                    </h4>
                    <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
                <form action="{{url('domain')}}">
                    <div class="modal-body pb-0">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <div class="p-3 mb-3 br-5 bg-light-400">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="d-flex align-items-center file-name-icon">
                                                    <a href="#" class="avatar avatar-md border avatar-rounded">
                                                        <img src="{{ URL::asset('build/img/icons/company-icon-01.svg') }}" class="img-fluid"
                                                            alt="img">
                                                    </a>
                                                    <div class="ms-2">
                                                        <h6 class="fw-medium fs-14"><a href="#">NovaWave LLC</a>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <span class="fs-12">Plan Name</span>
                                    <h6 class="fw-normal">Advanced</h6>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <span class="fs-12">Plan Type</span>
                                    <h6 class="fw-normal">Monthly</h6>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <span class="fs-12">Account URL</span>
                                    <h6 class="fw-normal">bwi.example.com</h6>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <span class="fs-12">Price</span>
                                    <h6 class="fw-normal">200</h6>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <span class="fs-12">Register Date</span>
                                    <h6 class="fw-normal">12 Sep 2024</h6>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <span class="fs-12">Expiring On</span>
                                    <h6 class="fw-normal">11 Oct 2024</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Domain Details -->

    <!-- Domain Details -->
    <div class="modal fade" id="domain_pending">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title d-flex align-items-center">
                        Domain Detail
                        <span class="badge bg-outline-skyblue d-inline-flex align-items-center badge-xs ms-2">
                            <i class="ti ti-point-filled"></i>Pending
                        </span>
                    </h4>
                    <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
                <form action="{{url('domain')}}">
                    <div class="modal-body pb-0">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <div class="p-3 mb-3 br-5 bg-light-400">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="d-flex align-items-center file-name-icon">
                                                    <a href="#" class="avatar avatar-md border avatar-rounded">
                                                        <img src="{{ URL::asset('build/img/icons/company-icon-01.svg') }}" class="img-fluid"
                                                            alt="img">
                                                    </a>
                                                    <div class="ms-2">
                                                        <h6 class="fw-medium fs-14"><a href="#">NovaWave LLC</a>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 text-end">
                                                <span
                                                    class="badge badge-success d-inline-flex align-items-center badge-xs ms-2">
                                                    <i class="ti ti-check me-1"></i>Approve
                                                </span>
                                                <span
                                                    class="badge badge-danger d-inline-flex align-items-center badge-xs ms-2">
                                                    <i class="ti ti-x me-1"></i>Reject
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <span class="fs-12">Plan Name</span>
                                    <h6 class="fw-normal">Advanced</h6>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <span class="fs-12">Plan Type</span>
                                    <h6 class="fw-normal">Monthly</h6>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <span class="fs-12">Account URL</span>
                                    <h6 class="fw-normal">bwi.example.com</h6>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <span class="fs-12">Price</span>
                                    <h6 class="fw-normal">200</h6>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <span class="fs-12">Register Date</span>
                                    <h6 class="fw-normal">12 Sep 2024</h6>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <span class="fs-12">Expiring On</span>
                                    <h6 class="fw-normal">11 Oct 2024</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Domain Details -->

    <!-- Domain Details -->
    <div class="modal fade" id="domain_rejected">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title d-flex align-items-center">Domain Detail
                        <span class="badge bg-outline-danger d-inline-flex align-items-center badge-xs ms-2">
                            <i class="ti ti-point-filled"></i>Rejected
                        </span>
                    </h4>
                    <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
                <form action="{{url('domain')}}">
                    <div class="modal-body pb-0">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <div class="p-3 mb-3 br-5 bg-light-400">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="d-flex align-items-center file-name-icon">
                                                    <a href="#" class="avatar avatar-md border avatar-rounded">
                                                        <img src="{{ URL::asset('build/img/icons/company-icon-01.svg') }}" class="img-fluid"
                                                            alt="img">
                                                    </a>
                                                    <div class="ms-2">
                                                        <h6 class="fw-medium fs-14"><a href="#">NovaWave LLC</a>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <span class="fs-12">Plan Name</span>
                                    <h6 class="fw-normal">Advanced</h6>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <span class="fs-12">Plan Type</span>
                                    <h6 class="fw-normal">Monthly</h6>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <span class="fs-12">Account URL</span>
                                    <h6 class="fw-normal">bwi.example.com</h6>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <span class="fs-12">Price</span>
                                    <h6 class="fw-normal">200</h6>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <span class="fs-12">Register Date</span>
                                    <h6 class="fw-normal">12 Sep 2024</h6>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <span class="fs-12">Expiring On</span>
                                    <h6 class="fw-normal">11 Oct 2024</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Domain Details -->

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
