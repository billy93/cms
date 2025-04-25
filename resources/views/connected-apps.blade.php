<?php $page = 'connected-apps'; ?>
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
                    connected-apps
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
                                        <h4 class="fw-semibold mb-3">General Settings</h4>
                                        <div class="list-group list-group-flush settings-sidebar">
                                            <a href="{{url('profile')}}" class="fw-medium">Profile</a>
                                            <a href="{{url('security')}}" class="fw-medium">Security</a>
                                            <a href="{{url('notifications')}}" class="fw-medium">Notifications</a>
                                            <a href="{{url('connected-apps')}}" class="fw-medium active">Connected Apps</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Settings Sidebar -->

                        </div>

                        <div class="col-xl-9 col-lg-12">

                            <!-- Settings Info -->
                            <div class="card">
                                <div class="card-body pb-0">
                                    <h4 class="fw-semibold mb-3">Connected Apps</h4>
                                    <div class="row">

                                        <!-- App -->
                                        <div class="col-md-4 col-sm-6">
                                            <div class="card border mb-3">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                                        <img src="{{URL::asset('/build/img/icons/integration-01.svg')}}" alt="Icon">
                                                        <div class="connect-btn">
                                                            <a href="javascript:void(0);" class="badge badge-soft-success">Connected</a>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <p class="mb-0">Google Calendar</p>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox" role="switch" checked>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /App -->

                                        <!-- App -->
                                        <div class="col-md-4 col-sm-6">
                                            <div class="card border mb-3">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                                        <img src="{{URL::asset('/build/img/icons/integration-02.svg')}}" alt="Icon">
                                                        <div class="connect-btn">
                                                            <a href="javascript:void(0);" class="badge border bg-white text-default">Connect</a>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <p class="mb-0">Figma</p>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox" role="switch" checked>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /App -->

                                        <!-- App -->
                                        <div class="col-md-4 col-sm-6">
                                            <div class="card border mb-3">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                                        <img src="{{URL::asset('/build/img/icons/integration-03.svg')}}" alt="Icon">
                                                        <div class="connect-btn">
                                                            <a href="javascript:void(0);" class="badge badge-soft-success">Connected</a>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <p class="mb-0">Dropbox</p>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox" role="switch" checked>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /App -->

                                        <!-- App -->
                                        <div class="col-md-4 col-sm-6">
                                            <div class="card border mb-3">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                                        <img src="{{URL::asset('/build/img/icons/integration-04.svg')}}" alt="Icon">
                                                        <div class="connect-btn">
                                                            <a href="javascript:void(0);" class="badge border bg-white text-default">Connect</a>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <p class="mb-0">Slack</p>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox" role="switch" checked>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /App -->

                                        <!-- App -->
                                        <div class="col-md-4 col-sm-6">
                                            <div class="card border mb-3">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                                        <img src="{{URL::asset('/build/img/icons/integration-05.svg')}}" alt="Icon">
                                                        <div class="connect-btn">
                                                            <a href="javascript:void(0);" class="badge badge-soft-success">Connected</a>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <p class="mb-0">Gmail</p>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox" role="switch" checked>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /App -->

                                        <!-- App -->
                                        <div class="col-md-4 col-sm-6">
                                            <div class="card border mb-3">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                                        <img src="{{URL::asset('/build/img/icons/integration-06.svg')}}" alt="Icon">
                                                        <div class="connect-btn">
                                                            <a href="javascript:void(0);" class="badge border bg-white text-default">Connect</a>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <p class="mb-0">Github</p>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox" role="switch" checked>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /App -->

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
@endsection
