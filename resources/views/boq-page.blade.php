<?php $page = 'boq'; ?>
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
										<a href="javascript:void(0);" id="c_user_add" class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_add"><i class="ti ti-square-rounded-plus me-2"></i>Create BOQ</a>
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
			<h5 class="fw-semibold">Create BOQ</h5>
			<button type="button" class="btn-close custom-btn-close border p-1 me-0 d-flex align-items-center justify-content-center rounded-circle" data-bs-dismiss="offcanvas" aria-label="Close">
					<i class="ti ti-x"></i>
			</button>
		</div>
		<div class="offcanvas-body">
			<form action="#" id="addBOQ">
				@csrf
				<div class="mb-3">
					<label class="col-form-label">BOQ Type <span class="text-danger">*</span></label>
					<select class="form-select" id="boq_type" name="boq_type" required>
						<option value="A" selected>Type A - Satu paket event (tanpa rincian harga)</option>
						<option value="B">Type B - Harga paket berdasarkan jumlah orang</option>
						<option value="C">Type C - Paket untuk Incentive Trips</option>
						<option value="D">Type D - Incentive Trips (umum)</option>
						<option value="E">Type E - Custom dengan Price</option>
					</select>
				</div>
				<div id="form_type_a">
					<!-- Description of products and services -->
					<div class="mb-3">
						<label class="col-form-label">Description of products and services <span class="text-danger">*</span></label>
						<textarea class="form-control" name="description_a"></textarea>
					</div>
					<!-- Pricing Model -->
					<div class="mb-3">
						<label class="col-form-label">Pricing Model</label>
						<div class="card p-3">
							<div class="mb-3">
								<label>Basic Price <span class="text-danger">*</span></label>
								<input type="number" class="form-control" name="basic_price_a" id="basic_price_a" min="0" step="1000">
							</div>
							<div class="mb-3">
								<label>Management Fee</label>
								<div class="input-group mb-2">
									<input type="number" class="form-control" name="management_fee_value_a" id="management_fee_value_a" min="0" step="1000" placeholder="Nominal">
									<span class="input-group-text">atau</span>
									<input type="number" class="form-control" name="management_fee_percent_a" id="management_fee_percent_a" min="0" max="100" step="0.01" placeholder="%">
									<span class="input-group-text">%</span>
								</div>
								<small class="text-muted">Manual Entry: bisa dengan menentukan prosentasi atau menentukan nominal nya</small>
							</div>
							<div class="mb-3">
								<label>Sales Amount</label>
								<input type="text" class="form-control" id="sales_amount_a" readonly>
							</div>
							<div class="mb-3">
								<label>VAT</label>
								<select class="form-select" name="vat_percent_a" id="vat_percent_a">
									<option value="1">1%</option>
									<option value="11" selected>11%</option>
								</select>
								<small class="text-muted">Manual - Pilihan 1% atau 11%</small>
							</div>
							<div class="mb-3">
								<label>VAT Amount</label>
								<input type="text" class="form-control" id="vat_amount_a" readonly>
							</div>
							<div class="mb-3">
								<label>Invoice Amount</label>
								<input type="text" class="form-control" id="invoice_amount_a" readonly>
							</div>
						</div>
					</div>
					<div class="mt-3" id="note_a">
						<span class="text-danger"><b>Note</b><br>
						<i>1. BOQ Type A adalah untuk proposal penawaran berupa satu paket event yang ditawarkan dengan tanpa rincian harga</i></span>
					</div>
				</div>
				<div id="form_type_b" style="display:none;">
					<!-- Description of products and services -->
					<div class="mb-3">
						<label class="col-form-label">Description of products and services <span class="text-danger">*</span></label>
						<textarea class="form-control" name="description_b"></textarea>
					</div>
					<!-- Pricing Model -->
					<div class="mb-3">
						<label class="col-form-label">Pricing Model</label>
						<div class="card p-3">
							<label class="mb-2">Basic Price</label>
							<table class="table table-bordered mb-3">
								<thead>
									<tr>
										<th style="width: 30%">Category</th>
										<th style="width: 15%">Qty</th>
										<th style="width: 25%">Price per Person</th>
										<th style="width: 30%">Subtotal</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Adult</td>
										<td><input type="number" class="form-control" name="qty_adult" id="qty_adult" min="0" value="0"></td>
										<td><input type="number" class="form-control" name="price_adult" id="price_adult" min="0" value="0"></td>
										<td><input type="text" class="form-control" id="subtotal_adult" readonly></td>
									</tr>
									<tr>
										<td>Child</td>
										<td><input type="number" class="form-control" name="qty_child" id="qty_child" min="0" value="0"></td>
										<td><input type="number" class="form-control" name="price_child" id="price_child" min="0" value="0"></td>
										<td><input type="text" class="form-control" id="subtotal_child" readonly></td>
									</tr>
									<tr>
										<td>Infant</td>
										<td><input type="number" class="form-control" name="qty_infant" id="qty_infant" min="0" value="0"></td>
										<td><input type="number" class="form-control" name="price_infant" id="price_infant" min="0" value="0"></td>
										<td><input type="text" class="form-control" id="subtotal_infant" readonly></td>
									</tr>
								</tbody>
								<tfoot>
									<tr>
										<th colspan="3" class="text-end">Total</th>
										<th><input type="text" class="form-control" id="basic_price_b" readonly></th>
									</tr>
								</tfoot>
							</table>
							<div class="mb-3">
								<label>Management Fee</label>
								<div class="input-group mb-2">
									<input type="number" class="form-control" name="management_fee_value_b" id="management_fee_value_b" min="0" step="1000" placeholder="Nominal">
									<span class="input-group-text">atau</span>
									<input type="number" class="form-control" name="management_fee_percent_b" id="management_fee_percent_b" min="0" max="100" step="0.01" placeholder="%">
									<span class="input-group-text">%</span>
								</div>
								<small class="text-muted">Manual Entry: bisa dengan menentukan prosentasi atau menentukan nominal nya</small>
							</div>
							<div class="mb-3">
								<label>Sales Amount</label>
								<input type="text" class="form-control" id="sales_amount_b" readonly>
							</div>
							<div class="mb-3">
								<label>VAT</label>
								<select class="form-select" name="vat_percent_b" id="vat_percent_b">
									<option value="1">1%</option>
									<option value="11" selected>11%</option>
								</select>
								<small class="text-muted">Manual - Pilihan 1% atau 11%</small>
							</div>
							<div class="mb-3">
								<label>VAT Amount</label>
								<input type="text" class="form-control" id="vat_amount_b" readonly>
							</div>
							<div class="mb-3">
								<label>Invoice Amount</label>
								<input type="text" class="form-control" id="invoice_amount_b" readonly>
							</div>
						</div>
					</div>
					<div class="mt-3" id="note_b">
						<span class="text-danger"><b>Note</b><br>
						<i>1. BOQ Type B digunakan untuk harga paket yang berdasarkan jumlah orang</i></span>
					</div>
				</div>
				<div id="form_type_c" style="display:none;">
					<!-- Description of products and services -->
					<div class="mb-3">
							<label class="col-form-label">Description of products and services <span class="text-danger">*</span></label>
							<textarea class="form-control" name="description_c"></textarea>
					</div>
					<!-- Products and Services Table -->
					<div class="mb-3">
							<label class="col-form-label">Products and Services</label>
							<div class="card p-3">
									<div class="table-responsive" style="overflow-x:auto;">
											<table class="table table-bordered mb-3" id="products_services_table_c">
													<thead>
															<tr>
																	<th style="width: 18%">Header</th>
																	<th style="width: 18%">Sub Header</th>
																	<th style="width: 10%">Title 1</th>
																	<th style="width: 10%">Title 2</th>
																	<th style="width: 10%">Title 3</th>
																	<th style="width: 10%">Title 4</th>
																	<th style="width: 14%">Amount</th>
																	<th style="width: 10%"></th>
															</tr>
													</thead>
													<tbody id="products_services_body">
													</tbody>
													<tfoot>
															<tr>
																	<th colspan="6" class="text-end">Total</th>
																	<th><input type="text" class="form-control" id="total_amount_c" readonly></th>
																	<th></th>
															</tr>
													</tfoot>
											</table>
									</div>
									<button type="button" class="btn btn-sm btn-success" id="add_row_btn" style="margin-top: 12px;"><i class="ti ti-plus"></i> Add Row</button>
							</div>
					</div>
					<div class="mb-3">
							<label>Management Fee</label>
							<div class="input-group mb-2">
									<input type="number" class="form-control" name="management_fee_value_c" id="management_fee_value_c" min="0" step="1000" placeholder="Nominal">
									<span class="input-group-text">atau</span>
									<input type="number" class="form-control" name="management_fee_percent_c" id="management_fee_percent_c" min="0" max="100" step="0.01" placeholder="%">
									<span class="input-group-text">%</span>
							</div>
							<small class="text-muted">Manual Entry: bisa dengan menentukan prosentasi atau menentukan nominal nya</small>
					</div>
					<div class="mb-3">
							<label>Sales Amount</label>
							<input type="text" class="form-control" id="sales_amount_c" readonly>
					</div>
					<div class="mb-3">
							<label>VAT</label>
							<select class="form-select" name="vat_percent_c" id="vat_percent_c">
									<option value="1">1%</option>
									<option value="11" selected>11%</option>
							</select>
							<small class="text-muted">Manual - Pilihan 1% atau 11%</small>
					</div>
					<div class="mb-3">
							<label>VAT Amount</label>
							<input type="text" class="form-control" id="vat_amount_c" readonly>
					</div>
					<div class="mb-3">
							<label>Invoice Amount</label>
							<input type="text" class="form-control" id="invoice_amount_c" readonly>
					</div>
					<div class="mt-3" id="note_c">
							<span class="text-danger"><b>Note</b><br>
							<i>1. BOQ Type C digunakan untuk harga paket yang umum digunakan untuk Incentive Trips<br>
							2. One Header can consists of many Sub Header</i></span>
					</div>
				</div> 
				<div id="form_type_d" style="display:none;">
    <!-- Description of products and services -->
    <div class="mb-3">
        <label class="col-form-label">Description of products and services <span class="text-danger">*</span></label>
        <textarea class="form-control" name="description_d"></textarea>
    </div>
    <!-- Products and Services Table -->
    <div class="mb-3">
        <label class="col-form-label">Products and Services</label>
        <div class="card p-3">
            <div class="table-responsive" style="overflow-x:auto;">
                <table class="table table-bordered mb-3" id="products_services_table_d">
                    <thead>
                        <tr>
                            <th style="width: 18%">Header</th>
                            <th style="width: 18%">Sub Header</th>
                            <th style="width: 10%">Title 1</th>
                            <th style="width: 10%">Title 2</th>
                            <th style="width: 10%">Title 3</th>
                            <th style="width: 10%">Title 4</th>
                            <th style="width: 14%">Amount</th>
                            <th style="width: 10%"></th>
                        </tr>
                    </thead>
                    <tbody id="products_services_body_d">
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="6" class="text-end">Total</th>
                            <th><input type="text" class="form-control" id="total_amount_d" readonly></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <button type="button" class="btn btn-sm btn-success" id="add_row_btn_d" style="margin-top: 12px;"><i class="ti ti-plus"></i> Add Row</button>
        </div>
    </div>
    <div class="mb-3">
        <label>Management Fee</label>
        <div class="input-group mb-2">
            <input type="number" class="form-control" name="management_fee_value_d" id="management_fee_value_d" min="0" step="1000" placeholder="Nominal">
            <span class="input-group-text">atau</span>
            <input type="number" class="form-control" name="management_fee_percent_d" id="management_fee_percent_d" min="0" max="100" step="0.01" placeholder="%">
            <span class="input-group-text">%</span>
        </div>
        <small class="text-muted">Manual Entry: bisa dengan menentukan prosentasi atau menentukan nominal nya</small>
    </div>
    <div class="mb-3">
        <label>Sales Amount</label>
        <input type="text" class="form-control" id="sales_amount_d" readonly>
    </div>
    <div class="mb-3">
        <label>VAT</label>
        <select class="form-select" name="vat_percent_d" id="vat_percent_d">
            <option value="1">1%</option>
            <option value="11" selected>11%</option>
        </select>
        <small class="text-muted">Manual - Pilihan 1% atau 11%</small>
    </div>
    <div class="mb-3">
        <label>VAT Amount</label>
        <input type="text" class="form-control" id="vat_amount_d" readonly>
    </div>
    <div class="mb-3">
        <label>Invoice Amount</label>
        <input type="text" class="form-control" id="invoice_amount_d" readonly>
    </div>
    <div class="mt-3" id="note_d">
        <span class="text-danger"><b>Note</b><br>
        <i>1. BOQ Type D memberikan keleluasaan untuk menentukan baik header maupun sub header dari produk dan jasa yang dijual, demikian juga dengan rincian kalkulasi harga nya<br>
        2. One Header can consists of many Sub Header</i></span>
    </div>
</div>
				<div id="form_type_e" style="display:none;">
    <!-- Description of products and services -->
    <div class="mb-3">
        <label class="col-form-label">Description of products and services <span class="text-danger">*</span></label>
        <textarea class="form-control" name="description_e"></textarea>
    </div>
    <!-- Products and Services Table -->
    <div class="mb-3">
        <label class="col-form-label">Products and Services</label>
        <div class="card p-3">
            <div class="table-responsive" style="overflow-x:auto;">
                <table class="table table-bordered mb-3" id="products_services_table_e">
                    <thead>
                        <tr>
                            <th style="width: 18%">Header</th>
                            <th style="width: 18%">Sub Header</th>
                            <th style="width: 10%">Title 1</th>
                            <th style="width: 10%">Title 2</th>
                            <th style="width: 10%">Title 3</th>
                            <th style="width: 10%">Price</th>
                            <th style="width: 14%">Amount</th>
                            <th style="width: 10%"></th>
                        </tr>
                    </thead>
                    <tbody id="products_services_body_e">
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="6" class="text-end">Total</th>
                            <th><input type="text" class="form-control" id="total_amount_e" readonly></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <button type="button" class="btn btn-sm btn-success" id="add_row_btn_e" style="margin-top: 12px;"><i class="ti ti-plus"></i> Add Row</button>
        </div>
    </div>
    <div class="mb-3">
        <label>Management Fee</label>
        <div class="input-group mb-2">
            <input type="number" class="form-control" name="management_fee_value_e" id="management_fee_value_e" min="0" step="1000" placeholder="Nominal">
            <span class="input-group-text">atau</span>
            <input type="number" class="form-control" name="management_fee_percent_e" id="management_fee_percent_e" min="0" max="100" step="0.01" placeholder="%">
            <span class="input-group-text">%</span>
        </div>
        <small class="text-muted">Manual Entry: bisa dengan menentukan prosentasi atau menentukan nominal nya</small>
    </div>
    <div class="mb-3">
        <label>Sales Amount</label>
        <input type="text" class="form-control" id="sales_amount_e" readonly>
    </div>
    <div class="mb-3">
        <label>VAT</label>
        <select class="form-select" name="vat_percent_e" id="vat_percent_e">
            <option value="1">1%</option>
            <option value="11" selected>11%</option>
        </select>
        <small class="text-muted">Manual - Pilihan 1% atau 11%</small>
    </div>
    <div class="mb-3">
        <label>VAT Amount</label>
        <input type="text" class="form-control" id="vat_amount_e" readonly>
    </div>
    <div class="mb-3">
        <label>Invoice Amount</label>
        <input type="text" class="form-control" id="invoice_amount_e" readonly>
    </div>
    <div class="mt-3" id="note_e">
        <span class="text-danger"><b>Note</b><br>
        <i>1. BOQ Type E memberikan keleluasaan untuk menentukan baik header maupun sub header dari produk dan jasa yang dijual, demikian juga dengan rincian kalkulasi harga nya<br>
        2. One Header can consists of many Sub Header</i></span>
    </div>
</div>
				<div class="d-flex align-items-center justify-content-end mt-4">
					<a href="#" class="btn btn-light me-2" data-bs-dismiss="offcanvas">Cancel</a>
					<button type="submit" class="btn btn-primary">Create</button>
				</div>
			</form>
			<script>
				function formatRupiah(angka) {
					if (!angka) return '';
					return parseInt(angka).toLocaleString('id-ID', {minimumFractionDigits: 0});
				}
				function getManagementFee(basic, percent, nominal) {
					if (percent) return Math.round(basic * (percent/100));
					if (nominal) return parseInt(nominal);
					return 0;
				}
				function recalculateA() {
					let basic = parseInt(document.getElementById('basic_price_a').value) || 0;
					let feePercent = parseFloat(document.getElementById('management_fee_percent_a').value) || 0;
					let feeNominal = parseInt(document.getElementById('management_fee_value_a').value) || 0;
					let vatPercent = parseFloat(document.getElementById('vat_percent_a').value) || 0;
					let fee = getManagementFee(basic, feePercent, feeNominal);
					let sales = basic + fee;
					let vat = Math.round(sales * (vatPercent/100));
					let invoice = sales + vat;
					document.getElementById('sales_amount_a').value = formatRupiah(sales);
					document.getElementById('vat_amount_a').value = formatRupiah(vat);
					document.getElementById('invoice_amount_a').value = formatRupiah(invoice);
				}
				function recalculateB() {
					let qty_adult = parseInt(document.getElementById('qty_adult').value) || 0;
					let price_adult = parseInt(document.getElementById('price_adult').value) || 0;
					let qty_child = parseInt(document.getElementById('qty_child').value) || 0;
					let price_child = parseInt(document.getElementById('price_child').value) || 0;
					let qty_infant = parseInt(document.getElementById('qty_infant').value) || 0;
					let price_infant = parseInt(document.getElementById('price_infant').value) || 0;
					let subtotal_adult = qty_adult * price_adult;
					let subtotal_child = qty_child * price_child;
					let subtotal_infant = qty_infant * price_infant;
					document.getElementById('subtotal_adult').value = formatRupiah(subtotal_adult);
					document.getElementById('subtotal_child').value = formatRupiah(subtotal_child);
					document.getElementById('subtotal_infant').value = formatRupiah(subtotal_infant);
					let basic = subtotal_adult + subtotal_child + subtotal_infant;
					document.getElementById('basic_price_b').value = formatRupiah(basic);
					let feePercent = parseFloat(document.getElementById('management_fee_percent_b').value) || 0;
					let feeNominal = parseInt(document.getElementById('management_fee_value_b').value) || 0;
					let vatPercent = parseFloat(document.getElementById('vat_percent_b').value) || 0;
					let fee = getManagementFee(basic, feePercent, feeNominal);
					let sales = basic + fee;
					let vat = Math.round(sales * (vatPercent/100));
					let invoice = sales + vat;
					document.getElementById('sales_amount_b').value = formatRupiah(sales);
					document.getElementById('vat_amount_b').value = formatRupiah(vat);
					document.getElementById('invoice_amount_b').value = formatRupiah(invoice);
				}
				function recalculateC() {
					let total = 0;
					document.querySelectorAll('#products_services_body .amount-input').forEach(function(input){
						total += parseInt(input.value) || 0;
					});
					document.getElementById('total_amount_c').value = formatRupiah(total);
					let feePercent = parseFloat(document.getElementById('management_fee_percent_c').value) || 0;
					let feeNominal = parseInt(document.getElementById('management_fee_value_c').value) || 0;
					let vatPercent = parseFloat(document.getElementById('vat_percent_c').value) || 0;
					let fee = getManagementFee(total, feePercent, feeNominal);
					let sales = total + fee;
					let vat = Math.round(sales * (vatPercent/100));
					let invoice = sales + vat;
					document.getElementById('sales_amount_c').value = formatRupiah(sales);
					document.getElementById('vat_amount_c').value = formatRupiah(vat);
					document.getElementById('invoice_amount_c').value = formatRupiah(invoice);
				}
				// --- Type C (Incentive Trips) ---
				const HEADERS = [
				    'Accommodation','Activities , Outdoor','Airport Assistance','Air tickets','Documentation','Entrance ticket - Shows and Entertainment','Entrance ticket - Places of interest','Excursion','F&B Restaurants','Front of House','Goodie Bags','Gratitudes','Insurance','Land transportation','Lighting','Manpower','MC','Media Relation','Meeting and Conference Kits','Meeting Package','Merchandise','Multimedia','Paramedic and First Aids','Rail tickets','Sales and Promotion Materials','Security Service & Fire','Software','Sound System','Speaker','Stationery','Streaming','Survey','Talents','Team Building','Travel Documents','Traveling kits','Venue'
				];
				const TITLES = [
				    'Quantity','Number of nights','Number of rooms','Number of hours','Number of days','Number of items','Number of participants','Number of unit','Number of package','Unit Price'
				];
				function createRowC() {
				    const tr = document.createElement('tr');
				    tr.innerHTML = `
				        <td><select class="form-select header-select">${HEADERS.map(h=>`<option value="${h}">${h}</option>`).join('')}</select></td>
				        <td><input type="text" class="form-control sub-header-input" placeholder="Sub Header"></td>
				        <td><select class="form-select title-select">${TITLES.map(t=>`<option value="${t}">${t}</option>`).join('')}</select></td>
				        <td><select class="form-select title-select">${TITLES.map(t=>`<option value="${t}">${t}</option>`).join('')}</select></td>
				        <td><select class="form-select title-select">${TITLES.map(t=>`<option value="${t}">${t}</option>`).join('')}</select></td>
				        <td><select class="form-select title-select">${TITLES.map(t=>`<option value="${t}">${t}</option>`).join('')}</select></td>
				        <td><input type="number" class="form-control amount-input" min="0" value="0"></td>
				        <td><button type="button" class="btn btn-sm btn-danger remove-row-btn"><i class="ti ti-trash"></i></button></td>
				    `;
				    return tr;
				}
				function setupTypeCListeners() {
				    // Add row button
				    const addRowBtn = document.getElementById('add_row_btn');
				    if (addRowBtn) {
				        addRowBtn.onclick = function() {
				            const tr = createRowC();
				            document.getElementById('products_services_body').appendChild(tr);
				            tr.querySelector('.amount-input').addEventListener('input', recalculateC);
				            tr.querySelector('.remove-row-btn').addEventListener('click', function(){
				                tr.remove();
				                recalculateC();
				            });
				        };
				    }
				    // Event delegation for amount input (in case of dynamic rows)
				    const tbody = document.getElementById('products_services_body');
				    if (tbody) {
				        tbody.addEventListener('input', function(e) {
				            if (e.target.classList.contains('amount-input')) recalculateC();
				        });
				        tbody.addEventListener('click', function(e) {
				            if (e.target.closest('.remove-row-btn')) {
				                e.target.closest('tr').remove();
				                recalculateC();
				            }
				        });
				    }
				    // Management fee & VAT
				    document.getElementById('management_fee_percent_c').addEventListener('input', recalculateC);
				    document.getElementById('management_fee_value_c').addEventListener('input', recalculateC);
				    document.getElementById('vat_percent_c').addEventListener('change', recalculateC);
				}
				function showTypeCForm() {
				    document.getElementById('form_type_a').style.display = 'none';
				    document.getElementById('form_type_b').style.display = 'none';
				    document.getElementById('form_type_c').style.display = '';
				    // Kosongkan tabel
				    const tbody = document.getElementById('products_services_body');
				    tbody.innerHTML = '';
				    // Tambah baris pertama
				    const tr = createRowC();
				    tbody.appendChild(tr);
				    // Pasang event listener
				    setupTypeCListeners();
				}
				document.getElementById('boq_type').addEventListener('change', function() {
					if (this.value === 'A') {
						document.getElementById('form_type_a').style.display = '';
						document.getElementById('form_type_b').style.display = 'none';
						document.getElementById('form_type_c').style.display = 'none';
						document.getElementById('form_type_d').style.display = 'none';
						document.getElementById('form_type_e').style.display = 'none';
					} else if (this.value === 'B') {
						document.getElementById('form_type_a').style.display = 'none';
						document.getElementById('form_type_b').style.display = '';
						document.getElementById('form_type_c').style.display = 'none';
						document.getElementById('form_type_d').style.display = 'none';
						document.getElementById('form_type_e').style.display = 'none';
					} else if (this.value === 'C') {
						showTypeCForm();
						document.getElementById('form_type_d').style.display = 'none';
						document.getElementById('form_type_e').style.display = 'none';
					} else if (this.value === 'D') {
						showTypeDForm();
						document.getElementById('form_type_e').style.display = 'none';
					} else if (this.value === 'E') {
						showTypeEForm();
					}
				});
				// Type A listeners
				['basic_price_a','management_fee_percent_a','management_fee_value_a','vat_percent_a'].forEach(function(id){
					let el = document.getElementById(id);
					if(el) el.addEventListener('input', recalculateA);
					if(el && id==='vat_percent_a') el.addEventListener('change', recalculateA);
				});
				// Type B listeners
				['qty_adult','price_adult','qty_child','price_child','qty_infant','price_infant','management_fee_percent_b','management_fee_value_b','vat_percent_b'].forEach(function(id){
					let el = document.getElementById(id);
					if(el) el.addEventListener('input', recalculateB);
					if(el && id==='vat_percent_b') el.addEventListener('change', recalculateB);
				});
				// Type C listeners
				setupTypeCListeners(); // Call setupTypeCListeners here to ensure it's ready when Type C is shown

				// Type D logic (duplikat Type C, id dan name _c jadi _d)
				const HEADERS_D = [
				    'Accommodation','Activities , Outdoor','Airport Assistance','Air tickets','Documentation','Entrance ticket - Shows and Entertainment','Entrance ticket - Places of interest','Excursion','F&B Restaurants','Front of House','Goodie Bags','Gratitudes','Insurance','Land transportation','Lighting','Manpower','MC','Media Relation','Meeting and Conference Kits','Meeting Package','Merchandise','Multimedia','Paramedic and First Aids','Rail tickets','Sales and Promotion Materials','Security Service & Fire','Software','Sound System','Speaker','Stationery','Streaming','Survey','Talents','Team Building','Travel Documents','Traveling kits','Venue'
				];
				const TITLES_D = [
				    'Quantity','Number of nights','Number of rooms','Number of hours','Number of days','Number of items','Number of participants','Unit Price'
				];
				function createRowD() {
				    const tr = document.createElement('tr');
				    tr.innerHTML = `
				        <td><input type="text" class="form-control header-input" placeholder="Header"></td>
				        <td><input type="text" class="form-control sub-header-input" placeholder="Sub Header"></td>
				        <td><select class="form-select title-select">${TITLES_D.map(t=>`<option value="${t}">${t}</option>`).join('')}</select></td>
				        <td><select class="form-select title-select">${TITLES_D.map(t=>`<option value="${t}">${t}</option>`).join('')}</select></td>
				        <td><select class="form-select title-select">${TITLES_D.map(t=>`<option value="${t}">${t}</option>`).join('')}</select></td>
				        <td><select class="form-select title-select">${TITLES_D.map(t=>`<option value="${t}">${t}</option>`).join('')}</select></td>
				        <td><input type="number" class="form-control amount-input" min="0" value="0"></td>
				        <td><button type="button" class="btn btn-sm btn-danger remove-row-btn"><i class="ti ti-trash"></i></button></td>
				    `;
				    return tr;
				}
				function setupTypeDListeners() {
				    // Add row button
				    const addRowBtn = document.getElementById('add_row_btn_d');
				    if (addRowBtn) {
				        addRowBtn.onclick = function() {
				            const tr = createRowD();
				            document.getElementById('products_services_body_d').appendChild(tr);
				            tr.querySelector('.amount-input').addEventListener('input', recalculateD);
				            tr.querySelector('.remove-row-btn').addEventListener('click', function(){
				                tr.remove();
				                recalculateD();
				            });
				        };
				    }
				    // Event delegation for amount input (in case of dynamic rows)
				    const tbody = document.getElementById('products_services_body_d');
				    if (tbody) {
				        tbody.addEventListener('input', function(e) {
				            if (e.target.classList.contains('amount-input')) recalculateD();
				        });
				        tbody.addEventListener('click', function(e) {
				            if (e.target.closest('.remove-row-btn')) {
				                e.target.closest('tr').remove();
				                recalculateD();
				            }
				        });
				    }
				    // Management fee & VAT
				    document.getElementById('management_fee_percent_d').addEventListener('input', recalculateD);
				    document.getElementById('management_fee_value_d').addEventListener('input', recalculateD);
				    document.getElementById('vat_percent_d').addEventListener('change', recalculateD);
				}
				function recalculateD() {
				    let total = 0;
				    document.querySelectorAll('#products_services_body_d .amount-input').forEach(function(input){
				        total += parseInt(input.value) || 0;
				    });
				    document.getElementById('total_amount_d').value = formatRupiah(total);
				    let feePercent = parseFloat(document.getElementById('management_fee_percent_d').value) || 0;
				    let feeNominal = parseInt(document.getElementById('management_fee_value_d').value) || 0;
				    let vatPercent = parseFloat(document.getElementById('vat_percent_d').value) || 0;
				    let fee = getManagementFee(total, feePercent, feeNominal);
				    let sales = total + fee;
				    let vat = Math.round(sales * (vatPercent/100));
				    let invoice = sales + vat;
				    document.getElementById('sales_amount_d').value = formatRupiah(sales);
				    document.getElementById('vat_amount_d').value = formatRupiah(vat);
				    document.getElementById('invoice_amount_d').value = formatRupiah(invoice);
				}
				function showTypeDForm() {
				    document.getElementById('form_type_a').style.display = 'none';
				    document.getElementById('form_type_b').style.display = 'none';
				    document.getElementById('form_type_c').style.display = 'none';
				    document.getElementById('form_type_d').style.display = '';
				    // Kosongkan tabel
				    const tbody = document.getElementById('products_services_body_d');
				    tbody.innerHTML = '';
				    // Tambah baris pertama
				    const tr = createRowD();
				    tbody.appendChild(tr);
				    // Pasang event listener
				    setupTypeDListeners();
				}
				document.getElementById('boq_type').addEventListener('change', function() {
					if (this.value === 'A') {
						document.getElementById('form_type_a').style.display = '';
						document.getElementById('form_type_b').style.display = 'none';
						document.getElementById('form_type_c').style.display = 'none';
						document.getElementById('form_type_d').style.display = 'none';
						document.getElementById('form_type_e').style.display = 'none';
					} else if (this.value === 'B') {
						document.getElementById('form_type_a').style.display = 'none';
						document.getElementById('form_type_b').style.display = '';
						document.getElementById('form_type_c').style.display = 'none';
						document.getElementById('form_type_d').style.display = 'none';
						document.getElementById('form_type_e').style.display = 'none';
					} else if (this.value === 'C') {
						showTypeCForm();
						document.getElementById('form_type_d').style.display = 'none';
						document.getElementById('form_type_e').style.display = 'none';
					} else if (this.value === 'D') {
						showTypeDForm();
						document.getElementById('form_type_e').style.display = 'none';
					} else if (this.value === 'E') {
						showTypeEForm();
					}
				});
				// Type A listeners
				['basic_price_a','management_fee_percent_a','management_fee_value_a','vat_percent_a'].forEach(function(id){
					let el = document.getElementById(id);
					if(el) el.addEventListener('input', recalculateA);
					if(el && id==='vat_percent_a') el.addEventListener('change', recalculateA);
				});
				// Type B listeners
				['qty_adult','price_adult','qty_child','price_child','qty_infant','price_infant','management_fee_percent_b','management_fee_value_b','vat_percent_b'].forEach(function(id){
					let el = document.getElementById(id);
					if(el) el.addEventListener('input', recalculateB);
					if(el && id==='vat_percent_b') el.addEventListener('change', recalculateB);
				});
				// Type C listeners
				setupTypeCListeners(); // Call setupTypeCListeners here to ensure it's ready when Type C is shown

				// Type D listeners
				setupTypeDListeners(); // Call setupTypeDListeners here to ensure it's ready when Type D is shown

				// Type E logic (duplikat Type D, Title 4 jadi Price input number)
				const HEADERS_E = [
				    'Accommodation','Activities , Outdoor','Airport Assistance','Air tickets','Documentation','Entrance ticket - Shows and Entertainment','Entrance ticket - Places of interest','Excursion','F&B Restaurants','Front of House','Goodie Bags','Gratitudes','Insurance','Land transportation','Lighting','Manpower','MC','Media Relation','Meeting and Conference Kits','Meeting Package','Merchandise','Multimedia','Paramedic and First Aids','Rail tickets','Sales and Promotion Materials','Security Service & Fire','Software','Sound System','Speaker','Stationery','Streaming','Survey','Talents','Team Building','Travel Documents','Traveling kits','Venue'
				];
				const TITLES_E = [
				    'Quantity','Number of nights','Number of rooms','Number of hours','Number of days','Number of items','Number of participants','Unit Price'
				];
				function createRowE() {
				    const tr = document.createElement('tr');
				    tr.innerHTML = `
				        <td><input type="text" class="form-control header-input" placeholder="Header"></td>
				        <td><input type="text" class="form-control sub-header-input" placeholder="Sub Header"></td>
				        <td><select class="form-select title-select">${TITLES_E.map(t=>`<option value="${t}">${t}</option>`).join('')}</select></td>
				        <td><select class="form-select title-select">${TITLES_E.map(t=>`<option value="${t}">${t}</option>`).join('')}</select></td>
				        <td><select class="form-select title-select">${TITLES_E.map(t=>`<option value="${t}">${t}</option>`).join('')}</select></td>
				        <td><input type="number" class="form-control price-input" min="0" value="0" placeholder="Price"></td>
				        <td><input type="number" class="form-control amount-input" min="0" value="0"></td>
				        <td><button type="button" class="btn btn-sm btn-danger remove-row-btn"><i class="ti ti-trash"></i></button></td>
				    `;
				    return tr;
				}
				function setupTypeEListeners() {
				    // Add row button
				    const addRowBtn = document.getElementById('add_row_btn_e');
				    if (addRowBtn) {
				        addRowBtn.onclick = function() {
				            const tr = createRowE();
				            document.getElementById('products_services_body_e').appendChild(tr);
				            tr.querySelector('.amount-input').addEventListener('input', recalculateE);
				            tr.querySelector('.remove-row-btn').addEventListener('click', function(){
				                tr.remove();
				                recalculateE();
				            });
				        };
				    }
				    // Event delegation for amount input (in case of dynamic rows)
				    const tbody = document.getElementById('products_services_body_e');
				    if (tbody) {
				        tbody.addEventListener('input', function(e) {
				            if (e.target.classList.contains('amount-input')) recalculateE();
				        });
				        tbody.addEventListener('click', function(e) {
				            if (e.target.closest('.remove-row-btn')) {
				                e.target.closest('tr').remove();
				                recalculateE();
				            }
				        });
				    }
				    // Management fee & VAT
				    document.getElementById('management_fee_percent_e').addEventListener('input', recalculateE);
				    document.getElementById('management_fee_value_e').addEventListener('input', recalculateE);
				    document.getElementById('vat_percent_e').addEventListener('change', recalculateE);
				}
				function recalculateE() {
				    let total = 0;
				    document.querySelectorAll('#products_services_body_e .amount-input').forEach(function(input){
				        total += parseInt(input.value) || 0;
				    });
				    document.getElementById('total_amount_e').value = formatRupiah(total);
				    let feePercent = parseFloat(document.getElementById('management_fee_percent_e').value) || 0;
				    let feeNominal = parseInt(document.getElementById('management_fee_value_e').value) || 0;
				    let vatPercent = parseFloat(document.getElementById('vat_percent_e').value) || 0;
				    let fee = getManagementFee(total, feePercent, feeNominal);
				    let sales = total + fee;
				    let vat = Math.round(sales * (vatPercent/100));
				    let invoice = sales + vat;
				    document.getElementById('sales_amount_e').value = formatRupiah(sales);
				    document.getElementById('vat_amount_e').value = formatRupiah(vat);
				    document.getElementById('invoice_amount_e').value = formatRupiah(invoice);
				}
				function showTypeEForm() {
				    document.getElementById('form_type_a').style.display = 'none';
				    document.getElementById('form_type_b').style.display = 'none';
				    document.getElementById('form_type_c').style.display = 'none';
				    document.getElementById('form_type_d').style.display = 'none';
				    document.getElementById('form_type_e').style.display = '';
				    // Kosongkan tabel
				    const tbody = document.getElementById('products_services_body_e');
				    tbody.innerHTML = '';
				    // Tambah baris pertama
				    const tr = createRowE();
				    tbody.appendChild(tr);
				    // Pasang event listener
				    setupTypeEListeners();
				}
				document.getElementById('boq_type').addEventListener('change', function() {
					if (this.value === 'A') {
						document.getElementById('form_type_a').style.display = '';
						document.getElementById('form_type_b').style.display = 'none';
						document.getElementById('form_type_c').style.display = 'none';
						document.getElementById('form_type_d').style.display = 'none';
						document.getElementById('form_type_e').style.display = 'none';
					} else if (this.value === 'B') {
						document.getElementById('form_type_a').style.display = 'none';
						document.getElementById('form_type_b').style.display = '';
						document.getElementById('form_type_c').style.display = 'none';
						document.getElementById('form_type_d').style.display = 'none';
						document.getElementById('form_type_e').style.display = 'none';
					} else if (this.value === 'C') {
						showTypeCForm();
						document.getElementById('form_type_d').style.display = 'none';
						document.getElementById('form_type_e').style.display = 'none';
					} else if (this.value === 'D') {
						showTypeDForm();
						document.getElementById('form_type_e').style.display = 'none';
					} else if (this.value === 'E') {
						showTypeEForm();
					}
				});
				// Type A listeners
				['basic_price_a','management_fee_percent_a','management_fee_value_a','vat_percent_a'].forEach(function(id){
					let el = document.getElementById(id);
					if(el) el.addEventListener('input', recalculateA);
					if(el && id==='vat_percent_a') el.addEventListener('change', recalculateA);
				});
				// Type B listeners
				['qty_adult','price_adult','qty_child','price_child','qty_infant','price_infant','management_fee_percent_b','management_fee_value_b','vat_percent_b'].forEach(function(id){
					let el = document.getElementById(id);
					if(el) el.addEventListener('input', recalculateB);
					if(el && id==='vat_percent_b') el.addEventListener('change', recalculateB);
				});
				// Type C listeners
				setupTypeCListeners(); // Call setupTypeCListeners here to ensure it's ready when Type C is shown

				// Type D listeners
				setupTypeDListeners(); // Call setupTypeDListeners here to ensure it's ready when Type D is shown

				// Type E listeners
				setupTypeEListeners(); // Call setupTypeEListeners here to ensure it's ready when Type E is shown

				function resetAllFormTypes() {
					['form_type_a','form_type_b','form_type_c','form_type_d','form_type_e'].forEach(function(formId) {
						var form = document.getElementById(formId);
						if (!form) return;
						// Reset input, textarea, select
						form.querySelectorAll('input, textarea, select').forEach(function(el) {
							if (el.type === 'checkbox' || el.type === 'radio') {
								el.checked = false;
							} else if (el.type === 'number' || el.type === 'text' || el.tagName === 'TEXTAREA') {
								el.value = '';
							} else if (el.tagName === 'SELECT') {
								el.selectedIndex = 0;
							}
						});
						// Reset table body if ada
						var tbody = form.querySelector('tbody');
						if (tbody) tbody.innerHTML = '';
						// Reset total/amount fields if ada
						form.querySelectorAll('input[readonly]').forEach(function(el){ el.value = ''; });
					});
				}

				document.getElementById('boq_type').addEventListener('change', function() {
					resetAllFormTypes();
					if (this.value === 'A') {
						document.getElementById('form_type_a').style.display = '';
						document.getElementById('form_type_b').style.display = 'none';
						document.getElementById('form_type_c').style.display = 'none';
						document.getElementById('form_type_d').style.display = 'none';
						document.getElementById('form_type_e').style.display = 'none';
					} else if (this.value === 'B') {
						document.getElementById('form_type_a').style.display = 'none';
						document.getElementById('form_type_b').style.display = '';
						document.getElementById('form_type_c').style.display = 'none';
						document.getElementById('form_type_d').style.display = 'none';
						document.getElementById('form_type_e').style.display = 'none';
					} else if (this.value === 'C') {
						showTypeCForm();
						document.getElementById('form_type_d').style.display = 'none';
						document.getElementById('form_type_e').style.display = 'none';
					} else if (this.value === 'D') {
						showTypeDForm();
						document.getElementById('form_type_e').style.display = 'none';
					} else if (this.value === 'E') {
						showTypeEForm();
					}
				});
			</script>
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

<style>
#products_services_table_c td input,
#products_services_table_c td select {
    min-width: 160px;
}

#products_services_table_d td input,
#products_services_table_d td select {
    min-width: 160px;
}

#products_services_table_e td input,
#products_services_table_e td select {
    min-width: 160px;
}
</style>

