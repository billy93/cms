<?php $page = 'tasks-important'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content">

            <div class="row">
                <div class="col-md-12">

                    @component('components.breadcrumb')
                        @slot('title')
                            Tasks
                        @endslot
                        @slot('item1')
                            123
                        @endslot
                        @slot('item2')
                            tasks-important
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
                                            <input type="text" class="form-control" placeholder="Search Task">
                                        </div>
                                    </div>
                                    <div class="col-md-7 col-sm-8">
                                        <div class="export-list text-sm-end">
                                            <ul>
                                                <li>
                                                    <a href="javascript:void(0);" class="btn btn-primary add-popup"><i
                                                            class="ti ti-square-rounded-plus"></i>Add New Task</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Search -->
	<!-- Filter -->
    <div class="filter-section">
        <div class="row align-items-center">
            <div class="col-md-4">
                <div class="sortby-list">
                    <ul>
                        <li>
                            <div class="sort-dropdown drop-down task-drops">
                                <a href="javascript:void(0);" class="dropdown-toggle"  data-bs-toggle="dropdown">Important </a>
                                <div class="dropdown-menu  dropdown-menu-start">
                                    <ul>
                                        <li>
                                            <a href="{{url('tasks')}}">
                                                <i class="ti ti-dots-vertical"></i>All Tasks
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{url('tasks-important')}}">
                                                <i class="ti ti-dots-vertical"></i>Important
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{url('tasks-completed')}}">
                                                <i class="ti ti-dots-vertical"></i>Completed
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                              </div>
                          </li>
                      </ul>
                  </div>
            </div>
            <div class="col-md-8">
                <div class="filter-list">
                    <ul class="justify-content-md-end">
                        <li class="all-read">
                            <label class="checkboxs"><input type="checkbox"><span class="checkmarks"></span>Mark all as read</label>
                        </li>
                        <li>
                            <div class="sort-dropdown drop-down">
                                <a href="javascript:void(0);" class="dropdown-toggle"  data-bs-toggle="dropdown"><i class="ti ti-sort-ascending-2"></i>Sort </a>
                                <div class="dropdown-menu  dropdown-menu-start">
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0);">
                                                <i class="ti ti-dots-vertical"></i>Ascending
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">
                                                <i class="ti ti-dots-vertical"></i>Descending
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">
                                                <i class="ti ti-dots-vertical"></i>Recently Viewed
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">
                                                <i class="ti ti-dots-vertical"></i>Recently Added
                                            </a>
                                        </li>
                                    </ul>
                                  </div>
                            </div>
                        </li>
                        <li>
                            <div class="form-wrap icon-form mb-0">
                                <span class="form-icon"><i class="ti ti-calendar"></i></span>
                                <input type="text" class="form-control bookingrange" placeholder="">
                            </div>
                        </li>
                        <li>
                            <div class="form-sorts dropdown">
                                <a href="javascript:void(0);" data-bs-toggle="dropdown"  data-bs-auto-close="false"><i class="ti ti-filter-share"></i>Filter</a>
                                <div class="filter-dropdown-menu dropdown-menu  dropdown-menu-md-end">
                                    <div class="filter-set-view">
                                        <div class="filter-set-head">
                                            <h4><i class="ti ti-filter-share"></i>Filter</h4>
                                        </div>
                                        <div class="accordion" id="accordionExample">
                                            <div class="filter-set-content">
                                                <div class="filter-set-content-head">
                                                    <a href="#" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">Task Name</a>
                                                </div>
                                                <div class="filter-set-contents accordion-collapse collapse show" id="collapseTwo" data-bs-parent="#accordionExample">
                                                    <div class="filter-content-list">
                                                        <div class="form-wrap icon-form">
                                                            <span class="form-icon"><i class="ti ti-search"></i></span>
                                                            <input type="text" class="form-control" placeholder="Search Task">
                                                        </div>
                                                        <ul>
                                                            <li>
                                                                <div class="filter-checks">
                                                                    <label class="checkboxs">
                                                                        <input type="checkbox" checked>
                                                                        <span class="checkmarks"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="collapse-inside-text">
                                                                    <h5>Add a form to Update Task</h5>
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
                                                                    <h5>Add a form to Update Task</h5>
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
                                                                    <h5>Update orginal content</h5>
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
                                                                    <h5>Use only component colours</h5>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="filter-set-content">
                                                <div class="filter-set-content-head">
                                                    <a href="#" class="collapsed" data-bs-toggle="collapse" data-bs-target="#owner" aria-expanded="false" aria-controls="owner"> Task Type</a>
                                                </div>
                                                <div class="filter-set-contents accordion-collapse collapse" id="owner" data-bs-parent="#accordionExample">
                                                    <div class="filter-content-list">
                                                        <ul>
                                                            <li>
                                                                <div class="filter-checks">
                                                                    <label class="checkboxs">
                                                                        <input type="checkbox" checked>
                                                                        <span class="checkmarks"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="collapse-inside-text">
                                                                    <h5>Meeting</h5>
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
                                                                    <h5>Calls</h5>
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
                                                                    <h5>Task</h5>
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
                                                                    <h5>Email</h5>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="filter-set-content">
                                                <div class="filter-set-content-head">
                                                    <a href="#" class="collapsed" data-bs-toggle="collapse" data-bs-target="#collapsestatus" aria-expanded="false" aria-controls="collapsestatus">Tags</a>
                                                </div>
                                                <div class="filter-set-contents accordion-collapse collapse" id="collapsestatus" data-bs-parent="#accordionExample">
                                                    <div class="filter-content-list">
                                                        <ul>
                                                            <li>
                                                                <div class="filter-checks">
                                                                    <label class="checkboxs">
                                                                        <input type="checkbox" checked>
                                                                        <span class="checkmarks"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="collapse-inside-text">
                                                                    <h5>Collab</h5>
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
                                                                    <h5>Rated</h5>
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
                                                                    <h5>Promotion</h5>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="filter-set-content">
                                                <div class="filter-set-content-head">
                                                    <a href="#" class="collapsed" data-bs-toggle="collapse" data-bs-target="#Status" aria-expanded="false" aria-controls="Status">Created Date</a>
                                                </div>
                                                <div class="filter-set-contents accordion-collapse collapse" id="Status" data-bs-parent="#accordionExample">
                                                    <div class="filter-content-list">
                                                        <div class="form-wrap icon-form">
                                                            <span class="form-icon"><i class="ti ti-search"></i></span>
                                                            <input type="text" class="form-control" placeholder="Search Date">
                                                        </div>
                                                        <ul>
                                                            <li>
                                                                <div class="filter-checks">
                                                                    <label class="checkboxs">
                                                                        <input type="checkbox" checked>
                                                                        <span class="checkmarks"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="collapse-inside-text">
                                                                    <h5>23 Oct 2023 </h5>
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
                                                                    <h5>29 Sep 2023</h5>
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
                                                                    <h5>24 Oct 2023 </h5>
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
                                                                    <h5>25 Oct 2023 </h5>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="filter-set-content">
                                                <div class="filter-set-content-head">
                                                    <a href="#" class="collapsed" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Created By</a>
                                                </div>
                                                <div class="filter-set-contents accordion-collapse collapse" id="collapseThree" data-bs-parent="#accordionExample">
                                                    <div class="filter-content-list">
                                                        <ul>
                                                            <li>
                                                                <div class="filter-checks">
                                                                    <label class="checkboxs">
                                                                        <input type="checkbox" checked>
                                                                        <span class="checkmarks"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="collapse-inside-text">
                                                                    <h5>Hendry</h5>
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
                                                                    <h5>Monty Beer</h5>
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
                                                                    <h5>Bradtke</h5>
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
                                                    <a href="{{url('tasks-important')}}" class="btn btn-primary">Filter</a>
                                                </div>
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

                            <!-- Recent Task List -->
                            <div class="task-wrapper">
                                <a href="#" class="task-accordion" data-bs-toggle="collapse"
                                    data-bs-target="#recent">
                                    <h4>Recent<span>24</span></h4>
                                </a>
                                <div class="tasks-activity tasks collapse show" id="recent">
                                    <ul>
                                        <li class="task-wrap pending">
                                            <div class="task-info">
                                                <span class="task-icon"><i class="ti ti-grip-vertical"></i></span>
                                                <div class="task-checkbox">
                                                    <label class="checkboxs"><input type="checkbox"><span
                                                            class="checkmarks"></span></label>
                                                </div>
                                                <div class="set-star rating-select filled">
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <p>Add a form to Update Task</p>
                                                <span class="badge badge-pill badge-status bg-green"><i
                                                        class="ti ti-phone"></i>Calls</span>
                                                <span class="badge badge-tag bg-pending">Pending</span>
                                            </div>
                                            <div class="task-actions">
                                                <ul>
                                                    <li class="task-time">
                                                        <span class="badge badge-tag badge-purple-light">Promotion</span>
                                                    </li>
                                                    <li class="task-date">
                                                        <i class="ti ti-calendar-exclamation"></i>25 Oct 2023
                                                    </li>
                                                    <li class="task-owner">
                                                        <div class="task-user">
                                                            <img src="{{ URL::asset('/build/img/profiles/avatar-14.jpg') }}"
                                                                alt="img">
                                                        </div>
                                                        <div class="dropdown table-action">
                                                            <a href="#" class="action-icon "
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item edit-popup" href="#"><i
                                                                        class="ti ti-edit text-blue"></i> Edit</a>
                                                                <a class="dropdown-item" href="#"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#delete_activity"><i
                                                                        class="ti ti-trash text-danger"></i> Delete</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="task-wrap  warning">
                                            <div class="task-info">
                                                <span class="task-icon"><i class="ti ti-grip-vertical"></i></span>
                                                <div class="task-checkbox">
                                                    <label class="checkboxs"><input type="checkbox"><span
                                                            class="checkmarks"></span></label>
                                                </div>
                                                <div class="set-star rating-select filled">
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <p>Update orginal content</p>
                                                <span class="badge badge-pill badge-status bg-green"><i
                                                        class="ti ti-phone"></i>Calls</span>
                                                <span class="badge badge-tag bg-warning">Inprogress</span>
                                            </div>
                                            <div class="task-actions">
                                                <ul>
                                                    <li class="task-time">
                                                        <span class="badge badge-tag badge-success-light">Collab</span>
                                                        <span class="badge badge-tag badge-warning-light">Rated</span>
                                                    </li>
                                                    <li class="task-date">
                                                        <i class="ti ti-calendar-exclamation"></i>25 Oct 2023
                                                    </li>
                                                    <li class="task-owner">
                                                        <div class="task-user">
                                                            <img src="{{ URL::asset('/build/img/profiles/avatar-14.jpg') }}"
                                                                alt="img">
                                                        </div>
                                                        <div class="dropdown table-action">
                                                            <a href="#" class="action-icon "
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item edit-popup" href="#"><i
                                                                        class="ti ti-edit text-blue"></i> Edit</a>
                                                                <a class="dropdown-item" href="#"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#delete_activity"><i
                                                                        class="ti ti-trash text-danger"></i> Delete</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /Recent Task List -->

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
