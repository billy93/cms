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

                    <!-- Proposal Section (Regular Only) -->
                    @if($project->type === 'Regular')
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
                    @endif

                    <!-- Invoice Section (For FIT Projects) -->
                    @if($project->type === 'FIT')
                    <div id="invoices_section">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Invoices</h5>
                                <div class="d-flex gap-2">
                                     <a 
                                        href="javascript:void(0);" 
                                        id="c_invoice_create_btn" 
                                        data-url="{{ route('projects.read', $project->id) }}"
                                        data-type="fit"
                                        class="btn btn-primary" 
                                    >
                                        <i class="ti ti-square-rounded-plus me-2"></i>Add New Invoice
                                    </a>
                                </div>
                            </div>
                            <style>
                                #invoices_section tfoot td {
                                    color: #6f6f6f;
                                    background-color: #fafafa;
                                    font-size: 14px;
                                }
                            </style>
                            <div class="card-body"></div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->

    @include('components.proposals.create-modal')
    @include('components.proposals.modal')
    @include('components.invoices.create-modal')
    @include('components.invoices.modal')
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
                    
                    if (response.data.type === 'FIT') {
                        // Section is rendered by Blade, just inject data
                        renderInvoiceInfo(response.data);
                    } else {
                        // Section is rendered by Blade, just inject data
                        renderProposalInfo(response.data);
                    }
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
                    <label class="fw-semibold">Project Type</label>
                    <p class="mb-0">${project.type === 'FIT' ? '<span class="badge bg-warning">FIT</span>' : '<span class="badge bg-primary">Regular</span>'}</p>
                </div>
            </div>
            ${project.type === 'FIT' ? `
            <div class="col-md-6 col-xxl-4">
                <div class="form-group mb-2">
                    <label class="fw-semibold">Sales Code</label>
                    <p class="mb-0 text-danger fw-bold">${project.sales_code || "-"}</p>
                </div>
            </div>` : ''}
            <div class="col-md-6 col-xxl-4">
                <div class="form-group mb-2">
                    <label class="fw-semibold">Ref. Doc. No.</label>
                    <p class="mb-0">${project.ref_doc_no || "-"}</p>
                </div>
            </div>
            <div class="col-md-6 col-xxl-4">
                <div class="form-group mb-2">
                    <label class="fw-semibold">Value</label>
                    <p class="mb-0">${project.value || "-"}</p>
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

    function renderInvoiceInfo(data) {
        // Invoices are loaded as data.invoices
        $('#invoices_section .card-body').empty(); // Clear first
        
        if (!data.invoices || data.invoices.length === 0) {
            $('#invoices_section .card-body').html('<p class="text-center">No invoices available.</p>');
            return;
        }

        const invoiceList = data.invoices.forEach((inv, i, a) => {
             const conditionalActions = inv.status !== "Paid" ? 
                `
                    <button 
                        class="btn btn-sm btn-secondary me-2 c_invoice_edit_btn"
                        data-url="/invoices/${inv.id}"
                        data-project_id="${data.id}"
                        data-proposal_id="${inv.proposal_id || ''}"
                    >
                        <i class="ti ti-edit" style="font-size: 1.25rem"></i>
                    </button>
                    <button 
                        class="btn btn-sm btn-danger c_invoice_delete_btn"
                        data-url="/invoices/${inv.id}"
                    >
                        <i class="ti ti-trash" style="font-size: 1.25rem"></i>
                    </button>
                ` :
                "";
                
            const feeLabelTable = inv.management_fee_type === 'percent' ? 
                    `Management Fee (${parseFloat(inv.management_fee || 0).toString().replace(".", ",")}%)` : 
                    "Management Fee (Rp)";

            const feeLabel = inv.management_fee_type === 'percent' ? 
                    `Management Fee (%)` : 
                    "Management Fee (Rp)";

            const html = `
                <div class="row ${i !== a.length - 1 ? "pb-3 mb-3" : ""}" style="${i !== a.length - 1 ? "border-bottom: var(--bs-card-border-width) solid var(--bs-card-border-color)" : ""}">
                    <div class="col-md-6 col-xxl-4">
                        <div class="form-group mb-2">
                            <label class="fw-semibold">Invoice Code</label>
                            <p class="mb-0">${inv.code || "-"}</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-xxl-4">
                        <div class="form-group mb-2">
                            <label class="fw-semibold">Invoice Number</label>
                            <p class="mb-0 text-primary fw-bold">${inv.invoice_number || "-"}</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-xxl-4">
                        <div class="form-group mb-2">
                            <label class="fw-semibold">Created</label>
                            <p class="mb-0">${inv.created_at ? formatDate(inv.created_at) : "-"}</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-xxl-4">
                        <div class="form-group mb-2">
                            <label class="fw-semibold">Updated</label>
                            <p class="mb-0">${inv.updated_at ? formatDate(inv.updated_at) : "-"}</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-xxl-4">
                        <div class="form-group mb-2">
                            <label class="fw-semibold">Due Date</label>
                            <p class="mb-0">${inv.due_date ? formatDate(inv.due_date) : "-"}</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-xxl-4">
                        <div class="form-group mb-2">
                            <label class="fw-semibold">Taxation</label>
                            <p class="mb-0">${inv.tax_type || "-"}</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-xxl-4">
                        <div class="form-group mb-2">
                            <label class="fw-semibold">Billing Type</label>
                            <p class="mb-0">${inv.billing_type ? getInvoiceType(inv.billing_type) : "-"}</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-xxl-4">
                        <div class="form-group mb-2">
                            <label class="fw-semibold">Status</label>
                            <p class="mb-0">${inv.status ? getInvoiceStatus(inv.status) : "-"}</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-xxl-4">
                        <div class="form-group mb-2">
                            <label class="fw-semibold">Bank Account</label>
                            <p class="mb-0">${inv.pcmi_bank && inv.pcmi_bank.bank ? `${inv.pcmi_bank.bank.bank_name} - ${inv.pcmi_bank.account_no}` : "-"}</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-xxl-4">
                        <div class="form-group mb-2">
                            <label class="fw-semibold">Basic Price</label>
                            <p class="mb-0">${formatRupiahDisplay(inv.total_amount?.toString().replace(".", ",") ?? 0) || "-"}</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-xxl-4">
                        <div class="form-group mb-2">
                            <label class="fw-semibold">${feeLabel}</label>
                            <p class="mb-0">${formatRupiahDisplay(inv.management_fee?.toString().replace(".", ",") ?? 0) || "-"}</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-xxl-4">
                        <div class="form-group mb-2">
                            <label class="fw-semibold">Sales Amount</label>
                            <p class="mb-0">${formatRupiahDisplay(inv.sales_amount?.toString().replace(".", ",") ?? 0) || "-"}</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-xxl-4">
                        <div class="form-group mb-2">
                            <label class="fw-semibold">Total Amount</label>
                            <p class="mb-0">${formatRupiahDisplay(inv.invoice_amount?.toString().replace(".", ",") ?? 0) || "-"}</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-xxl-4">
                        <div class="form-group mb-2">
                            <label class="fw-semibold">Payment Method</label>
                            <p class="mb-0">${inv.payment_method || "-"}</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-xxl-4">
                        <div class="form-group mb-2">
                            <label class="fw-semibold">Bill To</label>
                            <p class="mb-0">${inv.bill_to || "-"}</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-xxl-4 col-xxl-12">
                        <div class="form-group mb-2">
                            <label class="fw-semibold">Note</label>
                            <p class="mb-0">${inv.note || "-"}</p>
                        </div>
                    </div>
                    ${inv.proposal_id ? `
                    <div class="form-group mb-2">
                        <label class="fw-semibold">Items</label>
                    </div>
                    <div class="col-md-12">
                        <div class="table-responsive custom-table" style="border: 1px solid #e8e8e8; border-radius: 6px;">
                            <table class="table" id="invoice_items_${inv.id}">
                                <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Description</th>
                                    <th>Title 1</th>
                                    <th>Title 2</th>
                                    <th>Title 3</th>
                                    <th>Title 4</th>
                                    <th class="text-end">Unit Price</th>
                                    <th class="text-end">Total Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                    ${inv.items && inv.items.length ? inv.items.map((item, idx) => `
                                        <tr>
                                            <td>${idx + 1}</td>
                                            <td>${item.description || '-'}</td>
                                            <td>${item.title1_value || '-'}</td>
                                            <td>${item.title2_value || '-'}</td>
                                            <td>${item.title3_value || '-'}</td>
                                            <td>${item.title4_value || '-'}</td>
                                            <td class="text-end">${formatRupiahDisplay(item.selling_price?.toString().replace(".", ",") ?? 0)}</td>
                                            <td class="text-end">${formatRupiahDisplay(item.total_price?.toString().replace(".", ",") ?? 0)}</td>
                                        </tr>
                                    `).join('') : '<tr><td colspan="8" class="text-center">No items found</td></tr>'}
                                </tbody>
                                <tfoot>
                                    <tr class="fw-bold">
                                        <td colspan="7" class="text-end">Basic Price</td>
                                        <td class="text-end">${formatRupiahDisplay(inv.total_amount?.toString().replace(".", ",") ?? 0)}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="7" class="text-end">${feeLabelTable}</td>
                                        <td class="text-end">${formatRupiahDisplay(inv.management_fee?.toString().replace(".", ",") ?? 0)}</td>
                                    </tr>
                                    <tr class="fw-bold">
                                        <td colspan="7" class="text-end">Sales Amount</td>
                                        <td class="text-end">${formatRupiahDisplay(inv.sales_amount?.toString().replace(".", ",") ?? 0)}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="7" class="text-end">VAT (${parseFloat(inv.vat_rate || 0).toString().replace(".", ",")}%)</td>
                                        <td class="text-end">${formatRupiahDisplay(inv.vat_amount?.toString().replace(".", ",") ?? 0)}</td>
                                    </tr>
                                    <tr class="fw-bold text-primary">
                                        <td colspan="7" class="text-end">Total Amount</td>
                                        <td class="text-end">${formatRupiahDisplay(inv.invoice_amount?.toString().replace(".", ",") ?? 0)}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>` : `
                    <div class="col-md-12">
                         <div class="table-responsive custom-table" style="border: 1px solid #e8e8e8; border-radius: 6px;">
                            <table class="table" id="invoice_items_fit_${inv.id}">
                                <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Description</th>
                                    <th class="text-end">Unit Price</th>
                                    <th class="text-end">Total Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>${inv.description || '-'}</td>
                                        <td class="text-end">${formatRupiahDisplay(inv.total_amount?.toString().replace(".", ",") ?? 0)}</td>
                                        <td class="text-end">${formatRupiahDisplay(inv.total_amount?.toString().replace(".", ",") ?? 0)}</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr class="fw-bold">
                                        <td colspan="3" class="text-end">Basic Price</td>
                                        <td class="text-end">${formatRupiahDisplay(inv.total_amount?.toString().replace(".", ",") ?? 0)}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-end">${feeLabelTable}</td>
                                        <td class="text-end">${formatRupiahDisplay(inv.management_fee_amount?.toString().replace(".", ",") ?? 0)}</td>
                                    </tr>
                                    <tr class="fw-bold">
                                        <td colspan="3" class="text-end">Sales Amount</td>
                                        <td class="text-end">${formatRupiahDisplay(inv.sales_amount?.toString().replace(".", ",") ?? 0)}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-end">VAT (${parseFloat(inv.vat_rate || 0).toString().replace(".", ",")}%)</td>
                                        <td class="text-end">${formatRupiahDisplay(inv.vat_amount?.toString().replace(".", ",") ?? 0)}</td>
                                    </tr>
                                    <tr class="fw-bold text-primary">
                                        <td colspan="3" class="text-end">Total Amount</td>
                                        <td class="text-end">${formatRupiahDisplay(inv.invoice_amount?.toString().replace(".", ",") ?? 0)}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    `}

                    <div class="col-md-12 mt-3 d-flex justify-content-end">
                        <a 
                            href="/invoices/${inv.id}/pdf"
                            target="_blank"
                            class="btn btn-sm btn-outline-secondary me-2"
                            title="Generate PDF"
                        >
                            <i class="ti ti-file-type-pdf" style="font-size: 1.25rem"></i>
                        </a>
                        <a 
                            href="/invoices/${inv.id}"
                            class="btn btn-sm btn-outline-info me-2"
                        >
                            <i class="ti ti-eye" style="font-size: 1.25rem"></i>
                        </a>
                        ${conditionalActions}
                    </div>
                </div>
            `;
            
             $('#invoices_section .card-body').append(html);
        });
    }

    function formatCurrency(value) {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(value);
    }

    function getStatusClass(status) {
        switch(status) {
            case 'Active': return 'badge-pill badge-status bg-success';
            case 'Inactive': return 'badge-pill badge-status bg-dark';
            default: return 'badge-pill badge-status bg-secondary';
        }
    }

    function getInvoiceType(status) {
        switch (status) {
            case 'Partly Payment': return '<span class="badge badge-status bg-secondary">Partly Payment</span>';
            case 'Full Amount': return '<span class="badge badge-status bg-success">Full Amount</span>';
            default: return `<span class="badge badge-status bg-secondary">${status || 'Unknown'}</span>`;
        }
    }

    function getInvoiceStatus(status) {
        switch (status) {
            case 'PREPARED': return '<span class="badge badge-status bg-info">Prepared</span>';
            case 'SENT': return '<span class="badge badge-status bg-primary">Sent</span>';
            case 'REVISED': return '<span class="badge badge-status bg-warning">Revised</span>';
            case 'VOID': return '<span class="badge badge-status bg-danger">Void</span>';
            case 'Paid': return '<span class="badge badge-status bg-success">Paid</span>';
            default: return `<span class="badge badge-status bg-secondary">${status || 'Unknown'}</span>`;
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
<script src="/build/js/invoices/events.js"></script>
@endpush


