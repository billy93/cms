<?php $page = 'customers.detail'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content">

            <div class="row">
                <div class="col-md-12">
                    <!-- Customer Info Card -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Customer Information</h5>
                            <div class="d-flex gap-2">
                                <a href="/customers" class="btn btn-outline-secondary">
                                    <i class="ti ti-arrow-left me-1"></i>Back to Customers
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row" id="customer_info">
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Customer Code</label>
                                        <p class="mb-0">{{ $customer->code }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Status</label>
                                        <p class="mb-0">
                                            @if ($customer->status === 'Inactive')
                                                <span class="badge badge-status bg-secondary">Inactive</span>
                                            @elseif ($customer->status === 'Active')
                                                <span class="badge badge-status bg-success">Active</span>
                                            @else
                                                <span class="badge badge-status bg-secondary">{{ $customer->status ?? 'Unknown' }}</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Name</label>
                                        <p class="mb-0">{{ $customer->name }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Bank Name</label>
                                        <p class="mb-0">{{ $customer->bank_name ?? "-" }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Bank Acc. No.</label>
                                        <p class="mb-0">{{ $customer->bank_account_number ?? "-" }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Bank Acc. Name</label>
                                        <p class="mb-0">{{ $customer->bank_account_name ?? "-" }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Notes</label>
                                        <p class="mb-0">{{ $customer->notes ?? "-" }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Created</label>
                                        <p class="mb-0">{{ $customer->created_at ? formatDate($customer->created_at, 'd F Y') : "-" }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Updated</label>
                                        <p class="mb-0">{{ $customer->updated_at ? formatDate($customer->updated_at, 'd F Y') : "-" }}</p>
                                    </div>
                                </div>
                                <div class="mt-4 mb-2 d-flex justify-content-between align-items-center">
                                    <label class="fw-semibold">Billing Options</label>
                                    <button type="button" id="c_bill_addr_create_btn" class="btn btn-sm btn-primary">
                                        <i class="ti ti-square-rounded-plus me-1"></i>Add New Billing Address
                                    </button>
                                </div>
                                <div class="col-md-12 mb-4">
                                    <div class="table-responsive custom-table">
                                        <table class="table" id="billing_option_list" data-url="{{ route('billing-options.index') }}">
                                            <thead class="thead-light">
                                            <tr>
                                                <th class="td-break">Contact Person</th>
                                                <th class="td-break">Email</th>
                                                <th class="td-break">Phone (Off/Mob)</th>
                                                <th class="td-break">Address</th>
                                                <th class="td-break">Overseas</th>
                                                <th class="td-break">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                    <div class="row align-items-center" style="row-gap: 1em; padding: 10px 15px;">
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                                                <div class="billing_option_list_datatable_length"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 flex-grow-1">
                                            <div class="billing_option_list_datatable_paginate"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-2 mb-2">
                                    <label class="fw-semibold">Projects</label>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive custom-table">
                                        <table class="table" id="customer_project_list" data-url="{{ route('projects.index') }}">
                                            <thead class="thead-light">
                                            <tr>
                                                <th class="td-break">ID</th>
                                                <th class="td-break">Code</th>
                                                <th class="td-break">Name</th>
                                                <th class="td-break">Type</th>
                                                <th class="td-break">Status</th>
                                                <th class="td-break text-end">Value</th>
                                                <th class="td-break">Description</th>
                                                <th class="td-break">Created</th>
                                                <th class="td-break">Updated</th>
                                                <th class="td-break">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                    <div class="row align-items-center" style="row-gap: 1em; padding: 10px 15px;">
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                                                <div class="customer_project_list_datatable_length"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 flex-grow-1">
                                            <div class="customer_project_list_datatable_paginate"></div>
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
        const CUSTOMER_ID = @json($customer->id);
        document.addEventListener('DOMContentLoaded', function () {
            // Project List DataTable
            if ($('#customer_project_list').length > 0) {
                $('#customer_project_list').DataTable({
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
                        const $wrapper = $(settings.nTableWrapper);
                        $wrapper.find('.dataTables_paginate').appendTo('.customer_project_list_datatable_paginate');
                        $wrapper.find('.dataTables_length').appendTo('.customer_project_list_datatable_length');
                    },
                    ajax: {
                        url: $('#customer_project_list').data('url'),
                        type: "GET",
                        data: function (d) {
                            d.customer_id = CUSTOMER_ID;
                        },
                        dataSrc: function (json) {
                            return json.data;
                        }
                    },
                    columns: [
                        { data: 'id', visible: false },
                        { data: 'code' }, 
                        { data: 'name' }, 
                        { 
                            data: 'type',
                            render: function(data) {
                                if (data === 'FIT') return '<span class="badge bg-warning">FIT</span>';
                                return `<span class="badge bg-info">${data || 'Regular'}</span>`;
                            }
                        },
                        { 
                            data: 'status',
                            render: function(data) {
                                if (data === 'Active') return '<span class="badge bg-success">Active</span>';
                                return `<span class="badge bg-secondary">${data}</span>`;
                            }
                        }, 
                        { 
                            data: 'value',
                            className: 'text-end',
                        },
                        { data: 'description' }, 
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
                        { 
                            data: 'id',
                            name: 'view',
                            orderable: false,
                            searchable: false,
                            render: function(data) {
                                return `<a href="/projects/${data}" class="btn btn-sm btn-outline-info"><i class="ti ti-eye" style="color: inherit;"></i></a>`;
                            }
                        }
                    ],
                    columnDefs: [
                        {
                            targets: [5],
                            createdCell: function(td, cellData, rowData, row, col) {
                                $(td).css('white-space', 'normal');
                            }
                        }
                    ]
                });
            }
        });
    </script>
    @include('components.billing-options.create-modal')
    @include('components.billing-options.modal')

    <script src="/build/js/billing-options/events.js"></script>
    <script src="/build/js/billing-options/datatables.js"></script>
@endpush