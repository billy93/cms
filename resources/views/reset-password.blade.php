<?php $page = 'reset-password'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="account-content">
        <div class="d-flex flex-wrap w-100 vh-100 overflow-hidden account-bg-04">
            <div class="d-flex align-items-center justify-content-center flex-wrap vh-100 overflow-auto p-4 w-50 bg-backdrop">
                <form action="success" class="flex-fill">
                    <div class="mx-auto mw-450">
                        <div class="text-center mb-4">
                            <img src="{{ URL::asset('/build/img/logo.svg')}}" class="img-fluid" alt="Logo">
                        </div>
                        <div class="mb-4">
                            <h4 class="mb-2 fs-20">Reset Password?</h4>
                            <p>Enter New Password & Confirm Password to get inside</p>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Password</label>
                            <div class="pass-group">
                                <input type="password" class="pass-input form-control">
                                <span class="ti toggle-password ti-eye-off"></span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Confirm Password</label>
                            <div class="pass-group">
                                <input type="password" class="pass-inputs form-control">
                                <span class="ti toggle-passwords ti-eye-off"></span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">New Confirm Password</label>
                            <div class="pass-group">
                                <input type="password" class="pass-input-new form-control">
                                <span class="ti toggle-password-new ti-eye-off"></span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary w-100">Change Password</button>
                        </div>
                        <div class="mb-3 text-center">
                            <h6>Return to <a href="{{url('index')}}" class="text-purple link-hover"> Login</a></h6>
                        </div>
                        <div class="text-center">
                            <p class="fw-medium text-gray">Copyright &copy; 2024 - CRMS</p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
	</div>
@endsection
