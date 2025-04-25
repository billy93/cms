<?php $page = 'storage'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-md-12">

                    @component('components.breadcrumb')
                        @slot('title')
                            Settings
                        @endslot
                        @slot('item2')
                            storage
                        @endslot
                    @endcomponent

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
                                        <h4 class="fw-semibold mb-3">Other Settings</h4>
                                        <div class="list-group list-group-flush settings-sidebar">
                                            <a href="{{url('storage')}}" class="fw-medium active">Storage</a>
                                            <a href="{{url('ban-ip-address')}}" class="fw-medium">Ban IP Address</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Settings Sidebar -->

                        </div>

                        <div class="col-xl-9 col-lg-12">

                            <!-- Settings Info -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-4">
                                        <h4 class="fs-20">Storage</h4>
                                    </div>
                                    <div class="row">

                                        <!-- Storage -->
                                        <div class="col-xxl-4 col-sm-6">
                                            <div class="border rounded p-3 d-flex align-items-center justify-content-between mb-4">
                                                <div class="d-flex align-items-center">
                                                    <span class="avatar avatar-lg bg-light-100 border flex-shrink-0 me-2">
                                                        <img src="{{URL::asset('/build/img/icons/storage-icon-01.svg')}}" class="w-auto h-auto" alt="">
                                                    </span>
                                                    <h6 class="fw-semibold">Local Storage</h6>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <a href="javascript:void(0);" class="me-2"><i class="ti ti-settings fs-20"></i></a>
                                                    <div class="status-toggle">
                                                        <input type="checkbox" id="loc" class="check" checked="">
                                                        <label for="loc" class="checktoggle">	</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Storage -->

                                        <!-- Storage -->
                                        <div class="col-xxl-4 col-sm-6">
                                            <div class="border rounded p-3 d-flex align-items-center justify-content-between mb-4">
                                                <div class="d-flex align-items-center">
                                                    <span class="avatar avatar-lg bg-light-100 border flex-shrink-0 me-2">
                                                        <img src="{{URL::asset('/build/img/icons/storage-icon-02.svg')}}" class="w-auto h-auto" alt="">
                                                    </span>
                                                    <h6 class="fw-semibold">AWS</h6>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <a href="javascript:void(0);" class="me-2" data-bs-toggle="modal" data-bs-target="#add_settings"><i class="ti ti-settings fs-20"></i></a>
                                                    <div class="status-toggle">
                                                        <input type="checkbox" id="aws" class="check" checked="">
                                                        <label for="aws" class="checktoggle"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Storage -->

                                    </div>
                                    <div class="d-flex align-items-center">
                                        <a href="#" class="btn btn-light me-2">Cancel</a>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /Settings Info -->

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
