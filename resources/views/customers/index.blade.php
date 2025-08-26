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
                                    <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#add_customer"><i class="ti ti-square-rounded-plus me-2"></i>Add Customer</a>
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
                            <table class="table" id="customers_table">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="no-sort">
                                            <label class="checkboxs"><input type="checkbox" id="select-all"><span class="checkmarks"></span></label>
                                        </th>
                                        <th>Customer Code</th>
                                        <th>Customer Name</th>
                                        <th>Contact Person</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="customers_tbody">
                                    <!-- Data will be loaded here -->
                                </tbody>
                            </table>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="datatable-length"></div>
                            </div>
                            <div class="col-md-6">
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

<!-- Add Customer Offcanvas -->
<div class="offcanvas offcanvas-end offcanvas-large" tabindex="-1" id="add_customer">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Add New Customer</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
                <form id="add_customer_form">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Customer Code <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="customer_code" placeholder="e.g. CUST000001" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Customer Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="customer_name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Contact Person</label>
                                <input type="text" class="form-control" name="contact_person">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" class="form-control" name="phone">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Bank Name</label>
                                <input type="text" class="form-control" name="bank_name" placeholder="e.g. Bank Central Asia (BCA)">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Bank Account Number</label>
                                <input type="text" class="form-control" name="bank_account_number" placeholder="e.g. 1234567890">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Bank Account Name</label>
                                <input type="text" class="form-control" name="bank_account_name" placeholder="e.g. PT Maju Teknologi">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="select form-control" name="status">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Address <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="address" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Notes</label>
                                <textarea class="form-control" name="notes" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button type="submit" class="btn btn-primary submit-btn">Add Customer</button>
                    </div>
                </form>
    </div>
</div>
<!-- /Add Customer Offcanvas -->

<!-- Edit Customer Offcanvas -->
<div class="offcanvas offcanvas-end offcanvas-large" tabindex="-1" id="edit_customer">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Edit Customer</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
                <form id="edit_customer_form">
                    <input type="hidden" name="customer_id" id="edit_customer_id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Customer Code</label>
                                <input type="text" class="form-control" id="edit_customer_code" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Customer Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="customer_name" id="edit_customer_name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Contact Person</label>
                                <input type="text" class="form-control" name="contact_person" id="edit_contact_person">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" class="form-control" name="phone" id="edit_phone">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" id="edit_email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Bank Name</label>
                                <input type="text" class="form-control" name="bank_name" id="edit_bank_name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Bank Account Number</label>
                                <input type="text" class="form-control" name="bank_account_number" id="edit_bank_account_number">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Bank Account Name</label>
                                <input type="text" class="form-control" name="bank_account_name" id="edit_bank_account_name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="select form-control" name="status" id="edit_status">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Address <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="address" id="edit_address" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Notes</label>
                                <textarea class="form-control" name="notes" id="edit_notes" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button type="submit" class="btn btn-primary submit-btn">Update Customer</button>
                    </div>
                </form>
    </div>
</div>
<!-- /Edit Customer Offcanvas -->

<!-- Delete Customer Modal -->
<div class="modal fade" id="delete_customer" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center">
                    <div class="avatar avatar-xl bg-danger-light rounded-circle mb-3">
                        <i class="ti ti-trash-x fs-36 text-danger"></i>
                    </div>
                    <h4 class="mb-2">Delete Customer?</h4>
                    <p class="mb-0">Are you sure you want to delete <br> the customer you selected?</p>
                    <div class="d-flex align-items-center justify-content-center mt-4">
                        <a href="javascript:void(0);" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</a>
                        <a href="javascript:void(0);" class="btn btn-danger" id="confirm_delete">Yes, Delete it</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Delete Customer Modal -->

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    let currentPage = 1;
    let selectedCustomerId = null;
    let currentStatus = 'all';

    // Load customers on page load
    loadCustomers();
    
    // Auto-generate customer code when add modal opens
    $('#add_customer').on('show.bs.offcanvas', function() {
        // Generate suggested customer code
        const timestamp = Date.now().toString().slice(-6);
        const suggestedCode = 'CUST' + timestamp;
        $('input[name="customer_code"]').val(suggestedCode);
    });

    // Search functionality
    $('#search_customer').on('keyup', function() {
        currentPage = 1;
        loadCustomers();
    });

    // Status filter
    $('.dropdown-item[data-status]').click(function() {
        currentStatus = $(this).data('status');
        currentPage = 1;
        loadCustomers();
    });

    // Load customers function
    function loadCustomers() {
        const search = $('#search_customer').val();
        
        // Show loading indicator
        $('#customers_tbody').html('<tr><td colspan="10" class="text-center">Loading...</td></tr>');
        
        $.ajax({
            url: '/api/customers',
            method: 'GET',
            data: {
                search: search,
                status: currentStatus === 'all' ? '' : currentStatus,
                page: currentPage
            },
            success: function(response) {
                if(response.success) {
                    renderCustomers(response.data);
                    renderPagination(response.pagination);
                } else {
                    showAlert('error', 'Error loading customers');
                }
            },
            error: function(xhr, status, error) {
                showAlert('error', 'Error loading customers: ' + xhr.statusText);
            }
        });
    }

    // Render customers table
    function renderCustomers(customers) {
        let html = '';
        
        if (customers.length === 0) {
            html = '<tr><td colspan="10" class="text-center">No customers found</td></tr>';
        } else {
            customers.forEach(function(customer, index) {
                const statusClass = customer.status === 'active' ? 'badge-pill badge-status bg-success' : 'badge-pill badge-status bg-danger';
                const statusText = customer.status === 'active' ? 'Active' : 'Inactive';
                
                html += `
                    <tr>
                        <td>
                            <label class="checkboxs">
                                <input type="checkbox" class="customer-checkbox" value="${customer.id}">
                                <span class="checkmarks"></span>
                            </label>
                        </td>
                        <td><strong>${customer.customer_code}</strong></td>
                        <td>
                            <a href="javascript:void(0);" class="d-flex flex-column fw-medium">${customer.customer_name}</a>
                        </td>
                        <td>${customer.contact_person || '-'}</td>
                        <td>${customer.phone || '-'}</td>
                        <td>${customer.email || '-'}</td>
                        <td><span class="badge ${statusClass}">${statusText}</span></td>
                        <td>${formatDate(customer.created_at)}</td>
                        <td>
                            <div class="dropdown table-action">
                                <a href="#" class="action-icon" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="/customers/${customer.id}">
                                        <i class="ti ti-eye text-info"></i> View Detail
                                    </a>
                                    <a class="dropdown-item" href="#" onclick="editCustomer(${customer.id})">
                                        <i class="ti ti-edit text-blue"></i> Edit
                                    </a>
                                    <a class="dropdown-item" href="#" onclick="deleteCustomer(${customer.id})">
                                        <i class="ti ti-trash text-danger"></i> Delete
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                `;
            });
        }
        
        $('#customers_tbody').html(html);
    }

    // Render pagination
    function renderPagination(pagination) {
        let infoHtml = `Showing ${((pagination.current_page - 1) * pagination.per_page) + 1} to ${Math.min(pagination.current_page * pagination.per_page, pagination.total)} of ${pagination.total} entries`;
        $('.datatable-length').html(infoHtml);

        let linksHtml = '';
        if(pagination.last_page > 1) {
            linksHtml += '<ul class="pagination">';
            
            // Previous button
            if(pagination.current_page > 1) {
                linksHtml += `<li class="page-item"><a class="page-link" href="#" onclick="goToPage(${pagination.current_page - 1})">Previous</a></li>`;
            }

            // Page numbers
            for(let i = 1; i <= pagination.last_page; i++) {
                if(i === pagination.current_page) {
                    linksHtml += `<li class="page-item active"><a class="page-link" href="#">${i}</a></li>`;
                } else {
                    linksHtml += `<li class="page-item"><a class="page-link" href="#" onclick="goToPage(${i})">${i}</a></li>`;
                }
            }

            // Next button
            if(pagination.current_page < pagination.last_page) {
                linksHtml += `<li class="page-item"><a class="page-link" href="#" onclick="goToPage(${pagination.current_page + 1})">Next</a></li>`;
            }
            
            linksHtml += '</ul>';
        }
        $('.datatable-paginate').html(linksHtml);
    }

    // Go to page function
    window.goToPage = function(page) {
        currentPage = page;
        loadCustomers();
    }

    // Add customer form submit
    $('#add_customer_form').submit(function(e) {
        e.preventDefault();
        
        // Basic validation
        const customerCode = $('input[name="customer_code"]').val().trim();
        const customerName = $('input[name="customer_name"]').val().trim();
        const address = $('textarea[name="address"]').val().trim();
        
        if (!customerCode) {
            showAlert('error', 'Customer Code is required');
            return;
        }
        
        if (!customerName) {
            showAlert('error', 'Customer Name is required');
            return;
        }
        
        if (!address) {
            showAlert('error', 'Address is required');
            return;
        }
        
        $.ajax({
            url: '/api/customers',
            method: 'POST',
            data: $(this).serialize(),
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            success: function(response) {
                if(response.success) {
                    $('#add_customer').modal('hide');
                    $('#add_customer_form')[0].reset();
                    showAlert('success', 'Customer added successfully');
                    loadCustomers();
                } else {
                    showAlert('error', response.message);
                }
            },
            error: function(xhr) {
                console.error('Error response:', xhr.responseText);
                if(xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    let errorMessage = '';
                    for(let field in errors) {
                        errorMessage += errors[field][0] + '\n';
                    }
                    showAlert('error', errorMessage);
                } else {
                    showAlert('error', 'Error adding customer: ' + xhr.statusText);
                }
            }
        });
    });

    // Edit customer function
    window.editCustomer = function(id) {
        $.ajax({
            url: `/api/customers/${id}`,
            method: 'GET',
            success: function(response) {
                if(response.success) {
                    const customer = response.data;
                    $('#edit_customer_id').val(customer.id);
                    $('#edit_customer_code').val(customer.customer_code);
                    $('#edit_customer_name').val(customer.customer_name);
                    $('#edit_contact_person').val(customer.contact_person);
                    $('#edit_phone').val(customer.phone);
                    $('#edit_email').val(customer.email);
                    $('#edit_bank_name').val(customer.bank_name);
                    $('#edit_bank_account_number').val(customer.bank_account_number);
                    $('#edit_bank_account_name').val(customer.bank_account_name);
                    $('#edit_status').val(customer.status);
                    $('#edit_address').val(customer.address);
                    $('#edit_notes').val(customer.notes);
                    const editOffcanvas = new bootstrap.Offcanvas(document.getElementById('edit_customer'));
                    editOffcanvas.show();
                }
            },
            error: function() {
                showAlert('error', 'Error loading customer data');
            }
        });
    }

    // Edit customer form submit
    $('#edit_customer_form').submit(function(e) {
        e.preventDefault();
        const customerId = $('#edit_customer_id').val();
        
        $.ajax({
            url: `/api/customers/${customerId}`,
            method: 'PUT',
            data: $(this).serialize(),
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            success: function(response) {
                if(response.success) {
                    const editOffcanvas = bootstrap.Offcanvas.getInstance(document.getElementById('edit_customer'));
                    editOffcanvas.hide();
                    showAlert('success', 'Customer updated successfully');
                    loadCustomers();
                } else {
                    showAlert('error', response.message);
                }
            },
            error: function(xhr) {
                console.error('Error response:', xhr.responseText);
                if(xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    let errorMessage = '';
                    for(let field in errors) {
                        errorMessage += errors[field][0] + '\n';
                    }
                    showAlert('error', errorMessage);
                } else {
                    showAlert('error', 'Error updating customer: ' + xhr.statusText);
                }
            }
        });
    });

    // Delete customer function
    window.deleteCustomer = function(id) {
        selectedCustomerId = id;
        $('#delete_customer').modal('show');
    }

    // Confirm delete
    $('#confirm_delete').click(function() {
        if(selectedCustomerId) {
            $.ajax({
                url: `/api/customers/${selectedCustomerId}`,
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json'
                },
                success: function(response) {
                    if(response.success) {
                        $('#delete_customer').modal('hide');
                        showAlert('success', 'Customer deleted successfully');
                        loadCustomers();
                    } else {
                        showAlert('error', response.message);
                    }
                },
                error: function(xhr) {
                    console.error('Error response:', xhr.responseText);
                    showAlert('error', 'Error deleting customer: ' + xhr.statusText);
                }
            });
        }
    });

    // Select all checkbox
    $('#select-all').change(function() {
        $('.customer-checkbox').prop('checked', $(this).is(':checked'));
    });

    // Format date function
    function formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('id-ID', {
            year: 'numeric',
            month: 'short',
            day: 'numeric'
        });
    }

    // Show alert function
    function showAlert(type, message) {
        if(type === 'success') {
            // Use browser alert as fallback
            alert('Success: ' + message);
        } else {
            // Use browser alert as fallback
            alert('Error: ' + message);
        }
    }
});
</script>
@endpush