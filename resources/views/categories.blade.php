<?php $page = 'categories'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <!-- Search -->
                            <div class="row align-items-center">
								<div class="col-sm-4">
									<form class="icon-form mb-3 mb-sm-0" id="c_category_list_search_form">
										<span class="form-icon"><i class="ti ti-search"></i></span>
										<input type="text" class="form-control" placeholder="Search Category" id="c_category_list_search_input">
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
										<a href="javascript:void(0);" id="c_category_create_btn" class="btn btn-primary"><i class="ti ti-square-rounded-plus me-2"></i>Create Category</a>
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

                            <!-- Categories List -->
                            <div class="table-responsive custom-table">
								<table class="table" id="category_list" data-url="{{ route('categories.index') }}">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="td-break no-sort">
												<label class="checkboxs">
													<input type="checkbox" id="select_all_category_list">
													<span class="checkmarks"></span>
												</label>
											</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                            <!-- /Categories List -->

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

	@include('components.categories.create-modal')
	@include('components.categories.modal')
@endsection

@push('scripts')
	<script>
		const HIDE_CATEGORY_DATATABLE_CHECKBOX = true;
	</script>
  <script src="/build/js/categories/shared_var.js"></script>
  <script src="/build/js/categories/datatables.js"></script>
  <script src="/build/js/categories/events.js"></script>
@endpush
