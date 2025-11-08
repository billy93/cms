<?php $page = 'proposals.detail'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Used on proposal_2_script -->
        <div id="boq-route" data-url="{{ route('boqs.index') }}" style="display: none;"></div>
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
                            @if($proposal->status !== "Win")
                                <div class="d-flex gap-2">
                                    <a  
                                        class="btn btn-outline-primary" 
                                        id="c_boq_bulk_unbind_btn" 
                                        href="javascript:void(0);" 
                                        data-url="{{ route('boqs.unbindProposal') }}"
                                        style="display: none;"
                                    >
                                        <i class="ti ti-unlink me-2"></i> Unbind
                                    </a><a  
                                        class="btn btn-outline-primary" 
                                        id="c_boq_bulk_delete_btn" 
                                        href="javascript:void(0);" 
                                        data-url="{{ route('boqs.bulkDelete') }}"
                                        style="display: none;"
                                    >
                                        <i class="ti ti-trash me-2"></i> Delete
                                    </a>
                                    <a 
                                        href="javascript:void(0);" 
                                        id="c_append_boq_btn" 
                                        class="btn btn-outline-primary" 
                                    >
                                        <i class="ti ti-square-rounded-plus me-2"></i>Add Existing BOQ
                                    </a>
                                    <a 
                                        href="javascript:void(0);" 
                                        id="c_boq_create_btn" 
                                        class="btn btn-primary" 
                                    >
                                        <i class="ti ti-square-rounded-plus me-2"></i>Create BOQ
                                    </a>
                                </div>
                            @endif
                        </div>
                        <div class="card-body">
							<div class="table-responsive custom-table">
                                <table class="table" id="boq_list" data-url="{{ route('proposals.boqs', $proposal->id) }}">
									<style>
                                        #boq_list tr > th, 
                                        #boq_list tr > td {
                                            padding: 12px 30px;
                                        } 
                                        #boq_list tr > th:first-child, 
                                        #boq_list tr > td:first-child {
                                            left: 0;
                                            padding: 12px;
                                        } 
                                        #boq_list tr > td:first-child {
                                            position: sticky;
                                            z-index: 1;
                                            background-color: #fff; 
                                        } 
                                        #boq_list tr > td:first-child {
                                            position: sticky;
                                            z-index: 1;
                                            background-color: #fff; 
                                        } 
                                        #boq_list th:nth-child(2), 
                                        #boq_list td:nth-child(2) {
                                            padding-left: 0;
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
                                            <th class="td-break no-sort" rowspan="2" style="position: sticky; z-index: 1;">
                                                <label class="checkboxs">
                                                    <input type="checkbox" id="select_all_boq_list">
                                                    <span class="checkmarks"></span>
                                                </label>
                                            </th>
                                            <th class="td-break" rowspan="2">BOQ Code</th>
                                            <th class="td-break" rowspan="2">Sales Code</th>
                                            <th class="td-break" rowspan="2">BOQ Type</th>
                                            <th class="td-break" rowspan="2">Description</th>
                                            <th class="td-break" rowspan="2">Created</th>
                                            <th class="td-break" rowspan="2">Updated</th>
                                            <th colspan="8">Items</th>
                                            <th class="td-break" rowspan="2">Basic Price</th>
                                            <th class="td-break" rowspan="2">Management Fee</th>
                                            <th class="td-break" rowspan="2">Sales Amount</th>
                                            <th class="td-break" rowspan="2">VAT Rate</th>
                                            <th class="td-break" rowspan="2">VAT</th>
                                            <th class="td-break" rowspan="2">Invoice Amount</th>
                                            <th class="td-break" rowspan="2" class="no-sort">Action</th>
                                        </tr>
                                        <tr>
                                            <th>Header</th>
                                            <th>Subheader</th>
                                            <th>Unit Price</th>
                                            <th>Title1</th>
                                            <th>Title2</th>
                                            <th>Title3</th>
                                            <th>Title4</th>
                                            <th>Total</th> 
                                        </tr>
									</thead>
									<tbody>
                                        <!-- Data akan di-load via AJAX DataTable -->
									</tbody>
								</table>
							</div>
							<div class="row align-items-center mt-2" style="row-gap: 1em;">
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

                    <!-- Invoices Info Card -->
                    <div id="invoices_section" class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Invoice Information</h5>
                            @if($proposal->status === "Win" && $proposal->boqs->some(fn($boq) => $boq->invoice_id === null))
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
                        <div class="card-body" id="invoice_info">
                            <!-- Project info will be loaded here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->

    @if($proposal->status !== "Win")
        @include('components.boqs.create-modal')
        @include('components.boqs.modal')
        @include('components.proposals.append-boq-modal')
    @endif

    @if($proposal->status === "Win" && $proposal->boqs->some(fn($boq) => $boq->invoice_id === null))
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

            const noteField = proposal.status.toLowerCase() === "lose" ? 
                `<div class="col-md-6 col-xxl-4">
                    <div class="form-group mb-2">
                        <label class="fw-semibold">Invoice(s)</label>
                        <p class="mb-0">${proposal.note || "-"}</p>
                    </div>
                </div>` : "";

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
                        <label class="fw-semibold">Proposal Status</label>
                        <p class="mb-0">${proposal.status ? getProposalStatus(proposal.status) : "-"}</p>
                    </div>
                </div>
                <div class="col-md-6 col-xxl-4">
                    <div class="form-group mb-2">
                        <label class="fw-semibold">Invoice(s)</label>
                        <p class="mb-0">${invoices}</p>
                    </div>
                </div>
                ${noteField}
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

                const html = `
                    <div class="row ${i !== a.length - 1 ? "pb-3 mb-3" : ""}" style="${i !== a.length - 1 ? "border-bottom: var(--bs-card-border-width) solid var(--bs-card-border-color)" : ""}">
                        <div class="col-md-6 col-xxl-4">
                            <div class="form-group mb-2">
                                <label class="fw-semibold">Invoice No.</label>
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
                                <p class="mb-0">${invoice.type ? getInvoiceType(invoice.type) : "-"}</p>
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
                                <label class="fw-semibold">Total Amount</label>
                                <p class="mb-0">${formatRupiah(invoice.total_amount) || "-"}</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-xxl-4">
                            <div class="form-group mb-2">
                                <label class="fw-semibold">Payment Method</label>
                                <p class="mb-0">${invoice.payment_method || "-"}</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-xxl-4">
                            <div class="form-group mb-2">
                                <label class="fw-semibold">Note</label>
                                <p class="mb-0">${formatRupiah(invoice.note) || "-"}</p>
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
                                        <th class="td-break">BOQ Code</th>
                                        <th class="td-break">Basic Price</th>
                                        <th class="td-break">Management Fee</th>
                                        <th class="td-break">Sales Amount</th>
                                        <th class="td-break">VAT Rate</th>
                                        <th class="td-break">VAT</th>
                                        <th class="td-break">Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                            <div class="row align-items-center" style="row-gap: 1em; padding: 10px 15px;">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                                        <div class="invoice_items_${invoice.id}_length"></div>
                                    </div>
                                </div>
                                <div class="col-md-6 flex-grow-1">
                                    <div class="invoice_items_${invoice.id}_paginate"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3 d-flex justify-content-end">
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
                initInvoicesDataTable(invoice.id, invoice.boqs);
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
                case 'Partial': return '<span class="badge badge-status bg-secondary">Partial</span>';
                case 'Full': return '<span class="badge badge-status bg-success">Full</span>';
                default: return '<span class="badge badge-status bg-secondary">Unknown</span>';
            }
        }

        function getInvoiceStatus(status) {
            switch (status) {
                case 'Unpaid': return '<span class="badge badge-status bg-secondary">Unpaid</span>';
                case 'Paid': return '<span class="badge badge-status bg-success">Paid</span>';
                case 'Cancelled': return '<span class="badge badge-status bg-danger">Cancelled</span>';
                default: return '<span class="badge badge-status bg-secondary">Unknown</span>';
            }
        }

        function initInvoicesDataTable(id, data) {
            const self = this;
            const $table = $(`#invoice_items_${id}`);

            // 🔹 Kalau DataTable sudah ada → cuma update data-nya
            if ($.fn.DataTable.isDataTable($table)) {
            const dt = $table.DataTable();
            const currentPage = dt.page(); // simpan halaman sekarang

            dt.clear();
            dt.rows.add(data);
            dt.draw(false); // false = jangan reset pagination
            dt.page(currentPage).draw('page'); // balik ke halaman yang sama
            return; // selesai, gak usah reinit
            }

            // 🚀 Kalau belum ada → inisialisasi pertama kali
            $table.DataTable({
                bFilter: false,
                bInfo: false,
                ordering: true,
                order: [[0, "desc"]],
                language: {
                    search: ' ',
                    sLengthMenu: '_MENU_',
                    info: "_START_ - _END_ of _TOTAL_ items",
                    lengthMenu: "Show _MENU_ entries",
                    emptyTable: "No BOQs available for billing.",
                    paginate: {
                        next: 'Next <i class="fa fa-angle-right"></i>',
                        previous: '<i class="fa fa-angle-left"></i> Prev'
                    },
                },
                initComplete: function (settings, json) {
                    const $wrapper = $(settings.nTable).closest('.dataTables_wrapper');
                    $wrapper.find('.dataTables_paginate').appendTo(`.invoice_items_${id}_paginate`);
                    $wrapper.find('.dataTables_length').appendTo(`.invoice_items_${id}_length`);
                },
                data,
                columns: [
                    { data: 'code' },
                    {
                        data: 'total_amount_items',
                        render: data => formatRupiah(data)
                    },
                    {
                        data: 'management_fee',
                        orderable: false,
                        render: (data, type, row) => {
                            if (type === 'display') {
                            let amount = data;
                            if (row.management_fee_type === 'percent') {
                                amount = (row.total_amount_items * data) / 100;
                            }
                            return formatRupiah(amount);
                            }
                            return data;
                        }
                    },
                    {
                        data: 'sales_amount',
                        render: data => formatRupiah(data)
                    },
                    {
                        data: 'vat_rate',
                        render: (data, type) => (type === 'display' ? data + "%" : data)
                    },
                    {
                        data: 'vat',
                        render: data => formatRupiah(data)
                    },
                    {
                        data: 'invoice_amount',
                        render: data => formatRupiah(data)
                    },
                ]
            });
        }

        $(document).ready(function() {
            let selectedBoqRow = [];
            loadProposalData(PROPOSAL_ID);
        });
    </script>
    <script src="/build/js/boqs/shared_var.js"></script>
    <script src="/build/js/boqs/datatables.js"></script>

@if($proposal->status !== "Win")
    <script src="/build/js/proposals/append_boqs.js"></script>
    <script src="/build/js/boqs/events.js"></script>
@endif

@if($proposal->status === "Win" && $proposal->boqs->some(fn($boq) => $boq->invoice_id === null))
    <script src="/build/js/invoices/events.js"></script>
@endif
@endpush





