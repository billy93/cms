<?php $page = 'security'; ?>
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
                            security
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
                                            <a href="{{url('security')}}" class="fw-medium active">Security</a>
                                            <a href="{{url('notifications')}}" class="fw-medium">Notifications</a>
                                            <a href="{{url('connected-apps')}}" class="fw-medium">Connected Apps</a>
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
                                    <h4 class="fw-semibold mb-3">Security Settings</h4>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6 d-flex">
                                            <div class="card border shadow-none flex-fill mb-3">
                                                <div class="card-body d-flex justify-content-between flex-column">
                                                    <div class="mb-3">
                                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                                            <h6 class="fw-semibold">Password</h6>
                                                        </div>
                                                        <p>Last Changed 03 Jan 2023, 09:00 AM</p>
                                                    </div>														
                                                    <div>
                                                        <a href="javascript:void(0)" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#change_password">
                                                            Change Password
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 d-flex">
                                            <div class="card border shadow-none flex-fill mb-3">
                                                <div class="card-body d-flex justify-content-between flex-column">
                                                    <div class="mb-3">
                                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                                            <h6 class="fw-semibold">Two Factor</h6>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch" checked>
                                                            </div>
                                                        </div>
                                                        <p>Receive codes via SMS or email every time you login</p>
                                                    </div>														
                                                    <div>
                                                        <a href="javascript:void(0)" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#delete_two_factor">Delete Account</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 d-flex">
                                            <div class="card border shadow-none flex-fill mb-3">
                                                <div class="card-body d-flex justify-content-between flex-column">
                                                    <div class="mb-3">
                                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                                            <h6 class="fw-semibold">Google Authenticator</h6>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch" checked>
                                                            </div>
                                                        </div>
                                                        <p>Google Authenticator adds an extra layer of security to your online accounts by adding a second step of verification when you sign in.</p>
                                                    </div>														
                                                    <div>
                                                        <span class="badge badge-soft-success">Connected</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 d-flex">
                                            <div class="card border shadow-none flex-fill mb-3">
                                                <div class="card-body d-flex justify-content-between flex-column">
                                                    <div class="mb-3">
                                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                                            <h6 class="fw-semibold">Phone Number Verification<i class="ti ti-square-rounded-check-filled text-success ms-1"></i></h6>
                                                        </div>
                                                        <p>Verified Mobile Number : <span class="text-gray-9">+99264710583</span></p>
                                                    </div>														
                                                    <div class="d-flex align-items-center">
                                                        <a href="javascript:void(0)" class="2" data-bs-toggle="modal" data-bs-target="#change_phone_number">Change</a>
                                                    <a href="javascript:void(0)" class="link-danger fw-semibold">Remove</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 d-flex">
                                            <div class="card border shadow-none flex-fill mb-3">
                                                <div class="card-body d-flex justify-content-between flex-column">
                                                    <div class="mb-3">
                                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                                            <h6 class="fw-semibold">Email Verification<i class="ti ti-square-rounded-check-filled text-success ms-1"></i></h6>
                                                        </div>
                                                        <p>Verified Email : <span>info@example.com</span></p>
                                                    </div>														
                                                    <div class="d-flex align-items-center">
                                                        <a href="javascript:void(0)" class="btn btn-light me-2" data-bs-toggle="modal" data-bs-target="#change_email">Change</a>
                                                        <a href="javascript:void(0)" class="link-danger fw-semibold">Remove</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 d-flex">
                                            <div class="card border shadow-none flex-fill mb-3">
                                                <div class="card-body d-flex justify-content-between flex-column">
                                                    <div class="mb-3">
                                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                                            <h6 class="fw-semibold">Device Management</h6>
                                                        </div>
                                                        <p>Last Changed 17 Feb 2023, 11.00 AM</p>
                                                    </div>														
                                                    <div class="d-flex align-items-center">
                                                        <a href="javascript:void(0)" class="btn btn-light">Manage</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 d-flex">
                                            <div class="card border shadow-none flex-fill mb-3">
                                                <div class="card-body d-flex justify-content-between flex-column">
                                                    <div class="mb-3">
                                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                                            <h6 class="fw-semibold">Account Activity</h6>
                                                        </div>
                                                        <p>Last Changed 22 Feb 2023, 01:20 PM</p>
                                                    </div>														
                                                    <div class="d-flex align-items-center">
                                                        <a href="javascript:void(0)" class="btn btn-light">View</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 d-flex">
                                            <div class="card border shadow-none flex-fill mb-3">
                                                <div class="card-body d-flex justify-content-between flex-column">
                                                    <div class="mb-3">
                                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                                            <h6 class="fw-semibold">Deactive Account</h6>
                                                        </div>
                                                        <p>Last Changed 04 Mar 2023, 08:40 AM</p>
                                                    </div>														
                                                    <div class="d-flex align-items-center">
                                                        <a href="javascript:void(0)" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#deactive_account">Deactive</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 d-flex">
                                            <div class="card border shadow-none flex-fill mb-3">
                                                <div class="card-body d-flex justify-content-between flex-column">
                                                    <div class="mb-3">
                                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                                            <h6 class="fw-semibold">Delete Account</h6>
                                                        </div>
                                                        <p>Last Changed 13 Mar 2023, 02:40 PM</p>
                                                    </div>														
                                                    <div class="d-flex align-items-center">
                                                        <a href="javascript:void(0)" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#delete_account">Delete Account</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
