<?php $page = 'suppliers'; ?>
@extends('layout.mainlayout')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content">

        <div class="row">
            <div class="col-md-12">

                @component('components.breadcrumb')
                @slot('title')
                Suppliers
                @endslot
                @slot('item1')
                123
                @endslot
                @slot('item2')
                suppliers
                @endslot
                @endcomponent

                <div class="card ">
                    <div class="card-header">
                        <!-- Search -->
                        <div class="row align-items-center">
                            <div class="col-sm-4">
                                <div class="icon-form mb-3 mb-sm-0">
                                    <span class="form-icon"><i class="ti ti-search"></i></span>
                                    <input type="text" class="form-control" id="search_supplier" placeholder="Search Suppliers">
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
                                    <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#add_supplier"><i class="ti ti-square-rounded-plus me-2"></i>Add Supplier</a>
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

                        <!-- Supplier List -->
                        <div class="table-responsive custom-table">
                            <table class="table" id="suppliers_table">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="no-sort">
                                            <label class="checkboxs"><input type="checkbox" id="select-all"><span class="checkmarks"></span></label>
                                        </th>
                                        <th>Supplier Code</th>
                                        <th>Supplier Name</th>
                                        <th>Contact Person</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Tax Number</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="suppliers_tbody">
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
                        <!-- /Supplier List -->

                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
<!-- /Page Wrapper -->

<!-- Add Supplier Offcanvas -->
<div class="offcanvas offcanvas-end offcanvas-large" tabindex="-1" id="add_supplier">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Add New Supplier</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
                <form id="add_supplier_form">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Supplier Code <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="supplier_code" placeholder="e.g. SUPP000001" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Supplier Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="supplier_name" required>
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
                                <label>Tax Number (NPWP)</label>
                                <input type="text" class="form-control" name="tax_number" placeholder="e.g. 01.234.567.8-123.000">
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
                                <label>Bank Name</label>
                                <input type="text" class="form-control" name="bank_name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Bank Account Number</label>
                                <input type="text" class="form-control" name="bank_account_number">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Bank Account Name</label>
                                <input type="text" class="form-control" name="bank_account_name">
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
                        <button type="submit" class="btn btn-primary submit-btn">Add Supplier</button>
                    </div>
                </form>
    </div>
</div>
<!-- /Add Supplier Offcanvas -->

<!-- Edit Supplier Offcanvas -->
<div class="offcanvas offcanvas-end offcanvas-large" tabindex="-1" id="edit_supplier">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Edit Supplier</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
                <form id="edit_supplier_form">
                    <input type="hidden" name="supplier_id" id="edit_supplier_id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Supplier Code</label>
                                <input type="text" class="form-control" id="edit_supplier_code" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Supplier Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="supplier_name" id="edit_supplier_name" required>
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
                                <label>Tax Number (NPWP)</label>
                                <input type="text" class="form-control" name="tax_number" id="edit_tax_number">
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
                        <button type="submit" class="btn btn-primary submit-btn">Update Supplier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Edit Supplier Modal -->

<!-- Delete Supplier Modal -->
<div class="modal fade" id="delete_supplier" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center">
                    <div class="avatar avatar-xl bg-danger-light rounded-circle mb-3">
                        <i class="ti ti-trash-x fs-36 text-danger"></i>
                    </div>
                    <h4 class="mb-2">Delete Supplier?</h4>
                    <p class="mb-0">Are you sure you want to delete <br> the supplier you selected?</p>
                    <div class="d-flex align-items-center justify-content-center mt-4">
                        <a href="javascript:void(0);" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</a>
                        <a href="javascript:void(0);" class="btn btn-danger" id="confirm_delete">Yes, Delete it</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Delete Supplier Modal -->

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    let currentPage = 1;
    let selectedSupplierId = null;
    let currentStatus = 'all';

    // Load suppliers on page load
    loadSuppliers();
    
    // Auto-generate supplier code when add offcanvas opens
    $('#add_supplier').on('show.bs.offcanvas', function() {
        // Generate suggested supplier code
        const timestamp = Date.now().toString().slice(-6);
        const suggestedCode = 'SUPP' + timestamp;
        $('input[name="supplier_code"]').val(suggestedCode);
    });

    // Search functionality
    $('#search_supplier').on('keyup', function() {
        currentPage = 1;
        loadSuppliers();
    });

    // Status filter
    $('.dropdown-item[data-status]').click(function() {
        currentStatus = $(this).data('status');
        currentPage = 1;
        loadSuppliers();
    });

    // Load suppliers function
    function loadSuppliers() {
        const search = $('#search_supplier').val();
        
        // Show loading indicator
        $('#suppliers_tbody').html('<tr><td colspan="10" class="text-center">Loading...</td></tr>');
        
        $.ajax({
            url: '/api/suppliers',
            method: 'GET',
            data: {
                search: search,
                status: currentStatus === 'all' ? '' : currentStatus,
                page: currentPage
            },
            success: function(response) {
                if(response.success) {
                    renderSuppliers(response.data);
                    renderPagination(response.pagination);
                } else {
                    showAlert('error', 'Error loading suppliers');
                }
            },
            error: function(xhr, status, error) {
                showAlert('error', 'Error loading suppliers: ' + xhr.statusText);
            }
        });
    }

    // Render suppliers table
    function renderSuppliers(suppliers) {
        let html = '';
        
        if (suppliers.length === 0) {
            html = '<tr><td colspan="10" class="text-center">No suppliers found</td></tr>';
        } else {
            suppliers.forEach(function(supplier, index) {
                const statusClass = supplier.status === 'active' ? 'badge-pill badge-status bg-success' : 'badge-pill badge-status bg-danger';
                const statusText = supplier.status === 'active' ? 'Active' : 'Inactive';
                
                html += `
                    <tr>
                        <td>
                            <label class="checkboxs">
                                <input type="checkbox" class="supplier-checkbox" value="${supplier.id}">
                                <span class="checkmarks"></span>
                            </label>
                        </td>
                        <td><strong>${supplier.supplier_code}</strong></td>
                        <td>
                            <a href="javascript:void(0);" class="d-flex flex-column fw-medium">${supplier.supplier_name}</a>
                        </td>
                        <td>${supplier.contact_person || '-'}</td>
                        <td>${supplier.phone || '-'}</td>
                        <td>${supplier.email || '-'}</td>
                        <td>${supplier.tax_number || '-'}</td>
                        <td><span class="badge ${statusClass}">${statusText}</span></td>
                        <td>${formatDate(supplier.created_at)}</td>
                        <td>
                            <div class="dropdown table-action">
                                <a href="#" class="action-icon" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="/suppliers/${supplier.id}">
                                        <i class="ti ti-eye text-info"></i> View Detail
                                    </a>
                                    <a class="dropdown-item" href="#" onclick="editSupplier(${supplier.id})">
                                        <i class="ti ti-edit text-blue"></i> Edit
                                    </a>
                                    <a class="dropdown-item" href="#" onclick="deleteSupplier(${supplier.id})">
                                        <i class="ti ti-trash text-danger"></i> Delete
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                `;
            });
        }
        
        $('#suppliers_tbody').html(html);
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
        loadSuppliers();
    }

    // Add supplier form submit
    $('#add_supplier_form').submit(function(e) {
        e.preventDefault();
        
        // Basic validation
        const supplierCode = $('input[name="supplier_code"]').val().trim();
        const supplierName = $('input[name="supplier_name"]').val().trim();
        const address = $('textarea[name="address"]').val().trim();
        
        if (!supplierCode) {
            showAlert('error', 'Supplier Code is required');
            return;
        }
        
        if (!supplierName) {
            showAlert('error', 'Supplier Name is required');
            return;
        }
        
        if (!address) {
            showAlert('error', 'Address is required');
            return;
        }
        
        $.ajax({
            url: '/api/suppliers',
            method: 'POST',
            data: $(this).serialize(),
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            success: function(response) {
                if(response.success) {
                    const addOffcanvas = bootstrap.Offcanvas.getInstance(document.getElementById('add_supplier'));
                    addOffcanvas.hide();
                    $('#add_supplier_form')[0].reset();
                    showAlert('success', 'Supplier added successfully');
                    loadSuppliers();
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
                    showAlert('error', 'Error adding supplier: ' + xhr.statusText);
                }
            }
        });
    });

    // Edit supplier function
    window.editSupplier = function(id) {
        $.ajax({
            url: `/api/suppliers/${id}`,
            method: 'GET',
            success: function(response) {
                if(response.success) {
                    const supplier = response.data;
                    $('#edit_supplier_id').val(supplier.id);
                    $('#edit_supplier_code').val(supplier.supplier_code);
                    $('#edit_supplier_name').val(supplier.supplier_name);
                    $('#edit_contact_person').val(supplier.contact_person);
                    $('#edit_phone').val(supplier.phone);
                    $('#edit_email').val(supplier.email);
                    $('#edit_tax_number').val(supplier.tax_number);
                    $('#edit_bank_name').val(supplier.bank_name);
                    $('#edit_bank_account_number').val(supplier.bank_account_number);
                    $('#edit_bank_account_name').val(supplier.bank_account_name);
                    $('#edit_status').val(supplier.status);
                    $('#edit_address').val(supplier.address);
                    $('#edit_notes').val(supplier.notes);
                    const editOffcanvas = new bootstrap.Offcanvas(document.getElementById('edit_supplier'));
                    editOffcanvas.show();
                }
            },
            error: function() {
                showAlert('error', 'Error loading supplier data');
            }
        });
    }

    // Edit supplier form submit
    $('#edit_supplier_form').submit(function(e) {
        e.preventDefault();
        const supplierId = $('#edit_supplier_id').val();
        
        $.ajax({
            url: `/api/suppliers/${supplierId}`,
            method: 'PUT',
            data: $(this).serialize(),
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            success: function(response) {
                if(response.success) {
                    const editOffcanvas = bootstrap.Offcanvas.getInstance(document.getElementById('edit_supplier'));
                    editOffcanvas.hide();
                    showAlert('success', 'Supplier updated successfully');
                    loadSuppliers();
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
                    showAlert('error', 'Error updating supplier: ' + xhr.statusText);
                }
            }
        });
    });

    // Delete supplier function
    window.deleteSupplier = function(id) {
        selectedSupplierId = id;
        $('#delete_supplier').modal('show');
    }

    // Confirm delete
    $('#confirm_delete').click(function() {
        if(selectedSupplierId) {
            $.ajax({
                url: `/api/suppliers/${selectedSupplierId}`,
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json'
                },
                success: function(response) {
                    if(response.success) {
                        $('#delete_supplier').modal('hide');
                        showAlert('success', 'Supplier deleted successfully');
                        loadSuppliers();
                    } else {
                        showAlert('error', response.message);
                    }
                },
                error: function(xhr) {
                    console.error('Error response:', xhr.responseText);
                    showAlert('error', 'Error deleting supplier: ' + xhr.statusText);
                }
            });
        }
    });

    // Select all checkbox
    $('#select-all').change(function() {
        $('.supplier-checkbox').prop('checked', $(this).is(':checked'));
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