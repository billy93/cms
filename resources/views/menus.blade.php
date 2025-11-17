<?php $page = 'menus'; ?>
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
									<form class="icon-form mb-3 mb-sm-0" id="c_menu_list_search_form">
										<span class="form-icon"><i class="ti ti-search"></i></span>
										<input type="text" class="form-control" placeholder="Search Menu" id="c_menu_list_search_input">
									</form>	
								</div>
                                <div class="col-sm-8">					
                                    <div class="text-sm-end">
                                        <a href="javascript:void(0);" id="c_menu_create_btn" class="btn btn-primary"><i class="ti ti-square-rounded-plus me-2"></i>Add New Menu</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /Search -->
                        </div>
                        <div class="card-body">
                            <!-- Permissions List -->
                            <div class="table-responsive custom-table">
                                <table class="table" id="menu_list" data-url="{{ route('menus.index') }}">
                                    <thead class="thead-light">
                                        <tr>
											<th class="td-break no-sort">
												<label class="checkboxs">
													<input type="checkbox" id="select_all_menu_list">
													<span class="checkmarks"></span>
												</label>
											</th>
                                            <th>Name</th>
                                            <th>Route Name</th>
                                            <th>Path</th>
                                            <th>Order Idx.</th>
                                            <th>Visibility</th>
                                            <th>Icon</th>
                                            <th>Created</th>
                                            <th>Updated</th>
                                            <th class="no-sort">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                            <div class="row align-items-center mt-2" style="row-gap: 1em;">
								<div class="col-md-6">
									<div class="d-flex align-items-center justify-content-center justify-content-md-start">
										<div class="datatable-info"></div>
										<div class="datatable-length"></div>
									</div>
								</div>
								<div class="col-md-6 flex-grow-1">
									<div class="datatable-paginate"></div>
								</div>
							</div>
                            <!-- /Permissions List -->
                        </div>
					</div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->
     
    @include('components.menus.create-modal')
	@include('components.menus.modal')
@endsection

@push('scripts')
	<script>
		const HIDE_MENU_DATATABLE_CHECKBOX = true;
	</script>
  <script src="/build/js/menus/shared_var.js"></script>
  <script src="/build/js/menus/datatables.js"></script>
  <script src="/build/js/menus/events.js"></script>
@endpush
