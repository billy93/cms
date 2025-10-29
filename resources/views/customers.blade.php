<?php $page = 'customers'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content">

            <div class="row">
                <div class="col-md-12">

                    @component('components.breadcrumb')
                    @slot('title')
                    Customers
                    @endslot
                    @slot('item1')
                    123
                    @endslot
                    @slot('item2')
                    customers
                    @endslot
                    @endcomponent

                    <div class="card ">
                        <div class="card-header">
                            <!-- Search -->
                            <div class="row align-items-center">
                                <div class="col-sm-4">
                                    <div class="icon-form mb-3 mb-sm-0">
                                        <span class="form-icon"><i class="ti ti-search"></i></span>
                                        <input type="text" class="form-control" id="search_customer" placeholder="Search Customers">
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
                                        <a href="javascript:void(0);" id="c_customer_add" class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_add"><i class="ti ti-square-rounded-plus me-2"></i>Add New Customers</a>
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
                                <div class="d-flex align-items-center flex-wrap row-gap-2">
                                    <div class="dropdown me-2">
                                        <a href="javascript:void(0);" class="btn bg-soft-purple text-purple"  data-bs-toggle="dropdown"  data-bs-auto-close="outside"><i class="ti ti-columns-3 me-2"></i>Manage Columns</a>
                                        <div class="dropdown-menu  dropdown-menu-md-end dropdown-md p-3">
                                            <h4 class="mb-2 fw-semibold">Want to manage datatables?</h4>
                                            <p class="mb-3">Please drag and drop your column to reorder your table and enable see option as you want.</p>
                                            <div class="border-top pt-3">
                                                <div class="d-flex align-items-center justify-content-between mb-3">
                                                    <p class="mb-0 d-flex align-items-center"><i class="ti ti-grip-vertical me-2"></i>Customer Code</p>
                                                    <div class="status-toggle">
                                                        <input type="checkbox" id="toggle_customer_code" class="check" checked>
                                                        <label for="toggle_customer_code" class="checktoggle">checkbox</label>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between mb-3">
                                                    <p class="mb-0 d-flex align-items-center"><i class="ti ti-grip-vertical me-2"></i>Customer Name</p>
                                                    <div class="status-toggle">
                                                        <input type="checkbox" id="toggle_customer_name" class="check" checked>
                                                        <label for="toggle_customer_name" class="checktoggle">checkbox</label>
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
                                        <a href="{{url('customers')}}" class="active"><i class="ti ti-list-tree"></i></a>
                                        <a href="javascript:void(0);"><i class="ti ti-grid-dots"></i></a>
                                    </div>
                                </div>  
                            </div>
                            <!-- /Filter -->

                            <!-- Customer List -->
                            <div class="table-responsive custom-table">
                                <table class="table" id="customer_list" data-url="{{ route('customers.index') }}"> 
                                    <thead class="thead-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Customer Code</th>
                                            <th>Customer Name</th>
                                            <th>Contact Person</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="customers_tbody">
                                        <!-- Data will be loaded here -->
                                    </tbody>
                                </table>
                            </div>
                            <div class="row align-items-center" style="row-gap: 1em;">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                                        <div class="datatable-info"></div>
                                        <div class="datatable-length"></div>
                                    </div>
                                </div>
                                <div class="col-md-6 flex-grow-1">
                                    <div class="datatable-paginate"></div>
                                </div>
                            </div>
                            <!-- /Customer List -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->


    <!-- Add New Customer -->
    <div class="offcanvas offcanvas-end offcanvas-large" tabindex="-1" id="offcanvas_add">
        <div class="offcanvas-header border-bottom">
            <h4 id="customer_form_title">Create Customer</h4>
            <button type="button" id="close_customer_form" class="btn-close custom-btn-close border p-1 me-0 d-flex align-items-center justify-content-center rounded-circle" data-bs-dismiss="offcanvas" aria-label="Close">
                <i class="ti ti-x"></i>
            </button>
        </div>
        <div class="offcanvas-body">
            <style>
				#c_customer_form td { vertical-align: baseline; } 
			</style>
			<form id="c_customer_form" method="POST"></form>
        </div>
    </div>
    <!-- /Add New Customer -->
    
	<!-- Delete Modal -->
	<div class="modal fade" id="delete_customer_modal" tabindex="-1" aria-labelledby="deleteCustomerModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="deleteCustomerModalLabel">Confirm Delete</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					Are you sure you want to delete this item?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-danger" id="confirm_delete_customer">Delete</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Delete Modal -->

@endsection

@push('scripts')
  <script src="/build/js/customer_script.js"></script>
@endpush
