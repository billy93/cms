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
								<div class="row">
									<div class="col-md-5 col-sm-4">
										<div class="mb-3 mb-sm-0">
											<h4>Role Name : <span class="text-danger ">Admin</span></h4>
										</div>						
									</div>		
									<div class="col-md-7 col-sm-8">					
										<div class="text-sm-end">
											<label class="checkboxs d-flex align-items-center justify-content-sm-end"><input type="checkbox"><span class="checkmarks position-relative d-flex me-2"></span>Allow All Modules</label>
										</div>
									</div>
								</div>
							</div>
							<div class="card-body">
								<!-- Roles List -->
								<div class="table-responsive custom-table">
									<table class="table" id="permission_list">
										<thead class="thead-light">
											<tr>
												<th class="no-sort">
													<label class="checkboxs">
														<input type="checkbox" id="select-all"><span class="checkmarks"></span>
													</label>
												</th>
												<th>Modules</th>
												<th>Sub Modules</th>
												<th>Create</th>
												<th>Edit</th>
												<th>View</th>
												<th>Delete</th>
												<th>Allow All</th>
											</tr>
										</thead>
										<tbody>
											
										</tbody>
									</table>
								</div>
								<div class="row align-items-center">
									<div class="col-md-6">
										<div class="datatable-length"></div>
									</div>
									<div class="col-md-6">
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
@component('components.model-popup')
@endcomponent
@endsection