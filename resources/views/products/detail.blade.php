<?php $page = 'products.detail'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content">

            <div class="row">
                <div class="col-md-12">
                    <!-- Product Info Card -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Product Information</h5>
                            <div class="d-flex gap-2">
                                <a href="/products" class="btn btn-outline-secondary">
                                    <i class="ti ti-arrow-left me-1"></i>Back to Products
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row" id="boq_info">
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Supplier</label>
                                        <p class="mb-0">{{ $product->supplier?->name ?? "-" }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Product Code</label>
                                        <p class="mb-0">{{ $product->code ?? "-" }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Product Name</label>
                                        <p class="mb-0">{{ $product->name ?? "-" }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Unit</label>
                                        <p class="mb-0">{{ $product->unit ?? "-" }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Price</label>
                                        <p class="mb-0">{{ formatRupiah($product->activePriceVersion->price) ?? "-" }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Created</label>
                                        <p class="mb-0">{{ $product->created_at ? formatDate($product->created_at, 'd F Y') : "-" }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Updated</label>
                                        <p class="mb-0">{{ $product->updated_at ? formatDate($product->updated_at, 'd F Y') : "-" }}</p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Price History</label>
                                    </div>
                                    <div class="table-responsive custom-table" style="border: 1px solid #e8e8e8; border-radius: 6px;">
                                        <table class="table" id="price_version_list">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th class="td-break">Version</th>
                                                    <th class="text-end">Price</th>
                                                    <th class="text-end">Status</th>
                                                    <th class="text-end">Effective From</th>
                                                    <th class="text-end">Effective Until</th>
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
                                                <div class="table-price-version-length"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 flex-grow-1">
                                            <div class="table-price-version-paginate"></div>
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
        function initPriceVersionDataTable(data) {
            const $table = $('#price_version_list');

            if ($.fn.DataTable.isDataTable($table)) {
                const dt = $table.DataTable();
                dt.clear();
                dt.rows.add(data);
                dt.draw();
                return;
            }

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
                    emptyTable: "No price history available.",
                    paginate: {
                        next: 'Next <i class="fa fa-angle-right"></i>',
                        previous: '<i class="fa fa-angle-left"></i> Prev'
                    },
                },
                initComplete: function (settings, json) {
                    const $wrapper = $(settings.nTable).closest('.dataTables_wrapper');
                    $wrapper.find('.dataTables_paginate').appendTo('.table-price-version-paginate');
                    $wrapper.find('.dataTables_length').appendTo('.table-price-version-length');
                },
                data,
                columns: [
                    { 
                        data: 'version', 
                        title: 'Version',
                        render: function(data) { return 'v' + data; }
                    },
                    { 
                        data: 'price', 
                        title: 'Price',
                        className: 'text-end',
                        render: function(data) { 
                            return typeof formatRupiahDisplay === 'function' ? formatRupiahDisplay(data.toString().replace('.', ',')) : data;
                        }
                    },
                    { 
                        data: 'is_active', 
                        title: 'Status',
                        className: 'text-end',
                        render: function(data) {
                            if (data) {
                                return '<span class="badge bg-success">Active</span>';
                            }
                            return '<span class="badge bg-secondary">Inactive</span>';
                        }
                    },
                    { 
                        data: 'effective_from', 
                        title: 'Effective From',
                        className: 'text-end',
                        render: function(data) {
                            return data ? moment(data).format('DD MMM YYYY HH:mm') : '-';
                        }
                    },
                    { 
                        data: 'effective_until', 
                        title: 'Effective Until',
                        className: 'text-end',
                        render: function(data) {
                            return data ? moment(data).format('DD MMM YYYY HH:mm') : '-';
                        }
                    }
                ],
            });
        }
        
        initPriceVersionDataTable(@json($product->priceVersions));
        console.log(@json($product));
        
    });
</script>
@endpush
