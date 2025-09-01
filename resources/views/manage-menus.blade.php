<?php $page = 'manage-menus'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content">

            <div class="row">
                <div class="col-md-12">

                    @component('components.breadcrumb')
                        @slot('title')
                            Menus
                        @endslot
                        @slot('item2')
                            manage-menus
                        @endslot
                    @endcomponent

                    <div class="card">
                        <div class="card-header">
                            <!-- Search -->
                            <div class="row align-items-center">
                                <div class="col-sm-4">
                                    <div class="icon-form mb-3 mb-sm-0">
                                        <span class="form-icon"><i class="ti ti-search"></i></span>
                                        <input type="text" class="form-control" placeholder="Search Menus" id="search_menus">
                                    </div>							
                                </div>		
                                <div class="col-sm-8">					
                                    <div class="text-sm-end">
                                        <a href="javascript:void(0);" id="c_menu_add" class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_add_menu"><i class="ti ti-square-rounded-plus me-2"></i>Add New Menu</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /Search -->
                        </div>
                        <div class="card-body">
                            <!-- Menus List -->
                            <div class="table-responsive custom-table">
                                <table class="table" id="menus_list" data-url="{{ route('menus.index') }}">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Label</th>
                                            <th>Path</th>
                                            <th>Icon</th>
                                            <th>Parent</th>
                                            <th>Sort</th>
                                            <th>Status</th>
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
                            <!-- /Menus List -->

                        </div>
					</div>

                </div>
            </div>

        </div>
    </div>
    <!-- /Page Wrapper -->

    <!-- Add Menu -->
    <div class="offcanvas offcanvas-end offcanvas-large" tabindex="-1" id="offcanvas_add_menu">
        <div class="offcanvas-header border-bottom">
            <h5 class="fw-semibold">Add New Menu</h5>
            <button type="button" class="btn-close custom-btn-close border p-1 me-0 d-flex align-items-center justify-content-center rounded-circle" data-bs-dismiss="offcanvas" aria-label="Close">
                <i class="ti ti-x"></i>
            </button>
        </div>
        <div class="offcanvas-body">
            <form action="{{ route('menus.create') }}" id="addMenu">							
                @csrf
                @method('POST')
                <div>
                        <div class="mb-3">
                            <label class="col-form-label">Menu Label <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="label" required>
                            <div class="invalid-feedback d-flex" data-name="label"></div>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Path <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="path" required>
                            <div class="invalid-feedback d-flex" data-name="path"></div>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Icon</label>
                            <input type="text" class="form-control" name="icon" placeholder="e.g., ti ti-home">
                            <div class="invalid-feedback d-flex" data-name="icon"></div>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Parent Menu</label>
                            <select class="form-select" name="parent_id">
                                <option value="">Select Parent Menu</option>
                                @foreach ($parentMenus as $parentMenu)
                                    <option value="{{ $parentMenu->id }}">{{ $parentMenu->label }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback d-flex" data-name="parent_id"></div>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Sort Order</label>
                            <input type="number" class="form-control" name="sort" value="0" min="0">
                            <div class="invalid-feedback d-flex" data-name="sort"></div>
                        </div>
                        <div class="mb-0">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="is_active" value="1" checked id="add_is_active">
                                <label class="form-check-label" for="add_is_active">
                                    Active
                                </label>
                            </div>
                            <div class="invalid-feedback d-flex" data-name="is_active"></div>
                        </div>       
                    </div>
                    <div class="d-flex align-items-center justify-content-end mt-4">
                        <a href="javascript:void(0)" class="btn btn-light me-2" data-bs-dismiss="offcanvas">Cancel</a>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
        </div>
    </div>
    <!-- /Add Menu -->

    <!-- Edit Menu -->
    <div class="offcanvas offcanvas-end offcanvas-large" tabindex="-1" id="offcanvas_edit_menu">
        <div class="offcanvas-header border-bottom">
            <h5 class="fw-semibold">Edit Menu</h5>
            <button type="button" class="btn-close custom-btn-close border p-1 me-0 d-flex align-items-center justify-content-center rounded-circle" data-bs-dismiss="offcanvas" aria-label="Close">
                <i class="ti ti-x"></i>
            </button>
        </div>
        <div class="offcanvas-body">
            <form action="{{ route('menus.index') }}" id="editMenu">							
                @csrf
                @method('PUT')
                <div>
                        <div class="mb-3">
                            <label class="col-form-label">Menu Label <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="label" required>
                            <div class="invalid-feedback d-flex" data-name="label"></div>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Path <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="path" required>
                            <div class="invalid-feedback d-flex" data-name="path"></div>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Icon</label>
                            <input type="text" class="form-control" name="icon" placeholder="e.g., ti ti-home">
                            <div class="invalid-feedback d-flex" data-name="icon"></div>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Parent Menu</label>
                            <select class="form-select" name="parent_id" id="edit_parent_id">
                                <option value="">Select Parent Menu</option>
                                @foreach ($parentMenus as $parentMenu)
                                    <option value="{{ $parentMenu->id }}">{{ $parentMenu->label }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback d-flex" data-name="parent_id"></div>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Sort Order</label>
                            <input type="number" class="form-control" name="sort" value="0" min="0">
                            <div class="invalid-feedback d-flex" data-name="sort"></div>
                        </div>
                        <div class="mb-0">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="is_active" value="1" id="edit_is_active">
                                <label class="form-check-label" for="edit_is_active">
                                    Active
                                </label>
                            </div>
                            <div class="invalid-feedback d-flex" data-name="is_active"></div>
                        </div>       
                    </div>
                    <div class="d-flex align-items-center justify-content-end mt-4">
                        <a href="javascript:void(0)" class="btn btn-light me-2" data-bs-dismiss="offcanvas">Cancel</a>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form> 
        </div>
    </div>
    <!-- /Edit Menu -->

    <!-- Delete Menu -->
	<div class="modal fade" id="delete_menu_modal" role="dialog">
			<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
							<div class="modal-body">
									<div class="text-center">
											<div class="avatar avatar-xl bg-danger-light rounded-circle mb-3">
													<i class="ti ti-trash-x fs-36 text-danger"></i>
											</div>
											<h4 class="mb-2">Remove menu?</h4>
											<p class="mb-0">Are you sure you want to remove it</p>
											<div class="d-flex align-items-center justify-content-center mt-4">
													<a href="#" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</a>
													<button type="button" id="trigger_delete_menu" class="btn btn-danger">Yes, Delete it</button>
											</div>
									</div>
							</div>
					</div>
			</div>
	</div>
	<!-- /Delete Menu -->
      
    @component('components.model-popup')
    @endcomponent

@endsection