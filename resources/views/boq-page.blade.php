<?php $page = 'boqs'; ?>
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
								<h4 class="page-title">Bill of Quantity<span class="count-title">123</span></h4>
							</div>
							<div class="col-4 text-end">
								<div class="head-icons">
									<a href="{{url('boqs')}}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Refresh"><i class="ti ti-refresh-dot"></i></a>
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
										<input type="text" class="form-control" placeholder="Search BoQ">
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
										<a href="javascript:void(0);" id="c_boq_add" class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_add"><i class="ti ti-square-rounded-plus me-2"></i>Create BOQ</a>
									</div>
								</div>
							</div>
							<!-- /Search -->
						</div>
						<div class="card-body">
							<div class="table-responsive custom-table">
								<table class="table" id="boq_list" data-url="{{ route('boqs.index') }}">
									<style>
										#boq_list tbody tr td {
											vertical-align: baseline;
										}
										#boq_list thead tr th {
											text-align: center !important;
										}
										.td-break {
											word-break: auto-phrase;
											white-space: unset !important;
										}
										.desc-col {
											max-width: 300px
										}
									</style>
									<thead class="thead-light">
										  <tr>
												<!-- Kolom selain Items, rowspan 2 -->
												<th class="td-break" rowspan="2">ID</th>
												<th class="td-break" rowspan="2">BOQ Type</th>
												<th class="td-break" rowspan="2">Description</th>
												<th class="td-break" rowspan="2">Created</th>

												<!-- Super-header Items, span 8 kolom -->
												<th colspan="8">Items</th>

												<!-- Kolom lain yang rowspan 2 -->
												<th class="td-break" rowspan="2">Basic Price</th>
												<th class="td-break" rowspan="2">Management Fee</th>
												<th class="td-break" rowspan="2">Sales Amount</th>
												<th class="td-break" rowspan="2">VAT Rate</th>
												<th class="td-break" rowspan="2">VAT</th>
												<th class="td-break" rowspan="2">Invoice Amount</th>
												<th class="td-break" rowspan="2" class="no-sort">Action</th>
											</tr>
											
											<tr>
												<!-- Sub-header untuk Items (harus 8 kolom) -->
												<th>Header</th>
												<th>Subheader</th>
												<th>Unit Price</th>
												<th>Title1</th>
												<th>Title2</th>
												<th>Title3</th>
												<th>Title4</th>
												<th>Multiplier</th> <!-- ini sesuai columns: 'multiplier_total' -->
											</tr>
									</thead>
									<tbody>
											<!-- Data akan di-load via AJAX DataTable -->
									</tbody>
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

						</div>
					</div>

				</div>
			</div>

		</div>
	</div>
	<!-- /Page Wrapper -->

	<!-- Add BOQ -->
	<div class="offcanvas offcanvas-end offcanvas-large" tabindex="-1" id="offcanvas_add" style="width: 998px !important;">
		<div class="offcanvas-header border-bottom">
			<h5 class="fw-semibold">Create BOQ</h5>
			<button type="button" id="close_boq_add" class="btn-close custom-btn-close border p-1 me-0 d-flex align-items-center justify-content-center rounded-circle" data-bs-dismiss="offcanvas" aria-label="Close">
					<i class="ti ti-x"></i>
			</button>
		</div>
		<div class="offcanvas-body">
			<style>
				#addBOQ td { vertical-align: baseline; } 
			</style>
			<form action="{{ route('boqs.create') }}" id="addBOQ" method="POST"></form>
		</div>
	</div>
	<!-- /Add BOQ -->

	@component('components.model-popup')
	@endcomponent
@endsection

@push('scripts')
  <script src="/build/js/boq_script.js"></script>
@endpush