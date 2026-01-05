<?php $page = 'products'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content">

            <div class="row">
                <div class="col-md-12">

                    @component('components.breadcrumb')
                        @slot('title')
                            Products
                        @endslot
                        @slot('item1')
                            Products
                        @endslot
                        @slot('item2')
                            products
                        @endslot
                    @endcomponent

                    <div class="card">
                        <div class="card-header">
                            <!-- Search -->
                            <div class="row align-items-center">
								<div class="col-sm-4">
									<form class="icon-form mb-3 mb-sm-0" id="c_product_list_search_form">
										<span class="form-icon"><i class="ti ti-search"></i></span>
										<input type="text" class="form-control" placeholder="Search Product" id="c_product_list_search_input">
									</form>							
								</div>		
                                <div class="col-sm-8">
                                    <div class="d-flex align-items-center flex-wrap row-gap-2 justify-content-sm-end">
                                        <div class="dropdown me-2">
                                            <a href="javascript:void(0);" class="dropdown-toggle" data-bs-toggle="dropdown"><i class="ti ti-package-export me-2"></i>Export</a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul>
                                                    <li>
                                                        <a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-file-type-pdf text-danger me-1"></i>Export as PDF</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-file-type-xls text-green me-1"></i>Export as Excel</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <a href="javascript:void(0);" id="c_product_create_btn" class="btn btn-primary"><i class="ti ti-square-rounded-plus me-2"></i>Add New Product</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /Search -->
                        </div>

                        <div class="card-body">
                            <!-- Filter -->
                            <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-2 mb-4">
                                <div class="d-flex align-items-center flex-wrap row-gap-2">
                                    <div class="dropdown me-2">
                                        <a href="javascript:void(0);" class="dropdown-toggle" data-bs-toggle="dropdown"><i class="ti ti-sort-ascending-2 me-2"></i>Sort</a>
                                        <div class="dropdown-menu dropdown-menu-start">
                                            <ul>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item sort-option" data-sort="asc">
                                                        <i class="ti ti-circle-chevron-right me-1"></i>Ascending
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item sort-option" data-sort="desc">
                                                        <i class="ti ti-circle-chevron-right me-1"></i>Descending
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item sort-option" data-sort="recent">
                                                        <i class="ti ti-circle-chevron-right me-1"></i>Recently Added
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center flex-wrap row-gap-2">
                                    <div class="view-icons">
                                        <a href="javascript:void(0);" class="active"><i class="ti ti-list-tree"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!-- /Filter -->

                            <!-- Products List -->
                            <div class="table-responsive custom-table">
								<table class="table" id="product_list" data-url="{{ route('products.index') }}">
                                    <style>
										#product_list tbody tr td {
											vertical-align: baseline;
										}
                                    </style>
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="td-break no-sort">
												<label class="checkboxs">
													<input type="checkbox" id="select_all_product_list">
													<span class="checkmarks"></span>
												</label>
											</th>
                                            <th>Name</th>
                                            <th>Unit</th>
                                            <th>Unit Price (IDR)</th>
                                            <th>Description</th>
                                            <th>Categories</th>
                                            <th>Supplier</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                            <!-- /Products List -->

                            <!-- Pagination -->
                            <div class="row align-items-center mt-2">
                                <div class="col-md-6">
                                    <div class="datatable-length"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="datatable-paginate"></div>
                                </div>
                            </div>
                            <!-- /Pagination -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->

	@include('components.products.create-modal')
	@include('components.products.modal')
@endsection

@push('scripts')
    <script>
        const HIDE_PRODUCT_DATATABLE_CHECKBOX = true;
    </script>
    <script src="/build/js/products/shared_var.js"></script>
    <script src="/build/js/products/datatables.js"></script>
    <script src="/build/js/products/events.js"></script>
@endpush
