<?php $page = 'success'; ?>
@extends('layout.mainlayout')
@section('content')

    <div class="account-content">
        <div class="d-flex flex-wrap w-100 vh-100 overflow-hidden account-bg-04">
            <div class="d-flex align-items-center justify-content-center flex-wrap vh-100 overflow-auto p-4 w-50 bg-backdrop">
                <form action="success">
                    <div class="mx-auto mw-450">
                        <div class="text-center mb-4">
                            <img src="{{ URL::asset('/build/img/logo.svg')}}" class="img-fluid" alt="Logo">
                        </div>
                        <div class="text-center mb-3">
                            <span class="avatar avatar-xl rounded-circle bg-success mb-4"><i class="ti ti-check fs-26"></i></span>
                            <h4 class="mb-2 fs-20">Success</h4>
                            <p class="mb-0">Your Passwrod Reset Successfully!</p>
                        </div>
                        <div class="mb-3">
                            <a href="{{url('index')}}" class="btn btn-primary w-100">Back to Login</a>
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
