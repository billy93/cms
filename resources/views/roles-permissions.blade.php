<?php $page = 'roles-permissions'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content">

            <div class="row">
                <div class="col-md-12">

                    @component('components.breadcrumb')
                        @slot('title')
                            Roles
                        @endslot
                        @slot('item2')
                            roles-permissions
                        @endslot
                    @endcomponent

                    <div class="card">
                        <div class="card-header">
                            <!-- Search -->
                            <div class="row align-items-center">
                                <div class="col-sm-4">
                                    <div class="icon-form mb-3 mb-sm-0">
                                        <span class="form-icon"><i class="ti ti-search"></i></span>
                                        <input type="text" class="form-control" placeholder="Search Roles">
                                    </div>							
                                </div>		
                                <div class="col-sm-8">					
                                    <div class="text-sm-end">
                                        <a href="javascript:void(0);" id="c_role_add" class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_add_role"><i class="ti ti-square-rounded-plus me-2"></i>Add New Roles</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /Search -->
                        </div>
                        <div class="card-body">
                            <!-- Roles List -->
                            <div class="table-responsive custom-table">
                                <table class="table" id="roles_list" data-url="{{ route('roles.index') }}">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Role Name</th>
                                            <th>Description</th>
                                            <th>Created at</th>
                                            <th class="no-sort">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                            <div class="row align-items-center" style="row-gap: 1em;">
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

    <!-- Add Role -->
    <div class="offcanvas offcanvas-end offcanvas-large" tabindex="-1" id="offcanvas_add_role">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Add Role</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form action="{{ route('roles.create') }}" id="addRole">												
                @csrf
                @method('POST')
                        <div class="mb-3">
                            <label class="col-form-label">Role Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" required>
                            <div class="invalid-feedback d-flex" data-name="name"></div>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Description</label>
                            <input type="text" class="form-control" name="description">
                            <div class="invalid-feedback d-flex" data-name="description"></div>
                        </div>       
                    </div>
                    <div class="d-flex align-items-center justify-content-end mt-4">
                        <a href="javascript:void(0)" class="btn btn-light me-2" data-bs-dismiss="offcanvas">Cancel</a>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
        </div>
    </div>
    <!-- /Add Role -->

    <!-- Edit Role -->
    <div class="offcanvas offcanvas-end offcanvas-large" tabindex="-1" id="offcanvas_edit_role">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Edit Role</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form action="{{ route('roles.index') }}" id="editRole">												
                @csrf
                @method('PUT')
                        <div class="mb-3">
                            <label class="col-form-label">Role Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" required>
                            <div class="invalid-feedback d-flex" data-name="name"></div>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Description</label>
                            <input type="text" class="form-control" name="description">
                            <div class="invalid-feedback d-flex" data-name="description"></div>
                        </div>       
                    </div>
                    <div class="d-flex align-items-center justify-content-end mt-4">
                        <a href="javascript:void(0)" class="btn btn-light me-2" data-bs-dismiss="offcanvas">Cancel</a>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form> 
        </div>
    </div>
    <!-- /Edit Role -->

    <!-- Delete Role -->
	<div class="modal fade" id="delete_role_modal" role="dialog">
			<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
							<div class="modal-body">
									<div class="text-center">
											<div class="avatar avatar-xl bg-danger-light rounded-circle mb-3">
													<i class="ti ti-trash-x fs-36 text-danger"></i>
											</div>
											<h4 class="mb-2">Remove role?</h4>
											<p class="mb-0">Are you sure you want to remove it</p>
											<div class="d-flex align-items-center justify-content-center mt-4">
													<a href="#" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</a>
													<button type="button" id="trigger_delete_role" class="btn btn-danger">Yes, Delete it</button>
											</div>
									</div>
							</div>
					</div>
			</div>
	</div>
	<!-- /Delete Role -->

	<!-- Assign Menu -->
	<div class="offcanvas offcanvas-end offcanvas-large" tabindex="-1" id="offcanvas_assign_menu">
		<div class="offcanvas-header">
			<h5 class="offcanvas-title">Assign Menu to <span id="role_name_display"></span></h5>
			<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
		</div>
		<div class="offcanvas-body">
			<form id="assignMenuForm">
				@csrf
				<input type="hidden" id="assign_role_id" name="role_id">
				
				<div class="mb-3">
					<label class="col-form-label">Menu Hierarchy</label>
					<div class="menu-hierarchy" id="menu_hierarchy">
						<!-- Menu hierarchy will be loaded here -->
					</div>
				</div>
				
				<div class="d-flex justify-content-end">
					<button type="button" class="btn btn-light me-2" data-bs-dismiss="offcanvas">Cancel</button>
					<button type="submit" class="btn btn-primary">Save Assignment</button>
				</div>
			</form>
		</div>
	</div>
	<!-- /Assign Menu -->
      
    @component('components.model-popup')
    @endcomponent

@endsection
