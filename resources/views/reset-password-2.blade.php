<?php $page = 'reset-password-2'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="account-content">
        <div class="login-wrapper">
            <div class="login-content">
                <form action="success-2">
                    <div class="login-user-info">
                        <div class="login-logo">
                            <img src="{{ URL::asset('/build/img/logo.svg') }}" class="img-fluid" alt="Logo">
                        </div>
                        <div class="login-heading">
                            <h4>Reset Password?</h4>
                            <p>Enter New Password & Confirm Password to get inside</p>
                        </div>
                        <div class="form-wrap">
                            <label class="col-form-label">Password</label>
                            <div class="pass-group">
                                <input type="password" class="pass-input form-control">
                                <span class="ti toggle-password ti-eye-off"></span>
                            </div>
                        </div>
                        <div class="form-wrap">
                            <label class="col-form-label">Confirm Password</label>
                            <div class="pass-group">
                                <input type="password" class="pass-inputs form-control">
                                <span class="ti toggle-passwords ti-eye-off"></span>
                            </div>
                        </div>
                        <div class="form-wrap">
                            <label class="col-form-label">New Confirm Password</label>
                            <div class="pass-group">
                                <input type="password" class="pass-input-new form-control">
                                <span class="ti toggle-password-new ti-eye-off"></span>
                            </div>
                        </div>
                        <div class="form-wrap">
                            <button type="submit" class="btn btn-primary">Change Password</button>
                        </div>
                        <div class="login-form text-center">
                            <h6>Return to <a href="{{url('login-2')}}" class="hover-a">Log In</a></h6>
                        </div>
                        <div class="login-social-link">
                            <div class="copyright-text">
                                <p>Copyright &copy;2024 - CRMS</p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="login-img">
                <img src="{{ URL::asset('/build/img/authentication/reset-img.png') }}" class="img-fluid" alt="Login">
            </div>
        </div>
    </div>
@endsection
