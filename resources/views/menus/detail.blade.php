<?php $page = 'menus.detail'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content">

            <div class="row">
                <div class="col-md-12">

                    <!-- Menu Info Card -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Menu Information</h5>
                            <div class="d-flex gap-2">
                                <a href="/menus" class="btn btn-outline-secondary">
                                    <i class="ti ti-arrow-left me-1"></i>Back to Menus
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Name</label>
                                        <p class="mb-0">{{ $menu->name }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Icon</label>
                                        <p class="mb-0">
                                            @if($menu->icon)
                                                <div class="btn btn-sm btn-outline-info"><i class="{{ $menu->icon }}"></i></div>
                                            @else
                                                -
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Order Index</label>
                                        <p class="mb-0">{{ $menu->order_index }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Visibility</label>
                                        <p class="mb-0">{{ $menu->is_visible ? "ON" : "OFF" }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Created</label>
                                        <p class="mb-0">{{ $menu->created_at ? formatDate($menu->created_at, 'j F Y') : "-" }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Updated</label>
                                        <p class="mb-0">{{ $menu->updated_at ? formatDate($menu->updated_at, 'j F Y') : "-" }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Permission Info Card -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Menu Permission</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Route Name</label>
                                        <p class="mb-0">{{ $menu->permission?->route }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Method</label>
                                        <p class="mb-0">
                                            @switch($menu->permission?->method)
                                                @case('POST')
                                                @case('PUT')
                                                @case('PATCH')
                                                    <span class="badge badge-status bg-secondary">{{ $menu->permission?->method }}</span>
                                                    @break
                                                @case('GET')
                                                    <span class="badge badge-status bg-success">{{ $menu->permission?->method }}</span>
                                                    @break
                                                @case('DELETE')
                                                    <span class="badge badge-status bg-danger">{{ $menu->permission?->method }}</span>
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
                                        <p class="mb-0">{{ $menu->permission?->path }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Description</label>
                                        <p class="mb-0">{{ $menu->permission?->description }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Created</label>
                                        <p class="mb-0">{{ $menu->permission?->created_at ? formatDate($menu->permission?->created_at, 'j F Y') : "-" }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Updated</label>
                                        <p class="mb-0">{{ $menu->permission?->updated_at ? formatDate($menu->permission?->updated_at, 'j F Y') : "-" }}</p>
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
