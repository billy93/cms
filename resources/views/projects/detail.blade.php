<?php $page = 'projects.detail'; ?>
@extends('layout.mainlayout')
@section('content')

    <!-- BoQ Datatable url -->
    <div id="boq-route" data-url="{{ route('boqs.index') }}" style="display: none;"></div>
    
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
                                        id="c_proposal_create_btn" 
                                        class="btn btn-primary" 
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

    @include('components.proposals.create-modal')
    @include('components.proposals.modal')
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
            <div class="col-md-6 col-xxl-4">
                <div class="form-group mb-2">
                    <label class="fw-semibold">Project Code</label>
                    <p class="mb-0">${project.code}</p>
                </div>
            </div>
            <div class="col-md-6 col-xxl-4">
                <div class="form-group mb-2">
                    <label class="fw-semibold">Project Name</label>
                    <p class="mb-0">${project.name}</p>
                </div>
            </div>
            <div class="col-md-6 col-xxl-4">
                <div class="form-group mb-2">
                    <label class="fw-semibold">Project Status</label>
                    <p class="mb-0"><span class="badge ${statusClass}">${project.status.charAt(0).toUpperCase() + project.status.slice(1)}</span></p>
                </div>
            </div>
            <div class="col-md-6 col-xxl-4">
                <div class="form-group mb-2">
                    <label class="fw-semibold">Ref. Doc. No.</label>
                    <p class="mb-0">${project.ref_doc_no || "-"}</p>
                </div>
            </div>
            <div class="col-md-6 col-xxl-4">
                <div class="form-group mb-2">
                    <label class="fw-semibold">Customer</label>
                    <p class="mb-0">${customerName || "-"}</p>
                </div>
            </div>
            <div class="col-md-6 col-xxl-4">
                <div class="form-group mb-2">
                    <label class="fw-semibold">Created Date</label>
                    <p class="mb-0">${project.created_at ? formatDate(project.created_at) : "-"}</p>
                </div>
            </div>
            <div class="col-md-6 col-xxl-4">
                <div class="form-group mb-2">
                    <label class="fw-semibold">Last Updated</label>
                    <p class="mb-0">${project.updated_at ? formatDate(project.updated_at) : "-"}</p>
                </div>
            </div>
            <div class="col-md-6 col-xxl-4">
                <div class="form-group mb-2">
                    <label class="fw-semibold">Start Date</label>
                    <p class="mb-0">${project.start_date ? formatDate(project.start_date) : "-"}</p>
                </div>
            </div>
            <div class="col-md-6 col-xxl-4">
                <div class="form-group mb-2">
                    <label class="fw-semibold">End Date</label>
                    <p class="mb-0">${project.end_date ? formatDate(project.end_date) : "-"}</p>
                </div>
            </div>
            <div class="col-md-6 col-xxl-4">
                <div class="form-group mb-2">
                    <label class="fw-semibold">Due Date</label>
                    <p class="mb-0">${project.due_date ? formatDate(project.due_date) : "-"}</p>
                </div>
            </div>
            <div class="col-md-6 col-xxl-4">
                <div class="form-group mb-2">
                    <label class="fw-semibold">Description</label>
                    <p class="mb-0">${project.description || '-'}</p>
                </div>
            </div>
        `;
        
        $('#project_info').html(html);
    }

    function renderProposalInfo(data) {
        const proposalList = data.proposals.map((p, i, a) => {
            const conditionalActions = p.status !== "Win" ? 
            `
                <button 
                    class="btn btn-sm btn-secondary me-2 c_proposal_edit_btn"
                    data-url="/proposals/${p.id}"
                >
                    <i class="ti ti-edit" style="font-size: 1.25rem"></i>
                </button>
                <button 
                    class="btn btn-sm btn-danger c_proposal_delete_btn"
                    data-url="/proposals/${p.id}"
                >
                    <i class="ti ti-trash" style="font-size: 1.25rem"></i>
                </button>
            ` :
            "";

            const invoices = p.invoices?.length 
                ? "<ul>" + p.invoices.map(invoice => `<li>${invoice.code}</li>`).join("") + "</ul>" 
                : "-";

            const noteField = p.status.toLowerCase() === "lose" ? 
                `<div class="col-md-6 col-xxl-4">
                    <div class="form-group mb-2">
                        <label class="fw-semibold">Invoice(s)</label>
                        <p class="mb-0">${p.note || "-"}</p>
                    </div>
                </div>` : "";
                
            return `
                <div class="row ${i !== a.length - 1 ? "pb-3 mb-3" : ""}" style="${i !== a.length - 1 ? "border-bottom: var(--bs-card-border-width) solid var(--bs-card-border-color)" : ""}">
                    <div class="col-md-6 col-xxl-4">
                        <div class="form-group mb-2">
                            <label class="fw-semibold">Proposal Code</label>
                            <p class="mb-0">${p.code || "-"}</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-xxl-4">
                        <div class="form-group mb-2">
                            <label class="fw-semibold">Proposal Status</label>
                            <p class="mb-0">${p.status ? getProposalStatus(p.status) : "-"}</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-xxl-4">
                        <div class="form-group mb-2">
                            <label class="fw-semibold">Sales Code</label>
                            <p class="mb-0">${p.sales_code || "-"}</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-xxl-4">
                        <div class="form-group mb-2">
                            <label class="fw-semibold">Created</label>
                            <p class="mb-0">${p.created_at ? formatDate(p.created_at) : "-"}</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-xxl-4">
                        <div class="form-group mb-2">
                            <label class="fw-semibold">Last Updated</label>
                            <p class="mb-0">${p.updated_at ? formatDate(p.updated_at) : "-"}</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-xxl-4">
                        <div class="form-group mb-2">
                            <label class="fw-semibold">Invoice(s)</label>
                            <p class="mb-0">${invoices}</p>
                        </div>
                    </div>
                    ${noteField}
                    <div class="col-md-12 mt-3 d-flex justify-content-end">
                        <a 
                            href="/proposals/${p.id}"
                            class="btn btn-sm btn-outline-info me-2"
                        >
                            <i class="ti ti-eye" style="font-size: 1.25rem"></i>
                        </a>
                        ${conditionalActions}
                    </div>
                </div>
            `;
        });
        
        $('#proposals_section .card-body').html(proposalList.length ? proposalList : "No Proposals Found!");
    }

    function getStatusClass(status) {
        switch(status) {
            case 'Active': return 'badge-pill badge-status bg-success';
            case 'Inactive': return 'badge-pill badge-status bg-dark';
            default: return 'badge-pill badge-status bg-secondary';
        }
    }

    function getProposalStatus (status){
        switch (status) {
            case 'Draft': return '<span class="badge badge-status bg-secondary">Draft</span>';
            case 'Submitted': return '<span class="badge badge-status bg-info">Submitted</span>';
            case 'Win': return '<span class="badge badge-status bg-success">Win</span>';
            case 'Lose': return '<span class="badge badge-status bg-danger">Lose</span>';
            case 'Cancelled': return '<span class="badge badge-status bg-dark">Cancelled</span>';
            default: return '<span class="badge badge-status bg-secondary">Unknown</span>';
        }
    }

    $(document).ready(function() {
        // Load project data and proposal
        loadProjectData(PROJECT_ID);
    });
</script>
<script src="/build/js/proposals/events.js"></script>
@endpush


