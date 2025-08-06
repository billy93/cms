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
                                        <a href="javascript:void(0);" id="c_role_add" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_role"><i class="ti ti-square-rounded-plus me-2"></i>Add New Roles</a>
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
    <div class="modal fade" id="add_role" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Role</h5>
                    <button class="btn-close custom-btn-close border p-1 me-0 text-dark" data-bs-dismiss="modal" aria-label="Close">	
                        <i class="ti ti-x"></i>
                    </button>
                </div>
                <form action="{{ route('roles.create') }}" id="addRole">							
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="col-form-label">Role Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" required>
                            <div class="invalid-feedback d-flex" data-name="name"></div>
                        </div>    
                        <div class="mb-3">
                            <label class="col-form-label">Slug <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="slug" readonly>
                            <div class="invalid-feedback d-flex" data-name="slug"></div>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Description</label>
                            <input type="text" class="form-control" name="description">
                            <div class="invalid-feedback d-flex" data-name="description"></div>
                        </div> 
                        <div class="mb-0">
                            <label class="col-form-label">Permissions</label>
                            <div class="row">
                                @foreach ($permissions as $permission)
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input
                                                type="checkbox"
                                                name="permission_ids[]"
                                                value="{{ $permission->id }}"
                                                class="form-check-input"
                                                id="add_perm_{{ $permission->id }}">
                                            <label class="form-check-label" for="add_perm_{{ $permission->id }}">
                                                {{ $permission->module }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="invalid-feedback d-flex" data-name="permission_ids"></div>
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
    <!-- /Add Role -->

    <!-- Edit Role -->
    <div class="modal fade" id="edit_role" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Role</h5>
                    <button class="btn-close custom-btn-close border p-1 me-0 text-dark" data-bs-dismiss="modal" aria-label="Close">	
                        <i class="ti ti-x"></i>
                    </button>
                </div>
                <form action="{{ route('roles.index') }}" id="editRole">							
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="col-form-label">Role Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" required>
                            <div class="invalid-feedback d-flex" data-name="name"></div>
                        </div>    
                        <div class="mb-3">
                            <label class="col-form-label">Slug <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="slug" readonly>
                            <div class="invalid-feedback d-flex" data-name="slug"></div>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Description</label>
                            <input type="text" class="form-control" name="description">
                            <div class="invalid-feedback d-flex" data-name="description"></div>
                        </div>
                        <div class="mb-0">
                            <label class="col-form-label">Permissions</label>
                            <div class="row" id="edit-permissions-container"></div>
                            <div class="invalid-feedback d-flex" data-name="permission_ids"></div>
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
      
    @component('components.model-popup')
    @endcomponent
    @push('scripts')
        <script>
        function slugify(text) {
            return text.toString().toLowerCase()
                .trim()
                .replace(/[^a-z0-9 -]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
        }

        $(document).ready(function () {
            $(document).on('input', '#addRole input[name="name"], #editRole input[name="name"]', function () {
                const $form = $(this).closest('form');
                const name = $(this).val();
                const slug = slugify(name);

                $form.find('input[name="slug"]').val(slug);
            });
        });
        </script>
    @endpush
@endsection
