<?php $page = 'boqs.detail'; ?>
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

                    <!-- Proposal Info Card -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">BoQ Information</h5>
                            <div class="d-flex gap-2">
                                <a href="/boqs" class="btn btn-outline-secondary">
                                    <i class="ti ti-arrow-left me-1"></i>Back to BoQs
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row" id="boq_info">
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Proposal Code</label>
                                        <p class="mb-0">{{ $boq->proposal->code ?? '-' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Sales Code</label>
                                        <p class="mb-0">{{ $boq->proposal->sales_code ?? "-" }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">BoQ Code</label>
                                        <p class="mb-0">{{ $boq->code ?? '-' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Proposal Status</label>
                                        <p class="mb-0">
                                            @if (($boq->proposal->status ?? '') === 'Draft')
                                                <span class="badge badge-status bg-secondary">Draft</span>
                                            @elseif (($boq->proposal->status ?? '') === 'Submitted')
                                                <span class="badge badge-status bg-info">Submitted</span>
                                            @elseif (($boq->proposal->status ?? '') === 'Win')
                                                <span class="badge badge-status bg-success">Win</span>
                                            @elseif (($boq->proposal->status ?? '') === 'Lose')
                                                <span class="badge badge-status bg-danger">Lose</span>
                                            @elseif (($boq->proposal->status ?? '') === 'Cancelled')
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
                                        <p class="mb-0">{{ $boq->created_at ? formatDate($boq->created_at, 'd F Y') : "-" }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Updated</label>
                                        <p class="mb-0">{{ $boq->updated_at ? formatDate($boq->updated_at, 'd F Y') : "-" }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Grand Total</label>
                                        <p class="mb-0 fw-bold">{{ formatRupiah($boq->total_amount_items) }}</p>
                                    </div>
                                </div>
                                <div class="form-group mb-2">
                                    <label class="fw-semibold">Items</label>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive custom-table" style="border: 1px solid #e8e8e8; border-radius: 6px;">
                                        <table class="table" id="boq_detail_list" data-url="{{ route('boqs.read', $boq->id) }}">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th class="td-break">Name</th>
                                                    <th class="td-break">Description</th>
                                                    <th class="text-center">Qty</th>
                                                    <th class="text-center">Freq</th>
                                                    <th class="text-end">Unit Price</th>
                                                    <th class="text-end">Selling Price</th>
                                                    <th class="text-end">Total</th>
                                                    <th class="td-break">Created</th>
                                                    <th class="td-break">Updated</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody> 
                                        </table>
                                    </div>
                                    <div class="row align-items-center mt-2" style="row-gap: 1em;">
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                                                <div class="datatable-info"></div>
                                                <div class="table-boq-detail-length"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 flex-grow-1">
                                            <div class="table-boq-detail-paginate"></div>
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
        function initBoqItemsDataTable(data) {
            console.log(data);
            
            const self = this;
            const $table = $(`#boq_detail_list`);

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
                    $wrapper.find('.dataTables_paginate').appendTo('.table-boq-detail-paginate');
                    $wrapper.find('.dataTables_length').appendTo('.table-boq-detail-length');
                },
                data,
                columns: [
                    { 
                        data: null, 
                        title: 'Name',
                        render: function(data, type, row ) { return row.product?.name || ""; }
                    },
                    { data: 'description', title: 'Description' },
                    { 
                        data: null, 
                        title: 'Qty',
                        className: 'text-center',
                        render: function(data) { return data.qty + ' ' + (data.qty_unit || ''); }
                    },
                    { 
                        data: null, 
                        title: 'Freq',
                        className: 'text-center',
                        render: function(data) { return data.freq + ' ' + (data.freq_unit || ''); }
                    },
                    { 
                        data: null, 
                        title: 'Unit Price',
                        className: 'text-end',
                        render: function(data, type, row) { 
                            const price = row.product?.active_price_version?.price || 0;
                            return typeof formatRupiahDisplay === 'function' ? formatRupiahDisplay(price.toString().replace('.', ',')) : price;
                        }
                    },
                    { 
                        data: 'selling_price', 
                        title: 'Selling Price',
                        className: 'text-end',
                        render: function(data, type, row) { 
                        return typeof formatRupiahDisplay === 'function' ? formatRupiahDisplay(data.toString().replace('.', ',')) : data;
                        }
                    },
                    { 
                        data: 'total_price', 
                        title: 'Total',
                        className: 'text-end',
                        render: function(data, type, row) { 
                            return typeof formatRupiahDisplay === 'function' ? formatRupiahDisplay(data.toString().replace('.', ',')) : data;
                        }
                    },
                    {
                        data: 'created_at',
                        render: function (data, type, row) {
                            return type === 'display' ? moment(data).format('DD MMM YYYY') : data;
                        }
                    },
                    {
                        data: 'updated_at',
                        render: function (data, type, row) {
                            return type === 'display' ? moment(data).format('DD MMM YYYY') : data;
                        }
                    },
                ],
            });
        }
        
        initBoqItemsDataTable(@json($boq->items));
    });
</script>
@endpush
