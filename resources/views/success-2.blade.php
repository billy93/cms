<?php $page = 'success-2'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="account-content">
        <div class="login-wrapper">
            <div class="login-content">
                <form action="login-2">
                    <div class="login-user-info">
                        <div class="login-logo success-login-logo">
                            <img src="{{ URL::asset('/build/img/logo.svg') }}" class="img-fluid" alt="Logo">
                        </div>
                        <div class="login-heading text-center">
                            <i class="ti ti-circle-check-filled"></i>
                            <h4>Success</h4>
                            <p class="verfy-mail-content mb-0">Your Passwrod Reset Successfully!</p>
                        </div>
                        <div class="form-wrap">
                            <a href="{{url('login-2')}}" class="btn btn-primary">Back to Login</a>
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
                <img src="{{ URL::asset('/build/img/authentication/success-img.png') }}" class="img-fluid" alt="Login">
            </div>
        </div>
    </div>
@endsection
