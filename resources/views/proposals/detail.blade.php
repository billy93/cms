<?php $page = 'proposals.detail'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
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
                                <button onclick="downloadPdf({{ $proposal->id }})" class="btn btn-outline-danger">
                                    <i class="ti ti-file-type-pdf me-1"></i>Download PDF
                                </button>
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

                    <!-- Pricing Info Card -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Pricing Details</h5>
                        </div>
                        <style>
                            #pricing_table tfoot td {
                                color: #6f6f6f;
                                background-color: #fafafa;
                                font-size: 14px;
                            }
                        </style>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered custom-table" id="pricing_table">
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
                                    <tbody id="pricing_items_body">
                                        <!-- Items loaded via JS -->
                                    </tbody>
                                    <tfoot id="pricing_totals_foot">
                                        <!-- Totals loaded via JS -->
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Invoices Info Card -->
                    <div id="invoices_section" class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Invoice Information</h5>
                            @if(strtolower($proposal->status) === "win" && $proposal->items->contains(fn($item) => $item->invoice_id === null))
                                <div class="d-flex gap-2">
                                    <a 
                                        href="javascript:void(0);" 
                                        id="c_invoice_create_btn" 
                                        class="btn btn-primary" 
                                        data-url="/proposals/{{ $proposal->id }}"
                                        <i class="ti ti-square-rounded-plus me-2"></i>Add Invoice
                                    </a>
                                </div>
                            @endif
                        </div>
                        <style>
                            #invoice_info tfoot td {
                                color: #6f6f6f;
                                background-color: #fafafa;
                                font-size: 14px;
                            }
                        </style>
                        <div class="card-body" id="invoice_info">
                            <!-- Project info will be loaded here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->

    @if(strtolower($proposal->status) === "win")
        @include('components.invoices.create-modal')
        @include('components.invoices.modal')
    @endif
@endsection

@push('scripts')
    <script>
        const PROPOSAL_ID = parseInt('{{ $proposal->id }}');
        const PROPOSAL_STATUS = '{{ $proposal->status }}';
        let PROPOSAL = {};

        function loadProposalData(id) {
            $.ajax({
                url: `/proposals/${id}`,
                method: 'GET',
                success: function(response) {
                    if(response.success) {
                        PROPOSAL = response.data;
                        
                        renderProposalInfo(response.data);
                        renderPricingInfo(response.data);
                        renderInvoicesInfo(response.data);
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
            
            const invoices = proposal.invoices?.length 
                ? "<ul>" + proposal.invoices.map(invoice => `<li>${invoice.code}</li>`).join("") + "</ul>" 
                : "-";

            const totalAmountItems = parseFloat(proposal.total_amount_items) || 0;
            console.log(proposal);
            
            const feeType = proposal.management_fee_type;
            const managementFee = feeType === 'percent' ? (parseFloat(proposal.management_fee) || 0) / 100 * totalAmountItems : parseFloat(proposal.management_fee) || 0;
            const salesAmount = totalAmountItems + managementFee;
            const vatAmount = (parseFloat(proposal.vat_rate) || 0) / 100 * salesAmount;
            const invoiceAmount = salesAmount + vatAmount;

            const feeLabel = feeType === 'percent' ? 
                `Management Fee (${parseFloat(proposal.management_fee || 0).toString().replace(".", ",")}%)` : 
                "Management Fee (Rp)";

            const html = `
                <div class="col-md-6 col-xxl-4">
                    <div class="form-group mb-2">
                        <label class="fw-semibold">Project Code</label>
                        <p class="mb-0">${proposal.project.code || "-"}</p>
                    </div>
                </div>
                <div class="col-md-6 col-xxl-4">
                    <div class="form-group mb-2">
                        <label class="fw-semibold">Proposal Code</label>
                        <p class="mb-0">${proposal.code || "-"}</p>
                    </div>
                </div>
                <div class="col-md-6 col-xxl-4">
                    <div class="form-group mb-2">
                        <label class="fw-semibold">Sales Code</label>
                        <p class="mb-0">${proposal.sales_code || "-"}</p>
                    </div>
                </div>
                <div class="col-md-6 col-xxl-4">
                    <div class="form-group mb-2">
                        <label class="fw-semibold">Pricing Model</label>
                        <p class="mb-0">${proposal.pricing_model || "-"}</p>
                    </div>
                </div>
                <div class="col-md-6 col-xxl-4">
                    <div class="form-group mb-2">
                        <label class="fw-semibold">Proposal Status</label>
                        <p class="mb-0">${proposal.status ? getProposalStatus(proposal.status) : "-"}</p>
                    </div>
                </div>
                <div class="col-md-6 col-xxl-4">
                    <div class="form-group mb-2">
                        <label class="fw-semibold">Created</label>
                        <p class="mb-0">${proposal.created_at ? formatDate(proposal.created_at) : "-"}</p>
                    </div>
                </div>
                <div class="col-md-6 col-xxl-4">
                    <div class="form-group mb-2">
                        <label class="fw-semibold">Updated</label>
                        <p class="mb-0">${proposal.updated_at ? formatDate(proposal.updated_at) : "-"}</p>
                    </div>
                </div>
                <div class="col-md-6 col-xxl-4">
                    <div class="form-group mb-2">
                        <label class="fw-semibold">Basic Price</label>
                        <p class="mb-0">${formatRupiahDisplay(totalAmountItems.toString().replace('.', ',') || 0)}</p>
                    </div>
                </div>
                 <div class="col-md-6 col-xxl-4">
                    <div class="form-group mb-2">
                        <label class="fw-semibold">${feeLabel}</label>
                        <p class="mb-0">${formatRupiahDisplay(managementFee?.toString().replace('.', ',') || 0)}</p>
                    </div>
                </div>
                <div class="col-md-6 col-xxl-4">
                    <div class="form-group mb-2">
                        <label class="fw-semibold">Sales Amount</label>
                        <p class="mb-0">${formatRupiahDisplay(salesAmount?.toString().replace('.', ',') || 0)}</p>
                    </div>
                </div>
                <div class="col-md-6 col-xxl-4">
                    <div class="form-group mb-2">
                        <label class="fw-semibold">VAT (${parseFloat(proposal.vat_rate || 0).toString().replace(".", ",")}%)</label>
                        <p class="mb-0">${formatRupiahDisplay(vatAmount?.toString().replace('.', ',') || 0)}</p>
                    </div>
                </div>
                 <div class="col-md-6 col-xxl-4">
                    <div class="form-group mb-2">
                        <label class="fw-semibold">Total Amount</label>
                        <p class="mb-0 text-primary fw-bold" style="font-size: 1.1em">${formatRupiahDisplay(invoiceAmount?.toString().replace('.', ',') || 0)}</p>
                    </div>
                </div>
                <div class="col-md-6 col-xxl-4">
                    <div class="form-group mb-2">
                        <label class="fw-semibold">Invoice(s)</label>
                        <p class="mb-0">${invoices}</p>
                    </div>
                </div>
                ${proposal.status?.toLowerCase() === "lose" ? 
                `<div class="col-md-12">
                    <div class="form-group mb-2">
                        <label class="fw-semibold">Note</label>
                        <p class="mb-0">${proposal.note || "-"}</p>
                    </div>
                </div>` : ""}
            `;
            
            $('#proposal_info').html(html);
        }

        function renderInvoicesInfo(proposal) {
            $('#invoice_info').empty();
            if(proposal.invoices.length === 0) {
                $('#invoice_info').html('<p class="text-center">No invoices available for this proposal.</p>');
                return;
            }

            proposal.invoices.forEach((invoice, i, a) => {
                const conditionalActions = invoice.status !== "Paid" ? 
                `
                    <button 
                        class="btn btn-sm btn-secondary me-2 c_invoice_edit_btn"
                        data-url="/invoices/${invoice.id}"
                        data-proposal_id="${proposal.id}"
                    >
                        <i class="ti ti-edit" style="font-size: 1.25rem"></i>
                    </button>
                    <button 
                        class="btn btn-sm btn-danger c_invoice_delete_btn"
                        data-url="/invoices/${invoice.id}"
                    >
                        <i class="ti ti-trash" style="font-size: 1.25rem"></i>
                    </button>
                ` :
                "";

                // Generate Items HTML (Logic copied from renderPricingInfo)
                let itemsHtml = "";
                if (!invoice.items || invoice.items.length === 0) {
                    itemsHtml = '<tr><td colspan="8" class="text-center">No items found</td></tr>';
                } else {
                     // Sort items by ID (assuming order is preserved or simplest sort)
                     // Note: renderPricingInfo sorts by ID. If we want Header Order we need header_order field which might not be on invoice items directly if they are just proposal items.
                     // Proposal items have header logic. Invoice items ARE proposal items.
                    const items = invoice.items.sort((a, b) => a.id - b.id);

                    // Grouping Logic
                    let grouped = {};
                    items.forEach(item => {
                        const h = item.header || "";
                        if (!grouped[h]) grouped[h] = [];
                        grouped[h].push(item);
                    });

                    let counter = 1;
                    let headerIndex = 0;

                    // Iterate grouped (Headers)
                    Object.keys(grouped).sort().forEach(header => {
                         const groupItems = grouped[header];
                         const headerLabel = String.fromCharCode(65 + headerIndex);
                         
                         // Show Header Row if header is not empty
                             if (header) {
                                 itemsHtml += `
                                    <tr style="background-color: #f2f2f2;">
                                        <td>${headerLabel}</td>
                                        <td colspan="7" class="fw-bold text-uppercase">${header}</td>
                                    </tr>
                                 `;
                             }

                         // Group by Subheader inside Header
                         let subGrouped = {};
                         groupItems.forEach(item => {
                             const sh = item.subheader || "";
                             if (!subGrouped[sh]) subGrouped[sh] = [];
                             subGrouped[sh].push(item);
                         });

                         let subheaderIndex = 1;
                         Object.keys(subGrouped).sort().forEach(subheader => {
                             const subItems = subGrouped[subheader];
                             const subheaderLabel = header ? `${headerLabel}.${subheaderIndex}` : '';
                             
                             // Show Subheader Row if subheader is not empty AND header is present
                             if (subheader && header) {
                                  itemsHtml += `
                                    <tr>
                                        <td>${subheaderLabel}</td>
                                        <td colspan="7" class="fst-italic" style="padding-left: 20px;">${subheader}</td>
                                    </tr>
                                 `;
                                 subheaderIndex++;
                             }

                             subItems.forEach(item => {
                                const t1 = item.title1_value ? `${item.title1_value} <span class="text-xs">${item.title1_key || ''}</span>` : '-';
                                const t2 = item.title2_value ? `${item.title2_value} <span class="text-xs">${item.title2_key || ''}</span>` : '-';
                                const t3 = item.title3_value ? `${item.title3_value} <span class="text-xs">${item.title3_key || ''}</span>` : '-';
                                const t4 = item.title4_value ? `${item.title4_value} <span class="text-xs">${item.title4_key || ''}</span>` : '-';
                                 
                                const desc = (!header && item.subheader) ? 
                                             `<strong>${item.subheader}</strong>` : 
                                             (item.description || item.product?.name || '-');

                                itemsHtml += `
                                    <tr>
                                        <td>${counter++}</td>
                                        <td>${desc}</td>
                                        <td>${t1}</td>
                                        <td>${t2}</td>
                                        <td>${t3}</td>
                                        <td>${t4}</td>
                                        <td class="text-end nowrap">${formatRupiahDisplay(item.selling_price?.toString().replace('.', ',') || 0)}</td>
                                        <td class="text-end nowrap">${formatRupiahDisplay(item.total_price?.toString().replace('.', ',') || 0)}</td>
                                    </tr>
                                `;
                             });
                         });

                         if (header) headerIndex++;
                    });
                }

                const feeLabel = proposal.management_fee_type === 'percent' ? 
                    `Management Fee (${parseFloat(proposal.management_fee || 0).toString().replace(".", ",")}%)` : "";
console.log("AA",invoice);

                const html = `
                    <div class="row ${i !== a.length - 1 ? "pb-3 mb-3" : ""}" style="${i !== a.length - 1 ? "border-bottom: var(--bs-card-border-width) solid var(--bs-card-border-color)" : ""}">
                        <div class="col-md-6 col-xxl-4">
                            <div class="form-group mb-2">
                                <label class="fw-semibold">Invoice No.</label>
                                <p class="mb-0">${invoice.invoice_number || "-"}</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-xxl-4">
                            <div class="form-group mb-2">
                                <label class="fw-semibold">Invoice Code</label>
                                <p class="mb-0">${invoice.code || "-"}</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-xxl-4">
                            <div class="form-group mb-2">
                                <label class="fw-semibold">Created</label>
                                <p class="mb-0">${invoice.created_at ? formatDate(invoice.created_at) : "-"}</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-xxl-4">
                            <div class="form-group mb-2">
                                <label class="fw-semibold">Updated</label>
                                <p class="mb-0">${invoice.updated_at ? formatDate(invoice.updated_at) : "-"}</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-xxl-4">
                            <div class="form-group mb-2">
                                <label class="fw-semibold">Due Date</label>
                                <p class="mb-0">${invoice.due_date ? formatDate(invoice.due_date) : "-"}</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-xxl-4">
                            <div class="form-group mb-2">
                                <label class="fw-semibold">Type</label>
                                <p class="mb-0">${invoice.billing_type ? getInvoiceType(invoice.billing_type) : "-"}</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-xxl-4">
                            <div class="form-group mb-2">
                                <label class="fw-semibold">Status</label>
                                <p class="mb-0">${invoice.status ? getInvoiceStatus(invoice.status) : "-"}</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-xxl-4">
                            <div class="form-group mb-2">
                                <label class="fw-semibold">Payment Status</label>
                                <p class="mb-0">${invoice.payment_status ? getPaymentStatus(invoice.payment_status) : "-"}</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-xxl-4">
                            <div class="form-group mb-2">
                                <label class="fw-semibold">Basic Price</label>
                                <p class="mb-0">${formatRupiahDisplay(invoice.total_amount?.toString().replace(".", ",") ?? 0) || "-"}</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-xxl-4">
                            <div class="form-group mb-2">
                                <label class="fw-semibold">Management Fee</label>
                                <p class="mb-0">${formatRupiahDisplay(invoice.management_fee?.toString().replace(".", ",") ?? 0) || "-"}</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-xxl-4">
                            <div class="form-group mb-2">
                                <label class="fw-semibold">Sales Amount</label>
                                <p class="mb-0">${formatRupiahDisplay(invoice.sales_amount?.toString().replace(".", ",") ?? 0) || "-"}</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-xxl-4">
                            <div class="form-group mb-2">
                                <label class="fw-semibold">Total Amount</label>
                                <p class="mb-0">${formatRupiahDisplay(invoice.invoice_amount?.toString().replace(".", ",") ?? 0) || "-"}</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-xxl-4">
                            <div class="form-group mb-2">
                                <label class="fw-semibold">Bill To</label>
                                <p class="mb-0">${invoice.customer?.name || "-"}</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-xxl-4">
                            <div class="form-group mb-2">
                                <label class="fw-semibold">Bank Account</label>
                                <p class="mb-0">${invoice.pcmi_bank?.bank?.bank_name || "-"} (${invoice.pcmi_bank?.holder_name || "-"} / ${invoice.pcmi_bank?.account_no || "-"})</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-xxl-4">
                            <div class="form-group mb-2">
                                <label class="fw-semibold">Note</label>
                                <p class="mb-0">${invoice.description || "-"}</p>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label class="fw-semibold">Items</label>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive custom-table" style="border: 1px solid #e8e8e8; border-radius: 6px;">
                                <table class="table" id="invoice_items_${invoice.id}">
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
                                    <tbody>${itemsHtml}</tbody>
                                    <tfoot>
                                        <tr class="fw-bold">
                                            <td colspan="7" class="text-end">Basic Price</td>
                                            <td class="text-end">${formatRupiahDisplay(invoice.total_amount?.toString().replace(".", ",") ?? 0)}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="7" class="text-end">${feeLabel}</td>
                                            <td class="text-end">${formatRupiahDisplay(invoice.management_fee_amount?.toString().replace(".", ",") ?? 0)}</td>
                                        </tr>
                                        <tr class="fw-bold">
                                            <td colspan="7" class="text-end">Sales Amount</td>
                                            <td class="text-end">${formatRupiahDisplay(invoice.sales_amount?.toString().replace(".", ",") ?? 0)}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="7" class="text-end">VAT (${formatRupiahDisplay((proposal.vat_rate || 0).toString().replace(".", ","))}%)</td>
                                            <td class="text-end">${formatRupiahDisplay(invoice.vat_amount?.toString().replace(".", ",") ?? 0)}</td>
                                        </tr>
                                        <tr class="fw-bold text-primary">
                                            <td colspan="7" class="text-end">Total Amount</td>
                                            <td class="text-end">${formatRupiahDisplay(invoice.invoice_amount?.toString().replace(".", ",") ?? 0)}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3 d-flex justify-content-end">
                            <a 
                                href="/invoices/${invoice.id}/pdf"
                                target="_blank"
                                class="btn btn-sm btn-outline-secondary me-2"
                                title="Generate PDF"
                            >
                                <i class="ti ti-file-type-pdf" style="font-size: 1.25rem"></i>
                            </a>
                            <a 
                                href="/invoices/${invoice.id}"
                                class="btn btn-sm btn-outline-info me-2"
                            >
                                <i class="ti ti-eye" style="font-size: 1.25rem"></i>
                            </a>
                            ${conditionalActions}
                        </div>
                    </div>
                `;

                $('#invoice_info').append(html);
            });
        }

        function getProposalStatus(status) {
            switch (status) {
                case 'Draft': return '<span class="badge badge-status bg-secondary">Draft</span>';
                case 'Submitted': return '<span class="badge badge-status bg-info">Submitted</span>';
                case 'Win': return '<span class="badge badge-status bg-success">Win</span>';
                case 'Lose': return '<span class="badge badge-status bg-danger">Lose</span>';
                case 'Cancelled': return '<span class="badge badge-status bg-dark">Cancelled</span>';
                default: return '<span class="badge badge-status bg-secondary">Unknown</span>';
            }
        }

        function getInvoiceType(status) {
            switch (status) {
                case 'Partly Payment': return '<span class="badge badge-status bg-secondary">Partial</span>';
                case 'Full Amount': return '<span class="badge badge-status bg-success">Full</span>';
                default: return `<span class="badge badge-status bg-secondary">${status || "Unknown"}</span>`;
            }
        }

        function getInvoiceStatus(status) {
            switch (status) {
                case 'PREPARED': return '<span class="badge badge-status bg-secondary">Prepared</span>';
                case 'SENT': return '<span class="badge badge-status bg-info">Sent</span>';
                case 'REVISED': return '<span class="badge badge-status bg-warning">Revised</span>';
                case 'VOID': return '<span class="badge badge-status bg-danger">Void</span>';
                default: return `<span class="badge badge-status bg-secondary">${status}</span>`;
            }
        }

        function getPaymentStatus(status) {
            switch (status) {
                case 'UNPAID': return '<span class="badge badge-status bg-secondary">Unpaid</span>';
                case 'PARTLY PAID': return '<span class="badge badge-status bg-info">Partly Paid</span>';
                case 'FULLY PAID': return '<span class="badge badge-status bg-success">Fully Paid</span>';
                default: return `<span class="badge badge-status bg-secondary">${status}</span>`;
            }
        }

        function renderPricingInfo(proposal) {
            const tbody = $('#pricing_items_body');
            const tfoot = $('#pricing_totals_foot');
            tbody.empty();
            tfoot.empty();

            if (!proposal.items || proposal.items.length === 0) {
                tbody.html('<tr><td colspan="8" class="text-center">No items found</td></tr>');
            } else {
                // Sort items by Header Order then ID for consistency
                const items = proposal.items.sort((a, b) => {
                   return a.id - b.id;
                });

                // Grouping Logic
                let grouped = {};
                items.forEach(item => {
                    const h = item.header || "";
                    if (!grouped[h]) grouped[h] = [];
                    grouped[h].push(item);
                });

                let rowHtml = "";
                let counter = 1;
                let headerIndex = 0;

                // Iterate grouped (Headers)
                Object.keys(grouped).sort().forEach(header => {
                     const groupItems = grouped[header];
                     const headerLabel = String.fromCharCode(65 + headerIndex);
                     
                     // Show Header Row if header is not empty
                         if (header) {
                             rowHtml += `
                                <tr style="background-color: #f2f2f2;">
                                    <td>${headerLabel}</td>
                                    <td colspan="7" class="fw-bold text-uppercase">${header}</td>
                                </tr>
                             `;
                         }

                     // Group by Subheader inside Header
                     let subGrouped = {};
                     groupItems.forEach(item => {
                         const sh = item.subheader || "";
                         if (!subGrouped[sh]) subGrouped[sh] = [];
                         subGrouped[sh].push(item);
                     });

                     let subheaderIndex = 1;
                     Object.keys(subGrouped).sort().forEach(subheader => {
                         const subItems = subGrouped[subheader];
                         const subheaderLabel = header ? `${headerLabel}.${subheaderIndex}` : '';
                         
                         // Show Subheader Row if subheader is not empty AND header is present
                         if (subheader && header) {
                              rowHtml += `
                                <tr>
                                    <td>${subheaderLabel}</td>
                                    <td colspan="7" class="fst-italic" style="padding-left: 20px;">${subheader}</td>
                                </tr>
                             `;
                             subheaderIndex++;
                         }

                         subItems.forEach(item => {
                            const t1 = item.title1_value ? `${item.title1_value} <span class="text-xs">${item.title1_key || ''}</span>` : '-';
                            const t2 = item.title2_value ? `${item.title2_value} <span class="text-xs">${item.title2_key || ''}</span>` : '-';
                            const t3 = item.title3_value ? `${item.title3_value} <span class="text-xs">${item.title3_key || ''}</span>` : '-';
                            const t4 = item.title4_value ? `${item.title4_value} <span class="text-xs">${item.title4_key || ''}</span>` : '-';
                             
                            const desc = (!header && item.subheader) ? 
                                         `<strong>${item.subheader}</strong>` : 
                                         (item.description || item.product?.name || '-');

                            rowHtml += `
                                <tr>
                                    <td>${counter++}</td>
                                    <td>${desc}</td>
                                    <td>${t1}</td>
                                    <td>${t2}</td>
                                    <td>${t3}</td>
                                    <td>${t4}</td>
                                    <td class="text-end nowrap">${formatRupiahDisplay(item.selling_price?.toString().replace('.', ',') || 0)}</td>
                                    <td class="text-end nowrap">${formatRupiahDisplay(item.total_price?.toString().replace('.', ',') || 0)}</td>
                                </tr>
                            `;
                         });
                     });

                     if (header) headerIndex++;
                });
                tbody.html(rowHtml);
            }

            // --- Totals ---
            const totalAmountItems = parseFloat(proposal.total_amount_items) || 0;
            const feeType = proposal.management_fee_type;
            const managementFee = feeType === 'percent' ? (parseFloat(proposal.management_fee) || 0) / 100 * totalAmountItems : parseFloat(proposal.management_fee) || 0;
            const salesAmount = totalAmountItems + managementFee;
            const vatAmount = (parseFloat(proposal.vat_rate) || 0) / 100 * salesAmount;
            const invoiceAmount = salesAmount + vatAmount;

            const feeLabel = feeType === 'percent' ? 
                             `Management Fee (${formatRupiahDisplay((proposal.management_fee || 0).toString().replace(".", ","))}%)` : 
                             "Management Fee (Rp)";

            const footHtml = `
                <tr class="fw-bold">
                    <td colspan="7" class="text-end">Basic Price</td>
                    <td class="text-end">${formatRupiahDisplay(totalAmountItems.toString().replace('.', ','))}</td>
                </tr>
                <tr>
                    <td colspan="7" class="text-end">Management Fee</td>
                    <td class="text-end">${formatRupiahDisplay(managementFee.toString().replace('.', ','))}</td>
                </tr>
                <tr class="fw-bold">
                    <td colspan="7" class="text-end">Sales Amount</td>
                    <td class="text-end">${formatRupiahDisplay(salesAmount.toString().replace('.', ','))}</td>
                </tr>
                <tr>
                    <td colspan="7" class="text-end">VAT (${formatRupiahDisplay((proposal.vat_rate || 0).toString().replace(".", ","))}%)</td>
                    <td class="text-end">${formatRupiahDisplay(vatAmount.toString().replace('.', ','))}</td>
                </tr>
                <tr class="fw-bold text-primary">
                    <td colspan="7" class="text-end">Total Amount</td>
                    <td class="text-end">${formatRupiahDisplay(invoiceAmount.toString().replace('.', ','))}</td>
                </tr>
            `;
            
            tfoot.html(footHtml);
        }

        $(document).ready(function() {
            let selectedBoqRow = [];
            loadProposalData(PROPOSAL_ID);
        });

        function downloadPdf(id) {
            // Show loading Toast
            showToast("info", "Generating PDF...");
            
            fetch(`/proposals/${id}/pdf`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/pdf, application/json' // Accept both
                }
            })
            .then(async response => {
                if (!response.ok) {
                    // Expect JSON error
                    const data = await response.json();
                    throw new Error(data.message || "Failed to generate PDF");
                }
                return response.blob();
            })
            .then(blob => {
                // Create object URL and open in new tab
                const url = window.URL.createObjectURL(blob);
                window.open(url, '_blank');
                
                // Cleanup after a delay
                setTimeout(() => window.URL.revokeObjectURL(url), 1000); // 1s delay
            })
            .catch(error => {
                showToast("error", error.message);
            });
        }
    </script>
    <script src="/build/js/boqs/shared_var.js"></script>
    <script src="/build/js/boqs/datatables.js"></script>
    <script src="/build/js/proposals/pricing_config.js"></script>

    @if(strtolower($proposal->status) === "win")
        <script src="/build/js/proposals/append_boqs.js"></script>
        <script src="/build/js/boqs/events.js"></script>
        <script src="/build/js/invoices/events.js"></script>
    @endif
@endpush





