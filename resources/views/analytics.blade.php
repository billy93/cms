<?php $page = 'analytics'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content">

            <div class="row">
                <div class="col-md-12">


                    @component('components.breadcrumb')
                        @slot('title')
                            Analytics
                        @endslot
                        @slot('item2')
                            analytics
                        @endslot
                    @endcomponent

                </div>
            </div>

            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header border-0 pb-0">
                            <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                                <h4><i class="ti ti-grip-vertical me-1"></i>Recently Created Contacts</h4>
                                <div class="d-flex align-items-center flex-wrap row-gap-2">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0);">
                                            Last 30 Days
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Last 30 Days
                                            </a>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Last 15 Days
                                            </a>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Last 7 Days
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
						</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table dataTable custom-table mb-0" id="analytic-contact">
                                    <thead>
                                        <tr>
                                            <th>Contact</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Created at</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header border-0 pb-0">
                            <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                                <h4><i class="ti ti-grip-vertical me-1"></i>Won Deals Stage</h4>
                                <div class="d-flex align-items-center flex-wrap row-gap-2">
                                    <div class="dropdown me-2">
                                        <a class="dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0);">
                                            Marketing Pipeline
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">														
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Marketing Pipeline
                                            </a>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Sales Pipeline
                                            </a>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Email
                                            </a>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Chats
                                            </a>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Operational
                                            </a>
                                        </div>										
                                    </div>
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0);">
                                            Last 30 Days
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Last 30 Days
                                            </a>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Last 15 Days
                                            </a>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Last 7 Days
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
						</div>
                        <div class="card-body pt-0">
                            <div id="won-chart"></div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header border-0 pb-0">
                            <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                                <h4><i class="ti ti-grip-vertical me-1"></i>Recently Created Deals</h4>
                                <div class="d-flex align-items-center flex-wrap row-gap-2">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0);">
                                            Last 30 Days
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Last 30 Days
                                            </a>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Last 15 Days
                                            </a>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Last 7 Days
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
					    </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-nowrap custom-table mb-0" id="analytic-deal">
                                    <thead>
                                        <tr>
                                            <th>Deal Name</th>
                                            <th>Stage</th>
                                            <th>Deal Value</th>
                                            <th>Probability</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header border-0 pb-0">
                            <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                                <h4><i class="ti ti-grip-vertical me-1"></i>Lost Leads Stage</h4>
                                <div class="d-flex align-items-center flex-wrap row-gap-2">
                                    <div class="dropdown me-2">
                                        <a class="dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0);">
                                            Marketing Pipeline
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">														
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Marketing Pipeline
                                            </a>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Sales Pipeline
                                            </a>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Email
                                            </a>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Chats
                                            </a>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Operational
                                            </a>
                                        </div>										
                                    </div>
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0);">
                                            Last 30 Days
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Last 30 Days
                                            </a>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Last 15 Days
                                            </a>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Last 7 Days
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
						</div>
                        <div class="card-body pt-0">
                            <div id="last-chart-2"></div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header border-0 pb-0">
                            <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                                <h4><i class="ti ti-grip-vertical me-1"></i>Leads By Stage</h4>
                                <div class="d-flex align-items-center flex-wrap row-gap-2">
                                    <div class="dropdown me-2">
                                        <a class="dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0);">
                                            Sales Pipeline
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">														
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Marketing Pipeline
                                            </a>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Sales Pipeline
                                            </a>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Email
                                            </a>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Chats
                                            </a>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Operational
                                            </a>
                                        </div>										
                                    </div>
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0);">
                                            Last 30 Days
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Last 30 Days
                                            </a>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Last 15 Days
                                            </a>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Last 7 Days
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
						</div>
                        <div class="card-body">
                            <div id="leads-chart"></div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header border-0 pb-0">
                            <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                                <h4><i class="ti ti-grip-vertical me-1"></i>Recently Added Companies</h4>
                                <div class="d-flex align-items-center flex-wrap row-gap-2">
                                    <div class="dropdown me-2">
                                        <a class="dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0);">
                                            Last 30 Days
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Last 30 Days
                                            </a>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Last 15 Days
                                            </a>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Last 7 Days
                                            </a>
                                        </div>
                                    </div>
                                    <a href="#" class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_add_2"><i class="ti ti-square-rounded-plus me-2"></i> Add Company</a>
                                </div>
                            </div>
						</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table custom-table mb-0" id="analytic-company">
                                    <thead>
                                        <tr>
                                            <th>Company Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Created at</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header border-0 pb-0">
                            <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                                <h4><i class="ti ti-grip-vertical me-1"></i>Deals By Stage</h4>
                                <div class="d-flex align-items-center flex-wrap row-gap-2">
                                    <div class="dropdown me-2">
                                        <a class="dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0);">
                                            Sales Pipeline
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">														
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Marketing Pipeline
                                            </a>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Sales Pipeline
                                            </a>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Email
                                            </a>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Chats
                                            </a>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Operational
                                            </a>
                                        </div>										
                                    </div>
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0);">
                                            Last 30 Days
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Last 30 Days
                                            </a>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Last 15 Days
                                            </a>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Last 7 Days
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="deals-chart"></div>
                        </div>
					</div>
                    <div class="card">
                        <div class="card-header border-0 pb-0">
                            <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                                <h4><i class="ti ti-grip-vertical me-1"></i>Activities</h4>
                                <div class="d-flex align-items-center flex-wrap row-gap-2">
                                    <div class="dropdown me-2">
                                        <a class="dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0);">
                                            Last 30 Days
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Last 30 Days
                                            </a>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Last 15 Days
                                            </a>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Last 7 Days
                                            </a>
                                        </div>
                                    </div>
                                    <a href="#" class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_add" ><i class="ti ti-square-rounded-plus me-2"></i>Add New Activity</a>
                                </div>
                            </div>
						</div>
                        <div class="card-body">
                            <div class="activities-list">
                                <ul>
                                    <li>
                                        <div class="row align-items-center">
                                            <div class="col-md-5">
                                                <div class="activity-name">
                                                    <h5>We scheduled a meeting for next week</h5>
                                                    <p>Due Date : 10 Feb 2024, 09:00 am </p>
                                                    <span class="badge activity-badge bg-purple"><i
                                                            class="ti ti-user-share"></i>Meeting</span>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="user-activity">
                                                    <span>
                                                        <img src="{{ URL::asset('/build/img/profiles/avatar-19.jpg') }}"
                                                            alt="">
                                                    </span>
                                                    <h6>Darlee Robertson</h6>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-wrap mb-0">
                                                    <select class="select">
                                                        <option>Inprogress</option>
                                                        <option>Completed</option>
                                                        <option>Cancelled</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row align-items-center">
                                            <div class="col-md-5">
                                                <div class="activity-name">
                                                    <h5>Regarding latest updates in project </h5>
                                                    <p>Due date : 29 Sep 2023, 08:20 am</p>
                                                    <span class="badge activity-badge bg-warning"><i
                                                            class="ti ti-mail"></i>Email</span>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="user-activity">
                                                    <span>
                                                        <img src="{{ URL::asset('/build/img/profiles/avatar-22.jpg') }}"
                                                            alt="">
                                                    </span>
                                                    <h6>Dawn Mercha</h6>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-wrap mb-0">
                                                    <select class="select">
                                                        <option>Inprogress</option>
                                                        <option>Completed</option>
                                                        <option>Cancelled</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row align-items-center">
                                            <div class="col-md-5">
                                                <div class="activity-name">
                                                    <h5>Call John and discuss about project</h5>
                                                    <p>Due date : 05 Oct 2023, 10:35 am</p>
                                                    <span class="badge activity-badge bg-blue"><i
                                                            class="ti ti-subtask"></i>Task</span>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="user-activity">
                                                    <span>
                                                        <img src="{{ URL::asset('/build/img/profiles/avatar-16.jpg') }}"
                                                            alt="">
                                                    </span>
                                                    <h6>Carol Thomas</h6>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-wrap mb-0">
                                                    <select class="select">
                                                        <option>Inprogress</option>
                                                        <option>Completed</option>
                                                        <option>Cancelled</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row align-items-center">
                                            <div class="col-md-5">
                                                <div class="activity-name">
                                                    <h5>Discussed budget proposal with Edwin</h5>
                                                    <p>Due date : 16 Oct 2023, 04:40 pm</p>
                                                    <span class="badge activity-badge bg-green"><i
                                                            class="ti ti-phone"></i>Calls</span>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="user-activity">
                                                    <span>
                                                        <img src="{{ URL::asset('/build/img/profiles/avatar-20.jpg') }}"
                                                            alt="">
                                                    </span>
                                                    <h6>Sharon Roy</h6>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-wrap mb-0">
                                                    <select class="select">
                                                        <option>Inprogress</option>
                                                        <option>Completed</option>
                                                        <option>Cancelled</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header border-0 pb-0">
                            <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                                <h4><i class="ti ti-grip-vertical me-1"></i>Lost Leads Stage</h4>
                                <div class="d-flex align-items-center flex-wrap row-gap-2">
                                    <div class="dropdown me-2">
                                        <a class="dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0);">
                                            Last 30 Days
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Last 30 Days
                                            </a>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Last 15 Days
                                            </a>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Last 7 Days
                                            </a>
                                        </div>
                                    </div>
                                    <a href="#" class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_add_2"  ><i class="ti ti-square-rounded-plus me-2"></i> Add Company</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div id="last-chart"></div>
                        </div>
					</div>
                    <div class="card ">
                        <div class="card-header border-0 pb-0">
                            <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                                <h4><i class="ti ti-grip-vertical me-1"></i>Recently Created Leads</h4>
                                <div class="d-flex align-items-center flex-wrap row-gap-2">
                                    <div class="dropdown me-2">
                                        <a class="dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0);">
                                            Last 30 Days
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Last 30 Days
                                            </a>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Last 15 Days
                                            </a>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Last 7 Days
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table custom-table mb-0" id="analytic-lead">
                                    <thead>
                                        <tr>
                                            <th>Lead Name</th>
                                            <th>Company Name</th>
                                            <th>Phone</th>
                                            <th>Lead Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header border-0 pb-0">
                            <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                                <h4><i class="ti ti-grip-vertical me-1"></i>Recently Created Campaign</h4>
                                <div class="d-flex align-items-center flex-wrap row-gap-2">
                                    <div class="dropdown me-2">
                                        <a class="dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0);">
                                            Last 30 Days
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Last 30 Days
                                            </a>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Last 15 Days
                                            </a>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Last 7 Days
                                            </a>
                                        </div>
                                    </div>
                                    <a href="#" class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_pipeline"  ><i class="ti ti-square-rounded-plus me-2"></i>  Add Pipeline</a>
                                </div>
                            </div>
						</div>
                        <div class="card-body">
                            <div class="campaign-card">
                                <ul>
                                    <li class="campaign-wrap">
                                        <div class="campaign-info">
                                            <div class="campaign-name">
                                                <h5>Distribution</h5>
                                                <p>Public Relations</p>
                                            </div>
                                            <ul class="list-progress">
                                                <li>
                                                    <h6>30.5%</h6>
                                                    <p>Opened</p>
                                                </li>
                                                <li>
                                                    <h6>20.5%</h6>
                                                    <p>Closed</p>
                                                </li>
                                                <li>
                                                    <h6>30.5%</h6>
                                                    <p>Unsubscribe</p>
                                                </li>
                                                <li>
                                                    <h6>70.5%</h6>
                                                    <p>Delivered</p>
                                                </li>
                                                <li>
                                                    <h6>35.0%</h6>
                                                    <p>Conversation</p>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="campaign-action">
                                            <div class="campaign-date">
                                                <span class="badge badge-pill badge-status bg-danger">Bounced</span>
                                                <p>Due Date : 25 Sep 2023</p>
                                            </div>
                                            <ul class="project-mem">
                                                <li>
                                                    <a href="#"><img
                                                            src="{{ URL::asset('/build/img/profiles/avatar-14.jpg') }}"
                                                            alt="img"></a>
                                                </li>
                                                <li>
                                                    <a href="#"><img
                                                            src="{{ URL::asset('/build/img/profiles/avatar-15.jpg') }}"
                                                            alt="img"></a>
                                                </li>
                                                <li>
                                                    <a href="#"><img
                                                            src="{{ URL::asset('/build/img/profiles/avatar-16.jpg') }}"
                                                            alt="img"></a>
                                                </li>
                                                <li class="more-set"><a href="#">+03</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="campaign-wrap">
                                        <div class="campaign-info">
                                            <div class="campaign-name">
                                                <h5>Pricing</h5>
                                                <p>Social Marketing</p>
                                            </div>
                                            <ul class="list-progress">
                                                <li>
                                                    <h6>42.5%</h6>
                                                    <p>Opened</p>
                                                </li>
                                                <li>
                                                    <h6>38.2%</h6>
                                                    <p>Closed</p>
                                                </li>
                                                <li>
                                                    <h6>48.8%</h6>
                                                    <p>Unsubscribe</p>
                                                </li>
                                                <li>
                                                    <h6>62.7%</h6>
                                                    <p>Delivered</p>
                                                </li>
                                                <li>
                                                    <h6>22.5%</h6>
                                                    <p>Conversation</p>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="campaign-action">
                                            <div class="campaign-date">
                                                <span class="badge badge-pill badge-status bg-green">Running</span>
                                                <p>Due Date : 14 Oct 2023</p>
                                            </div>
                                            <ul class="project-mem">
                                                <li>
                                                    <a href="#"><img
                                                            src="{{ URL::asset('/build/img/profiles/avatar-14.jpg') }}"
                                                            alt="img"></a>
                                                </li>
                                                <li>
                                                    <a href="#"><img
                                                            src="{{ URL::asset('/build/img/profiles/avatar-15.jpg') }}"
                                                            alt="img"></a>
                                                </li>
                                                <li>
                                                    <a href="#"><img
                                                            src="{{ URL::asset('/build/img/profiles/avatar-16.jpg') }}"
                                                            alt="img"></a>
                                                </li>
                                                <li class="more-set"><a href="#">+04</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="campaign-wrap">
                                        <div class="campaign-info">
                                            <div class="campaign-name">
                                                <h5>Merchandising</h5>
                                                <p>Content Marketing</p>
                                            </div>
                                            <ul class="list-progress">
                                                <li>
                                                    <h6>52.5%</h6>
                                                    <p>Opened</p>
                                                </li>
                                                <li>
                                                    <h6>29.3%</h6>
                                                    <p>Closed</p>
                                                </li>
                                                <li>
                                                    <h6>62.8%</h6>
                                                    <p>Unsubscribe</p>
                                                </li>
                                                <li>
                                                    <h6>71.3%</h6>
                                                    <p>Delivered</p>
                                                </li>
                                                <li>
                                                    <h6>39.5%</h6>
                                                    <p>Conversation</p>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="campaign-action">
                                            <div class="campaign-date">
                                                <span class="badge badge-pill badge-status bg-info">Paused</span>
                                                <p>Due Date : 14 Oct 2023</p>
                                            </div>
                                            <ul class="project-mem">
                                                <li>
                                                    <a href="#"><img
                                                            src="{{ URL::asset('/build/img/profiles/avatar-14.jpg') }}"
                                                            alt="img"></a>
                                                </li>
                                                <li>
                                                    <a href="#"><img
                                                            src="{{ URL::asset('/build/img/profiles/avatar-15.jpg') }}"
                                                            alt="img"></a>
                                                </li>
                                                <li>
                                                    <a href="#"><img
                                                            src="{{ URL::asset('/build/img/profiles/avatar-16.jpg') }}"
                                                            alt="img"></a>
                                                </li>
                                                <li class="more-set"><a href="#">+06</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="campaign-wrap">
                                        <div class="campaign-info">
                                            <div class="campaign-name">
                                                <h5>Repeat Customers</h5>
                                                <p>Rebranding</p>
                                            </div>
                                            <ul class="list-progress">
                                                <li>
                                                    <h6>17.5%</h6>
                                                    <p>Opened</p>
                                                </li>
                                                <li>
                                                    <h6>49.5%</h6>
                                                    <p>Closed</p>
                                                </li>
                                                <li>
                                                    <h6>35.2%</h6>
                                                    <p>Unsubscribe</p>
                                                </li>
                                                <li>
                                                    <h6>54.8%</h6>
                                                    <p>Delivered</p>
                                                </li>
                                                <li>
                                                    <h6>60.5%</h6>
                                                    <p>Conversation</p>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="campaign-action">
                                            <div class="campaign-date">
                                                <span class="badge badge-pill badge-status bg-success">Success</span>
                                                <p>Due Date : 29 Oct 2023</p>
                                            </div>
                                            <ul class="project-mem">
                                                <li>
                                                    <a href="#"><img
                                                            src="{{ URL::asset('/build/img/profiles/avatar-14.jpg') }}"
                                                            alt="img"></a>
                                                </li>
                                                <li>
                                                    <a href="#"><img
                                                            src="{{ URL::asset('/build/img/profiles/avatar-15.jpg') }}"
                                                            alt="img"></a>
                                                </li>
                                                <li>
                                                    <a href="#"><img
                                                            src="{{ URL::asset('/build/img/profiles/avatar-16.jpg') }}"
                                                            alt="img"></a>
                                                </li>
                                                <li class="more-set"><a href="#">+02</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
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
