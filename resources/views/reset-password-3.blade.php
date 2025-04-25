<?php $page = 'reset-password-3'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="account-content">
        <div class="login-wrapper login-new">
            <div class="login-shapes">
                <div class="login-right-shape">
                    <img src="{{ URL::asset('/build/img/authentication/shape-01.png') }}" alt="Shape">
                </div>
                <div class="login-left-shape">
                    <img src="{{ URL::asset('/build/img/authentication/shape-02.png') }}" alt="Shape">
                </div>
            </div>
            <div class="container">
                <div class="login-content user-login">
                    <div class="login-logo">
                        <img src="{{ URL::asset('/build/img/logo.svg') }}" class="img-fluid" alt="Logo">
                    </div>
                    <form action="success-3">
                        <div class="login-user-info login-user-inner">
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
                            <div class="login-form text-center mb-0">
                                <h6>Return to <a href="{{url('login-3')}}" class="hover-a">Log In</a></h6>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="copyright-text">
                    <p>Copyright &copy;2024 - CRMS</p>
                </div>
            </div>
        </div>
    </div>
@endsection
