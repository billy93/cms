<?php $page = 'projects.show'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div id="boq-container" data-url="{{ route('boqs.index') }}" style="display: none;"></div>
        <div class="content">

            <div class="row">
                <div class="col-md-12">

                    @component('components.breadcrumb')
                    @slot('title')
                    Proposal Detail
                    @endslot
                    @slot('item1')
                    Proposals
                    @endslot
                    @slot('item2')
                    proposal-detail
                    @endslot
                    @endcomponent

                    <!-- Proposal Info Card -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Proposal Information</h5>
                            <div class="d-flex gap-2">
                                <a href="/proposals" class="btn btn-outline-secondary">
                                    <i class="ti ti-arrow-left me-1"></i>Back to Proposals
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row" id="proposal_info">
                                <!-- Project info will be loaded here -->
                            </div>
                        </div>
                    </div>

                    <!-- BOQ Section -->
                    <div id="boqs_section" class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">BOQ Information</h5>
                            <div class="d-flex gap-2">
                                <a 
                                    href="javascript:void(0);" 
                                    id="c_append_boq" 
                                    class="btn btn-outline-primary" 
                                    data-bs-toggle="offcanvas" 
                                    data-bs-target="#append_boq_canvas"
                                >
                                    <i class="ti ti-square-rounded-plus me-2"></i>Add Existing BOQ
                                </a>
                                <a 
                                    href="javascript:void(0);" 
                                    id="c_boq_add" 
                                    class="btn btn-primary" 
                                    data-bs-toggle="offcanvas" 
                                    data-bs-target="#offcanvas_add"
                                >
                                    <i class="ti ti-square-rounded-plus me-2"></i>Create BOQ
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
							<div class="table-responsive custom-table">
                                <table class="table" id="boq_list" data-url="{{ route('proposals.show', $proposal->id) }}">
									<style>
										#boq_list th, 
										#boq_list td {
												padding: 12px 30px;
										} 
										#boq_list tbody tr td {
											vertical-align: baseline;
										}
										#boq_list thead tr th {
											text-align: center !important;
										}
										#boq_list .td-break {
											text-align: left !important;
											word-break: auto-phrase;
											white-space: unset !important;
										}
										.desc-col {
											max-width: 300px
										}
									</style>
									<thead class="thead-light">
                                        <tr>
                                            <!-- Kolom selain Items, rowspan 2 -->
                                            <th class="td-break" rowspan="2">ID</th>
                                            <th class="td-break" rowspan="2">BOQ Code</th>
                                            <th class="td-break" rowspan="2">BOQ Type</th>
                                            <th class="td-break" rowspan="2">Description</th>
                                            <th class="td-break" rowspan="2">Created</th>

                                            <!-- Super-header Items, span 8 kolom -->
                                            <th colspan="8">Items</th>

                                            <!-- Kolom lain yang rowspan 2 -->
                                            <th class="td-break" rowspan="2">Basic Price</th>
                                            <th class="td-break" rowspan="2">Management Fee</th>
                                            <th class="td-break" rowspan="2">Sales Amount</th>
                                            <th class="td-break" rowspan="2">VAT Rate</th>
                                            <th class="td-break" rowspan="2">VAT</th>
                                            <th class="td-break" rowspan="2">Invoice Amount</th>
                                            <th class="td-break" rowspan="2" class="no-sort">Action</th>
                                        </tr>
                                        
                                        <tr>
                                            <!-- Sub-header untuk Items (harus 8 kolom) -->
                                            <th>Header</th>
                                            <th>Subheader</th>
                                            <th>Unit Price</th>
                                            <th>Title1</th>
                                            <th>Title2</th>
                                            <th>Title3</th>
                                            <th>Title4</th>
                                            <th>Multiplier</th> <!-- ini sesuai columns: 'multiplier_total' -->
                                        </tr>
									</thead>
									<tbody>
											<!-- Data akan di-load via AJAX DataTable -->
									</tbody>
								</table>
							</div>
							<div class="row align-items-center" style="row-gap: 1em;">
								<div class="col-md-6">
									<div class="d-flex align-items-center justify-content-center justify-content-md-start">
										<div class="datatable-info"></div>
										<div class="table-boq-length"></div>
									</div>
								</div>
								<div class="col-md-6 flex-grow-1">
									<div class="table-boq-paginate"></div>
								</div>
							</div>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->

    <!-- Append Boq -->
	<div class="offcanvas offcanvas-end offcanvas-large" tabindex="-1" id="append_boq_canvas" style="width: 998px !important;">
        <div class="offcanvas-header border-bottom">
            <h4 id="tes">Add Existing BOQ</h4>
            <button type="button" class="btn-close custom-btn-close border p-1 me-0 d-flex align-items-center justify-content-center rounded-circle" data-bs-dismiss="offcanvas" aria-label="Close">
                <i class="ti ti-x"></i>
            </button>
        </div>
        <div class="offcanvas-body">
            <style>
                #c_append_boq_form th,
                #c_append_boq_form td {
                        padding: 12px 30px;
                }
                #c_append_boq_form tbody tr td {
                    vertical-align: baseline;
                }
                #c_append_boq_form thead tr th {
                    text-align: center !important;
                }
                #c_append_boq_form .td-break {
                    text-align: left !important;
                    word-break: auto-phrase;
                    white-space: unset !important;
                }
                .desc-col {
                    max-width: 300px
                }
                #c_append_boq_form #selected-append-boq {
                    display: flex;  
                    list-style: none;
                    gap: 6px; 
                    margin-bottom: 24px;
                }
                #c_append_boq_form .selected-tag {
                    padding: 4px 6px;  
                    border-radius: 3px;
                    background: #e41f07;
                    color: #fff;
                }
                #c_append_boq_form .no-selected-tag {
                    padding: 4px;  
                    color: #6f6f6f;
                }
            </style>
            <form id="c_append_boq_form" method="POST"></form>
        </div>
    </div>
    <!-- /Append Boq -->
    
    <!-- Add New Boq -->
	<div class="offcanvas offcanvas-end offcanvas-large" tabindex="-1" id="offcanvas_add" style="width: 998px !important;">
        <div class="offcanvas-header border-bottom">
            <h4 id="boq_form_title">Create BOQ</h4>
            <button type="button" id="close_boq_form" class="btn-close custom-btn-close border p-1 me-0 d-flex align-items-center justify-content-center rounded-circle" data-bs-dismiss="offcanvas" aria-label="Close">
                <i class="ti ti-x"></i>
            </button>
        </div>
        <div class="offcanvas-body">
            <style>
				#c_boq_form td { vertical-align: baseline; } 
			</style>
			<form id="c_boq_form" method="POST"></form>
        </div>
    </div>
    <!-- /Add New Boq -->
    
	<!-- Delete Modal -->
	<div class="modal fade" id="delete_boq_modal" tabindex="-1" aria-labelledby="deleteBoqModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="deleteBoqModalLabel">Confirm Delete</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					Are you sure you want to delete this item?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-danger" id="confirm_delete_boq">Delete</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Delete Modal -->

@endsection

@push('scripts')
<script>
    const PROPOSAL_ID = parseInt('{{ $proposal->id }}');

    function loadProposalData(id) {
        $.ajax({
            url: `/proposals/${id}`,
            method: 'GET',
            success: function(response) {
                if(response.success) {
                    console.log( response.data);
                    
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

    function renderProposalInfo(proposal) {
        const html = `
            <div class="col-md-6">
                <div class="form-group mb-2">
                    <label class="fw-semibold">PRoject Code:</label>
                    <p class="mb-0">${proposal.project.code || "-"}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-2">
                    <label class="fw-semibold">Proposal Code:</label>
                    <p class="mb-0">${proposal.code || "-"}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-2">
                    <label class="fw-semibold">Proposal Status:</label>
                    <p class="mb-0">${proposal.status ? getProposalStatus(proposal.status) : "-"}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-2">
                    <label class="fw-semibold">Type of Sales Code:</label>
                    <p class="mb-0">${proposal.type_of_sales_code || "-"}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-2">
                    <label class="fw-semibold">Sales Code:</label>
                    <p class="mb-0">${proposal.sales_code || "-"}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-2">
                    <label class="fw-semibold">Year of Sales:</label>
                    <p class="mb-0">${proposal.year_of_sales || "-"}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-2">
                    <label class="fw-semibold">Invoice No:</label>
                    <p class="mb-0">${proposal.invoice_no || "-"}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-2">
                    <label class="fw-semibold">Destination:</label>
                    <p class="mb-0">${proposal.destination || "-"}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-2">
                    <label class="fw-semibold">City:</label>
                    <p class="mb-0">${proposal.city || "-"}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-2">
                    <label class="fw-semibold">Activity:</label>
                    <p class="mb-0">${proposal.activity || "-"}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-2">
                    <label class="fw-semibold">Start Date:</label>
                    <p class="mb-0">${proposal.date_from ? formatDate(proposal.date_from) : "-"}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-2">
                    <label class="fw-semibold">End Date:</label>
                    <p class="mb-0">${proposal.date_to ? formatDate(proposal.date_to) : "-"}</p>
                </div>
            </div>
        `;
        
        $('#proposal_info').html(html);
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
        let selectedAppendBoqRow = [];
       
        loadProposalData(PROPOSAL_ID);

    });
</script>
<script src="/build/js/proposal_2_script.js"></script>
<script src="/build/js/boq_script.js"></script>
@endpush


