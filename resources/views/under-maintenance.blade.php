<?php $page = 'under-maintenance'; ?>
@extends('layout.mainlayout')
@section('content')

    <div class="d-flex flex-wrap w-100 vh-100 overflow-hidden">
        <div class="d-flex align-items-center justify-content-center flex-fill flex-column vh-100 overflow-auto">
            <div class="error-img mb-4">
                <img src="{{ URL::asset('/build/img/authentication/maintenance-img.png')}}" class="img-fluid" alt="">
            </div>
            <div class="text-center">
                <h3 class="fs-28 mb-3">We are Under Maintenance</h3>
                <p class="fs-16">Sorry for any inconvenience caused, we have almost <br> done Will get back soon!</p>
                <a href="deals-dashboard" class="btn btn-primary">
                    <i class="ti ti-arrow-narrow-left me-1"></i> Back to Dashboard
                </a>
            </div>
        </div>
    </div>

@endsection
