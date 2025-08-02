<?php $page = 'index'; ?>
@extends('layout.mainlayout')
@section('content')

    <div class="account-content">
        <div class="d-flex flex-wrap w-100 vh-100 overflow-hidden account-bg-01">
            <div class="d-flex align-items-center justify-content-center flex-wrap vh-100 overflow-auto p-4 w-50 bg-backdrop">
                <form action="{{ route('auth.signin') }}" method="POST" class="flex-fill"> 
                @csrf
                    <div class="mx-auto mw-450">
                        <div class="text-center mb-4">
                            <img src="{{ URL::asset('/build/img/logo.svg')}}" class="img-fluid" alt="Logo">
                        </div>
                        <div class="mb-4">
                            <h4 class="mb-2 fs-20">Sign In</h4>
                            <p>Access the CRMS panel using your email and passcode.</p>
                        </div>
                        @if(session('access_denied'))
                            <div class="alert alert-danger">
                                {{ session('access_denied') }}
                            </div>
                        @endif
                        <div class="mb-3">
                            <label class="col-form-label">Email Address</label>
                            <div class="position-relative">
                                <span class="input-icon-addon">
                                    <i class="ti ti-mail"></i>
                                </span>
                                <input type="email" placeholder="example@mail.com" class="form-control" name="email" id="email" value="{{ old('email') }}" required>
                            </div>
                            <div class="text-danger pt-2">
                                @error('0')
                                    {{ $message }}
                                @enderror
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Password</label>
                            <div class="pass-group">
                                <input type="password" class="pass-input form-control" name="password" id="password" required>
                                <span class="ti toggle-password ti-eye-off"></span>
                            </div>
                            <div class="text-danger pt-2">
                                @error('0')
                                    {{ $message }}
                                @enderror
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="form-check form-check-md d-flex align-items-center">
                                <input class="form-check-input" type="checkbox" name="remember" value="1" id="checkebox-md" checked="">
                                <label class="form-check-label" for="checkebox-md">
                                    Remember Me
                                </label>
                            </div>
                            <div class="text-end">
                                <a href="{{url('forgot-password')}}" class="text-primary fw-medium link-hover">Forgot Password?</a>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary w-100">Sign In</button>
                        </div>
                        <div class="mb-3">
                            <h6>New on our platform?<a href="{{url('register')}}" class="text-purple link-hover"> Create an account</a></h6>
                        </div>
                        <div class="form-set-login or-text mb-3">
                            <h4>OR</h4>
                        </div>
                        <div class="d-flex align-items-center justify-content-center flex-wrap mb-3">
                            <div class="text-center me-2 flex-fill">
                                <a href="javascript:void(0);" class="br-10 p-2 px-4 btn bg-pending  d-flex align-items-center justify-content-center">
                                    <img class="img-fluid m-1" src="{{ URL::asset('/build/img/icons/facebook-logo.svg')}}" alt="Facebook">
                                </a>
                            </div>
                            <div class="text-center me-2 flex-fill">
                                <a href="javascript:void(0);" class="br-10 p-2 px-4 btn bg-white d-flex align-items-center justify-content-center">
                                    <img class="img-fluid  m-1" src="{{ URL::asset('/build/img/icons/google-logo.svg')}}" alt="Facebook">
                                </a>
                            </div>
                            <div class="text-center flex-fill">
                                <a href="javascript:void(0);" class="bg-dark br-10 p-2 px-4 btn btn-dark d-flex align-items-center justify-content-center">
                                    <img class="img-fluid  m-1" src="{{ URL::asset('/build/img/icons/apple-logo.svg')}}" alt="Apple">
                                </a>
                            </div>
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
