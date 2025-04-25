<?php $page = 'two-step-verification-3'; ?>
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
                    <form method="get" class="digit-group login-form-control" data-group-name="digits"
                        data-autosubmit="false" autocomplete="off" action="deals-dashboard">
                        <div class="login-user-info login-user-inner">
                            <div class="login-heading">
                                <h4>Login With Your Email Address</h4>
                                <p class="verfy-mail-content">We sent a verification code to your email. Enter the code from
                                    the email in the field below</p>
                            </div>
                            <div class="otp-box text-center">
                                <div class="form-wrap">
                                    <input type="text" id="digit-1" name="digit-1" data-next="digit-2" maxlength="1">
                                    <input type="text" id="digit-2" name="digit-2" data-next="digit-3"
                                        data-previous="digit-1" maxlength="1">
                                    <input type="text" id="digit-3" name="digit-3" data-next="digit-4"
                                        data-previous="digit-2" maxlength="1">
                                    <input type="text" id="digit-4" name="digit-4" data-next="digit-5"
                                        data-previous="digit-3" maxlength="1">
                                </div>
                            </div>
                            <div class="otp-expire">
                                <p>Otp will expire in 09 :10</p>
                            </div>
                            <div class="form-wrap mb-0">
                                <button type="submit" class="btn btn-primary">Verify My Account</button>
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
