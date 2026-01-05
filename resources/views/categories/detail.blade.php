<?php $page = 'categories.detail'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content">

            <div class="row">
                <div class="col-md-12">

                    <!-- Category Info Card -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Category Information</h5>
                            <div class="d-flex gap-2">
                                <a href="/categories" class="btn btn-outline-secondary">
                                    <i class="ti ti-arrow-left me-1"></i>Back to Categories
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Name</label>
                                        <p class="mb-0">{{ $category->name }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Description</label>
                                        <p class="mb-0">{{ $category->description }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Created</label>
                                        <p class="mb-0">{{ $category->created_at ? formatDate($category->created_at, 'j F Y') : "-" }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Updated</label>
                                        <p class="mb-0">{{ $category->updated_at ? formatDate($category->updated_at, 'j F Y') : "-" }}</p>
                                    </div>
                                </div>
                                <div class="form-group mb-2">
                                    <label class="fw-semibold">Products</label>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive custom-table">
                                        <table class="table" id="category_product_list" data-url="{{ route('products.index') }}">
                                            <style>
                                                #category_product_list td {
                                                    vertical-align: baseline;
                                                }
                                            </style>
                                            <thead class="thead-light">
                                            <tr>
                                                <th class="td-break">ID</th>
                                                <th class="td-break">Name</th>
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
                                                <div class="category_product_list_datatable_length"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 flex-grow-1">
                                            <div class="category_product_list_datatable_paginate"></div>
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
            if ($('#category_product_list').length > 0) {
                $('#category_product_list').DataTable({
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
                        $('.dataTables_paginate').appendTo('.category_product_list_datatable_paginate');
                        $('.dataTables_length').appendTo('.category_product_list_datatable_length');
                    },
                    ajax: {
                        url: $('#category_product_list').data('url'),
                        type: "GET",
                        data: function (d) {
                            d.category_id = @json($category->id);
                        },
                        dataSrc: function (json) {
                            return json.data;
                        }
                    },
                    columns: [
                        { data: 'id', visible: false },
                        { data: 'name' }, 
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