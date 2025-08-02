<?php $page = 'manage-users'; ?>
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
								<h4 class="page-title">User<span class="count-title">123</span></h4>
							</div>
							<div class="col-4 text-end">
								<div class="head-icons">
									<a href="{{url('manage-users')}}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Refresh"><i class="ti ti-refresh-dot"></i></a>
									<a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Collapse" id="collapse-header"><i class="ti ti-chevrons-up"></i></a>
								</div>
							</div>
						</div>
					</div>
					<!-- /Page Header -->

					<div class="card">
						<div class="card-header">
							<!-- Search -->
							<div class="row align-items-center">
								<div class="col-sm-4">
									<div class="icon-form mb-3 mb-sm-0">
										<span class="form-icon"><i class="ti ti-search"></i></span>
										<input type="text" class="form-control" placeholder="Search User">
									</div>							
								</div>		
								<div class="col-sm-8">					
									<div class="d-flex align-items-center flex-wrap row-gap-2 justify-content-sm-end">
										<div class="dropdown me-2">
											<a href="javascript:void(0);" class="dropdown-toggle"  data-bs-toggle="dropdown"><i class="ti ti-package-export me-2"></i>Export</a>
											<div class="dropdown-menu  dropdown-menu-end">
												<ul>
													<li>
														<a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-file-type-pdf text-danger me-1"></i>Export as PDF</a>
													</li>
													<li>
														<a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-file-type-xls text-green me-1"></i>Export as Excel </a>
													</li>
												</ul>
											</div>
										</div>	
										<a href="javascript:void(0);" id="c_user_add" class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_add"><i class="ti ti-square-rounded-plus me-2"></i>Add New User</a>
									</div>
								</div>
							</div>
							<!-- /Search -->
						</div>
						<div class="card-body">
							<!-- Filter -->
							<!-- <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-2 mb-4">
								<div class="d-flex align-items-center flex-wrap row-gap-2">
									<div class="dropdown me-2">
										<a href="javascript:void(0);" class="dropdown-toggle"  data-bs-toggle="dropdown"><i class="ti ti-sort-ascending-2 me-2"></i>Sort </a>
										<div class="dropdown-menu  dropdown-menu-start">
											<ul>
												<li>
													<a href="javascript:void(0);" class="dropdown-item">
														<i class="ti ti-circle-chevron-right me-1"></i>Ascending
													</a>
												</li>
												<li>
													<a href="javascript:void(0);" class="dropdown-item">
														<i class="ti ti-circle-chevron-right me-1"></i>Descending
													</a>
												</li>
												<li>
													<a href="javascript:void(0);" class="dropdown-item">
														<i class="ti ti-circle-chevron-right me-1"></i>Recently Viewed
													</a>
												</li>
												<li>
													<a href="javascript:void(0);" class="dropdown-item">
														<i class="ti ti-circle-chevron-right me-1"></i>Recently Added
													</a>
												</li>
											</ul>
										</div>
									</div>
									<div class="icon-form">
										<span class="form-icon"><i class="ti ti-calendar"></i></span>
										<input type="text" class="form-control bookingrange" placeholder="">
									</div>
								</div>
								<div class="d-flex align-items-center flex-wrap row-gap-2">
									<div class="dropdown me-2">
										<a href="javascript:void(0);" class="btn bg-soft-purple text-purple"  data-bs-toggle="dropdown"  data-bs-auto-close="outside"><i class="ti ti-columns-3 me-2"></i>Manage Columns</a>
										<div class="dropdown-menu  dropdown-menu-md-end dropdown-md p-3">
											<h4 class="mb-2 fw-semibold">Want to manage datatables?</h4>
											<p class="mb-3">Please drag and drop your column to reorder your table and enable see option as you want.</p>
											<div class="border-top pt-3">
												<div class="d-flex align-items-center justify-content-between mb-3">
													<p class="mb-0 d-flex align-items-center"><i class="ti ti-grip-vertical me-2"></i>Name</p>
													<div class="status-toggle">
														<input type="checkbox" id="col-name" class="check">
														<label for="col-name" class="checktoggle"></label>
													</div>
												</div>
												<div class="d-flex align-items-center justify-content-between mb-3">
													<p class="mb-0 d-flex align-items-center"><i class="ti ti-grip-vertical me-2"></i>Phone</p>
													<div class="status-toggle">
														<input type="checkbox" id="col-phone" class="check">
														<label for="col-phone" class="checktoggle"></label>
													</div>
												</div>
												<div class="d-flex align-items-center justify-content-between mb-3">
													<p class="mb-0 d-flex align-items-center"><i class="ti ti-grip-vertical me-2"></i>Email</p>
													<div class="status-toggle">
														<input type="checkbox" id="col-email" class="check">
														<label for="col-email" class="checktoggle"></label>
													</div>
												</div>
												<div class="d-flex align-items-center justify-content-between mb-3">
													<p class="mb-0 d-flex align-items-center"><i class="ti ti-grip-vertical me-2"></i>Location</p>
													<div class="status-toggle">
														<input type="checkbox" id="col-tag" class="check">
														<label for="col-tag" class="checktoggle"></label>
													</div>
												</div>
												<div class="d-flex align-items-center justify-content-between mb-3">
													<p class="mb-0 d-flex align-items-center"><i class="ti ti-grip-vertical me-2"></i>Created Date</p>
													<div class="status-toggle">
														<input type="checkbox" id="col-date" class="check">
														<label for="col-date" class="checktoggle"></label>
													</div>
												</div>
												<div class="d-flex align-items-center justify-content-between mb-3">
													<p class="mb-0 d-flex align-items-center"><i class="ti ti-grip-vertical me-2"></i>Last Activity</p>
													<div class="status-toggle">
														<input type="checkbox" id="col-activity" class="check">
														<label for="col-activity" class="checktoggle"></label>
													</div>
												</div>
												<div class="d-flex align-items-center justify-content-between mb-3">
													<p class="mb-0 d-flex align-items-center"><i class="ti ti-grip-vertical me-2"></i>Status</p>
													<div class="status-toggle">
														<input type="checkbox" id="col-status" class="check">
														<label for="col-status" class="checktoggle"></label>
													</div>
												</div>
												<div class="d-flex align-items-center justify-content-between mb-3">
													<p class="mb-0 d-flex align-items-center"><i class="ti ti-grip-vertical me-2"></i>Action</p>
													<div class="status-toggle">
														<input type="checkbox" id="col-action" class="check">
														<label for="col-action" class="checktoggle"></label>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="form-sorts dropdown">
										<a href="javascript:void(0);" data-bs-toggle="dropdown"  data-bs-auto-close="outside"><i class="ti ti-filter-share"></i>Filter</a>
										<div class="filter-dropdown-menu dropdown-menu  dropdown-menu-md-end p-3">
											<div class="filter-set-view">
												<div class="filter-set-head">
													<h4><i class="ti ti-filter-share"></i>Filter</h4>
												</div>
												<div class="accordion" id="accordionExample">
													<div class="filter-set-content">
														<div class="filter-set-content-head">
															<a href="#" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">Name</a>
														</div>
														<div class="filter-set-contents accordion-collapse collapse show" id="collapseTwo" data-bs-parent="#accordionExample">
															<div class="filter-content-list">
																<div class="mb-2 icon-form">
																	<span class="form-icon"><i class="ti ti-search"></i></span>
																	<input type="text" class="form-control" placeholder="Search Name">
																</div>
																<ul>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox" checked>
																				<span class="checkmarks"></span>
																				Darlee Robertson
																			</label>
																		</div>
																	</li>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox">
																				<span class="checkmarks"></span>
																				Sharon Roy
																			</label>
																		</div>
																	</li>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox">
																				<span class="checkmarks"></span>
																				Vaughan
																			</label>
																		</div>
																	</li>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox">
																				<span class="checkmarks"></span>
																				Jessica
																			</label>
																		</div>
																	</li>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox">
																				<span class="checkmarks"></span>
																				Carol Thomas
																			</label>
																		</div>
																	</li>
																</ul>
															</div>
														</div>
													</div>
													<div class="filter-set-content">
														<div class="filter-set-content-head">
															<a href="#" class="collapsed" data-bs-toggle="collapse" data-bs-target="#phone" aria-expanded="false" aria-controls="phone">Phone</a>
														</div>
														<div class="filter-set-contents accordion-collapse collapse" data-bs-parent="#accordionExample">
															<div class="filter-content-list">
																<ul>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox" checked>
																				<span class="checkmarks"></span>
																				+1 875455453
																			</label>
																		</div>
																	</li>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox" checked>
																				<span class="checkmarks"></span>
																				+1 989757485
																			</label>
																		</div>
																	</li>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox">
																				<span class="checkmarks"></span>
																				+1 546555455
																			</label>
																		</div>
																	</li>
																</ul>
															</div>
														</div>
													</div>
													<div class="filter-set-content">
														<div class="filter-set-content-head">
															<a href="#" class="collapsed" data-bs-toggle="collapse" data-bs-target="#email" aria-expanded="false" aria-controls="email">Email</a>
														</div>
														<div class="filter-set-contents accordion-collapse collapse" id="email" data-bs-parent="#accordionExample">
															<div class="filter-content-list">
																<ul>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox" checked>
																				<span class="checkmarks"></span>
																				robertson@example.com
																			</label>
																		</div>
																	</li>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox" checked>
																				<span class="checkmarks"></span>
																				sharon@example.com
																			</label>
																		</div>
																	</li>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox">
																				<span class="checkmarks"></span>
																				vaughan12@example.com
																			</label>
																		</div>
																	</li>
																</ul>
															</div>
														</div>
													</div>
													<div class="filter-set-content">
														<div class="filter-set-content-head">
															<a href="#" class="collapsed" data-bs-toggle="collapse" data-bs-target="#location" aria-expanded="false" aria-controls="location">Location</a>
														</div>
														<div class="filter-set-contents accordion-collapse collapse" id="location" data-bs-parent="#accordionExample">
															<div class="filter-content-list">
																<ul>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox" checked>
																				<span class="checkmarks"></span>
																				Germany
																			</label>
																		</div>
																	</li>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox" checked>
																				<span class="checkmarks"></span>
																				USA
																			</label>
																		</div>
																	</li>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox">
																				<span class="checkmarks"></span>
																				Canada
																			</label>
																		</div>
																	</li>
																</ul>
															</div>
														</div>
													</div>
													<div class="filter-set-content">
														<div class="filter-set-content-head">
															<a href="#" class="collapsed" data-bs-toggle="collapse" data-bs-target="#owner" aria-expanded="false" aria-controls="owner">Created Date</a>
														</div>
														<div class="filter-set-contents accordion-collapse collapse" id="owner" data-bs-parent="#accordionExample">
															<div class="filter-content-list">
																<ul>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox" checked>
																				<span class="checkmarks"></span>
																				25 Sep 2023, 12:12 pm
																			</label>
																		</div>
																	</li>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox" checked>
																				<span class="checkmarks"></span>
																				27 Sep 2023, 07:40 am
																			</label>
																		</div>
																	</li>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox">
																				<span class="checkmarks"></span>
																				29 Sep 2023, 08:20 am
																			</label>
																		</div>
																	</li>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox">
																				<span class="checkmarks"></span>
																				02 Oct 2023, 10:10 am
																			</label>
																		</div>
																	</li>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox">
																				<span class="checkmarks"></span>
																				17 Oct 2023, 04:25 pm
																			</label>
																		</div>
																	</li>
																</ul>
															</div>
														</div>
													</div>
													<div class="filter-set-content">
														<div class="filter-set-content-head">
															<a href="#" class="collapsed" data-bs-toggle="collapse" data-bs-target="#Status" aria-expanded="false" aria-controls="Status">Status</a>
														</div>
														<div class="filter-set-contents accordion-collapse collapse" id="Status" data-bs-parent="#accordionExample">
															<div class="filter-content-list">
																<ul>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox" checked>
																				<span class="checkmarks"></span>
																				Active
																			</label>
																		</div>
																	</li>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox" checked>
																				<span class="checkmarks"></span>
																				Inactive
																			</label>
																		</div>
																	</li>
																</ul>
															</div>
														</div>
													</div>
												</div>													
												<div class="filter-reset-btns">
													<div class="row">
														<div class="col-6">
															<a href="#" class="btn btn-light">Reset</a>
														</div>
														<div class="col-6">
															<a href="{{url('manage-users')}}" class="btn btn-primary">Filter</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								
								</div>
							</div> -->
							<!-- /Filter -->

							<!-- Manage Users List -->
							<div class="table-responsive custom-table">
								<table class="table" id="manage-users-list" data-url="{{ route('users.index') }}">
									<thead class="thead-light">
										<tr>
											<th>Name</th>
											<th>Email</th>
											<th>Phone</th>
											<th>Location</th>
											<th>Created</th>
											<th>Status</th>
											<th class="no-sort">Action</th>
										</tr>
									</thead>
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
							<!-- /Manage Users List -->

						</div>
					</div>

				</div>
			</div>

		</div>
	</div>
	<!-- /Page Wrapper -->

	<!-- Add User -->
	<div class="offcanvas offcanvas-end offcanvas-large" tabindex="-1" id="offcanvas_add">
		<div class="offcanvas-header border-bottom">
			<h5 class="fw-semibold">Add New User</h5>
			<button type="button" class="btn-close custom-btn-close border p-1 me-0 d-flex align-items-center justify-content-center rounded-circle" data-bs-dismiss="offcanvas" aria-label="Close">
					<i class="ti ti-x"></i>
			</button>
		</div>
		<div class="offcanvas-body">
			<form action="{{ route('users.create') }}" id="addUser">							
				@csrf
				@method('POST')
				<div>
					<!-- Basic Info -->
					<div>
							<div class="row">
									<div class="col-md-6">
											<div class="mb-3">
													<label class="col-form-label">Name <span class="text-danger">*</span></label>
													<input type="text" class="form-control" name="name" required>
													<div class="invalid-feedback d-flex" data-name="name"></div>
											</div>
									</div>
									<div class="col-md-6">
											<div class="mb-3">
													<label class="col-form-label">Email <span class="text-danger">*</span></label>
													<input type="email" class="form-control" name="email" required>
													<div class="invalid-feedback d-flex" data-name="email"></div>
											</div>
									</div>
									<div class="col-md-6">
											<div class="mb-3">
													<label class="col-form-label">Phone</label>
													<input type="text" class="form-control" name="phone">
													<div class="invalid-feedback d-flex" data-name="phone"></div>
											</div>
									</div>
									<div class="col-md-6">
											<div class="mb-3">
													<label class="col-form-label">Location</label>
													<input type="text" class="form-control" name="location">
													<div class="invalid-feedback d-flex" data-name="location"></div>
											</div>
									</div>
									<div class="col-md-6">
										<div class="mb-3">
											<label class="col-form-label">Role</label>
											<select name="role_id" class="select">
												<option value="" selected>-- Selelct Role --</option>
												@foreach ($roles as $role)
													<option value="{{ $role->id }}">{{ $role->name }}</option>
												@endforeach
											</select>
											<div class="invalid-feedback d-flex" data-name="role_id"></div>
										</div>
									</div>
									<div class="col-md-6">
											<div class="mb-3">
													<label class="col-form-label">Password <span class="text-danger">*</span></label>
													<input type="password" class="form-control" name="password" required>
													<div class="invalid-feedback d-flex" data-name="password"></div>
											</div>
									</div>
									<div class="col-md-6">
											<div class="mb-3">
													<div class="radio-wrap">
															<label class="col-form-label">Status</label>
															<div class="d-flex align-items-center">
																	<div class="me-2">
																			<input type="radio" id="addStatusActive" class="status-radio" name="status" value="active" checked>
																			<label for="addStatusActive">Active</label>
																	</div>
																	<div class="me-2">
																			<input type="radio" id="addStatusInactive" class="status-radio" name="status" value="inactive">
																			<label for="addStatusInactive">Inactive</label>
																	</div>
																	<div class="me-2">
																			<input type="radio" id="addStatusSuspended" class="status-radio" name="status" value="suspended">
																			<label for="addStatusSuspended">Suspended</label>
																	</div>
															</div>
													</div>
													<div class="invalid-feedback d-flex" data-name="status"></div>
											</div>  
									</div>  
							</div>
					</div>
					<!-- /Basic Info -->
				</div>
				<div class="d-flex align-items-center justify-content-end mt-4">
					<a href="#" class="btn btn-light me-2" data-bs-dismiss="offcanvas">Cancel</a>
					<button type="submit" class="btn btn-primary">Create</button>
				</div>
			</form>
		</div>
	</div>
	<!-- /Add User -->

	
	<!-- Edit User -->
	<div class="offcanvas offcanvas-end offcanvas-large" tabindex="-1" id="offcanvas_edit">
			<div class="offcanvas-header border-bottom">
					<h5 class="fw-semibold">Edit User</h5>
					<button type="button" class="btn-close custom-btn-close border p-1 me-0 d-flex align-items-center justify-content-center rounded-circle" data-bs-dismiss="offcanvas" aria-label="Close">
							<i class="ti ti-x"></i>
					</button>
			</div>
			<div class="offcanvas-body">
					<form action="{{ route('users.index') }}" id="editUser">							
							@csrf
							@method('PUT')
			
							<!-- Basic Info -->
							<div>
									<div class="row">
											<div class="col-md-6">
													<div class="mb-3">
															<label class="col-form-label">Name <span class="text-danger">*</span></label>
															<input type="text" class="form-control" name="name" required>
															<div class="invalid-feedback d-flex" data-name="name"></div>
													</div>
											</div>
											<div class="col-md-6">
													<div class="mb-3">
															<label class="col-form-label">Email <span class="text-danger">*</span></label>
															<input type="email" class="form-control" name="email" required>
															<div class="invalid-feedback d-flex" data-name="email"></div>
													</div>
											</div>
											<div class="col-md-6">
													<div class="mb-3">
															<label class="col-form-label">Phone</label>
															<input type="text" class="form-control" name="phone">
															<div class="invalid-feedback d-flex" data-name="phone"></div>
													</div>
											</div>
											<div class="col-md-6">
													<div class="mb-3">
															<label class="col-form-label">Location</label>
															<input type="text" class="form-control" name="location">
															<div class="invalid-feedback d-flex" data-name="location"></div>
													</div>
											</div>
											<div class="col-md-6">
													<div class="cmb-3">
															<div class="radio-wrap">
																	<label class="col-form-label">Status</label>
																	<div class="d-flex align-items-center">
																			<div class="me-2">
																					<input type="radio" id="editStatusActive" class="status-radio" name="status" value="active">
																					<label for="editStatusActive">Active</label>
																			</div>
																			<div class="me-2">
																					<input type="radio" id="editStatusInactive" class="status-radio" name="status" value="inactive">
																					<label for="editStatusInactive">Inactive</label>
																			</div>
																			<div class="me-2">
																					<input type="radio" id="editStatusSuspended" class="status-radio" name="status" value="suspended">
																					<label for="editStatusSuspended">Suspended</label>
																			</div>
																	</div>
															</div>
															<div class="invalid-feedback d-flex" data-name="status"></div>
													</div>
											</div>
											<div class="col-md-6">
													<div class="cmb-3">
															<label class="col-form-label">Role</label>
															<select class="select" name="role_id">
																	<option value="">-- Selelct Role --</option>
															</select>
															<div class="invalid-feedback d-flex" data-name="role_id"></div>
													</div>
											</div>
									</div>
							</div>
							<!-- /Basic Info -->
							<div class="d-flex align-items-center justify-content-end mt-4">
									<a href="#" class="btn btn-light me-2" data-bs-dismiss="offcanvas">Cancel</a>
									<button type="submit" class="btn btn-primary">Save Changes</button>
							</div>
					</form>
			</div>
	</div>
	<!-- /Edit User -->

	<!-- Delete User -->
	<div class="modal fade" id="delete_user_modal" role="dialog">
			<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
							<div class="modal-body">
									<div class="text-center">
											<div class="avatar avatar-xl bg-danger-light rounded-circle mb-3">
													<i class="ti ti-trash-x fs-36 text-danger"></i>
											</div>
											<h4 class="mb-2">Remove user?</h4>
											<p class="mb-0">Are you sure you want to remove it</p>
											<div class="d-flex align-items-center justify-content-center mt-4">
													<a href="#" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</a>
													<button type="button" id="trigger_delete_user" class="btn btn-danger">Yes, Delete it</button>
											</div>
									</div>
							</div>
					</div>
			</div>
	</div>
	<!-- /Delete User -->

	@component('components.model-popup')
	@endcomponent
@endsection

