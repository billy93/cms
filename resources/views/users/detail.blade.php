<?php $page = 'users.detail'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content">

            <div class="row">
                <div class="col-md-12">

                    <!-- User Info Card -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">User Information</h5>
                            <div class="d-flex gap-2">
                                <a href="/users" class="btn btn-outline-secondary">
                                    @php
                                        $userMenu = $userMenus->first(fn($m) => $m->permission?->route === 'users.index');
                                    @endphp
                                    <i class="ti ti-arrow-left me-1"></i>Back to {{ $userMenu?->name ?: 'Users' }}
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Name</label>
                                        <p class="mb-0">{{ $user->name }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Email</label>
                                        <p class="mb-0">{{ $user->email }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Phone</label>
                                        <p class="mb-0">{{ $user->phone }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Role</label>
                                        <p class="mb-0">{{ $user->role?->name ?: "-" }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Status</label>
                                        <p class="mb-0">
                                            @if ($user->status === 'Inactive')
                                                <span class="badge badge-status bg-secondary">Inactive</span>
                                            @elseif ($user->status === 'Active')
                                                <span class="badge badge-status bg-success">Active</span>
                                            @elseif ($user->status === 'Suspended')
                                                <span class="badge badge-status bg-danger">Suspended</span>
                                            @else
                                                <span class="badge badge-status bg-secondary">Unknown</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Location</label>
                                        <p class="mb-0">{{ $user->location }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Created</label>
                                        <p class="mb-0">{{ $user->created_at ? formatDate($user->created_at, 'j F Y') : "-" }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Updated</label>
                                        <p class="mb-0">{{ $user->updated_at ? formatDate($user->updated_at, 'j F Y') : "-" }}</p>
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
