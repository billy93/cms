<?php $page = 'project-dashboard'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content">

            <div class="row">
                <div class="col-md-12">

                    @component('components.breadcrumb')
                        @slot('title')
                            Project Dashboard
                        @endslot
                        @slot('item1')
                            project-dashboard
                        @endslot
                    @endcomponent

                </div>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header border-0 pb-0">
                            <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                                <h4><i class="ti ti-grip-vertical me-1"></i>Recent Projects</h4>
                                <div class="d-flex align-items-center flex-wrap row-gap-3">
                                    <div class="dropdown me-2">
                                        <a class="dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0);">
                                            <i class="ti ti-calendar-check me-2"></i>Last 7 days
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Last 15 days
                                            </a>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Last 30 days
                                            </a>
                                        </div>
                                    </div>
                                    <a class="btn btn-primary" href="javascript:void(0);" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_add">
                                        <i class="ti ti-square-rounded-plus me-1"></i>Add Project
                                    </a>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">

                            <div class="table-responsive custom-table">
                                <table class="table dataTable" id="recent-project">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Priority</th>
                                            <th>Name</th>
                                            <th>Client</th>
                                            <th>Due Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 d-flex">
                    <div class="card w-100">
                        <div class="card-header border-0 pb-0">
                            <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                                <h4><i class="ti ti-grip-vertical me-1"></i>Project By Stage</h4>
                                <div class="dropdown">
                                    <a class="dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0);">
                                        <i class="ti ti-calendar-check me-2"></i>Last 30 days
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a href="javascript:void(0);" class="dropdown-item">
                                            Last 15 days
                                        </a>
                                        <a href="javascript:void(0);" class="dropdown-item">
                                            Last 30 days
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">

                            <div id="contacts-analysis"></div>
                        </div>
                    </div>
                </div>
			</div>

            <div class="row">
                <div class="col-md-6 d-flex">
                    <div class="card w-100">
                        <div class="card-header border-0 pb-0">
                            <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                                <h4><i class="ti ti-grip-vertical me-1"></i>Projects By Stage</h4>
                                <div class="d-flex align-items-center flex-wrap row-gap-2">
                                    <div class="dropdown me-2">
                                        <a class="dropdown-toggle" data-bs-toggle="dropdown"
                                            href="javascript:void(0);">
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
                                        <a class="dropdown-toggle" data-bs-toggle="dropdown"
                                            href="javascript:void(0);">
                                            Last 3 months
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

                            <div id="project-stage"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 ">
                    <div class="card">
                        <div class="card-header border-0 pb-0">
                            <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                                <h4><i class="ti ti-grip-vertical me-1"></i>Leads By Stage</h4>
                                <div class="d-flex align-items-center flex-wrap row-gap-2">
                                    <div class="dropdown me-2">
                                        <a class="dropdown-toggle" data-bs-toggle="dropdown"
                                            href="javascript:void(0);">
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
                                        <a class="dropdown-toggle" data-bs-toggle="dropdown"
                                            href="javascript:void(0);">
                                            Last 3 months
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

                            <div id="last-chart"></div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header border-0 pb-0">
                            <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                                <h4><i class="ti ti-grip-vertical me-1"></i>Won Deals Stage</h4>
                                <div class="d-flex align-items-center flex-wrap row-gap-2">
                                    <div class="dropdown me-2">
                                        <a class="dropdown-toggle" data-bs-toggle="dropdown"
                                            href="javascript:void(0);">
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
                                        <a class="dropdown-toggle" data-bs-toggle="dropdown"
                                            href="javascript:void(0);">
                                            Last 3 months
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
                        <div class="card-body ">

                            <div id="won-chart"></div>
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
