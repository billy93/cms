<?php $page = 'leads-dashboard'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content">

            <div class="row">
                <div class="col-md-12">

                    @component('components.breadcrumb')
                        @slot('title')
                            Leads Dashboard
                        @endslot
                        @slot('item1')
                            leads-dashboard
                        @endslot
                    @endcomponent

                </div>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header border-0 pb-0">
                            <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                                <h4><i class="ti ti-grip-vertical me-1"></i>Recently Created Leads</h4>
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
                            <div class="table-responsive custom-table">
                                <table class="table dataTable" id="lead-project">
                                    <thead class="thead-light">
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
                </div>
                <div class="col-md-5 d-flex">
                    <div class="card w-100">
                        <div class="card-header border-0 pb-0">
                            <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                                <h4><i class="ti ti-grip-vertical me-1"></i>Projects By Stage</h4>
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
                        <div class="card-body">

                            <div id="leadpiechart"></div>
                        </div>
                    </div>
                </div>
			</div>
            <div class="row">
                <div class="col-md-12 d-flex">
                    <div class="card w-100">
                        <div class="card-header border-0 pb-0">
                            <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                                <h4><i class="ti ti-grip-vertical me-1"></i>Projects By Stage</h4>
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
                            
                            <div id="contact-report"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header border-0 pb-0">
                            <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                                <h4><i class="ti ti-grip-vertical me-1"></i>Leads By Stage</h4>
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
                                            Last 3 months
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Last 3 months
                                            </a>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Last 6 months
                                            </a>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Last 12 months
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
                </div>
                <div class="col-md-6">
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
                                            Last 3 months
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Last 3 months
                                            </a>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Last 6 months
                                            </a>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Last 12 months
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
