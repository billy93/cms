<?php $page = 'email-verification-2'; ?>
@extends('layout.mainlayout')
@section('content')

<div class="account-content">
    <div class="login-wrapper">
        <div class="login-content">
            <form action="deals-dashboard">
                <div class="login-user-info">
                    <div class="login-logo">
                       <img src="{{URL::asset('/build/img/logo.svg')}}" class="img-fluid" alt="Logo">
                   </div>
                   <div class="login-heading text-center">
                       <h4>Verify Your Email</h4>
                       <p>We've sent a link to your email ter4@example.com. Please follow the link inside to continue</p>
                   </div>
                   <div class="login-form text-center">
                       <h6>Didn't receive an email? <a href="javascript:void(0);" class="hover-a">Resend Link</a></h6>
                   </div>
                   <div class="form-wrap">
                       <button type="submit" class="btn btn-primary">Skip Now</button>
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
            <img src="{{URL::asset('/build/img/authentication/email-img.png')}}" class="img-fluid" alt="Login">
        </div>
    </div>
</div>

@component('components.model-popup')
@endcomponent
@endsection