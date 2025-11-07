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
											<a href="javascript:void(0);" class="dropdown-toggle" data-bs-toggle="dropdown"><i class="ti ti-package-export me-2"></i>Export</a>
											<div class="dropdown-menu dropdown-menu-end">
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
										<a href="javascript:void(0);" id="c_boq_create_btn" class="btn btn-primary"><i class="ti ti-square-rounded-plus me-2"></i>Create BOQ</a>
									</div>
								</div>
							</div>
							<!-- /Search -->
						</div>
						<div class="card-body">
							<div class="table-responsive custom-table">
								<table class="table" id="boq_list" data-url="{{ route('boqs.index') }}">
									<style>
                    #boq_list th, 
                    #boq_list td {
                            padding: 12px 30px;
                    } 
                    #boq_list th:first-child, 
                    #boq_list td:first-child {
                            padding: 12px;
                    } 
                    #boq_list th:nth-child(2), 
                    #boq_list td:nth-child(2) {
                            padding-left: 0;
                    }
										#boq_list tbody tr td {
											vertical-align: baseline;
										}
										#boq_list thead tr th {
											text-align: center !important;
										}
										#boq_list .td-break {
											text-align: left !important;
											word-break: auto-phrase;
											white-space: unset !important;
										}
										.desc-col {
											max-width: 300px
										}
									</style>
									<thead class="thead-light">
										  <tr>
												<th class="td-break no-sort" rowspan="2">
													<label class="checkboxs">
														<input type="checkbox" id="select_all_boq_list">
														<span class="checkmarks"></span>
													</label>
												</th>
												<th class="td-break" rowspan="2">BOQ Code</th>
												<th class="td-break" rowspan="2">Sales Code</th>
												<th class="td-break" rowspan="2">BOQ Type</th>
												<th class="td-break" rowspan="2">Description</th>
												<th class="td-break" rowspan="2">Created</th>
												<th class="td-break" rowspan="2">Updated</th>
												<th colspan="8">Items</th>
												<th class="td-break" rowspan="2">Basic Price</th>
												<th class="td-break" rowspan="2">Management Fee</th>
												<th class="td-break" rowspan="2">Sales Amount</th>
												<th class="td-break" rowspan="2">VAT Rate</th>
												<th class="td-break" rowspan="2">VAT</th>
												<th class="td-break" rowspan="2">Invoice Amount</th>
												<th class="td-break" rowspan="2" class="no-sort">Action</th>
											</tr>
											<tr>
												<th>Header</th>
												<th>Subheader</th>
												<th>Unit Price</th>
												<th>Title1</th>
												<th>Title2</th>
												<th>Title3</th>
												<th>Title4</th>
												<th>Total Amount</th>
											</tr>
									</thead>
									<tbody></tbody>
								</table>
							</div>
							<div class="row align-items-center mt-2" style="row-gap: 1em;">
								<div class="col-md-6">
									<div class="d-flex align-items-center justify-content-center justify-content-md-start">
										<div class="datatable-info"></div>
										<div class="table-boq-length"></div>
									</div>
								</div>
								<div class="col-md-6 flex-grow-1">
									<div class="table-boq-paginate"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Page Wrapper -->
	 
	 @include('components.boqs.create-modal')
	 @include('components.boqs.modal')
@endsection

@push('scripts')
	<script>
		const HIDE_CHECKBOX = true;
	</script>
  <script src="/build/js/boqs/shared_var.js"></script>
	<script src="/build/js/boqs/datatables.js"></script>
	<script src="/build/js/boqs/events.js"></script>
@endpush