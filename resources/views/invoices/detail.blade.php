<?php $page = 'invoices.detail'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content">

            <div class="row">
                <div class="col-md-12">

                    @component('components.breadcrumb')
                        @slot('title')
                            BOQ Detail
                        @endslot
                        @slot('item1')
                            BOQs
                        @endslot
                        @slot('item2')
                            boq-detail
                        @endslot
                    @endcomponent

                    <!-- Invoice Info Card -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Invoice Information</h5>
                            <div class="d-flex gap-2">
                                <a 
                                    href="/invoices/{{ $invoice->id }}/pdf"
                                    target="_blank"
                                    class="btn btn-outline-danger"
                                    title="Generate PDF"
                                >
                                    <i class="ti ti-file-type-pdf me-1"></i>Generate PDF
                                </a>
                                <a href="/invoices" class="btn btn-outline-secondary">
                                    <i class="ti ti-arrow-left me-1"></i>Back to Invoices
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row" id="boq_info">
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Proposal Code</label>
                                        <p class="mb-0">{{ $invoice->proposal?->code }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Invoice No.</label>
                                        <p class="mb-0">{{ $invoice->code }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Customer</label>
                                        <p class="mb-0">{{ $invoice->customer?->name }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Type</label>
                                        <p class="mb-0">
                                            @if ($invoice->type === 'Partial')
                                                <span class="badge badge-status bg-secondary">Partial</span>
                                            @elseif ($invoice->type === 'Full')
                                                <span class="badge badge-status bg-success">Full</span>
                                            @else
                                                <span class="badge badge-status bg-secondary">Unknown</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Status</label>
                                        <p class="mb-0">
                                            @if ($invoice->status === 'Unpaid')
                                                <span class="badge badge-status bg-secondary">Unpaid</span>
                                            @elseif ($invoice->status === 'Paid')
                                                <span class="badge badge-status bg-success">Paid</span>
                                            @elseif ($invoice->status === 'Cancelled')
                                                <span class="badge badge-status bg-dark">Cancelled</span>
                                            @else
                                                <span class="badge badge-status bg-secondary">Unknown</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Created</label>
                                        <p class="mb-0">{{ $invoice->created_at ? formatDate($invoice->created_at, 'j F Y') : "-" }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Updated</label>
                                        <p class="mb-0">{{ $invoice->updated_at ? formatDate($invoice->updated_at, 'j F Y') : "-" }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Due Date</label>
                                        <p class="mb-0">{{ $invoice->due_date ? formatDate($invoice->due_date, 'j F Y') : "-" }}</p>
                                    </div>
                                </div>
                                <!-- <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Ship To</label>
                                        <p class="mb-0">{{ $invoice->ship_to ?: "-" }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Bill To</label>
                                        <p class="mb-0">{{ $invoice->bill_to ?: "-" }}</p>
                                    </div>
                                </div> -->
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Basic Price Sum</label>
                                        <p class="mb-0">{{ $invoice->total_amount ? formatRupiah($invoice->total_amount) : "-" }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Management Fee</label>
                                        <p class="mb-0">
                                            {{ formatRupiah($invoice->management_fee) }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Sales Amount</label>
                                        <p class="mb-0">{{ $invoice->sales_amount ? formatRupiah($invoice->sales_amount) : "-" }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">VAT Amount</label>
                                        <p class="mb-0">{{ $invoice->vat_amount ? formatRupiah($invoice->vat_amount) : "-" }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Total Amount</label>
                                        <p class="mb-0 fw-bold">{{ $invoice->invoice_amount ? formatRupiah($invoice->invoice_amount) : "-" }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Note</label>
                                        <p class="mb-0 fw-bold">{{ $invoice->note ?? "-" }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Payment Method</label>
                                        <p class="mb-0">{{ $invoice->payment_method ?: "-" }}</p>
                                    </div>
                                </div>
                                <div class="form-group mb-2">
                                    <label class="fw-semibold">Items</label>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive custom-table">
                                        <table class="table" id="invoice_items_list">
                                            <thead class="thead-light">
                                                <th class="td-break">BOQ Code</th>
                                                <th class="td-break text-end">Basic Price</th>
                                            </tr>
                                            </thead>
                                            <tbody></tbody>
                                            <tfoot>
                                                <tr style="border-top: 2px solid #dee2e6; font-weight: bold;">
                                                    <td class="text-end" style="color: inherit;">Basic Price Sum</td>
                                                    <td class="text-end" style="color: inherit;">{{ formatRupiah($invoice->total_amount) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-end" style="color: inherit;">Management Fee</td>
                                                    <td class="text-end" style="color: inherit;">{{ formatRupiah($invoice->management_fee) }}</td>
                                                </tr>
                                                <tr style="font-weight: bold;">
                                                    <td class="text-end" style="color: inherit;">Sales Amount</td>
                                                    <td class="text-end" style="color: inherit;">{{ formatRupiah($invoice->sales_amount) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-end" style="color: inherit;">VAT Amount</td>
                                                    <td class="text-end" style="color: inherit;">{{ formatRupiah($invoice->vat_amount) }}</td>
                                                </tr>
                                                <tr style="font-weight: bold; border-top: 2px solid #dee2e6;">
                                                    <td class="text-end" style="color: inherit;">Total Amount</td>
                                                    <td class="text-end" style="color: inherit;">{{ formatRupiah($invoice->invoice_amount) }}</td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="row align-items-center" style="row-gap: 1em; padding: 10px 15px;">
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                                                <div class="invoice_items_list_datatable_length"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 flex-grow-1">
                                            <div class="invoice_items_list_datatable_paginate"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
           function initInvoicesDataTable(data) {
                const self = this;
                const $table = $(`#invoice_items_list`);
                const proposal = @json($invoice->proposal);

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
                        $wrapper.find('.dataTables_paginate').appendTo(`.invoice_items_list_datatable_paginate`);
                        $wrapper.find('.dataTables_length').appendTo(`.invoice_items_list_datatable_length`);
                    },
                    data,
                    columns: [
                        { data: 'code' },
                        {
                            data: 'total_amount_items',
                            className: 'text-end',
                            render: data => formatRupiahDisplay(data.toString().replace(".", ","))
                        },
                    ]
                });
            }
            initInvoicesDataTable(@json($invoice->boqs)); 
        });
    </script>    
@endpush