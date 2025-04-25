<?php $page = 'lock-screen'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="account-content">
        <div class="d-flex flex-wrap w-100 vh-100 overflow-hidden">
            <div class="d-flex align-items-center justify-content-center flex-fill flex-wrap vh-100 overflow-auto">
                <div class="login-shapes">
                    <div class="login-right-shape">
                        <img src="{{ URL::asset('/build/img/authentication/shape-01.png')}}" alt="Shape">
                    </div>
                    <div class="login-left-shape">
                        <img src="{{ URL::asset('/build/img/authentication/shape-02.png')}}" alt="Shape"> 
                    </div> 
                </div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-5">
                            <div class="login-content user-login">
                                <div class="text-center mb-4">
                                <img src="{{ URL::asset('/build/img/logo.svg')}}" class="img-fluid" alt="Logo">
                            </div>
                                <form action="deals-dashboard">
                                    <div class="card border p-sm-3">
                                        <div class="card-body p-4">
                                            <div class="text-center">
                                                <p class="text-default mb-3">Welcome back!</p>
                                                <div class="mb-3">
                                                    <span class="avatar avatar-xxxl rounded-circle mb-4"><img src="{{ URL::asset('/build/img/profiles/avatar-14.jpg')}}" class="img-fluid rounded-circle" alt="Profile"></span>
                                                    <h5 class="fs-18 fw-semibold">Adrian Davies</h5>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="col-form-label">Enter Password</label>
                                                <div class="pass-group">
                                                    <input type="password" class="pass-input form-control">
                                                    <span class="ti toggle-password ti-eye-off"></span>
                                                </div>
                                            </div>
                                            <div class="mb-0">
                                                <button type="submit" class="btn btn-primary w-100">Log In</button>
                                            </div>
                                        </div>
                                </div>
                                </form>
                            </div>
                            <div class="d-flex align-items-center flex-wrap row-gap-2 justify-content-center mb-4">
                                <a href="javascript:void(0);" class="fw-medium me-3">Terms & Condition</a>
                                <a href="javascript:void(0);" class="fw-medium me-3">Privacy</a>
                                <a href="javascript:void(0);" class="fw-medium me-3">Help</a>
                                <div class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle fw-medium border-0 p-0 bg-transparent shadow-none" data-bs-toggle="dropdown">English</a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a href="javascript:void(0);" class="dropdown-item">French</a>
                                        <a href="javascript:void(0);" class="dropdown-item">Spanish</a>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <p class="fw-medium text-gray">Copyright &copy; 2024 - CRMS</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
@endsection