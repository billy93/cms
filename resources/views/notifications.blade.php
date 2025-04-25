<?php $page = 'notifications'; ?>
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
                    notifications
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
                                            <a href="{{url('notifications')}}" class="fw-medium active">Notifications</a>
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
                                <div class="card-body">
                                    <h4 class="fw-semibold mb-3">Notification Settings</h4>
                                    <div class="settings-form">

                                        <!-- General Notifications -->	
                                        <div class="border-bottom mb-3 pb-3">
                                            <h5 class="fw-semibold mb-1">General Notifications</h5>
                                            <p>Select notifications</p>
                                        </div>
                                        <div class="border-bottom mb-3 pb-3">
                                            <div class="form-check d-flex align-items-center justify-content-between ps-0 mb-3">
                                                <label class="form-check-label text-gray-9 fw-medium" for="notification1">
                                                    Mobile Push Notifications
                                                </label>
                                                <input class="form-check-input" type="checkbox" value="" id="notification1" checked="">
                                            </div>
                                            <div class="form-check d-flex align-items-center justify-content-between ps-0 mb-3">
                                                <label class="form-check-label text-gray-9 fw-medium" for="notification2">
                                                    Desktop Notifications
                                                </label>
                                                <input class="form-check-input" type="checkbox" value="" id="notification2" checked="">
                                            </div>
                                            <div class="form-check d-flex align-items-center justify-content-between ps-0 mb-3">
                                                <label class="form-check-label text-gray-9 fw-medium" for="notification3">
                                                    Email Notifications
                                                </label>
                                                <input class="form-check-input" type="checkbox" id="notification3" checked="">
                                            </div>
                                            <div class="form-check d-flex align-items-center justify-content-between ps-0 mb-0">
                                                <label class="form-check-label text-gray-9 fw-medium" for="notification4">
                                                    SMS Notifications
                                                </label>
                                                <input class="form-check-input" type="checkbox" id="notification4" checked="">
                                            </div>
                                        </div>
                                        <!-- /General Notifications -->		

                                        <!-- Custom Notifications -->									
                                        <div class="border-bottom mb-3 pb-3">
                                            <h5 class="fw-semibold mb-1">Custom Notifications</h5>
                                            <p>Select when you will be notified when the following changes occur </p>
                                        </div>
                                        <div class="table-responsive notificaion-table">
                                            <table class="table table-borderless">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>Push</th>
                                                        <th>SMS</th>
                                                        <th>Email</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            Legendary
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch" checked>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch" checked>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch" checked>
                                                            </div>
                                                        </td>
                                                    </tr>	
                                                    <tr>
                                                        <td>
                                                            Transaction
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch" checked>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch" checked>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch" checked>
                                                            </div>
                                                        </td>
                                                    </tr>												
                                                    <tr>
                                                        <td>
                                                            Email Verification
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch" checked>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch" checked>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch" checked>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            OTP
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch" checked>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch" checked>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch" checked>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Activity
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch" checked>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch" checked>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch" checked>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Account
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch" checked>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch" checked>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch" checked>
                                                            </div>
                                                        </td>
                                                    </tr>										
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /Custom Notifications -->

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
