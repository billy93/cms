<?php $page = 'sms-gateway'; ?>
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
                            sms-gateways
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
                                            <a href="{{url('email-settings')}}" class="fw-medium">Email Settings</a>
                                            <a href="{{url('sms-gateways')}}" class="fw-medium active">SMS Gateways</a>
                                            <a href="{{url('gdpr-cookies')}}" class="fw-medium">GDPR Cookies</a>
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
                                    <div class="mb-4">
                                        <h4 class="fs-20">SMS Gateways</h4>
                                    </div>
                                    <div class="row">

                                        <!-- Gateway Wrap -->
                                        <div class="col-xxl-4 col-sm-6">
                                            <div class="border rounded d-flex align-items-center justify-content-between p-3 mb-3">
                                                <div>
                                                    <img src="{{ URL::asset('/build/img/icons/gateway-01.svg')}}" alt="">
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#add_nexmo"><i class="ti ti-settings fs-20"></i></a>
                                                    <div class="status-toggle ms-3">
                                                        <input type="checkbox" id="sms" class="check" checked="">
                                                        <label for="sms" class="checktoggle">	</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Gateway Wrap -->

                                        <!-- Gateway Wrap -->
                                        <div class="col-xxl-4 col-sm-6">
                                            <div class="border rounded d-flex align-items-center justify-content-between p-3 mb-3">
                                                <div>
                                                    <img src="{{ URL::asset('/build/img/icons/gateway-02.svg')}}" alt="">
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#add_factor"><i class="ti ti-settings fs-20"></i></a>
                                                    <div class="status-toggle ms-3">
                                                        <input type="checkbox" id="sms1" class="check" checked="">
                                                        <label for="sms1" class="checktoggle">	</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Gateway Wrap -->

                                        <!-- Gateway Wrap -->
                                        <div class="col-xxl-4 col-sm-6">
                                            <div class="border rounded d-flex align-items-center justify-content-between p-3 mb-3">
                                                <div>
                                                    <img src="{{ URL::asset('/build/img/icons/gateway-03.svg')}}" alt="">
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#add_twilio"><i class="ti ti-settings fs-20"></i></a>
                                                    <div class="status-toggle ms-3">
                                                        <input type="checkbox" id="loc" class="check" checked="">
                                                        <label for="loc" class="checktoggle">	</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Gateway Wrap -->

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
