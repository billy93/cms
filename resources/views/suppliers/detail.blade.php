<?php $page = 'suppliers.detail'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content">

            <div class="row">
                <div class="col-md-12">
                    <!-- Supplier Info Card -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Supplier Information</h5>
                            <div class="d-flex gap-2">
                                <a href="/suppliers" class="btn btn-outline-secondary">
                                    <i class="ti ti-arrow-left me-1"></i>Back to Suppliers
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row" id="boq_info">
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Supplier Code</label>
                                        <p class="mb-0">{{ $supplier->code }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Status</label>
                                        <p class="mb-0">
                                            @if ($supplier->status === 'Inactive')
                                                <span class="badge badge-status bg-secondary">Inactive</span>
                                            @elseif ($supplier->status === 'Active')
                                                <span class="badge badge-status bg-success">Active</span>
                                            @else
                                                <span class="badge badge-status bg-secondary">Unknown</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Name</label>
                                        <p class="mb-0">{{ $supplier->name }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Address</label>
                                        <p class="mb-0">{{ $supplier->address }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Contact Person</label>
                                        <p class="mb-0">{{ $supplier->contact_person }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Phone</label>
                                        <p class="mb-0">{{ $supplier->phone }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Email</label>
                                        <p class="mb-0">{{ $supplier->email }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Tax No.</label>
                                        <p class="mb-0">{{ $supplier->tax_number }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Bank Name</label>
                                        <p class="mb-0">{{ $supplier->bank_name }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Bank Acc. No.</label>
                                        <p class="mb-0">{{ $supplier->bank_account_number }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Bank Acc. Name</label>
                                        <p class="mb-0">{{ $supplier->bank_account_name }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Notes</label>
                                        <p class="mb-0">{{ $supplier->notes }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Created</label>
                                        <p class="mb-0">{{ $supplier->created_at ? formatDate($supplier->created_at, 'j F Y') : "-" }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Updated</label>
                                        <p class="mb-0">{{ $supplier->updated_at ? formatDate($supplier->updated_at, 'j F Y') : "-" }}</p>
                                    </div>
                                </div>
                                <div class="form-group mb-2">
                                    <label class="fw-semibold">Products</label>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive custom-table">
                                        <table class="table" id="supplier_product_list" data-url="{{ route('products.index') }}">
                                            <style>
                                                #supplier_product_list td {
                                                    vertical-align: baseline;
                                                }
                                            </style>
                                            <thead class="thead-light">
                                            <tr>
                                                <th class="td-break">ID</th>
                                                <th class="td-break">Name</th>
                                                <th class="td-break">Unit</th>
                                                <th class="td-break">Base Cost</th>
                                                <th class="td-break">Description</th>
                                                <th class="td-break">Created</th>
                                                <th class="td-break">Updated</th>
                                            </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                    <div class="row align-items-center mt-2" style="row-gap: 1em; padding: 10px 15px;">
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                                                <div class="supplier_product_list_datatable_length"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 flex-grow-1">
                                            <div class="supplier_product_list_datatable_paginate"></div>
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
            if ($('#supplier_product_list').length > 0) {
                $('#supplier_product_list').DataTable({
                    "serverSide": true,
                    "bFilter": false,
                    "bInfo": false,
                    "ordering": true,
                    "autoWidth": true,
                    "order": [[0, "desc"]],
                    "language": {
                        search: '',
                        sLengthMenu: '_MENU_',
                        searchPlaceholder: "Search",
                        info: "_START_ - _END_ of _TOTAL_ items",
                        "lengthMenu": "Show _MENU_ entries",
                        paginate: {
                        next: 'Next <i class="fa fa-angle-right"></i>',
                        previous: '<i class="fa fa-angle-left"></i> Prev'
                        },
                    },
                    initComplete: (settings, json) => {
                        $('.dataTables_paginate').appendTo('.supplier_product_list_datatable_paginate');
                        $('.dataTables_length').appendTo('.supplier_product_list_datatable_length');
                    },
                    ajax: {
                        url: $('#supplier_product_list').data('url'),
                        type: "GET",
                        data: function (d) {
                            d.supplier_id = @json($supplier->id);
                        },
                        dataSrc: function (json) {
                            return json.data;
                        }
                    },
                    columns: [
                        { data: 'id', visible: false },
                        { data: 'name' }, 
                        { data: 'unit' }, 
                        { data: 'base_cost' },
                        { data: 'description' }, 
                        {
                        data: 'created_at',
                            render: function (data, type, row) {
                                return type === 'display' ? moment(data).format('DD-MMM-YYYY') : data;
                            }
                        },
                        {
                        data: 'updated_at',
                            render: function (data, type, row) {
                                return type === 'display' ? moment(data).format('DD-MMM-YYYY') : data;
                            }
                        },
                    ],
                    columnDefs: [
                        {
                            targets: [4],
                            createdCell: function(td, cellData, rowData, row, col) {
                                $(td).css('white-space', 'normal');
                            }
                        }
                    ]
                });
            }
        }); 
    </script>
@endpush