<?php $page = 'tax-rates'; ?>
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
                            tax-rates
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
                                        <h4 class="fw-semibold mb-3">Financial Settings</h4>
                                        <div class="list-group list-group-flush settings-sidebar">
                                            <a href="{{url('payment-gateways')}}" class="fw-medium">Payment Gateways</a>
                                            <a href="{{url('bank-accounts')}}" class="fw-medium">Bank Accounts</a>
                                            <a href="{{url('tax-rates')}}" class="fw-medium active">Tax Rates</a>
                                            <a href="{{url('currencies')}}" class="fw-medium">Currencies</a>
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
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <h4 class="fs-20">Tax Rates</h4>
                                        <a href="javascript:void(0)" class="btn btn-sm btn-icon border rounded" data-bs-toggle="modal" data-bs-target="#add_tax" ><i class="ti ti-plus"></i></a>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="col-form-label">VAT</label>
                                                <div class="icon-form-end">
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#edit_tax">
                                                        <span class="form-icon"><i class="ti ti-edit"></i></span>
                                                    </a>
                                                    <input type="text" class="form-control" value="16%">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="col-form-label">GST</label>
                                                <div class="icon-form-end">
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#edit_tax">
                                                        <span class="form-icon"><i class="ti ti-edit"></i></span>
                                                    </a>
                                                    <input type="text" class="form-control" value="14%">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="col-form-label">HST</label>
                                                <div class="icon-form-end">
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#edit_tax">
                                                        <span class="form-icon"><i class="ti ti-edit"></i></span>
                                                    </a>
                                                    <input type="text" class="form-control" value="12%">
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
