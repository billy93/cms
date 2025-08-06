<?php $page = 'permission'; ?>
@extends('layout.mainlayout')
@section('content')
		<!-- Page Wrapper -->
		<div class="page-wrapper">
			<div class="content">

				<div class="row">
					<div class="col-md-12">

						<!-- Page Header -->
						<div class="page-header">
							<div class="row align-items-center">
								<div class="col-8">
									<h4 class="page-title">Permission</h4>
								</div>
								<div class="col-4 text-end">
									<div class="head-icons">
										<a href="{{url('permission')}}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Refresh"><i class="ti ti-refresh-dot"></i></a>
										<a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Collapse" id="collapse-header"><i class="ti ti-chevrons-up"></i></a>
									</div>
								</div>
							</div>
						</div>
						<!-- /Page Header -->

						<div class="card">
							<div class="card-header">
									<div class="row align-items-center">
											<div class="col-sm-4">
													<div class="icon-form mb-3 mb-sm-0">
															<span class="form-icon"><i class="ti ti-search"></i></span>
															<input type="text" class="form-control" placeholder="Search Permission">
													</div>							
											</div>		
											<div class="col-sm-8">					
													<div class="text-sm-end">
															<a href="javascript:void(0);" id="c_permission_add" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_permission"><i class="ti ti-square-rounded-plus me-2"></i>Add New Module</a>
													</div>
											</div>
									</div>
							</div>
							<div class="card-body">
								<!-- Roles List -->
								<div class="table-responsive custom-table">
									<table class="table" id="permission_list" data-url="{{ route('permissions.index') }}">
										<thead class="thead-light">
											<tr>
												<th>Module</th>
												<th>Description</th>
												<th>Created</th>
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
		 
		<!-- Add Permission -->
    <div class="modal fade" id="add_permission" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Permission</h5>
                    <button class="btn-close custom-btn-close border p-1 me-0 text-dark" data-bs-dismiss="modal" aria-label="Close">	
                        <i class="ti ti-x"></i>
                    </button>
                </div>
                <form action="{{ route('permissions.create') }}" id="addPermission">							
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="col-form-label">Module <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="module" required>
                            <div class="invalid-feedback d-flex" data-name="module"></div>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Description</label>
                            <input type="text" class="form-control" name="description">
                            <div class="invalid-feedback d-flex" data-name="description"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="d-flex align-items-center justify-content-end m-0">
                            <a href="javascript:void(0)" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</a>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>								
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Add Permission -->

    <!-- Edit Permission -->
    <div class="modal fade" id="edit_permission" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Permission</h5>
                    <button class="btn-close custom-btn-close border p-1 me-0 text-dark" data-bs-dismiss="modal" aria-label="Close">	
                        <i class="ti ti-x"></i>
                    </button>
                </div>
                <form action="{{ route('permissions.index') }}" id="editPermission">							
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="col-form-label">Module <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="module" required>
                            <div class="invalid-feedback d-flex" data-name="module"></div>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Description</label>
                            <input type="text" class="form-control" name="description">
                            <div class="invalid-feedback d-flex" data-name="description"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="d-flex align-items-center justify-content-end m-0">
                            <a href="javascript:void(0)" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</a>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>							
                    </div>
                </form> 
            </div>
        </div>
    </div>
    <!-- /Edit Permission -->

    <!-- Delete Permission -->
	<div class="modal fade" id="delete_permission_modal" role="dialog">
			<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
							<div class="modal-body">
									<div class="text-center">
											<div class="avatar avatar-xl bg-danger-light rounded-circle mb-3">
													<i class="ti ti-trash-x fs-36 text-danger"></i>
											</div>
											<h4 class="mb-2">Remove permission?</h4>
											<p class="mb-0">Are you sure you want to remove it</p>
											<div class="d-flex align-items-center justify-content-center mt-4">
													<a href="#" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</a>
													<button type="button" id="trigger_delete_permission" class="btn btn-danger">Yes, Delete it</button>
											</div>
									</div>
							</div>
					</div>
			</div>
	</div>
	<!-- /Delete Permission -->
@endsection