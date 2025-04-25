<?php $page = 'login-2'; ?>
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
                   <div class="login-heading">
                       <h4>Sign In</h4>
                       <p>Access the CRMS panel using your email and passcode.</p>
                   </div>
                   <div class="form-wrap">
                       <label class="col-form-label">Email Address</label>
                       <div class="form-wrap-icon">
                           <input type="text" class="form-control">
                           <i class="ti ti-mail"></i>
                       </div>
                   </div>
                   <div class="form-wrap">
                       <label class="col-form-label">Password</label>
                       <div class="pass-group">
                           <input type="password" class="pass-input form-control">
                           <span class="ti toggle-password ti-eye-off"></span>
                       </div>
                   </div>
                   <div class="form-wrap form-wrap-checkbox">
                       <div class="custom-control custom-checkbox">
                            <label class="check">
                                <input type="checkbox">
                                <span class="box"></span> Remember Me
                            </label>
                       </div>
                       <div class="text-end">
                           <a href="{{url('forgot-password-2')}}" class="forgot-link">Forgot Password?</a>
                       </div>
                   </div>
                   <div class="form-wrap">
                       <button type="submit" class="btn btn-primary">Sign In</button>
                   </div>
                   <div class="login-form">
                       <h6>New on our platform?<a href="{{url('register-2')}}" class="hover-a"> Create an account</a></h6>
                   </div>
                   <div class="form-set-login or-text">
                       <h4>OR</h4>
                   </div>
                   <div class="login-social-link">
                       <ul class="nav">
                           <li>
                               <a href="javascript:void(0);" class="facebook-logo">
                                   <img src="{{URL::asset('/build/img/icons/facebook-logo.svg')}}" alt="Facebook">
                               </a>
                           </li>
                           <li>
                               <a href="javascript:void(0);">
                                   <img src="{{URL::asset('/build/img/icons/google-logo.svg')}}" alt="Google">
                               </a>
                           </li>
                           <li>
                               <a href="javascript:void(0);" class="apple-logo">
                                   <img src="{{URL::asset('/build/img/icons/apple-logo.svg')}}" alt="Apple">
                               </a>
                           </li>
                       </ul>
                       <div class="copyright-text">
                           <p>Copyright &copy;2024 - CRMS</p>
                       </div>
                   </div>
               </div>
            </form>
        </div>
        <div class="login-img">
            <img src="{{URL::asset('/build/img/authentication/login-img.png')}}" class="img-fluid" alt="Login">
        </div>
    </div>
</div>
@endsection