<?php $page = 'language-web'; ?>
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
                                <h4 class="page-title">Settings</h4>
                            </div>
                            <div class="col-4 text-end">
                                <div class="head-icons">
                                    <a href="{{ url('language-web') }}" data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-original-title="Refresh"><i class="ti ti-refresh-dot"></i></a>
                                    <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-original-title="Collapse" id="collapse-header"><i
                                            class="ti ti-chevrons-up"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->

                    <!-- Settings Menu -->
                    @component('components.settings-menu')
                    @endcomponent
                    <!-- /Settings Menu -->

                    <div class="row">
                        <div class="col-xl-3 col-lg-12 theiaStickySidebar">

                            <!-- Settings Sidebar -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="settings-sidebar">
                                        <h4 class="fw-semibold mb-3">Website Settings</h4>
                                        <div class="list-group list-group-flush settings-sidebar">
                                            <a href="{{url('company-settings')}}" class="fw-medium">Company Settings</a>
                                            <a href="{{url('localization')}}" class="fw-medium">Localization</a>
                                            <a href="{{url('prefixes')}}" class="fw-medium">Prefixes</a>
                                            <a href="{{url('preference')}}" class="fw-medium">Preference</a>
                                            <a href="{{url('appearance')}}" class="fw-medium">Appearance</a>
                                            <a href="{{url('language')}}" class="fw-medium active">Language</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Settings Sidebar -->
                        </div>

                        <div class="col-xl-9 col-lg-12">
                            <!-- Language Web -->
                            <div class="card">
                                <div class="card-header">
                                    <div>
                                        <div class="mb-4">
                                            <h4 class="fs-20">Language</h4>
                                        </div>	
                                        <div class="row gy-3">
                                            <div class="col-xl-5 col-md-3 col-lg-5">
                                                <div class="">
                                                    <div class="d-flex align-items-center">
                                                        <div class="lang-flag me-2">
                                                            <a href="javascript:void(0);">
                                                                <img class="avatar-img" src="{{URL::asset('/build/img/icons/flag-02.svg')}}" alt="Flag"><span>Arabic</span>
                                                            </a>
                                                        </div>
                                                        <ul class="lang-direct d-flex align-items-center">
                                                            <li>
                                                                <a href="javascript:void(0);" class="active">LTR</a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);">RTL</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>							
                                            </div>		
                                            <div class="col-xl-7 col-md-9 col-lg-12">					
                                                <div class="d-flex align-items-center flex-wrap row-gap-2 justify-content-sm-end">
                                                    <div class="dropdown me-2">
                                                        <a href="javascript:void(0);" class="dropdown-toggle"  data-bs-toggle="dropdown"><i class="ti ti-package-export me-2"></i>Export</a>
                                                        <div class="dropdown-menu  dropdown-menu-end">
                                                            <ul>
                                                                <li>
                                                                    <a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-file-type-pdf text-danger me-1"></i>Export as PDF</a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-file-type-xls text-green me-1"></i>Export as Excel </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>	
                                                    <a href="{{url('language')}}" class="btn btn-primary"><i class="ti ti-arrow-narrow-left me-2"></i>Back to Translation</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">																			
                                    <!-- Filter -->
                                    <div class="d-flex align-items-center justify-content-between flex-wrap mb-2">											
                                        <div class="dropdown mb-3">
                                            <a href="javascript:void(0);" class="dropdown-toggle"  data-bs-toggle="dropdown"><i class="ti ti-sort-ascending-2 me-2"></i>Sort </a>
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
                                                            <i class="ti ti-circle-chevron-right me-1"></i>Recently Viewed
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);" class="dropdown-item">
                                                            <i class="ti ti-circle-chevron-right me-1"></i>Recently Added
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="dropdown mb-3">
                                            <a href="javascript:void(0);" class="btn bg-soft-purple text-purple"  data-bs-toggle="dropdown"  data-bs-auto-close="outside"><i class="ti ti-columns-3 me-2"></i>Manage Columns</a>
                                            <div class="dropdown-menu  dropdown-menu-md-end dropdown-md p-3">
                                                <h4 class="mb-2 fw-semibold">Want to manage datatables?</h4>
                                                <p class="mb-3">Please drag and drop your column to reorder your table and enable see option as you want.</p>
                                                <div class="border-top pt-3">
                                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                                        <p class="mb-0 d-flex align-items-center"><i class="ti ti-grip-vertical me-2"></i>Medium</p>
                                                        <div class="status-toggle">
                                                            <input type="checkbox" id="col-name" class="check">
                                                            <label for="col-name" class="checktoggle"></label>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                                        <p class="mb-0 d-flex align-items-center"><i class="ti ti-grip-vertical me-2"></i>File</p>
                                                        <div class="status-toggle">
                                                            <input type="checkbox" id="col-phone" class="check">
                                                            <label for="col-phone" class="checktoggle"></label>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                                        <p class="mb-0 d-flex align-items-center"><i class="ti ti-grip-vertical me-2"></i>Total</p>
                                                        <div class="status-toggle">
                                                            <input type="checkbox" id="col-email" class="check">
                                                            <label for="col-email" class="checktoggle"></label>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                                        <p class="mb-0 d-flex align-items-center"><i class="ti ti-grip-vertical me-2"></i>Done</p>
                                                        <div class="status-toggle">
                                                            <input type="checkbox" id="col-loc" class="check">
                                                            <label for="col-loc" class="checktoggle"></label>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                                        <p class="mb-0 d-flex align-items-center"><i class="ti ti-grip-vertical me-2"></i>Progress</p>
                                                        <div class="status-toggle">
                                                            <input type="checkbox" id="col-rate" class="check">
                                                            <label for="col-rate" class="checktoggle"></label>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <p class="mb-0 d-flex align-items-center"><i class="ti ti-grip-vertical me-2"></i>Action</p>
                                                        <div class="status-toggle">
                                                            <input type="checkbox" id="col-action" class="check">
                                                            <label for="col-action" class="checktoggle"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>											
                                    </div>
                                    <!-- /Filter -->	

                                    <!-- Language List -->
                                    <div class="table-responsive custom-table">
                                        <table class="table" id="language-web">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th class="no-sort"></th>
                                                    <th class="no-sort"></th>
                                                    <th>Medium</th>
                                                    <th>File</th>
                                                    <th>Total</th>
                                                    <th>Done</th>
                                                    <th>Progress</th>
                                                    <th>Action</th>
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
                                    <!-- /Language List -->										

                                </div>
                            </div>
                            <!-- /Language Web -->
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
