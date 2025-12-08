<?php $page = 'banks'; ?>
@extends('layout.mainlayout')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content">

        <div class="row">
            <div class="col-md-12">

                @component('components.breadcrumb')
                @slot('title')
                Banks
                @endslot
                @slot('item1')
                123
                @endslot
                @slot('item2')
                banks
                @endslot
                @endcomponent

                <div class="card ">
                    <div class="card-header">
                        <!-- Search -->
                        <div class="row align-items-center">
                            <div class="col-sm-4">
                                <form class="icon-form mb-3 mb-sm-0" id="c_bank_list_search_form">
                                    <span class="form-icon"><i class="ti ti-search"></i></span>
                                    <input type="text" class="form-control" placeholder="Search Bank" id="c_bank_list_search_input">
                                </form>	
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
                                    <a href="javascript:void(0);" id="c_bank_create_btn" class="btn btn-primary"><i class="ti ti-square-rounded-plus me-2"></i>Add Bank</a>
                                </div>
                            </div>
                        </div>
                        <!-- /Search -->
                    </div>
                    <div class="card-body">
                        <!-- Filter -->
                        <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-2 mb-4">
                            <div class="d-flex align-items-center flex-wrap row-gap-2">
                                <div class="dropdown me-2">
                                    <a href="javascript:void(0);" class="dropdown-toggle"  data-bs-toggle="dropdown"><i class="ti ti-sort-ascending-2 me-2"></i>Sort </a>
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
                                <div class="dropdown me-2">
                                    <a href="javascript:void(0);" class="dropdown-toggle"  data-bs-toggle="dropdown"><i class="ti ti-filter me-2"></i>Status </a>
                                    <div class="dropdown-menu  dropdown-menu-start">
                                        <ul>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-status="all">
                                                    <i class="ti ti-circle-chevron-right me-1"></i>All Status
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-status="active">
                                                    <i class="ti ti-circle-chevron-right me-1"></i>Active
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-status="inactive">
                                                    <i class="ti ti-circle-chevron-right me-1"></i>Inactive
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
                            <!-- <div class="d-flex align-items-center flex-wrap row-gap-2">
                                <div class="dropdown me-2">
                                    <a href="javascript:void(0);" class="btn bg-soft-purple text-purple"  data-bs-toggle="dropdown"  data-bs-auto-close="outside"><i class="ti ti-columns-3 me-2"></i>Manage Columns</a>
                                    <div class="dropdown-menu  dropdown-menu-md-end dropdown-md p-3">
                                        <h4 class="mb-2 fw-semibold">Want to manage datatables?</h4>
                                        <p class="mb-3">Please drag and drop your column to reorder your table and enable see option as you want.</p>
                                        <div class="border-top pt-3">
                                            <div class="d-flex align-items-center justify-content-between mb-3">
                                                <p class="mb-0 d-flex align-items-center"><i class="ti ti-grip-vertical me-2"></i>Supplier Code</p>
                                                <div class="status-toggle">
                                                    <input type="checkbox" id="toggle_supplier_code" class="check" checked>
                                                    <label for="toggle_supplier_code" class="checktoggle">checkbox</label>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mb-3">
                                                <p class="mb-0 d-flex align-items-center"><i class="ti ti-grip-vertical me-2"></i>Supplier Name</p>
                                                <div class="status-toggle">
                                                    <input type="checkbox" id="toggle_supplier_name" class="check" checked>
                                                    <label for="toggle_supplier_name" class="checktoggle">checkbox</label>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mb-3">
                                                <p class="mb-0 d-flex align-items-center"><i class="ti ti-grip-vertical me-2"></i>Contact Person</p>
                                                <div class="status-toggle">
                                                    <input type="checkbox" id="toggle_contact_person" class="check" checked>
                                                    <label for="toggle_contact_person" class="checktoggle">checkbox</label>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mb-3">
                                                <p class="mb-0 d-flex align-items-center"><i class="ti ti-grip-vertical me-2"></i>Phone</p>
                                                <div class="status-toggle">
                                                    <input type="checkbox" id="toggle_phone" class="check" checked>
                                                    <label for="toggle_phone" class="checktoggle">checkbox</label>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mb-3">
                                                <p class="mb-0 d-flex align-items-center"><i class="ti ti-grip-vertical me-2"></i>Email</p>
                                                <div class="status-toggle">
                                                    <input type="checkbox" id="toggle_email" class="check" checked>
                                                    <label for="toggle_email" class="checktoggle">checkbox</label>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mb-3">
                                                <p class="mb-0 d-flex align-items-center"><i class="ti ti-grip-vertical me-2"></i>Tax Number</p>
                                                <div class="status-toggle">
                                                    <input type="checkbox" id="toggle_tax_number" class="check" checked>
                                                    <label for="toggle_tax_number" class="checktoggle">checkbox</label>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mb-3">
                                                <p class="mb-0 d-flex align-items-center"><i class="ti ti-grip-vertical me-2"></i>Status</p>
                                                <div class="status-toggle">
                                                    <input type="checkbox" id="toggle_status" class="check" checked>
                                                    <label for="toggle_status" class="checktoggle">checkbox</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="view-icons">
                                    <a href="{{url('suppliers')}}" class="active"><i class="ti ti-list-tree"></i></a>
                                    <a href="javascript:void(0);"><i class="ti ti-grid-dots"></i></a>
                                </div>
                            </div>   -->
                        </div>
                        <!-- /Filter -->

                        <!-- Bank List -->
                        <div class="table-responsive custom-table">
                            <table class="table" id="bank_list" data-url="{{ route('banks.index') }}"> 
                                <style>
                                    #bank_list td {
                                        vertical-align: baseline;
                                    }
                                </style>
                                <thead class="thead-light">
                                    <tr>
                                        <th class="td-break no-sort">
                                            <label class="checkboxs">
                                                <input type="checkbox" id="select_all_bank_list">
                                                <span class="checkmarks"></span>
                                            </label>
                                        </th>
                                        <th>Bank Code</th>
                                        <th>Bank Brand</th>
                                        <th>Bank Name</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        <div class="row align-items-center mt-2">
                            <div class="col-md-6">
                                <div class="datatable-length"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="datatable-paginate"></div>
                            </div>
                        </div>
                        <!-- /Bank List -->

                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
<!-- /Page Wrapper -->
 	
	@include('components.banks.create-modal')
	@include('components.banks.modal')
@endsection

@push('scripts')
	<script>
		const HIDE_BANK_DATATABLE_CHECKBOX = true;
	</script>
    <script src="/build/js/banks/shared_var.js"></script>
    <script src="/build/js/banks/datatables.js"></script>
    <script src="/build/js/banks/events.js"></script>
@endpush
