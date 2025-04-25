<?php $page = 'pages-list'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content">

            <div class="row">
                <div class="col-md-12">
                    @component('components.breadcrumb')
                        @slot('title')
                            Pages
                        @endslot
                        @slot('item1')
                            123
                        @endslot
                        @slot('item2')
                            pages-list
                        @endslot
                    @endcomponent

                    <div class="card main-card">
                        <div class="card-body">

                        <!-- Search -->
                        <div class="search-section">
                            <div class="row">
                                <div class="col-md-5 col-sm-4">
                                    <div class="form-wrap icon-form">
                                        <span class="form-icon"><i class="ti ti-search"></i></span>
                                        <input type="text" class="form-control" placeholder="Search Contacts">
                                    </div>							
                                </div>		
                                <div class="col-md-7 col-sm-8">					
                                    <div class="export-list text-sm-end">
                                        <ul>
                                            <li>
                                                <div class="export-dropdwon">
                                                    <a href="javascript:void(0);" class="dropdown-toggle"  data-bs-toggle="dropdown"><i class="ti ti-package-export"></i>Export</a>
                                                    <div class="dropdown-menu  dropdown-menu-end">
                                                        <ul>
                                                            <li>
                                                                <a href="javascript:void(0);"><i class="ti ti-file-type-pdf text-danger"></i>Export as PDF</a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);"><i class="ti ti-file-type-xls text-green"></i>Export as Excel </a>
                                                            </li>
                                                        </ul>
                                                      </div>
                                                </div>
                                            </li>									
                                            <li>
                                                <a href="javascript:void(0);" class="btn btn-primary add-popup"><i class="ti ti-square-rounded-plus"></i>Add New Page</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- /Search -->

                            <!-- Filter -->
                            <div class="filter-section">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="sortby-list">
                                            <ul>
                                                <li>
                                                    <div class="sort-dropdown drop-down">
                                                        <a href="javascript:void(0);" class="dropdown-toggle"
                                                            data-bs-toggle="dropdown"><i
                                                                class="ti ti-sort-ascending-2"></i>Sort </a>
                                                        <div class="dropdown-menu  dropdown-menu-start">
                                                            <ul>
                                                                <li>
                                                                    <a href="javascript:void(0);">
                                                                        <i class="ti ti-circle-chevron-right"></i>Ascending
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:void(0);">
                                                                        <i class="ti ti-circle-chevron-right"></i>Descending
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:void(0);">
                                                                        <i class="ti ti-circle-chevron-right"></i>Recently
                                                                        Viewed
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:void(0);">
                                                                        <i class="ti ti-circle-chevron-right"></i>Recently
                                                                        Added
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-wrap icon-form">
                                                        <span class="form-icon"><i class="ti ti-calendar"></i></span>
                                                        <input type="text" class="form-control bookingrange"
                                                            placeholder="">
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="filter-list">
                                            <ul>
                                                <li>
                                                    <div class="manage-dropdwon">
                                                        <a href="javascript:void(0);" class="btn btn-purple-light"
                                                            data-bs-toggle="dropdown" data-bs-auto-close="false"><i
                                                                class="ti ti-columns-3"></i>Manage Columns</a>
                                                        <div class="dropdown-menu  dropdown-menu-xl-end">
                                                            <h4>Want to manage datatables?</h4>
                                                            <p>Please drag and drop your column to reorder your table and
                                                                enable see option as you want.</p>
                                                            <ul>
                                                                <li>
                                                                    <p><i class="ti ti-grip-vertical"></i>Title</p>
                                                                    <div class="status-toggle">
                                                                        <input type="checkbox" id="col-name"
                                                                            class="check">
                                                                        <label for="col-name" class="checktoggle"></label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <p><i class="ti ti-grip-vertical"></i>Language</p>
                                                                    <div class="status-toggle">
                                                                        <input type="checkbox" id="col-phone"
                                                                            class="check">
                                                                        <label for="col-phone" class="checktoggle"></label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <p><i class="ti ti-grip-vertical"></i>Location</p>
                                                                    <div class="status-toggle">
                                                                        <input type="checkbox" id="col-email"
                                                                            class="check">
                                                                        <label for="col-email" class="checktoggle"></label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <p><i class="ti ti-grip-vertical"></i>Status</p>
                                                                    <div class="status-toggle">
                                                                        <input type="checkbox" id="col-tag"
                                                                            class="check">
                                                                        <label for="col-tag" class="checktoggle"></label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <p><i class="ti ti-grip-vertical"></i>Created Date</p>
                                                                    <div class="status-toggle">
                                                                        <input type="checkbox" id="col-tag"
                                                                            class="check">
                                                                        <label for="col-tag" class="checktoggle"></label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <p><i class="ti ti-grip-vertical"></i>Action</p>
                                                                    <div class="status-toggle">
                                                                        <input type="checkbox" id="col-tag"
                                                                            class="check">
                                                                        <label for="col-tag" class="checktoggle"></label>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-sorts dropdown">
                                                        <a href="javascript:void(0);" data-bs-toggle="dropdown"
                                                            data-bs-auto-close="false"><i
                                                                class="ti ti-filter-share"></i>Filter</a>
                                                        <div
                                                            class="filter-dropdown-menu dropdown-menu  dropdown-menu-xl-end">
                                                            <div class="filter-set-view">
                                                                <div class="filter-set-head">
                                                                    <h4><i class="ti ti-filter-share"></i>Filter</h4>
                                                                    <a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#save_view">Save View</a>
                                                                </div>
                                                                <div class="header-set">
                                                                    <select class="select">
                                                                        <option>Select a View</option>
                                                                        <option>Contact View List</option>
                                                                        <option>Contact Location View</option>
                                                                    </select>
                                                                    <div class="radio-btn-items">
                                                                        <div class="radio-btn">
                                                                            <input type="radio" class="status-radio"
                                                                                id="pdf" name="export-type"
                                                                                checked="">
                                                                            <label for="pdf">Just For Me</label>
                                                                        </div>
                                                                        <div class="radio-btn">
                                                                            <input type="radio" class="status-radio"
                                                                                id="share" name="export-type">
                                                                            <label for="share">Share Filter with
                                                                                Everyone </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="accordion" id="accordionExample">
                                                                    <div class="filter-set-content">
                                                                        <div class="filter-set-content-head">
                                                                            <a href="#" data-bs-toggle="collapse"
                                                                                data-bs-target="#collapseTwo"
                                                                                aria-expanded="true"
                                                                                aria-controls="collapseTwo">Pages</a>
                                                                        </div>
                                                                        <div class="filter-set-contents accordion-collapse collapse show"
                                                                            id="collapseTwo"
                                                                            data-bs-parent="#accordionExample">
                                                                            <div class="filter-content-list">
                                                                                <div class="form-wrap icon-form">
                                                                                    <span class="form-icon"><i
                                                                                            class="ti ti-search"></i></span>
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        placeholder="Search Page">
                                                                                </div>
                                                                                <ul>
                                                                                    <li>
                                                                                        <div class="filter-checks">
                                                                                            <label class="checkboxs">
                                                                                                <input type="checkbox">
                                                                                                <span
                                                                                                    class="checkmarks"></span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="collapse-inside-text">
                                                                                            <h5>Home</h5>
                                                                                        </div>
                                                                                    </li>
                                                                                    <li>
                                                                                        <div class="filter-checks">
                                                                                            <label class="checkboxs">
                                                                                                <input type="checkbox">
                                                                                                <span
                                                                                                    class="checkmarks"></span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="collapse-inside-text">
                                                                                            <h5>About Us</h5>
                                                                                        </div>
                                                                                    </li>
                                                                                    <li>
                                                                                        <div class="filter-checks">
                                                                                            <label class="checkboxs">
                                                                                                <input type="checkbox">
                                                                                                <span
                                                                                                    class="checkmarks"></span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="collapse-inside-text">
                                                                                            <h5>FAQ</h5>
                                                                                        </div>
                                                                                    </li>
                                                                                    <li>
                                                                                        <div class="filter-checks">
                                                                                            <label class="checkboxs">
                                                                                                <input type="checkbox">
                                                                                                <span
                                                                                                    class="checkmarks"></span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="collapse-inside-text">
                                                                                            <h5>Categories</h5>
                                                                                        </div>
                                                                                    </li>
                                                                                    <li>
                                                                                        <div class="filter-checks">
                                                                                            <label class="checkboxs">
                                                                                                <input type="checkbox">
                                                                                                <span
                                                                                                    class="checkmarks"></span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="collapse-inside-text">
                                                                                            <h5>Privacy Policy</h5>
                                                                                        </div>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="filter-set-content">
                                                                        <div class="filter-set-content-head">
                                                                            <a href="#" class="collapsed"
                                                                                data-bs-toggle="collapse"
                                                                                data-bs-target="#owner"
                                                                                aria-expanded="false"
                                                                                aria-controls="owner">Language</a>
                                                                        </div>
                                                                        <div class="filter-set-contents accordion-collapse collapse"
                                                                            id="owner"
                                                                            data-bs-parent="#accordionExample">
                                                                            <div class="filter-content-list">
                                                                                <div class="form-wrap icon-form">
                                                                                    <span class="form-icon"><i
                                                                                            class="ti ti-search"></i></span>
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        placeholder="Search Owner">
                                                                                </div>
                                                                                <ul>
                                                                                    <li>
                                                                                        <div class="filter-checks">
                                                                                            <label class="checkboxs">
                                                                                                <input type="checkbox">
                                                                                                <span
                                                                                                    class="checkmarks"></span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="collapse-inside-text">
                                                                                            <h5>English</h5>
                                                                                        </div>
                                                                                    </li>
                                                                                    <li>
                                                                                        <div class="filter-checks">
                                                                                            <label class="checkboxs">
                                                                                                <input type="checkbox">
                                                                                                <span
                                                                                                    class="checkmarks"></span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="collapse-inside-text">
                                                                                            <h5>Arabic</h5>
                                                                                        </div>
                                                                                    </li>
                                                                                    <li>
                                                                                        <div class="filter-checks">
                                                                                            <label class="checkboxs">
                                                                                                <input type="checkbox">
                                                                                                <span
                                                                                                    class="checkmarks"></span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="collapse-inside-text">
                                                                                            <h5>Chinese</h5>
                                                                                        </div>
                                                                                    </li>
                                                                                    <li>
                                                                                        <div class="filter-checks">
                                                                                            <label class="checkboxs">
                                                                                                <input type="checkbox">
                                                                                                <span
                                                                                                    class="checkmarks"></span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="collapse-inside-text">
                                                                                            <h5>Hind</h5>
                                                                                        </div>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="filter-set-content">
                                                                        <div class="filter-set-content-head">
                                                                            <a href="#" class="collapsed"
                                                                                data-bs-toggle="collapse"
                                                                                data-bs-target="#Status"
                                                                                aria-expanded="false"
                                                                                aria-controls="Status">Location</a>
                                                                        </div>
                                                                        <div class="filter-set-contents accordion-collapse collapse"
                                                                            id="Status"
                                                                            data-bs-parent="#accordionExample">
                                                                            <div class="filter-content-list">
                                                                                <ul>
                                                                                    <li>
                                                                                        <div class="filter-checks">
                                                                                            <label class="checkboxs">
                                                                                                <input type="checkbox">
                                                                                                <span
                                                                                                    class="checkmarks"></span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="collapse-inside-text">
                                                                                            <h5>Active</h5>
                                                                                        </div>
                                                                                    </li>
                                                                                    <li>
                                                                                        <div class="filter-checks">
                                                                                            <label class="checkboxs">
                                                                                                <input type="checkbox">
                                                                                                <span
                                                                                                    class="checkmarks"></span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="collapse-inside-text">
                                                                                            <h5>Inactive</h5>
                                                                                        </div>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="filter-set-content">
                                                                        <div class="filter-set-content-head">
                                                                            <a href="#" class="collapsed"
                                                                                data-bs-toggle="collapse"
                                                                                data-bs-target="#Status"
                                                                                aria-expanded="false"
                                                                                aria-controls="Status">Status</a>
                                                                        </div>
                                                                        <div class="filter-set-contents accordion-collapse collapse"
                                                                            id="Status"
                                                                            data-bs-parent="#accordionExample">
                                                                            <div class="filter-content-list">
                                                                                <ul>
                                                                                    <li>
                                                                                        <div class="filter-checks">
                                                                                            <label class="checkboxs">
                                                                                                <input type="checkbox">
                                                                                                <span
                                                                                                    class="checkmarks"></span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="collapse-inside-text">
                                                                                            <h5>Active</h5>
                                                                                        </div>
                                                                                    </li>
                                                                                    <li>
                                                                                        <div class="filter-checks">
                                                                                            <label class="checkboxs">
                                                                                                <input type="checkbox">
                                                                                                <span
                                                                                                    class="checkmarks"></span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="collapse-inside-text">
                                                                                            <h5>Inactive</h5>
                                                                                        </div>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="filter-set-content">
                                                                        <div class="filter-set-content-head">
                                                                            <a href="#" class="collapsed"
                                                                                data-bs-toggle="collapse"
                                                                                data-bs-target="#Status"
                                                                                aria-expanded="false"
                                                                                aria-controls="Status">Created Date</a>
                                                                        </div>
                                                                        <div class="filter-set-contents accordion-collapse collapse"
                                                                            id="Status"
                                                                            data-bs-parent="#accordionExample">
                                                                            <div class="filter-content-list">
                                                                                <ul>
                                                                                    <li>
                                                                                        <div class="filter-checks">
                                                                                            <label class="checkboxs">
                                                                                                <input type="checkbox">
                                                                                                <span
                                                                                                    class="checkmarks"></span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="collapse-inside-text">
                                                                                            <h5>Active</h5>
                                                                                        </div>
                                                                                    </li>
                                                                                    <li>
                                                                                        <div class="filter-checks">
                                                                                            <label class="checkboxs">
                                                                                                <input type="checkbox">
                                                                                                <span
                                                                                                    class="checkmarks"></span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="collapse-inside-text">
                                                                                            <h5>Inactive</h5>
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
                                                                            <a href="#"
                                                                                class="btn btn-light">Reset</a>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <a href="{{ url('pages') }}"
                                                                                class="btn btn-primary">Filter</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="filter-set-content">
                                                                    <div class="filter-set-content-head">
                                                                        <a href="#" class="collapsed" data-bs-toggle="collapse" data-bs-target="#Status" aria-expanded="false" aria-controls="Status">Created Date</a>
                                                                    </div>
                                                                    <div class="filter-set-contents accordion-collapse collapse" id="Status" data-bs-parent="#accordionExample">
                                                                        <div class="filter-content-list">
                                                                            <ul>
                                                                                <li>
                                                                                    <div class="filter-checks">
                                                                                        <label class="checkboxs">
                                                                                            <input type="checkbox">
                                                                                            <span class="checkmarks"></span>
                                                                                        </label>
                                                                                    </div>
                                                                                    <div class="collapse-inside-text">
                                                                                        <h5>Active</h5>
                                                                                    </div>
                                                                                </li>
                                                                                <li>
                                                                                    <div class="filter-checks">
                                                                                        <label class="checkboxs">
                                                                                            <input type="checkbox">
                                                                                            <span class="checkmarks"></span>
                                                                                        </label>
                                                                                    </div>
                                                                                    <div class="collapse-inside-text">
                                                                                        <h5>Inactive</h5>
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
                                                                        <a href="{{url('pages')}}" class="btn btn-primary">Filter</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Filter -->

                            <!-- Contact List -->
                            <div class="table-responsive custom-table">
                                <table class="table datatable" id="pageslist">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="no-sort">
                                                <label class="checkboxs"><input type="checkbox" id="select-all"><span
                                                        class="checkmarks"></span></label>
                                            </th>
                                            <th class="no-sort"></th>
                                            <th>Title</th>
                                            <th>Language</th>
                                            <th>Location</th>
                                            <th>Status</th>
                                            <th>Created Date</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

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
                            <!-- /page List -->

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <!-- /Page Wrapper -->
    @component('components.model-popup')
    @endcomponent
@endsection
