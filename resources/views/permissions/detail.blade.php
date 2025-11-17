<?php $page = 'permissions.detail'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content">

            <div class="row">
                <div class="col-md-12">

                    <!-- Permission Info Card -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Permission Information</h5>
                            <div class="d-flex gap-2">
                                <a href="/permissions" class="btn btn-outline-secondary">
                                    <i class="ti ti-arrow-left me-1"></i>Back to Permissions
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Route Name</label>
                                        <p class="mb-0">{{ $permission->route }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Method</label>
                                        <p class="mb-0">
                                            @switch($permission->method)
                                                @case('POST')
                                                @case('PUT')
                                                @case('PATCH')
                                                    <span class="badge badge-status bg-secondary">{{ $permission->method }}</span>
                                                    @break
                                                @case('GET')
                                                    <span class="badge badge-status bg-success">{{ $permission->method }}</span>
                                                    @break
                                                @case('DELETE')
                                                    <span class="badge badge-status bg-danger">{{ $permission->method }}</span>
                                                    @break
                                                @default
                                                    <span class="badge badge-status bg-dark">Unknown</span>
                                                    @break
                                            @endswitch
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Path</label>
                                        <p class="mb-0">{{ $permission->path }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Description</label>
                                        <p class="mb-0">{{ $permission->description }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Created</label>
                                        <p class="mb-0">{{ $permission->created_at ? formatDate($permission->created_at, 'j F Y') : "-" }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Updated</label>
                                        <p class="mb-0">{{ $permission->updated_at ? formatDate($permission->updated_at, 'j F Y') : "-" }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->
@endsection
