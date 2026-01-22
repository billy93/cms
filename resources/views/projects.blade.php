<?php $page = 'projects'; ?>
@extends('layout.mainlayout')
@section('content')
	<!-- Page Wrapper -->
	<div class="page-wrapper">
		<div class="content">
			<div class="row">
				<div class="col-md-12">
					@component('components.breadcrumb')
						@slot('title')
							Projects
						@endslot
						@slot('item1')
							123
						@endslot
						@slot('item2')
							projects
						@endslot
					@endcomponent
					<div class="card">
						<div class="card-header">
							<!-- Search -->
							<div class="row align-items-center">
								<div class="col-sm-4">
									<form class="icon-form mb-3 mb-sm-0" id="c_project_list_search_form">
										<span class="form-icon"><i class="ti ti-search"></i></span>
										<input type="text" class="form-control" placeholder="Search Project" id="c_project_list_search_input">
									</form>	
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
										<a href="javascript:void(0);" id="c_project_create_btn" class="btn btn-primary"><i class="ti ti-square-rounded-plus me-2"></i>Add New Project</a>
									</div>
								</div>
							</div>
							<!-- /Search -->
						</div>

						<div class="card-body">
							<!-- Projects List -->
							<div class="table-responsive custom-table">
								<table class="table" id="project_list" data-url="{{ route('projects.index') }}"> 
									<thead class="thead-light">
										<tr>
											
										</tr>
										<tr>
											<th class="td-break no-sort" rowspan="2">
												<label class="checkboxs">
													<input type="checkbox" id="select_all_project_list">
													<span class="checkmarks"></span>
												</label>
											</th>
											<th rowspan="2">Project Code</th>
											<th rowspan="2">Project Name</th>
											<th rowspan="2">Customer</th>
											<th rowspan="2">Ref. Doc. No.</th>
											<th rowspan="2">Value</th>
											<th colspan="2" class="text-center">Period</th>
											<th class="td-break" rowspan="2">Due Date</th>
											<th rowspan="2">Type</th>
											<th rowspan="2">Status</th>
											<th rowspan="2" class="fit">Action</th>
										</tr>
										<tr>
											<th class="text-center">Start Date</th>
											<th class="text-center">End Date</th>
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
							<!-- /Projects List -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Page Wrapper -->
	
	@include('components.projects.create-modal')
	@include('components.projects.modal')
@endsection

@push('scripts')
	<script>
		const HIDE_PROJECT_DATATABLE_CHECKBOX = true;
	</script>
  <script src="/build/js/projects/shared_var.js"></script>
  <script src="/build/js/projects/datatables.js"></script>
  <script src="/build/js/projects/events.js"></script>
@endpush
