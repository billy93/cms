<?php $page = 'projects'; ?>
@extends('layout.mainlayout')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content">

        <div class="row">
            <div class="col-md-12">

                @component('components.breadcrumb')
                @slot('title')
                Projects
                @endslot
                @slot('item1')
                123
                @endslot
                @slot('item2')
                projects
                @endslot
                @endcomponent

                <div class="card ">
                    <div class="card-header">
                        <!-- Search -->
                        <div class="row align-items-center">
                            <div class="col-sm-4">
                                <div class="icon-form mb-3 mb-sm-0">
                                    <span class="form-icon"><i class="ti ti-search"></i></span>
                                    <input type="text" class="form-control" id="search_project" placeholder="Search Projects">
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
                                    <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#add_project"><i class="ti ti-square-rounded-plus me-2"></i>Add Project</a>
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
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-status="completed">
                                                    <i class="ti ti-circle-chevron-right me-1"></i>Completed
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-status="cancelled">
                                                    <i class="ti ti-circle-chevron-right me-1"></i>Cancelled
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
                                                <p class="mb-0 d-flex align-items-center"><i class="ti ti-grip-vertical me-2"></i>Project Code</p>
                                                <div class="status-toggle">
                                                    <input type="checkbox" id="toggle_project_code" class="check" checked>
                                                    <label for="toggle_project_code" class="checktoggle">checkbox</label>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mb-3">
                                                <p class="mb-0 d-flex align-items-center"><i class="ti ti-grip-vertical me-2"></i>Project Name</p>
                                                <div class="status-toggle">
                                                    <input type="checkbox" id="toggle_project_name" class="check" checked>
                                                    <label for="toggle_project_name" class="checktoggle">checkbox</label>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mb-3">
                                                <p class="mb-0 d-flex align-items-center"><i class="ti ti-grip-vertical me-2"></i>Customer</p>
                                                <div class="status-toggle">
                                                    <input type="checkbox" id="toggle_customer" class="check" checked>
                                                    <label for="toggle_customer" class="checktoggle">checkbox</label>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mb-3">
                                                <p class="mb-0 d-flex align-items-center"><i class="ti ti-grip-vertical me-2"></i>Status</p>
                                                <div class="status-toggle">
                                                    <input type="checkbox" id="toggle_status" class="check" checked>
                                                    <label for="toggle_status" class="checktoggle">checkbox</label>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mb-3">
                                                <p class="mb-0 d-flex align-items-center"><i class="ti ti-grip-vertical me-2"></i>Proposal</p>
                                                <div class="status-toggle">
                                                    <input type="checkbox" id="toggle_proposal" class="check" checked>
                                                    <label for="toggle_proposal" class="checktoggle">checkbox</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="view-icons">
                                    <a href="{{url('projects')}}" class="active"><i class="ti ti-list-tree"></i></a>
                                    <a href="javascript:void(0);"><i class="ti ti-grid-dots"></i></a>
                                </div>
                            </div>  
                        </div>
                        <!-- /Filter -->

                        <!-- Project List -->
                        <div class="table-responsive custom-table">
                            <table class="table" id="projects_table">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="no-sort">
                                            <label class="checkboxs"><input type="checkbox" id="select-all"><span class="checkmarks"></span></label>
                                        </th>
                                        <th>Project Code</th>
                                        <th>Project Name</th>
                                        <th>Customer</th>
                                        <th>Status</th>
                                        <th>Proposal</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="projects_tbody">
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
                        <!-- /Project List -->

                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
<!-- /Page Wrapper -->

<!-- Add Project Offcanvas -->
<div class="offcanvas offcanvas-end offcanvas-large" tabindex="-1" id="add_project">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Add New Project</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
                <form id="add_project_form">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Project Code <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="project_code" placeholder="e.g. PROJ000001" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Project Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Customer <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="customer_search" placeholder="Search customer..." autocomplete="off">
                                <input type="hidden" name="customer_id" id="customer_id_hidden" required>
                                <div id="customer_dropdown" class="dropdown-menu w-100" style="display: none; max-height: 200px; overflow-y: auto;"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="select form-control" name="status">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="completed">Completed</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button type="submit" class="btn btn-primary submit-btn">Add Project</button>
                    </div>
                </form>
    </div>
</div>
<!-- /Add Project Offcanvas -->

<!-- Edit Project Offcanvas -->
<div class="offcanvas offcanvas-end offcanvas-large" tabindex="-1" id="edit_project">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Edit Project</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
                <form id="edit_project_form">
                    <input type="hidden" name="project_id" id="edit_project_id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Project Code</label>
                                <input type="text" class="form-control" id="edit_project_code" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Project Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" id="edit_project_name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Customer <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="edit_customer_search" placeholder="Search customer..." autocomplete="off">
                                <input type="hidden" name="customer_id" id="edit_customer_id_hidden" required>
                                <div id="edit_customer_dropdown" class="dropdown-menu w-100" style="display: none; max-height: 200px; overflow-y: auto;"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="select form-control" name="status" id="edit_status">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="completed">Completed</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description" id="edit_description" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button type="submit" class="btn btn-primary submit-btn">Update Project</button>
                    </div>
                </form>
    </div>
</div>
<!-- /Edit Project Offcanvas -->

<!-- Delete Project Modal -->
<div class="modal fade" id="delete_project" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center">
                    <div class="avatar avatar-xl bg-danger-light rounded-circle mb-3">
                        <i class="ti ti-trash-x fs-36 text-danger"></i>
                    </div>
                    <h4 class="mb-2">Delete Project?</h4>
                    <p class="mb-0">Are you sure you want to delete <br> the project you selected?</p>
                    <div class="d-flex align-items-center justify-content-center mt-4">
                        <a href="javascript:void(0);" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</a>
                        <a href="javascript:void(0);" class="btn btn-danger" id="confirm_delete">Yes, Delete it</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Delete Project Modal -->

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    let currentPage = 1;
    let selectedProjectId = null;
    let currentStatus = 'all';

    //// Load customers on page load
    loadProjects();
    
    // Initialize customer autocomplete
    initializeCustomerAutocomplete();
    
    // Auto-generate project code when add modal opens
    $('#add_project').on('show.bs.offcanvas', function() {
        // Generate suggested project code
        const timestamp = Date.now().toString().slice(-6);
        const suggestedCode = 'PROJ' + timestamp;
        $('input[name="project_code"]').val(suggestedCode);
    });

    // Search functionality
    $('#search_project').on('keyup', function() {
        currentPage = 1;
        loadProjects();
    });

    // Status filter
    $('.dropdown-item[data-status]').click(function() {
        currentStatus = $(this).data('status');
        currentPage = 1;
        loadProjects();
    });

    // Load customers for dropdown
    function loadCustomers() {
        $.ajax({
            url: '/api/customers/active',
            method: 'GET',
            success: function(response) {
                if(response.success) {
                    let options = '<option value="">Select Customer</option>';
                    response.data.forEach(function(customer) {
                        options += `<option value="${customer.id}">${customer.customer_name} (${customer.customer_code})</option>`;
                    });
                    $('#customer_select, #edit_customer_select').html(options);
                }
            },
            error: function() {
                console.error('Error loading customers');
            }
        });
    }

    // Initialize customer autocomplete functionality
    function initializeCustomerAutocomplete() {
        let searchTimeout;
        
        // Add customer search functionality
        $('#customer_search, #edit_customer_search').on('input', function() {
            const searchInput = $(this);
            const dropdownId = searchInput.attr('id') === 'customer_search' ? '#customer_dropdown' : '#edit_customer_dropdown';
            const hiddenInputId = searchInput.attr('id') === 'customer_search' ? '#customer_id_hidden' : '#edit_customer_id_hidden';
            const query = searchInput.val().trim();
            
            clearTimeout(searchTimeout);
            
            if (query.length < 2) {
                $(dropdownId).hide();
                return;
            }
            
            searchTimeout = setTimeout(function() {
                $.ajax({
                    url: '/api/projects/search/customers',
                    method: 'GET',
                    data: { q: query },
                    success: function(response) {
                        if (response.success && response.data.length > 0) {
                            let dropdownHtml = '';
                            response.data.forEach(function(customer) {
                                dropdownHtml += `
                                    <a class="dropdown-item customer-option" href="#" 
                                       data-id="${customer.id}" 
                                       data-name="${customer.customer_name}" 
                                       data-code="${customer.customer_code}">
                                        <div>
                                            <strong>${customer.customer_name}</strong>
                                            <br><small class="text-muted">${customer.customer_code}</small>
                                        </div>
                                    </a>
                                `;
                            });
                            $(dropdownId).html(dropdownHtml).show();
                        } else {
                            $(dropdownId).html('<div class="dropdown-item-text">No customers found</div>').show();
                        }
                    },
                    error: function() {
                        $(dropdownId).html('<div class="dropdown-item-text text-danger">Error searching customers</div>').show();
                    }
                });
            }, 300);
        });
        
        // Handle customer selection
        $(document).on('click', '.customer-option', function(e) {
            e.preventDefault();
            const customerId = $(this).data('id');
            const customerName = $(this).data('name');
            const customerCode = $(this).data('code');
            
            // Determine which form we're in
            const isEditForm = $(this).closest('#edit_customer_dropdown').length > 0;
            const searchInputId = isEditForm ? '#edit_customer_search' : '#customer_search';
            const hiddenInputId = isEditForm ? '#edit_customer_id_hidden' : '#customer_id_hidden';
            const dropdownId = isEditForm ? '#edit_customer_dropdown' : '#customer_dropdown';
            
            $(searchInputId).val(`${customerName} (${customerCode})`);
            $(hiddenInputId).val(customerId);
            $(dropdownId).hide();
        });
        
        // Hide dropdown when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.form-group').length) {
                $('#customer_dropdown, #edit_customer_dropdown').hide();
            }
        });
        
        // Clear selection when input is cleared
        $('#customer_search, #edit_customer_search').on('keyup', function() {
            if ($(this).val().trim() === '') {
                const hiddenInputId = $(this).attr('id') === 'customer_search' ? '#customer_id_hidden' : '#edit_customer_id_hidden';
                $(hiddenInputId).val('');
            }
        });
    }

    // Load projects function
    function loadProjects() {
        const search = $('#search_project').val();
        
        // Show loading indicator
        $('#projects_tbody').html('<tr><td colspan="8" class="text-center">Loading...</td></tr>');
        
        $.ajax({
            url: '/api/projects',
            method: 'GET',
            data: {
                search: search,
                status: currentStatus === 'all' ? '' : currentStatus,
                page: currentPage
            },
            success: function(response) {
                if(response.success) {
                    renderProjects(response.data);
                    renderPagination(response.pagination);
                } else {
                    showAlert('error', 'Error loading projects');
                }
            },
            error: function(xhr, status, error) {
                showAlert('error', 'Error loading projects: ' + xhr.statusText);
            }
        });
    }

    // Render projects table
    function renderProjects(projects) {
        let html = '';
        
        if (projects.length === 0) {
            html = '<tr><td colspan="8" class="text-center">No projects found</td></tr>';
        } else {
            projects.forEach(function(project, index) {
                let statusClass = '';
                let statusText = '';
                
                switch(project.status) {
                    case 'active':
                        statusClass = 'badge-pill badge-status bg-success';
                        statusText = 'Active';
                        break;
                    case 'inactive':
                        statusClass = 'badge-pill badge-status bg-secondary';
                        statusText = 'Inactive';
                        break;
                    case 'completed':
                        statusClass = 'badge-pill badge-status bg-primary';
                        statusText = 'Completed';
                        break;
                    case 'cancelled':
                        statusClass = 'badge-pill badge-status bg-danger';
                        statusText = 'Cancelled';
                        break;
                    default:
                        statusClass = 'badge-pill badge-status bg-secondary';
                        statusText = project.status;
                }
                
                const customerName = project.customer ? project.customer.customer_name : '-';
                const proposalStatus = project.proposal ? 
                    '<span class="badge badge-pill badge-status bg-info">Created</span>' : 
                    `<button class="btn btn-sm btn-outline-primary" onclick="createProposal(${project.id})">Create Proposal</button>`;
                
                html += `
                    <tr>
                        <td>
                            <label class="checkboxs">
                                <input type="checkbox" class="project-checkbox" value="${project.id}">
                                <span class="checkmarks"></span>
                            </label>
                        </td>
                        <td><strong>${project.project_code}</strong></td>
                        <td>
                            <a href="javascript:void(0);" class="d-flex flex-column fw-medium">${project.name}</a>
                        </td>
                        <td>${customerName}</td>
                        <td><span class="badge ${statusClass}">${statusText}</span></td>
                        <td>${proposalStatus}</td>
                        <td>${formatDate(project.created_at)}</td>
                        <td>
                            <div class="dropdown table-action">
                                <a href="#" class="action-icon" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="/projects/${project.id}">
                                        <i class="ti ti-eye text-info"></i> View Detail
                                    </a>
                                    <a class="dropdown-item" href="#" onclick="editProject(${project.id})">
                                        <i class="ti ti-edit text-blue"></i> Edit
                                    </a>
                                    <a class="dropdown-item" href="#" onclick="deleteProject(${project.id})">
                                        <i class="ti ti-trash text-danger"></i> Delete
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                `;
            });
        }
        
        $('#projects_tbody').html(html);
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
        loadProjects();
    }

    // Add project form submit
    $('#add_project_form').submit(function(e) {
        e.preventDefault();
        
        // Basic validation
        const projectCode = $('input[name="project_code"]').val().trim();
        const projectName = $('input[name="name"]').val().trim();
        const customerId = $('#customer_id_hidden').val();
        
        if (!projectCode) {
            showAlert('error', 'Project Code is required');
            return;
        }
        
        if (!projectName) {
            showAlert('error', 'Project Name is required');
            return;
        }
        
        if (!customerId) {
            showAlert('error', 'Customer is required');
            return;
        }
        
        $.ajax({
            url: '/api/projects',
            method: 'POST',
            data: $(this).serialize(),
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            success: function(response) {
                if(response.success) {
                    $('#add_project').modal('hide');
                    $('#add_project_form')[0].reset();
                    showAlert('success', 'Project added successfully');
                    loadProjects();
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
                    showAlert('error', 'Error adding project: ' + xhr.statusText);
                }
            }
        });
    });

    // Edit project function
    window.editProject = function(id) {
        $.ajax({
            url: `/api/projects/${id}`,
            method: 'GET',
            success: function(response) {
                if(response.success) {
                    const project = response.data;
                    $('#edit_project_id').val(project.id);
                    $('#edit_project_code').val(project.project_code);
                    $('#edit_project_name').val(project.name);
                    $('#edit_customer_search').val(`${project.customer.customer_name} (${project.customer.customer_code})`);
                    $('#edit_customer_id_hidden').val(project.customer_id);
                    $('#edit_status').val(project.status);
                    $('#edit_description').val(project.description);
                    const editOffcanvas = new bootstrap.Offcanvas(document.getElementById('edit_project'));
                    editOffcanvas.show();
                }
            },
            error: function() {
                showAlert('error', 'Error loading project data');
            }
        });
    }

    // Edit project form submit
    $('#edit_project_form').submit(function(e) {
        e.preventDefault();
        const projectId = $('#edit_project_id').val();
        
        $.ajax({
            url: `/api/projects/${projectId}`,
            method: 'PUT',
            data: $(this).serialize(),
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            success: function(response) {
                if(response.success) {
                    const editOffcanvas = bootstrap.Offcanvas.getInstance(document.getElementById('edit_project'));
                    editOffcanvas.hide();
                    showAlert('success', 'Project updated successfully');
                    loadProjects();
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
                    showAlert('error', 'Error updating project: ' + xhr.statusText);
                }
            }
        });
    });

    // Delete project function
    window.deleteProject = function(id) {
        selectedProjectId = id;
        $('#delete_project').modal('show');
    }

    // Confirm delete
    $('#confirm_delete').click(function() {
        if(selectedProjectId) {
            $.ajax({
                url: `/api/projects/${selectedProjectId}`,
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json'
                },
                success: function(response) {
                    if(response.success) {
                        $('#delete_project').modal('hide');
                        showAlert('success', 'Project deleted successfully');
                        loadProjects();
                    } else {
                        showAlert('error', response.message);
                    }
                },
                error: function(xhr) {
                    console.error('Error response:', xhr.responseText);
                    showAlert('error', 'Error deleting project: ' + xhr.statusText);
                }
            });
        }
    });

    // Create proposal function
    window.createProposal = function(projectId) {
        // Redirect to project detail page with create proposal modal trigger
        window.location.href = `/projects/${projectId}?action=create_proposal`;
    }

    // Select all checkbox
    $('#select-all').change(function() {
        $('.project-checkbox').prop('checked', $(this).is(':checked'));
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
        } else if(type === 'info') {
            alert('Info: ' + message);
        } else {
            // Use browser alert as fallback
            alert('Error: ' + message);
        }
    }
});
</script>
@endpush