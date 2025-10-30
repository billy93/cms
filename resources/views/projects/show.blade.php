<?php $page = 'projects.show'; ?>
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
                    <div id="proposals_section">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Proposal</h5>
                                <div class="d-flex gap-2">
                                    <a 
                                        href="javascript:void(0);" 
                                        id="c_proposal_add" 
                                        class="btn btn-primary" 
                                        data-bs-toggle="offcanvas" 
                                        data-bs-target="#offcanvas_add"
                                    >
                                    <i class="ti ti-square-rounded-plus me-2"></i>Add New Proposals
                                </a>
                                </div>
                            </div>
                            <div class="card-body"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->

    <!-- Add New Proposal -->
    <div class="offcanvas offcanvas-end offcanvas-large" tabindex="-1" id="offcanvas_add">
        <div class="offcanvas-header border-bottom">
            <h4 id="proposal_form_title">Edit Proposal</h4>
            <button type="button" id="close_proposal_form" class="btn-close custom-btn-close border p-1 me-0 d-flex align-items-center justify-content-center rounded-circle" data-bs-dismiss="offcanvas" aria-label="Close">
                <i class="ti ti-x"></i>
            </button>
        </div>
        <div class="offcanvas-body">
            <style>
				#c_proposal_form td { vertical-align: baseline; } 
			</style>
			<form id="c_proposal_form" method="POST"></form>
        </div>
    </div>
    <!-- /Add New Proposal -->
    
	<!-- Delete Modal -->
	<div class="modal fade" id="delete_proposal_modal" tabindex="-1" aria-labelledby="deleteProposalModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="deleteProposalModalLabel">Confirm Delete</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					Are you sure you want to delete this item?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-danger" id="confirm_delete_proposal">Delete</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Delete Modal -->

@endsection

@push('scripts')
<script>
    const PROJECT_ID = parseInt('{{ $project->id }}');

    function loadProjectData(id) {
        $.ajax({
            url: `/projects/${id}`,
            method: 'GET',
            success: function(response) {
                if(response.success) {
                    renderProjectInfo(response.data);
                    renderProposalInfo(response.data);
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
        const customerName = project.customer ? project.customer.name : '-';
        const customerCode = project.customer ? project.customer.code : '-';
        
        const html = `
            <div class="col-md-6">
                <div class="form-group mb-2">
                    <label class="fw-semibold">Project Code:</label>
                    <p class="mb-0">${project.code}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-2">
                    <label class="fw-semibold">Project Status:</label>
                    <p class="mb-0"><span class="badge ${statusClass}">${project.status.charAt(0).toUpperCase() + project.status.slice(1)}</span></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-2">
                    <label class="fw-semibold">Project Name:</label>
                    <p class="mb-0">${project.name}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-2">
                    <label class="fw-semibold">Customer:</label>
                    <p class="mb-0">${customerName || "-"} ${customerCode ? "(" + customerCode + ")" : ""}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-2">
                    <label class="fw-semibold">Created Date:</label>
                    <p class="mb-0">${project.created_at ? formatDate(project.created_at) : "-"}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-2">
                    <label class="fw-semibold">Last Updated:</label>
                    <p class="mb-0">${project.updated_at ? formatDate(project.updated_at) : "-"}</p>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group mb-2">
                    <label class="fw-semibold">Description:</label>
                    <p class="mb-0">${project.description || '-'}</p>
                </div>
            </div>
        `;
        
        $('#project_info').html(html);
    }

    function renderProposalInfo(data) {
        const proposalList = data.proposals.map((p, i, a) => {
            return `
                <div class="row ${i !== a.length - 1 ? "pb-3" : ""}" style="${i !== a.length - 1 ? "border-bottom: var(--bs-card-border-width) solid var(--bs-card-border-color)" : ""}">
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label class="fw-semibold">Proposal Code:</label>
                            <p class="mb-0">${p.code || "-"}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label class="fw-semibold">Proposal Status:</label>
                            <p class="mb-0">${p.status ? getProposalStatus(p.status) : "-"}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label class="fw-semibold">Type of Sales Code:</label>
                            <p class="mb-0">${p.type_of_sales_code || "-"}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label class="fw-semibold">Sales Code:</label>
                            <p class="mb-0">${p.sales_code || "-"}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label class="fw-semibold">Year of Sales:</label>
                            <p class="mb-0">${p.year_of_sales || "-"}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label class="fw-semibold">Invoice No:</label>
                            <p class="mb-0">${p.invoice_no || "-"}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label class="fw-semibold">Destination:</label>
                            <p class="mb-0">${p.destination || "-"}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label class="fw-semibold">City:</label>
                            <p class="mb-0">${p.city || "-"}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label class="fw-semibold">Activity:</label>
                            <p class="mb-0">${p.activity || "-"}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label class="fw-semibold">Start Date:</label>
                            <p class="mb-0">${p.date_from ? formatDate(p.date_from) : "-"}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label class="fw-semibold">End Date:</label>
                            <p class="mb-0">${p.date_to ? formatDate(p.date_to) : "-"}</p>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <button 
                            class="btn btn-secondary me-2 c_proposal_edit"
                            data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvas_add"
                            data-url="/proposals/${p.id}"
                        >
                            <i class="ti ti-edit me-1"></i>Edit Proposal
                        </button>
                        <button 
                            class="btn btn-danger c_proposal_delete"
                            data-bs-toggle="modal" 
                            data-bs-target="#delete_proposal_modal"
                            data-url="/proposals/${p.id}"
                        >
                            <i class="ti ti-trash me-1"></i>Delete Proposal
                        </button>
                    </div>
                </div>
            `;
        });
        
        $('#proposals_section .card-body').html(proposalList.length ? proposalList : "No Proposals Found!");
    }

    function getStatusClass(status) {
        switch(status) {
            case 'Active': return 'badge-pill badge-status bg-success';
            case 'Inactive': return 'badge-pill badge-status bg-secondary';
            case 'Completed': return 'badge-pill badge-status bg-primary';
            case 'Cancelled': return 'badge-pill badge-status bg-danger';
            default: return 'badge-pill badge-status bg-secondary';
        }
    }

    function getProposalStatus (status){
        switch (status) {
            case 'Draft': return '<span class="badge badge-status bg-secondary">Draft</span>';
            case 'Submitted': return '<span class="badge badge-status bg-info">Submitted</span>';
            case 'Approved': return '<span class="badge badge-status bg-success">Approved</span>';
            case 'Rejected': return '<span class="badge badge-status bg-danger">Rejected</span>';
            case 'Cancelled': return '<span class="badge badge-status bg-dark">Cancelled</span>';
            default: return '<span class="badge badge-status bg-secondary">Unknown</span>';
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

    $(document).ready(function() {
        // Load project data and proposal
        loadProjectData(PROJECT_ID);
    });
</script>
<script src="/build/js/proposal_script.js"></script>
@endpush


