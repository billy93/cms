<?php $page = 'roles.detail'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content">

            <div class="row">
                <div class="col-md-12">

                    <!-- Role Info Card -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Role Information</h5>
                            <div class="d-flex gap-2">
                                <a href="/roles" class="btn btn-outline-secondary">
                                    <i class="ti ti-arrow-left me-1"></i>Back to Roles
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Name</label>
                                        <p class="mb-0">{{ $role->name }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Slug</label>
                                        <p class="mb-0">{{ $role->slug }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Created</label>
                                        <p class="mb-0">{{ $role->created_at ? formatDate($role->created_at, 'j F Y') : "-" }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Updated</label>
                                        <p class="mb-0">{{ $role->updated_at ? formatDate($role->updated_at, 'j F Y') : "-" }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Permission Info Card -->
                     <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Role Permissions</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive custom-table">
                                        <table class="table" id="role_permission_list" data-url="{{ route('permissions.index') }}">
                                            <thead class="thead-light">
                                            <tr>
                                                <th class="td-break">ID</th>
                                                <th class="td-break">Route Name</th>
                                                <th class="td-break">Method</th>
                                                <th class="td-break">Path</th>
                                                <th class="td-break">Description</th>
                                                <th class="td-break">Created</th>
                                                <th class="td-break">Updated</th>
                                            </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                    <div class="row align-items-center" style="row-gap: 1em; padding: 10px 15px;">
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                                                <div class="role_permission_list_datatable_length"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 flex-grow-1">
                                            <div class="role_permission_list_datatable_paginate"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Menu Access Info Card -->
                     <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Menu Access</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive custom-table">
                                        <table class="table" id="role_menu_list" data-url="{{ route('menus.index') }}">
                                            <style>
                                                #category_permission_list td {
                                                    vertical-align: baseline;
                                                }
                                            </style>
                                            <thead class="thead-light">
                                            <tr>
                                                <th class="td-break">ID</th>
                                                <th class="td-break">Name</th>
                                                <th class="td-break">Route Name</th>
                                                <th class="td-break">Method</th>
                                                <th class="td-break">Path</th>
                                                <th class="td-break">Icon</th>
                                                <th class="td-break">Created</th>
                                                <th class="td-break">Updated</th>
                                            </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                    <div class="row align-items-center" style="row-gap: 1em; padding: 10px 15px;">
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                                                <div class="role_menu_list_datatable_length"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 flex-grow-1">
                                            <div class="role_menu_list_datatable_paginate"></div>
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
            if ($('#role_permission_list').length > 0) {
                $('#role_permission_list').DataTable({
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
                        const $wrapper = $(settings.nTable).closest('.dataTables_wrapper');
                        $wrapper.find('.dataTables_paginate').appendTo('.role_permission_list_datatable_paginate');
                        $wrapper.find('.dataTables_length').appendTo('.role_permission_list_datatable_length');
                    },
                    ajax: {
                        url: $('#role_permission_list').data('url'),
                        type: "GET",
                        data: function (d) {
                            d.role_id = @json($role->id);
                        },
                        dataSrc: function (json) {
                            return json.data;
                        }
                    },
                    columns: [
                        { data: 'id', visible: false },
                        { data: 'route' },
                        {
                            data: 'method',
                            render: function (data, type) {
                                if (type === 'display') {
                                switch (data.toLowerCase()) {
                                    case 'post':
                                    case 'put':
                                    case 'patch':
                                    return `<span class="badge badge-status bg-secondary">${data}</span>`;
                                    case 'get': return `<span class="badge badge-status bg-success">${data}</span>`;
                                    case 'delete': return `<span class="badge badge-status bg-danger">${data}</span>`;
                                    default: return '<span class="badge badge-status bg-dark">Invalid</span>';
                                }
                                }
                                return data;
                            }
                        },
                        { data: 'path' },
                        { data: 'description' },
                        {
                            data: 'created_at',
                            render: function (data, type) {
                                return type === 'display' ? moment(data).format('DD MMM YYYY') : data;
                            }
                        },
                        {
                        data: 'updated_at',
                            render: function (data, type) {
                                return type === 'display' ? moment(data).format('DD MMM YYYY') : data;
                            }
                        },
                    ],
                    // columnDefs: [
                    //     {
                    //         targets: [4],
                    //         createdCell: function(td, cellData, rowData, row, col) {
                    //             $(td).css('white-space', 'normal');
                    //         }
                    //     }
                    // ]
                });
            }

            if ($('#role_menu_list').length > 0) {
                $('#role_menu_list').DataTable({
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
                        const $wrapper = $(settings.nTable).closest('.dataTables_wrapper');
                        $wrapper.find('.dataTables_paginate').appendTo('.role_menu_list_datatable_paginate');
                        $wrapper.find('.dataTables_length').appendTo('.role_menu_list_datatable_length');
                    },
                    ajax: {
                        url: $('#role_menu_list').data('url'),
                        type: "GET",
                        data: function (d) {
                            d.role_id = @json($role->id);
                        },
                        dataSrc: function (json) {
                            return json.data;
                        }
                    },
                    columns: [
                        { data: 'id', visible: false },
                        { data: 'name' },
                        { data: 'route' },
                        {
                            data: 'method',
                            render: function (data, type) {
                                if (type === 'display') {
                                switch (data.toLowerCase()) {
                                    case 'post':
                                    case 'put':
                                    case 'patch':
                                    return `<span class="badge badge-status bg-secondary">${data}</span>`;
                                    case 'get': return `<span class="badge badge-status bg-success">${data}</span>`;
                                    case 'delete': return `<span class="badge badge-status bg-danger">${data}</span>`;
                                    default: return '<span class="badge badge-status bg-dark">Invalid</span>';
                                }
                                }
                                return data;
                            }
                        },
                        { data: 'path' },
                        // { data: 'order_index' },
                        // {
                        //     data: 'is_visible',
                        //     render: function (data, type) {
                        //         if (type == "display") {
                        //         return data ? 'ON' : 'OFF';
                        //         }
                        //         return data
                        //     }
                        // },
                        {
                            data: 'icon',
                            render: function (data, type) {
                                return type === 'display' ? data ? `<div class="btn btn-sm btn-outline-info"><i class="${data}"></i></div>` : "" : data;
                            }
                        },
                        {
                            data: 'created_at',
                            render: function (data, type) {
                                return type === 'display' ? moment(data).format('DD MMM YYYY') : data;
                            }
                        },
                        {
                            data: 'updated_at',
                            render: function (data, type) {
                                return type === 'display' ? moment(data).format('DD MMM YYYY') : data;
                            }
                        },
                    ],
                });
            }
        }); 
    </script>    
@endpush