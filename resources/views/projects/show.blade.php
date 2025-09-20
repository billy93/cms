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
                Project Detail
                @endslot
                @slot('item1')
                Projects
                @endslot
                @slot('item2')
                project-detail
                @endslot
                @endcomponent

                <!-- Project Info Card -->
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Project Information</h5>
                        <div class="d-flex gap-2">
                            <a href="/projects" class="btn btn-outline-secondary">
                                <i class="ti ti-arrow-left me-1"></i>Back to Projects
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row" id="project_info">
                            <!-- Project info will be loaded here -->
                        </div>
                    </div>
                </div>

                <!-- Proposal Section -->
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Proposal</h5>
                        <button class="btn btn-success" id="create_proposal_btn" onclick="showCreateProposal()" style="display: none;">
                            <i class="ti ti-plus me-1"></i>Create Proposal
                        </button>
                    </div>
                    <div class="card-body">
                        <div id="proposal_content">
                            <!-- Proposal content will be loaded here -->
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
<!-- /Page Wrapper -->

<!-- Create Proposal Offcanvas -->
<div class="offcanvas offcanvas-end offcanvas-large" tabindex="-1" id="create_proposal_modal">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Create Proposal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
                <form id="create_proposal_form">
                    <input type="hidden" name="project_id" id="proposal_project_id">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>BOQ Code <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="boq_code" required>
                                    <button type="button" class="btn btn-outline-secondary" onclick="generateCodes()">
                                        <i class="ti ti-refresh"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Sales Code <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="sales_code" required>
                                    <button type="button" class="btn btn-outline-secondary" onclick="generateCodes()">
                                        <i class="ti ti-refresh"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Type of Sales Code <span class="text-danger">*</span></label>
                                <select class="select form-control" name="type_of_sales_code" required>
                                    <option value="">Select Type</option>
                                    <option value="FIT">FIT</option>
                                    <option value="Non FIT">Non FIT</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Year of Sales <span class="text-danger">*</span></label>
                                <select class="select form-control" name="year_of_sales" required>
                                    <option value="">Select Year</option>
                                    <!-- Years will be populated by JavaScript -->
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Destination <span class="text-danger">*</span></label>
                                <select class="select form-control" name="destination" id="destination_select" required>
                                    <option value="">Select Destination</option>
                                    <option value="Indonesia">Indonesia</option>
                                    <option value="Overseas">Overseas</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>City <span class="text-danger">*</span></label>
                                <select class="select form-control" name="city" id="city_select" required>
                                    <option value="">Select City</option>
                                    <option value="Bogor">Bogor</option>
                                    <option value="Jakarta">Jakarta</option>
                                    <option value="Overseas">Overseas</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Activity <span class="text-danger">*</span></label>
                                <select class="select form-control" name="activity" required>
                                    <option value="">Select Activity</option>
                                    <option value="Awarding">Awarding</option>
                                    <option value="Conference and Seminar">Conference and Seminar</option>
                                    <option value="Exhibitions">Exhibitions</option>
                                    <option value="Gala Dinner">Gala Dinner</option>
                                    <option value="Gathering">Gathering</option>
                                    <option value="Holidays">Holidays</option>
                                    <option value="Incentive Trip">Incentive Trip</option>
                                    <option value="Meeting">Meeting</option>
                                    <option value="Product Launching">Product Launching</option>
                                    <option value="Shareholders Meeting (RUPS)">Shareholders Meeting (RUPS)</option>
                                    <option value="Workshop">Workshop</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date From <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="date_from" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date To <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="date_to" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Pricing Model <span class="text-danger">*</span></label>
                                <select class="select form-control" name="pricing_model" required>
                                    <option value="">Select Pricing Model</option>
                                    <option value="All inclusive package">All inclusive package</option>
                                    <option value="All inclusive - Price Per Person">All inclusive - Price Per Person</option>
                                    <option value="Simple package">Simple package</option>
                                    <option value="Free format">Free format</option>
                                    <option value="Itemized">Itemized</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="offcanvas">Cancel</button>
                        <button type="button" class="btn btn-primary" onclick="submitProposal()">Create Proposal</button>
                    </div>
                </form>
    </div>
</div>
<!-- /Create Proposal Offcanvas -->

<!-- Edit Proposal Offcanvas -->
<div class="offcanvas offcanvas-end offcanvas-large" tabindex="-1" id="edit_proposal_modal">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Edit Proposal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
                <form id="edit_proposal_form">
                    <input type="hidden" name="proposal_id" id="edit_proposal_id">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>BOQ Code <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="boq_code" id="edit_boq_code" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Sales Code <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="sales_code" id="edit_sales_code" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Type of Sales Code <span class="text-danger">*</span></label>
                                <select class="select form-control" name="type_of_sales_code" id="edit_type_of_sales_code" required>
                                    <option value="">Select Type</option>
                                    <option value="FIT">FIT</option>
                                    <option value="Non FIT">Non FIT</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Year of Sales <span class="text-danger">*</span></label>
                                <select class="select form-control" name="year_of_sales" id="edit_year_of_sales" required>
                                    <option value="">Select Year</option>
                                    <!-- Years will be populated by JavaScript -->
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Destination <span class="text-danger">*</span></label>
                                <select class="select form-control" name="destination" id="edit_destination_select" required>
                                    <option value="">Select Destination</option>
                                    <option value="Indonesia">Indonesia</option>
                                    <option value="Overseas">Overseas</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>City <span class="text-danger">*</span></label>
                                <select class="select form-control" name="city" id="edit_city_select" required>
                                    <option value="">Select City</option>
                                    <option value="Bogor">Bogor</option>
                                    <option value="Jakarta">Jakarta</option>
                                    <option value="Overseas">Overseas</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Activity <span class="text-danger">*</span></label>
                                <select class="select form-control" name="activity" id="edit_activity" required>
                                    <option value="">Select Activity</option>
                                    <option value="Awarding">Awarding</option>
                                    <option value="Conference and Seminar">Conference and Seminar</option>
                                    <option value="Exhibitions">Exhibitions</option>
                                    <option value="Gala Dinner">Gala Dinner</option>
                                    <option value="Gathering">Gathering</option>
                                    <option value="Holidays">Holidays</option>
                                    <option value="Incentive Trip">Incentive Trip</option>
                                    <option value="Meeting">Meeting</option>
                                    <option value="Product Launching">Product Launching</option>
                                    <option value="Shareholders Meeting (RUPS)">Shareholders Meeting (RUPS)</option>
                                    <option value="Workshop">Workshop</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date From <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="date_from" id="edit_date_from" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date To <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="date_to" id="edit_date_to" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Pricing Model <span class="text-danger">*</span></label>
                                <select class="select form-control" name="pricing_model" id="edit_pricing_model" required>
                                    <option value="">Select Pricing Model</option>
                                    <option value="All inclusive package">All inclusive package</option>
                                    <option value="All inclusive - Price Per Person">All inclusive - Price Per Person</option>
                                    <option value="Simple package">Simple package</option>
                                    <option value="Free format">Free format</option>
                                    <option value="Itemized">Itemized</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="offcanvas">Cancel</button>
                        <button type="button" class="btn btn-primary" onclick="updateProposal()">Update Proposal</button>
                    </div>
                </form>
    </div>
</div>
<!-- /Edit Proposal Offcanvas -->

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    const projectId = window.location.pathname.split('/').pop();
    
    // Check if we need to open create proposal modal
    const urlParams = new URLSearchParams(window.location.search);
    const action = urlParams.get('action');
    
    // Load project data and proposal
    loadProjectData(projectId);
    loadProposalData(projectId);
    
    // Open create proposal offcanvas if action parameter is set
    if (action === 'create_proposal') {
        setTimeout(() => {
            const createProposalOffcanvas = new bootstrap.Offcanvas(document.getElementById('create_proposal_modal'));
            createProposalOffcanvas.show();
        }, 500); // Small delay to ensure page is loaded
    }
    
    // Populate years dropdown
    populateYears();
    
    // Handle destination change
    $('#destination_select, #edit_destination_select').change(function() {
        const destination = $(this).val();
        const citySelect = $(this).attr('id') === 'destination_select' ? '#city_select' : '#edit_city_select';
        loadCities(destination, citySelect);
    });
    
    function loadProjectData(id) {
        $.ajax({
            url: `/api/projects/${id}`,
            method: 'GET',
            success: function(response) {
                if(response.success) {
                    renderProjectInfo(response.data);
                } else {
                    showAlert('error', 'Error loading project data');
                }
            },
            error: function() {
                showAlert('error', 'Error loading project data');
            }
        });
    }
    
    function renderProjectInfo(project) {
        const statusClass = getStatusClass(project.status);
        const customerName = project.customer ? project.customer.customer_name : '-';
        const customerCode = project.customer ? project.customer.customer_code : '-';
        
        const html = `
            <div class="col-md-6">
                <div class="form-group">
                    <label class="fw-semibold">Project Code:</label>
                    <p class="mb-0">${project.project_code}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="fw-semibold">Project Name:</label>
                    <p class="mb-0">${project.name}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="fw-semibold">Customer:</label>
                    <p class="mb-0">${customerName} (${customerCode})</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="fw-semibold">Status:</label>
                    <p class="mb-0"><span class="badge ${statusClass}">${project.status.charAt(0).toUpperCase() + project.status.slice(1)}</span></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="fw-semibold">Created Date:</label>
                    <p class="mb-0">${formatDate(project.created_at)}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="fw-semibold">Last Updated:</label>
                    <p class="mb-0">${formatDate(project.updated_at)}</p>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="fw-semibold">Description:</label>
                    <p class="mb-0">${project.description || '-'}</p>
                </div>
            </div>
        `;
        
        $('#project_info').html(html);
    }
    
    function loadProposalData(projectId) {
        $.ajax({
            url: `/api/proposals/project/${projectId}`,
            method: 'GET',
            success: function(response) {
                if(response.success) {
                    renderProposalInfo(response.data);
                    $('#create_proposal_btn').hide();
                } else {
                    // No proposal found, show create button
                    $('#proposal_content').html('<p class="text-muted">No proposal created for this project yet.</p>');
                    $('#create_proposal_btn').show();
                    $('#proposal_project_id').val(projectId);
                }
            },
            error: function() {
                $('#proposal_content').html('<p class="text-muted">No proposal created for this project yet.</p>');
                $('#create_proposal_btn').show();
                $('#proposal_project_id').val(projectId);
            }
        });
    }
    
    function renderProposalInfo(proposal) {
        const html = `
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="fw-semibold">BOQ Code:</label>
                        <p class="mb-0">${proposal.boq_code}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="fw-semibold">Sales Code:</label>
                        <p class="mb-0">${proposal.sales_code}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="fw-semibold">Type of Sales Code:</label>
                        <p class="mb-0">${proposal.type_of_sales_code}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="fw-semibold">Year of Sales:</label>
                        <p class="mb-0">${proposal.year_of_sales}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="fw-semibold">Destination:</label>
                        <p class="mb-0">${proposal.destination}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="fw-semibold">City:</label>
                        <p class="mb-0">${proposal.city}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="fw-semibold">Activity:</label>
                        <p class="mb-0">${proposal.activity}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="fw-semibold">Invoice No:</label>
                        <p class="mb-0">${proposal.invoice_no}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="fw-semibold">Date From:</label>
                        <p class="mb-0">${formatDate(proposal.date_from)}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="fw-semibold">Date To:</label>
                        <p class="mb-0">${formatDate(proposal.date_to)}</p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="fw-semibold">Pricing Model:</label>
                        <p class="mb-0">${proposal.pricing_model}</p>
                    </div>
                </div>
                <div class="col-md-12 mt-3">
                    <button class="btn btn-primary me-2" onclick="editProposal(${proposal.id})">
                        <i class="ti ti-edit me-1"></i>Edit Proposal
                    </button>
                    <button class="btn btn-danger" onclick="deleteProposal(${proposal.id})">
                        <i class="ti ti-trash me-1"></i>Delete Proposal
                    </button>
                </div>
            </div>
        `;
        
        $('#proposal_content').html(html);
    }
    
    function populateYears() {
        const currentYear = new Date().getFullYear();
        let yearOptions = '<option value="">Select Year</option>';
        
        for(let i = currentYear - 5; i <= currentYear + 5; i++) {
            yearOptions += `<option value="${i}">${i}</option>`;
        }
        
        $('select[name="year_of_sales"]').html(yearOptions);
    }
    
    function loadCities(destination, selectElement) {
        if(!destination) {
            $(selectElement).html('<option value="">Select City</option>');
            return;
        }
        
        $.ajax({
            url: '/api/proposals/cities',
            method: 'GET',
            data: { destination: destination },
            success: function(response) {
                if(response.success) {
                    let options = '<option value="">Select City</option>';
                    response.data.forEach(function(city) {
                        options += `<option value="${city}">${city}</option>`;
                    });
                    $(selectElement).html(options);
                }
            },
            error: function() {
                console.error('Error loading cities');
            }
        });
    }
    
    window.showCreateProposal = function() {
        const createProposalOffcanvas = new bootstrap.Offcanvas(document.getElementById('create_proposal_modal'));
        createProposalOffcanvas.show();
    }
    
    window.generateCodes = function() {
        $.ajax({
            url: '/api/proposals/generate-codes',
            method: 'GET',
            success: function(response) {
                if(response.success) {
                    $('input[name="boq_code"]').val(response.data.boq_code);
                    $('input[name="sales_code"]').val(response.data.sales_code);
                }
            },
            error: function() {
                console.error('Error generating codes');
            }
        });
    }
    
    window.submitProposal = function() {
        // Validate required fields
        const boqCode = $('input[name="boq_code"]').val().trim();
        const salesCode = $('input[name="sales_code"]').val().trim();
        const typeOfSalesCode = $('select[name="type_of_sales_code"]').val();
        const yearOfSales = $('select[name="year_of_sales"]').val();
        const destination = $('select[name="destination"]').val();
        const city = $('select[name="city"]').val();
        const activity = $('select[name="activity"]').val();
        const dateFrom = $('input[name="date_from"]').val();
        const dateTo = $('input[name="date_to"]').val();
        const pricingModel = $('select[name="pricing_model"]').val();
        
        // Validation checks
        if (!boqCode) {
            showAlert('error', 'BOQ Code is required');
            return;
        }
        
        if (!salesCode) {
            showAlert('error', 'Sales Code is required');
            return;
        }
        
        if (!typeOfSalesCode) {
            showAlert('error', 'Type of Sales Code is required');
            return;
        }
        
        if (!yearOfSales) {
            showAlert('error', 'Year of Sales is required');
            return;
        }
        
        if (!destination) {
            showAlert('error', 'Destination is required');
            return;
        }
        
        if (!city) {
            showAlert('error', 'City is required');
            return;
        }
        
        if (!activity) {
            showAlert('error', 'Activity is required');
            return;
        }
        
        if (!dateFrom) {
            showAlert('error', 'Date From is required');
            return;
        }
        
        if (!dateTo) {
            showAlert('error', 'Date To is required');
            return;
        }
        
        if (!pricingModel) {
            showAlert('error', 'Pricing Model is required');
            return;
        }
        
        // Validate date range
        if (new Date(dateFrom) > new Date(dateTo)) {
            showAlert('error', 'Date From cannot be later than Date To');
            return;
        }
        
        // Show loading state
        const submitBtn = $('button[onclick="submitProposal()"]');
        const originalText = submitBtn.text();
        submitBtn.prop('disabled', true).text('Creating...');
        
        const formData = $('#create_proposal_form').serialize();
        
        $.ajax({
            url: '/api/proposals',
            method: 'POST',
            data: formData,
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            success: function(response) {
                if(response.success) {
                    const createProposalOffcanvas = bootstrap.Offcanvas.getInstance(document.getElementById('create_proposal_modal'));
                    createProposalOffcanvas.hide();
                    $('#create_proposal_form')[0].reset();
                    showAlert('success', 'Proposal created successfully');
                    loadProposalData(projectId);
                } else {
                    showAlert('error', response.message || 'Error creating proposal');
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
                } else if(xhr.status === 409) {
                    showAlert('error', xhr.responseJSON.message || 'Proposal already exists for this project');
                } else {
                    showAlert('error', 'Error creating proposal. Please try again.');
                }
            },
            complete: function() {
                // Restore button state
                submitBtn.prop('disabled', false).text(originalText);
            }
        });
    }
    
    window.editProposal = function(proposalId) {
        $.ajax({
            url: `/api/proposals/${proposalId}`,
            method: 'GET',
            success: function(response) {
                if(response.success) {
                    const proposal = response.data;
                    
                    // Populate edit form
                    $('#edit_proposal_id').val(proposal.id);
                    $('#edit_boq_code').val(proposal.boq_code);
                    $('#edit_sales_code').val(proposal.sales_code);
                    $('#edit_type_of_sales_code').val(proposal.type_of_sales_code);
                    $('#edit_year_of_sales').val(proposal.year_of_sales);
                    $('#edit_destination_select').val(proposal.destination);
                    $('#edit_activity').val(proposal.activity);
                    // Format dates for HTML date inputs (YYYY-MM-DD)
                    const dateFrom = proposal.date_from ? new Date(proposal.date_from).toISOString().split('T')[0] : '';
                    const dateTo = proposal.date_to ? new Date(proposal.date_to).toISOString().split('T')[0] : '';
                    $('#edit_date_from').val(dateFrom);
                    $('#edit_date_to').val(dateTo);
                    $('#edit_pricing_model').val(proposal.pricing_model);
                    
                    // Load cities for the destination
                    loadCities(proposal.destination, '#edit_city_select');
                    setTimeout(() => {
                        $('#edit_city_select').val(proposal.city);
                    }, 500);
                    
                    const editProposalOffcanvas = new bootstrap.Offcanvas(document.getElementById('edit_proposal_modal'));
                    editProposalOffcanvas.show();
                }
            },
            error: function() {
                showAlert('error', 'Error loading proposal data');
            }
        });
    }
    
    window.updateProposal = function() {
        const proposalId = $('#edit_proposal_id').val();
        const formData = $('#edit_proposal_form').serialize();
        
        $.ajax({
            url: `/api/proposals/${proposalId}`,
            method: 'PUT',
            data: formData,
            success: function(response) {
                if(response.success) {
                    const editProposalOffcanvas = bootstrap.Offcanvas.getInstance(document.getElementById('edit_proposal_modal'));
                    editProposalOffcanvas.hide();
                    showAlert('success', 'Proposal updated successfully');
                    loadProposalData(projectId);
                } else {
                    showAlert('error', response.message);
                }
            },
            error: function(xhr) {
                if(xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    let errorMessage = '';
                    for(let field in errors) {
                        errorMessage += errors[field][0] + '\n';
                    }
                    showAlert('error', errorMessage);
                } else {
                    showAlert('error', 'Error updating proposal');
                }
            }
        });
    }
    
    window.deleteProposal = function(proposalId) {
        if(confirm('Are you sure you want to delete this proposal?')) {
            $.ajax({
                url: `/api/proposals/${proposalId}`,
                method: 'DELETE',
                success: function(response) {
                    if(response.success) {
                        showAlert('success', 'Proposal deleted successfully');
                        loadProposalData(projectId);
                    } else {
                        showAlert('error', response.message);
                    }
                },
                error: function() {
                    showAlert('error', 'Error deleting proposal');
                }
            });
        }
    }
    
    function getStatusClass(status) {
        switch(status) {
            case 'active': return 'badge-pill badge-status bg-success';
            case 'inactive': return 'badge-pill badge-status bg-secondary';
            case 'completed': return 'badge-pill badge-status bg-primary';
            case 'cancelled': return 'badge-pill badge-status bg-danger';
            default: return 'badge-pill badge-status bg-secondary';
        }
    }
    
    function formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('id-ID', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
    }
    
    function showAlert(type, message) {
        // Create toast notification instead of basic alert
        const toastContainer = $('#toast-container');
        if (toastContainer.length === 0) {
            $('body').append('<div id="toast-container" class="position-fixed top-0 end-0 p-3" style="z-index: 11"></div>');
        }
        
        const toastId = 'toast-' + Date.now();
        const toastClass = type === 'success' ? 'bg-success' : 'bg-danger';
        const toastIcon = type === 'success' ? 'ti-check' : 'ti-x';
        
        const toastHtml = `
            <div id="${toastId}" class="toast ${toastClass} text-white" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header ${toastClass} text-white border-0">
                    <i class="ti ${toastIcon} me-2"></i>
                    <strong class="me-auto">${type === 'success' ? 'Success' : 'Error'}</strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    ${message}
                </div>
            </div>
        `;
        
        $('#toast-container').append(toastHtml);
        
        // Initialize and show toast
        const toastElement = document.getElementById(toastId);
        const toast = new bootstrap.Toast(toastElement, {
            autohide: true,
            delay: 5000
        });
        toast.show();
        
        // Remove toast element after it's hidden
        toastElement.addEventListener('hidden.bs.toast', function() {
            $(this).remove();
        });
    }
});
</script>
@endpush