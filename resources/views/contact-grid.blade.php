<?php $page = 'contact-grid'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content">

            <div class="row">
                <div class="col-md-12">
                    @component('components.breadcrumb')
                        @slot('title')
                            Contacts
                        @endslot
                        @slot('item1')
                            123
                        @endslot
                        @slot('item2')
                            contact-grid
                        @endslot
                    @endcomponent

                  	<!-- Card -->
					<div class="card">
                        <div class="card-header">
                            <!-- Search -->
                            <div class="row align-items-center">
                                <div class="col-sm-4">
                                    <div class="icon-form mb-3 mb-sm-0">
                                        <span class="form-icon"><i class="ti ti-search"></i></span>
                                        <input type="text" class="form-control" placeholder="Search Contacts">
                                    </div>							
                                </div>		
                                <div class="col-sm-8">					
                                    <div class="d-flex align-items-center flex-wrap row-gap-2 justify-content-sm-end">
                                        <div class="dropdown me-2">
                                            <a href="javascript:void(0);" class="dropdown-toggle"  data-bs-toggle="dropdown"><i class="ti ti-package-export me-2"></i>Export</a>
                                            <div class="dropdown-menu  dropdown-menu-end">
                                                <ul>
                                                    <li>
                                                        <a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-file-type-pdf text-danger me-1"></i>Export as PDF</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-file-type-xls text-green me-1"></i>Export as Excel </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>	
                                        <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_add"><i class="ti ti-square-rounded-plus me-2"></i>Add Contacts</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /Search -->
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-2 mb-4">
                                <div class="d-flex align-items-center flex-wrap row-gap-2">
                                    <div class="dropdown me-2">
                                        <a href="javascript:void(0);" class="dropdown-toggle" data-bs-toggle="dropdown"><i class="ti ti-sort-ascending-2 me-1"></i>Sort </a>
                                        <div class="dropdown-menu  dropdown-menu-start">
                                            <ul>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">
                                                        <i class="ti ti-circle-chevron-right me-1"></i>Ascending
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">
                                                        <i class="ti ti-circle-chevron-right me-1"></i>Descending
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">
                                                        <i class="ti ti-circle-chevron-right me-1"></i>Recently Viewed
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">
                                                        <i class="ti ti-circle-chevron-right me-1"></i>Recently Added
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="icon-form">
                                        <span class="form-icon"><i class="ti ti-calendar"></i></span>
                                        <input type="text" class="form-control bookingrange" placeholder="">
                                    </div>
                                </div>
                                <div class="d-flex align-items-center flex-wrap row-gap-2">
                                    <div class="form-sorts dropdown me-2">
                                        <a href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside"><i class="ti ti-filter-share"></i>Filter</a>
                                        <div class="filter-dropdown-menu dropdown-menu  dropdown-menu-md-end p-3">
                                            <div class="filter-set-view">
                                                <div class="filter-set-head">
                                                    <h4><i class="ti ti-filter-share"></i>Filter</h4>
                                                </div>
                                                <div class="accordion" id="accordionExample">
                                                    <div class="filter-set-content">
                                                        <div class="filter-set-content-head">
                                                            <a href="#" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">Country</a>
                                                        </div>
                                                        <div class="filter-set-contents accordion-collapse collapse show" id="collapseTwo" data-bs-parent="#accordionExample">
                                                            <div class="filter-content-list">
                                                                <div class="mb-2 icon-form">
                                                                    <span class="form-icon"><i class="ti ti-search"></i></span>
                                                                    <input type="text" class="form-control" placeholder="Search Country">
                                                                </div>
                                                                <ul>
                                                                    <li>
                                                                        <div class="filter-checks">
                                                                            <label class="checkboxs">
                                                                                <input type="checkbox">
                                                                                <span class="checkmarks"></span>
                                                                                India
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="filter-checks">
                                                                            <label class="checkboxs">
                                                                                <input type="checkbox">
                                                                                <span class="checkmarks"></span>
                                                                                USA
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="filter-checks">
                                                                            <label class="checkboxs">
                                                                                <input type="checkbox">
                                                                                <span class="checkmarks"></span>
                                                                                France
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="filter-checks">
                                                                            <label class="checkboxs">
                                                                                <input type="checkbox">
                                                                                <span class="checkmarks"></span>
                                                                                United Kingdom
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="filter-checks">
                                                                            <label class="checkboxs">
                                                                                <input type="checkbox">
                                                                                <span class="checkmarks"></span>
                                                                                UAE
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="filter-checks">
                                                                            <label class="checkboxs">
                                                                                <input type="checkbox">
                                                                                <span class="checkmarks"></span>
                                                                                Italy
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="filter-checks">
                                                                            <label class="checkboxs">
                                                                                <input type="checkbox">
                                                                                <span class="checkmarks"></span>
                                                                                Japan
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="filter-checks">
                                                                            <label class="checkboxs">
                                                                                <input type="checkbox">
                                                                                <span class="checkmarks"></span>
                                                                                Germany
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="filter-set-content">
                                                        <div class="filter-set-content-head">
                                                            <a href="#" class="collapsed" data-bs-toggle="collapse" data-bs-target="#owner" aria-expanded="false" aria-controls="owner">Owner</a>
                                                        </div>
                                                        <div class="filter-set-contents accordion-collapse collapse" id="owner" data-bs-parent="#accordionExample">
                                                            <div class="filter-content-list">
                                                                <div class="mb-2 icon-form">
                                                                    <span class="form-icon"><i class="ti ti-search"></i></span>
                                                                    <input type="text" class="form-control" placeholder="Search Owner">
                                                                </div>
                                                                <ul>
                                                                    <li>
                                                                        <div class="filter-checks">
                                                                            <label class="checkboxs">
                                                                                <input type="checkbox" checked="">
                                                                                <span class="checkmarks"></span>
                                                                                Hendry
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="filter-checks">
                                                                            <label class="checkboxs">
                                                                                <input type="checkbox">
                                                                                <span class="checkmarks"></span>
                                                                                Guillory
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="filter-checks">
                                                                            <label class="checkboxs">
                                                                                <input type="checkbox">
                                                                                <span class="checkmarks"></span>
                                                                                Jami
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="filter-checks">
                                                                            <label class="checkboxs">
                                                                                <input type="checkbox">
                                                                                <span class="checkmarks"></span>
                                                                                Theresa
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="filter-checks">
                                                                            <label class="checkboxs">
                                                                                <input type="checkbox">
                                                                                <span class="checkmarks"></span>
                                                                                Espinosa
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="filter-set-content">
                                                        <div class="filter-set-content-head">
                                                            <a href="#" class="collapsed" data-bs-toggle="collapse" data-bs-target="#Status" aria-expanded="false" aria-controls="Status">Status</a>
                                                        </div>
                                                        <div class="filter-set-contents accordion-collapse collapse" id="Status" data-bs-parent="#accordionExample">
                                                            <div class="filter-content-list">
                                                                <ul>
                                                                    <li>
                                                                        <div class="filter-checks">
                                                                            <label class="checkboxs">
                                                                                <input type="checkbox" checked="">
                                                                                <span class="checkmarks"></span>
                                                                                Active
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="filter-checks">
                                                                            <label class="checkboxs">
                                                                                <input type="checkbox">
                                                                                <span class="checkmarks"></span>
                                                                                Inactive
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="filter-set-content">
                                                        <div class="filter-set-content-head">
                                                            <a href="#" class="collapsed" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">Rating</a>
                                                        </div>
                                                        <div class="filter-set-contents accordion-collapse collapse" id="collapseOne" data-bs-parent="#accordionExample">
                                                            <div class="filter-content-list">
                                                                <ul>
                                                                    <li>
                                                                        <div class="filter-checks">
                                                                            <label class="checkboxs">
                                                                                <input type="checkbox" checked="">
                                                                                <span class="checkmarks"></span>
                                                                                <span class="rating">
                                                                                    <i class="fa fa-star filled"></i>
                                                                                    <i class="fa fa-star filled"></i>
                                                                                    <i class="fa fa-star filled"></i>
                                                                                    <i class="fa fa-star filled"></i>
                                                                                    <i class="fa fa-star filled"></i>
                                                                                    <span>5.0</span>
                                                                                </span>
                                                                            </label>
                                                                        </div>
                                                                        
                                                                    </li>
                                                                    <li>
                                                                        <div class="filter-checks">
                                                                            <label class="checkboxs">
                                                                                <input type="checkbox">
                                                                                <span class="checkmarks"></span>
                                                                                <span class="rating">
                                                                                    <i class="fa fa-star filled"></i>
                                                                                    <i class="fa fa-star filled"></i>
                                                                                    <i class="fa fa-star filled"></i>
                                                                                    <i class="fa fa-star filled"></i>
                                                                                    <i class="fa fa-star"></i>
                                                                                    <span>4.0</span>
                                                                                </span>
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="filter-checks">
                                                                            <label class="checkboxs">
                                                                                <input type="checkbox">
                                                                                <span class="checkmarks"></span>
                                                                                <span class="rating">
                                                                                    <i class="fa fa-star filled"></i>
                                                                                    <i class="fa fa-star filled"></i>
                                                                                    <i class="fa fa-star filled"></i>
                                                                                    <i class="fa fa-star"></i>
                                                                                    <i class="fa fa-star"></i>
                                                                                    <span>3.0</span>
                                                                                </span>
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="filter-checks">
                                                                            <label class="checkboxs">
                                                                                <input type="checkbox">
                                                                                <span class="checkmarks"></span>																																				
                                                                                <span class="rating">
                                                                                    <i class="fa fa-star filled"></i>
                                                                                    <i class="fa fa-star filled"></i>
                                                                                    <i class="fa fa-star"></i>
                                                                                    <i class="fa fa-star"></i>
                                                                                    <i class="fa fa-star"></i>
                                                                                    <span>2.0</span>
                                                                                </span>
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="filter-checks">
                                                                            <label class="checkboxs">
                                                                                <input type="checkbox">
                                                                                <span class="checkmarks"></span>
                                                                                <span class="rating">
                                                                                    <i class="fa fa-star filled"></i>
                                                                                    <i class="fa fa-star"></i>
                                                                                    <i class="fa fa-star"></i>
                                                                                    <i class="fa fa-star"></i>
                                                                                    <i class="fa fa-star"></i>
                                                                                    <span>1.0</span>
                                                                                </span>
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="filter-set-content">
                                                        <div class="filter-set-content-head">
                                                            <a href="#" class="collapsed" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Tags</a>
                                                        </div>
                                                        <div class="filter-set-contents accordion-collapse collapse" id="collapseThree" data-bs-parent="#accordionExample">
                                                            <div class="filter-content-list">
                                                                <ul>
                                                                    <li>
                                                                        <div class="filter-checks">
                                                                            <label class="checkboxs">
                                                                                <input type="checkbox" checked="">
                                                                                <span class="checkmarks"></span>
                                                                                Promotion
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="filter-checks">
                                                                            <label class="checkboxs">
                                                                                <input type="checkbox">
                                                                                <span class="checkmarks"></span>
                                                                                Rated
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="filter-checks">
                                                                            <label class="checkboxs">
                                                                                <input type="checkbox">
                                                                                <span class="checkmarks"></span>
                                                                                Rejected
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="filter-checks">
                                                                            <label class="checkboxs">
                                                                                <input type="checkbox">
                                                                                <span class="checkmarks"></span>
                                                                                Collab
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="filter-checks">
                                                                            <label class="checkboxs">
                                                                                <input type="checkbox">
                                                                                <span class="checkmarks"></span>
                                                                                Calls
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>													
                                                <div class="filter-reset-btns">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <a href="#" class="btn btn-light">Reset</a>
                                                        </div>
                                                        <div class="col-6">
                                                            <a href="{{url('contact-grid')}}" class="btn btn-primary">Filter</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="view-icons">
                                        <a href="{{url('contacts')}}"><i class="ti ti-list-tree"></i></a>
                                        <a href="{{url('contact-grid')}}" class="active"><i class="ti ti-grid-dots"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!-- Contact Grid -->
                            <div class="row">
                                <div class="col-xxl-3 col-xl-4 col-md-6">
                                    <div class="card border">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between mb-3">
                                                <div class="d-flex align-items-center">
                                                    <a href="{{url('contact-details')}}" class="avatar avatar-md flex-shrink-0 me-2">
                                                        <img src="{{URL::asset('/build/img/profiles/avatar-19.jpg')}}" alt="img">
                                                    </a>
                                                    <div>
                                                        <h6><a href="{{url('contact-details')}}" class="fw-medium">Darlee Robertson</a></h6>
                                                        <p class="text-default">Facility Manager</p>
                                                    </div>
                                                </div>
                                                <div class="dropdown table-action">
                                                    <a href="#" class="action-icon " data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_edit"><i class="ti ti-edit text-blue"></i> Edit</a>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_contact"><i class="ti ti-trash text-danger"></i> Delete</a>
                                                        <a class="dropdown-item" href="{{url('contact-details')}}"><i class="ti ti-eye text-blue-light"></i> Preview</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-block">
                                                <div class="d-flex flex-column mb-3">
                                                    <p class="text-default d-inline-flex align-items-center mb-2"><i class="ti ti-mail text-dark me-1"></i>robertson@example.com</p>
                                                    <p class="text-default d-inline-flex align-items-center mb-2"><i class="ti ti-phone text-dark me-1"></i>1234567890</p>
                                                    <p class="text-default d-inline-flex align-items-center"><i class="ti ti-map-pin-pin text-dark me-1"></i>Germany</p>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <span class="badge badge-tag badge-success-light me-2">Collab</span>
                                                    <span class="badge badge-tag badge-warning-light">Rated</span>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                                                <div class="d-flex align-items-center grid-social-links">
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle me-1"><i class="ti ti-mail fs-14"></i></a>
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle me-1"><i class="ti ti-phone-check fs-14"></i></a>
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle me-1"><i class="ti ti-message-circle-share fs-14"></i></a>
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle me-1"><i class="ti ti-brand-skype fs-14"></i></a>
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle"><i class="ti ti-brand-facebook fs-14"></i></a>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <div class="set-star text-default me-2">
                                                        <i class="fa fa-star filled me-1"></i>4.2
                                                    </div>
                                                    <a href="javascript:void(0);" class="avatar avatar-md" data-bs-toggle="tooltip" data-bs-original-title="Mervin" data-bs-placement="top">
                                                        <img src="{{URL::asset('/build/img/profiles/avatar-14.jpg')}}" alt="img">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-xl-4 col-md-6">
                                    <div class="card border">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between mb-3">
                                                <div class="d-flex align-items-center">
                                                    <a href="{{url('contact-details')}}" class="avatar avatar-md flex-shrink-0 me-2">
                                                        <img src="{{URL::asset('/build/img/profiles/avatar-20.jpg')}}" alt="img">
                                                    </a>
                                                    <div>
                                                        <h6><a href="{{url('contact-details')}}" class="fw-medium">Sharon Roy</a></h6>
                                                        <p class="text-default">Installer</p>
                                                    </div>
                                                </div>
                                                <div class="dropdown table-action">
                                                    <a href="#" class="action-icon " data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_edit"><i class="ti ti-edit text-blue"></i> Edit</a>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_contact"><i class="ti ti-trash text-danger"></i> Delete</a>
                                                        <a class="dropdown-item" href="{{url('contact-details')}}"><i class="ti ti-eye text-blue-light"></i> Preview</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-block">
                                                <div class="d-flex flex-column mb-3">
                                                    <p class="text-default d-inline-flex align-items-center mb-2"><i class="ti ti-mail text-dark me-1"></i>sharon@example.com</p>
                                                    <p class="text-default d-inline-flex align-items-center mb-2"><i class="ti ti-phone text-dark me-1"></i>+1 989757485</p>
                                                    <p class="text-default d-inline-flex align-items-center"><i class="ti ti-map-pin-pin text-dark me-1"></i>+1 989757485</p>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <span class="badge badge-tag badge-success-light me-2">Collab</span>
                                                    <span class="badge badge-tag badge-warning-light">Rated</span>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                                                <div class="d-flex align-items-center grid-social-links">
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle me-1"><i class="ti ti-mail fs-14"></i></a>
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle me-1"><i class="ti ti-phone-check fs-14"></i></a>
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle me-1"><i class="ti ti-message-circle-share fs-14"></i></a>
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle me-1"><i class="ti ti-brand-skype fs-14"></i></a>
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle"><i class="ti ti-brand-facebook fs-14"></i></a>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <div class="set-star text-default me-2">
                                                        <i class="fa fa-star filled me-1"></i>5.0
                                                    </div>
                                                    <a href="javascript:void(0);" class="avatar avatar-md" data-bs-toggle="tooltip" data-bs-original-title="Mervin" data-bs-placement="top">
                                                        <img src="{{URL::asset('/build/img/profiles/avatar-14.jpg')}}" alt="img">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-xl-4 col-md-6">
                                    <div class="card border">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between mb-3">
                                                <div class="d-flex align-items-center">
                                                    <a href="{{url('contact-details')}}" class="avatar avatar-md flex-shrink-0 me-2">
                                                        <img src="{{URL::asset('/build/img/profiles/avatar-21.jpg')}}" alt="img">
                                                    </a>
                                                    <div>
                                                        <h6><a href="{{url('contact-details')}}" class="fw-medium">Vaughan</a></h6>
                                                        <p class="text-default">Senior Manager</p>
                                                    </div>
                                                </div>
                                                <div class="dropdown table-action">
                                                    <a href="#" class="action-icon " data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_edit"><i class="ti ti-edit text-blue"></i> Edit</a>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_contact"><i class="ti ti-trash text-danger"></i> Delete</a>
                                                        <a class="dropdown-item" href="{{url('contact-details')}}"><i class="ti ti-eye text-blue-light"></i> Preview</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-block">
                                                <div class="d-flex flex-column mb-3">
                                                    <p class="text-default d-inline-flex align-items-center mb-2"><i class="ti ti-mail text-dark me-1"></i>vaughan12@example.com</p>
                                                    <p class="text-default d-inline-flex align-items-center mb-2"><i class="ti ti-phone text-dark me-1"></i>+1 546555455</p>
                                                    <p class="text-default d-inline-flex align-items-center"><i class="ti ti-map-pin-pin text-dark me-1"></i>India</p>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <span class="badge badge-tag badge-success-light me-2">Collab</span>
                                                    <span class="badge badge-tag badge-warning-light">Rated</span>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                                                <div class="d-flex align-items-center grid-social-links">
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle me-1"><i class="ti ti-mail fs-14"></i></a>
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle me-1"><i class="ti ti-phone-check fs-14"></i></a>
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle me-1"><i class="ti ti-message-circle-share fs-14"></i></a>
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle me-1"><i class="ti ti-brand-skype fs-14"></i></a>
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle"><i class="ti ti-brand-facebook fs-14"></i></a>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <div class="set-star text-default me-2">
                                                        <i class="fa fa-star filled me-1"></i>3.5
                                                    </div>
                                                    <a href="javascript:void(0);" class="avatar avatar-md" data-bs-toggle="tooltip" data-bs-original-title="Mervin" data-bs-placement="top">
                                                        <img src="{{URL::asset('/build/img/profiles/avatar-14.jpg')}}" alt="img">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-xl-4 col-md-6">
                                    <div class="card border">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between mb-3">
                                                <div class="d-flex align-items-center">
                                                    <a href="{{url('contact-details')}}" class="avatar avatar-md flex-shrink-0 me-2">
                                                        <img src="{{URL::asset('/build/img/profiles/avatar-23.jpg')}}" alt="img">
                                                    </a>
                                                    <div>
                                                        <h6><a href="{{url('contact-details')}}" class="fw-medium">Jessica</a></h6>
                                                        <p class="text-default">Test Engineer</p>
                                                    </div>
                                                </div>
                                                <div class="dropdown table-action">
                                                    <a href="#" class="action-icon " data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_edit"><i class="ti ti-edit text-blue"></i> Edit</a>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_contact"><i class="ti ti-trash text-danger"></i> Delete</a>
                                                        <a class="dropdown-item" href="{{url('contact-details')}}"><i class="ti ti-eye text-blue-light"></i> Preview</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-block">
                                                <div class="d-flex flex-column mb-3">
                                                    <p class="text-default d-inline-flex align-items-center mb-2"><i class="ti ti-mail text-dark me-1"></i>jessica13@example.com</p>
                                                    <p class="text-default d-inline-flex align-items-center mb-2"><i class="ti ti-phone text-dark me-1"></i>+1 454478787</p>
                                                    <p class="text-default d-inline-flex align-items-center"><i class="ti ti-map-pin-pin text-dark me-1"></i>India</p>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <span class="badge badge-tag badge-success-light me-2">Collab</span>
                                                    <span class="badge badge-tag badge-warning-light">Rated</span>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                                                <div class="d-flex align-items-center grid-social-links">
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle me-1"><i class="ti ti-mail fs-14"></i></a>
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle me-1"><i class="ti ti-phone-check fs-14"></i></a>
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle me-1"><i class="ti ti-message-circle-share fs-14"></i></a>
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle me-1"><i class="ti ti-brand-skype fs-14"></i></a>
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle"><i class="ti ti-brand-facebook fs-14"></i></a>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <div class="set-star text-default me-2">
                                                        <i class="fa fa-star filled me-1"></i>3.5
                                                    </div>
                                                    <a href="javascript:void(0);" class="avatar avatar-md" data-bs-toggle="tooltip" data-bs-original-title="Mervin" data-bs-placement="top">
                                                        <img src="{{URL::asset('/build/img/profiles/avatar-14.jpg')}}" alt="img">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>	
                                <div class="col-xxl-3 col-xl-4 col-md-6">
                                    <div class="card border">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between mb-3">
                                                <div class="d-flex align-items-center">
                                                    <a href="{{url('contact-details')}}" class="avatar avatar-md flex-shrink-0 me-2">
                                                        <img src="{{URL::asset('/build/img/profiles/avatar-16.jpg')}}" alt="img">
                                                    </a>
                                                    <div>
                                                        <h6><a href="{{url('contact-details')}}" class="fw-medium">Carol Thomas</a></h6>
                                                        <p class="text-default">UI /UX Designer</p>
                                                    </div>
                                                </div>
                                                <div class="dropdown table-action">
                                                    <a href="#" class="action-icon " data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_edit"><i class="ti ti-edit text-blue"></i> Edit</a>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_contact"><i class="ti ti-trash text-danger"></i> Delete</a>
                                                        <a class="dropdown-item" href="{{url('contact-details')}}"><i class="ti ti-eye text-blue-light"></i> Preview</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-block">
                                                <div class="d-flex flex-column mb-3">
                                                    <p class="text-default d-inline-flex align-items-center mb-2"><i class="ti ti-mail text-dark me-1"></i>caroltho3@example.com</p>
                                                    <p class="text-default d-inline-flex align-items-center mb-2"><i class="ti ti-phone text-dark me-1"></i>+1 124547845</p>
                                                    <p class="text-default d-inline-flex align-items-center"><i class="ti ti-map-pin-pin text-dark me-1"></i>China</p>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <span class="badge badge-tag badge-success-light me-2">Collab</span>
                                                    <span class="badge badge-tag badge-warning-light">Rated</span>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                                                <div class="d-flex align-items-center grid-social-links">
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle me-1"><i class="ti ti-mail fs-14"></i></a>
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle me-1"><i class="ti ti-phone-check fs-14"></i></a>
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle me-1"><i class="ti ti-message-circle-share fs-14"></i></a>
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle me-1"><i class="ti ti-brand-skype fs-14"></i></a>
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle"><i class="ti ti-brand-facebook fs-14"></i></a>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <div class="set-star text-default me-2">
                                                        <i class="fa fa-star filled me-1"></i>3.5
                                                    </div>
                                                    <a href="javascript:void(0);" class="avatar avatar-md" data-bs-toggle="tooltip" data-bs-original-title="Mervin" data-bs-placement="top">
                                                        <img src="{{URL::asset('/build/img/profiles/avatar-14.jpg')}}" alt="img">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-xl-4 col-md-6">
                                    <div class="card border">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between mb-3">
                                                <div class="d-flex align-items-center">
                                                    <a href="{{url('contact-details')}}" class="avatar avatar-md flex-shrink-0 me-2">
                                                        <img src="{{URL::asset('/build/img/profiles/avatar-22.jpg')}}" alt="img">
                                                    </a>
                                                    <div>
                                                        <h6><a href="{{url('contact-details')}}" class="fw-medium">Dawn Mercha</a></h6>
                                                        <p class="text-default">Technician</p>
                                                    </div>
                                                </div>
                                                <div class="dropdown table-action">
                                                    <a href="#" class="action-icon " data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_edit"><i class="ti ti-edit text-blue"></i> Edit</a>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_contact"><i class="ti ti-trash text-danger"></i> Delete</a>
                                                        <a class="dropdown-item" href="{{url('contact-details')}}"><i class="ti ti-eye text-blue-light"></i> Preview</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-block">
                                                <div class="d-flex flex-column mb-3">
                                                    <p class="text-default d-inline-flex align-items-center mb-2"><i class="ti ti-mail text-dark me-1"></i>dawnmercha@example.com</p>
                                                    <p class="text-default d-inline-flex align-items-center mb-2"><i class="ti ti-phone text-dark me-1"></i>+1 478845447</p>
                                                    <p class="text-default d-inline-flex align-items-center"><i class="ti ti-map-pin-pin text-dark me-1"></i>Japan</p>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <span class="badge badge-tag badge-success-light me-2">Collab</span>
                                                    <span class="badge badge-tag badge-warning-light">Rated</span>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                                                <div class="d-flex align-items-center grid-social-links">
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle me-1"><i class="ti ti-mail fs-14"></i></a>
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle me-1"><i class="ti ti-phone-check fs-14"></i></a>
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle me-1"><i class="ti ti-message-circle-share fs-14"></i></a>
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle me-1"><i class="ti ti-brand-skype fs-14"></i></a>
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle"><i class="ti ti-brand-facebook fs-14"></i></a>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <div class="set-star text-default me-2">
                                                        <i class="fa fa-star filled me-1"></i>3.5
                                                    </div>
                                                    <a href="javascript:void(0);" class="avatar avatar-md" data-bs-toggle="tooltip" data-bs-original-title="Mervin" data-bs-placement="top">
                                                        <img src="{{URL::asset('/build/img/profiles/avatar-14.jpg')}}" alt="img">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-xl-4 col-md-6">
                                    <div class="card border">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between mb-3">
                                                <div class="d-flex align-items-center">
                                                    <a href="{{url('contact-details')}}" class="avatar avatar-md flex-shrink-0 me-2">
                                                        <img src="{{URL::asset('/build/img/profiles/avatar-24.jpg')}}" alt="img">
                                                    </a>
                                                    <div>
                                                        <h6><a href="{{url('contact-details')}}" class="fw-medium">Rachel Hampton</a></h6>
                                                        <p class="text-default">Software Developer</p>
                                                    </div>
                                                </div>
                                                <div class="dropdown table-action">
                                                    <a href="#" class="action-icon " data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_edit"><i class="ti ti-edit text-blue"></i> Edit</a>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_contact"><i class="ti ti-trash text-danger"></i> Delete</a>
                                                        <a class="dropdown-item" href="{{url('contact-details')}}"><i class="ti ti-eye text-blue-light"></i> Preview</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-block">
                                                <div class="d-flex flex-column mb-3">
                                                    <p class="text-default d-inline-flex align-items-center mb-2"><i class="ti ti-mail text-dark me-1"></i>rachel@example.com</p>
                                                    <p class="text-default d-inline-flex align-items-center mb-2"><i class="ti ti-phone text-dark me-1"></i>+1 215544845</p>
                                                    <p class="text-default d-inline-flex align-items-center"><i class="ti ti-map-pin-pin text-dark me-1"></i>Indonesia</p>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <span class="badge badge-tag badge-success-light me-2">Collab</span>
                                                    <span class="badge badge-tag badge-warning-light">Rated</span>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                                                <div class="d-flex align-items-center grid-social-links">
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle me-1"><i class="ti ti-mail fs-14"></i></a>
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle me-1"><i class="ti ti-phone-check fs-14"></i></a>
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle me-1"><i class="ti ti-message-circle-share fs-14"></i></a>
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle me-1"><i class="ti ti-brand-skype fs-14"></i></a>
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle"><i class="ti ti-brand-facebook fs-14"></i></a>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <div class="set-star text-default me-2">
                                                        <i class="fa fa-star filled me-1"></i>3.5
                                                    </div>
                                                    <a href="javascript:void(0);" class="avatar avatar-md" data-bs-toggle="tooltip" data-bs-original-title="Mervin" data-bs-placement="top">
                                                        <img src="{{URL::asset('/build/img/profiles/avatar-14.jpg')}}" alt="img">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-xl-4 col-md-6">
                                    <div class="card border">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between mb-3">
                                                <div class="d-flex align-items-center">
                                                    <a href="{{url('contact-details')}}" class="avatar avatar-md flex-shrink-0 me-2">
                                                        <img src="{{URL::asset('/build/img/profiles/avatar-25.jpg')}}" alt="img">
                                                    </a>
                                                    <div>
                                                        <h6><a href="{{url('contact-details')}}" class="fw-medium">Jonelle Curtiss</a></h6>
                                                        <p class="text-default">Supervisor</p>
                                                    </div>
                                                </div>
                                                <div class="dropdown table-action">
                                                    <a href="#" class="action-icon " data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_edit"><i class="ti ti-edit text-blue"></i> Edit</a>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_contact"><i class="ti ti-trash text-danger"></i> Delete</a>
                                                        <a class="dropdown-item" href="{{url('contact-details')}}"><i class="ti ti-eye text-blue-light"></i> Preview</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-block">
                                                <div class="d-flex flex-column mb-3">
                                                    <p class="text-default d-inline-flex align-items-center mb-2"><i class="ti ti-mail text-dark me-1"></i>jonelle@example.com</p>
                                                    <p class="text-default d-inline-flex align-items-center mb-2"><i class="ti ti-phone text-dark me-1"></i>+1 121145471</p>
                                                    <p class="text-default d-inline-flex align-items-center"><i class="ti ti-map-pin-pin text-dark me-1"></i>Cuba</p>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <span class="badge badge-tag badge-success-light me-2">Collab</span>
                                                    <span class="badge badge-tag badge-warning-light">Rated</span>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                                                <div class="d-flex align-items-center grid-social-links">
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle me-1"><i class="ti ti-mail fs-14"></i></a>
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle me-1"><i class="ti ti-phone-check fs-14"></i></a>
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle me-1"><i class="ti ti-message-circle-share fs-14"></i></a>
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle me-1"><i class="ti ti-brand-skype fs-14"></i></a>
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle"><i class="ti ti-brand-facebook fs-14"></i></a>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <div class="set-star text-default me-2">
                                                        <i class="fa fa-star filled me-1"></i>3.5
                                                    </div>
                                                    <a href="javascript:void(0);" class="avatar avatar-md" data-bs-toggle="tooltip" data-bs-original-title="Mervin" data-bs-placement="top">
                                                        <img src="{{URL::asset('/build/img/profiles/avatar-14.jpg')}}" alt="img">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-xl-4 col-md-6">
                                    <div class="card border">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between mb-3">
                                                <div class="d-flex align-items-center">
                                                    <a href="{{url('contact-details')}}" class="avatar avatar-md flex-shrink-0 me-2">
                                                        <img src="{{URL::asset('/build/img/profiles/avatar-26.jpg')}}" alt="img">
                                                    </a>
                                                    <div>
                                                        <h6><a href="{{url('contact-details')}}" class="fw-medium">Jonathan</a></h6>
                                                        <p class="text-default">Team Lead Dev</p>
                                                    </div>
                                                </div>
                                                <div class="dropdown table-action">
                                                    <a href="#" class="action-icon " data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_edit"><i class="ti ti-edit text-blue"></i> Edit</a>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_contact"><i class="ti ti-trash text-danger"></i> Delete</a>
                                                        <a class="dropdown-item" href="{{url('contact-details')}}"><i class="ti ti-eye text-blue-light"></i> Preview</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-block">
                                                <div class="d-flex flex-column mb-3">
                                                    <p class="text-default d-inline-flex align-items-center mb-2"><i class="ti ti-mail text-dark me-1"></i>jonathan@example.com</p>
                                                    <p class="text-default d-inline-flex align-items-center mb-2"><i class="ti ti-phone text-dark me-1"></i>+1 321454789</p>
                                                    <p class="text-default d-inline-flex align-items-center"><i class="ti ti-map-pin-pin text-dark me-1"></i>Isreal</p>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <span class="badge badge-tag badge-success-light me-2">Collab</span>
                                                    <span class="badge badge-tag badge-warning-light">Rated</span>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                                                <div class="d-flex align-items-center grid-social-links">
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle me-1"><i class="ti ti-mail fs-14"></i></a>
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle me-1"><i class="ti ti-phone-check fs-14"></i></a>
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle me-1"><i class="ti ti-message-circle-share fs-14"></i></a>
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle me-1"><i class="ti ti-brand-skype fs-14"></i></a>
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle"><i class="ti ti-brand-facebook fs-14"></i></a>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <div class="set-star text-default me-2">
                                                        <i class="fa fa-star filled me-1"></i>2.7
                                                    </div>
                                                    <a href="javascript:void(0);" class="avatar avatar-md" data-bs-toggle="tooltip" data-bs-original-title="Mervin" data-bs-placement="top">
                                                        <img src="{{URL::asset('/build/img/profiles/avatar-14.jpg')}}" alt="img">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-xl-4 col-md-6">
                                    <div class="card border">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between mb-3">
                                                <div class="d-flex align-items-center">
                                                    <a href="{{url('contact-details')}}" class="avatar avatar-md flex-shrink-0 me-2">
                                                        <img src="{{URL::asset('/build/img/profiles/avatar-01.jpg')}}" alt="img">
                                                    </a>
                                                    <div>
                                                        <h6><a href="{{url('contact-details')}}" class="fw-medium">Brook</a></h6>
                                                        <p class="text-default">Team Lead Dev</p>
                                                    </div>
                                                </div>
                                                <div class="dropdown table-action">
                                                    <a href="#" class="action-icon " data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_edit"><i class="ti ti-edit text-blue"></i> Edit</a>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_contact"><i class="ti ti-trash text-danger"></i> Delete</a>
                                                        <a class="dropdown-item" href="{{url('contact-details')}}"><i class="ti ti-eye text-blue-light"></i> Preview</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-block">
                                                <div class="d-flex flex-column mb-3">
                                                    <p class="text-default d-inline-flex align-items-center mb-2"><i class="ti ti-mail text-dark me-1"></i>brook@example.com</p>
                                                    <p class="text-default d-inline-flex align-items-center mb-2"><i class="ti ti-phone text-dark me-1"></i>+1 278907145</p>
                                                    <p class="text-default d-inline-flex align-items-center"><i class="ti ti-map-pin-pin text-dark me-1"></i>Colombia</p>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <span class="badge badge-tag badge-success-light me-2">Collab</span>
                                                    <span class="badge badge-tag badge-warning-light">Rated</span>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                                                <div class="d-flex align-items-center grid-social-links">
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle me-1"><i class="ti ti-mail fs-14"></i></a>
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle me-1"><i class="ti ti-phone-check fs-14"></i></a>
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle me-1"><i class="ti ti-message-circle-share fs-14"></i></a>
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle me-1"><i class="ti ti-brand-skype fs-14"></i></a>
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle"><i class="ti ti-brand-facebook fs-14"></i></a>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <div class="set-star text-default me-2">
                                                        <i class="fa fa-star filled me-1"></i>3.0
                                                    </div>
                                                    <a href="javascript:void(0);" class="avatar avatar-md" data-bs-toggle="tooltip" data-bs-original-title="Mervin" data-bs-placement="top">
                                                        <img src="{{URL::asset('/build/img/profiles/avatar-14.jpg')}}" alt="img">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-xl-4 col-md-6">
                                    <div class="card border">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between mb-3">
                                                <div class="d-flex align-items-center">
                                                    <a href="{{url('contact-details')}}" class="avatar avatar-md flex-shrink-0 me-2">
                                                        <img src="{{URL::asset('/build/img/profiles/avatar-06.jpg')}}" alt="img">
                                                    </a>
                                                    <div>
                                                        <h6><a href="{{url('contact-details')}}" class="fw-medium">Eric Adams</a></h6>
                                                        <p class="text-default">HR Manager</p>
                                                    </div>
                                                </div>
                                                <div class="dropdown table-action">
                                                    <a href="#" class="action-icon " data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_edit"><i class="ti ti-edit text-blue"></i> Edit</a>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_contact"><i class="ti ti-trash text-danger"></i> Delete</a>
                                                        <a class="dropdown-item" href="{{url('contact-details')}}"><i class="ti ti-eye text-blue-light"></i> Preview</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-block">
                                                <div class="d-flex flex-column mb-3">
                                                    <p class="text-default d-inline-flex align-items-center mb-2"><i class="ti ti-mail text-dark me-1"></i>ericadams@example.com</p>
                                                    <p class="text-default d-inline-flex align-items-center mb-2"><i class="ti ti-phone text-dark me-1"></i>+1 19023-78104</p>
                                                    <p class="text-default d-inline-flex align-items-center"><i class="ti ti-map-pin-pin text-dark me-1"></i>France</p>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <span class="badge badge-tag badge-success-light me-2">Collab</span>
                                                    <span class="badge badge-tag badge-warning-light">Rated</span>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                                                <div class="d-flex align-items-center grid-social-links">
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle me-1"><i class="ti ti-mail fs-14"></i></a>
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle me-1"><i class="ti ti-phone-check fs-14"></i></a>
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle me-1"><i class="ti ti-message-circle-share fs-14"></i></a>
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle me-1"><i class="ti ti-brand-skype fs-14"></i></a>
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle"><i class="ti ti-brand-facebook fs-14"></i></a>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <div class="set-star text-default me-2">
                                                        <i class="fa fa-star filled me-1"></i>4.2
                                                    </div>
                                                    <a href="javascript:void(0);" class="avatar avatar-md" data-bs-toggle="tooltip" data-bs-original-title="Mervin" data-bs-placement="top">
                                                        <img src="{{URL::asset('/build/img/profiles/avatar-14.jpg')}}" alt="img">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>	
                                <div class="col-xxl-3 col-xl-4 col-md-6">
                                    <div class="card border">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between mb-3">
                                                <div class="d-flex align-items-center">
                                                    <a href="{{url('contact-details')}}" class="avatar avatar-md flex-shrink-0 me-2">
                                                        <img src="{{URL::asset('/build/img/profiles/avatar-05.jpg')}}" alt="img">
                                                    </a>
                                                    <div>
                                                        <h6><a href="{{url('contact-details')}}" class="fw-medium">Richard Cooper</a></h6>
                                                        <p class="text-default">Devops Engineer</p>
                                                    </div>
                                                </div>
                                                <div class="dropdown table-action">
                                                    <a href="#" class="action-icon " data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_edit"><i class="ti ti-edit text-blue"></i> Edit</a>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_contact"><i class="ti ti-trash text-danger"></i> Delete</a>
                                                        <a class="dropdown-item" href="{{url('contact-details')}}"><i class="ti ti-eye text-blue-light"></i> Preview</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-block">
                                                <div class="d-flex flex-column mb-3">
                                                    <p class="text-default d-inline-flex align-items-center mb-2"><i class="ti ti-mail text-dark me-1"></i>richard@example.com</p>
                                                    <p class="text-default d-inline-flex align-items-center mb-2"><i class="ti ti-phone text-dark me-1"></i>+1 18902-63904</p>
                                                    <p class="text-default d-inline-flex align-items-center"><i class="ti ti-map-pin-pin text-dark me-1"></i>Belgium</p>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <span class="badge badge-tag badge-success-light me-2">Collab</span>
                                                    <span class="badge badge-tag badge-warning-light">Rated</span>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                                                <div class="d-flex align-items-center grid-social-links">
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle me-1"><i class="ti ti-mail fs-14"></i></a>
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle me-1"><i class="ti ti-phone-check fs-14"></i></a>
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle me-1"><i class="ti ti-message-circle-share fs-14"></i></a>
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle me-1"><i class="ti ti-brand-skype fs-14"></i></a>
                                                    <a href="#" class="avatar avatar-xs text-dark rounded-circle"><i class="ti ti-brand-facebook fs-14"></i></a>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <div class="set-star text-default me-2">
                                                        <i class="fa fa-star filled me-1"></i>4.2
                                                    </div>
                                                    <a href="javascript:void(0);" class="avatar avatar-md" data-bs-toggle="tooltip" data-bs-original-title="Mervin" data-bs-placement="top">
                                                        <img src="{{URL::asset('/build/img/profiles/avatar-14.jpg')}}" alt="img">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>																		
                            </div>
                            <!-- /Contact Grid --> 							

                            <div class="load-btn text-center">
                                <a href="javascript:void(0);" class="btn btn-primary">Load More Contacts<i class="ti ti-loader"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- /Card -->

                </div>
            </div>

        </div>
    </div>
    <!-- /Page Wrapper -->
    @component('components.model-popup')
    @endcomponent
@endsection
