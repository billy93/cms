<?php $page = 'email-verification'; ?>
@extends('layout.mainlayout')
@section('content')

    <div class="account-content">
        <div class="d-flex flex-wrap w-100 vh-100 overflow-hidden account-bg-04">
            <div class="d-flex align-items-center justify-content-center flex-wrap vh-100 overflow-auto p-4 w-50 bg-backdrop">
                <form action="deals-dashboard">
                    <div class="mx-auto mw-450">
                        <div class="text-center mb-4">
                            <img src="{{ URL::asset('/build/img/logo.svg')}}" class="img-fluid" alt="Logo">
                        </div>
                        <div class="text-center mb-3">
                            <span class="avatar avatar-xl rounded-circle bg-success mb-4"><i class="ti ti-check fs-26"></i></span>
                            <h4 class="mb-2 fs-20">Verify Your Email</h4>
                            <p class="mb-3">We've sent a link to your email ter4@example.com. Please <br> follow the link inside to continue</p>
                                <h6>Didn't receive an email? <a href="javascript:void(0);" class="text-purple link-hover">  Resend Link</a></h6>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary w-100">Skip Now</button>
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