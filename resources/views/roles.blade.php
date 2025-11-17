<?php $page = 'roles'; ?>
@extends('layout.mainlayout')
@section('content')

    <!-- Permission & Menu Datatable url -->
    <div id="permission-route" data-url="{{ route('permissions.index') }}" style="display: none;"></div>
    <div id="menu-route" data-url="{{ route('menus.index') }}" style="display: none;"></div>
    
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
									<form class="icon-form mb-3 mb-sm-0" id="c_role_list_search_form">
										<span class="form-icon"><i class="ti ti-search"></i></span>
										<input type="text" class="form-control" placeholder="Search Role" id="c_role_list_search_input">
									</form>	
								</div>
                                <div class="col-sm-8">					
                                    <div class="text-sm-end">
                                        <a href="javascript:void(0);" id="c_role_create_btn" class="btn btn-primary"><i class="ti ti-square-rounded-plus me-2"></i>Add New Roles</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /Search -->
                        </div>
                        <div class="card-body">
                            <!-- Roles List -->
                            <div class="table-responsive custom-table">
                                <table class="table" id="role_list" data-url="{{ route('roles.index') }}">
                                    <thead class="thead-light">
                                        <tr>
											<th class="td-break no-sort">
												<label class="checkboxs">
													<input type="checkbox" id="select_all_role_list">
													<span class="checkmarks"></span>
												</label>
											</th>
                                            <th>Role Name</th>
                                            <th>Slug</th>
                                            <th>Description</th>
                                            <th>Created</th>
                                            <th>Updated</th>
                                            <th class="no-sort fit">Action</th>
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
                            <!-- /Roles List -->
                        </div>
					</div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->
     
    @include('components.roles.create-modal')
	@include('components.roles.modal')
@endsection

@push('scripts')
	<script>
		const HIDE_ROLE_DATATABLE_CHECKBOX = true;
	</script>
  <script src="/build/js/roles/shared_var.js"></script>
  <script src="/build/js/roles/datatables.js"></script>
  <script src="/build/js/roles/events.js"></script>
@endpush
