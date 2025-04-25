<?php $page = 'bank-accounts'; ?>
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
									<h4 class="page-title">Settings</h4>
								</div>
								<div class="col-4 text-end">
									<div class="head-icons">
										<a href="{{url('bank-accounts')}}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Refresh"><i class="ti ti-refresh-dot"></i></a>
										<a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Collapse" id="collapse-header"><i class="ti ti-chevrons-up"></i></a>
									</div>
								</div>
							</div>
						</div>
						<!-- /Page Header -->

						<!-- Settings Menu -->
						@component('components.settings-menu')
						@endcomponent
						<!-- /Settings Menu -->

						<div class="row">
							<div class="col-xl-3 col-lg-12 theiaStickySidebar">

								<!-- Settings Sidebar -->
								<div class="card">
									<div class="card-body">
										<div class="settings-sidebar">
											<h4 class="fw-semibold mb-3">Financial Settings</h4>
											<div class="list-group list-group-flush settings-sidebar">
												<a href="{{url('payment-gateways')}}" class="fw-medium">Payment Gateways</a>
												<a href="{{url('bank-accounts')}}" class="fw-medium active">Bank Accounts</a>
												<a href="{{url('tax-rates')}}" class="fw-medium">Tax Rates</a>
												<a href="{{url('currencies')}}" class="fw-medium">Currencies</a>
											</div>
										</div>
									</div>
								</div>
								<!-- /Settings Sidebar -->

							</div>

							<div class="col-xl-9 col-lg-12">

								<!-- Settings Info -->
								<div class="card">
									<div class="card-body pb-0">
										<div class="d-flex align-items-center justify-content-between mb-4">
											<h4 class="fs-20">Bank Accounts</h4>
											<a href="javascript:void(0)" class="btn btn-sm btn-icon rounded border" data-bs-toggle="modal" data-bs-target="#add_bank" ><i class="ti ti-plus"></i></a>
										</div>
										<div class="row">

											<!-- Bank Account -->
											<div class="col-xxl-4 col-sm-6">
												<div class="bank-box active">
													<div class="mb-4">
														<h5 class="fw-semibold mb-1">HDFC</h5>
														<p class="fw-medium">**** **** 4872</p>
													</div>
													<div class="d-flex align-items-center justify-content-between">
														<div>
															<h6 class="fw-medium mb-1">Holder Name</h6>
															<p class="fs-12">Darlee Robertson</p>
														</div>
														<div class="dropdown table-action">
															<a href="#" class="action-icon" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
															<div class="dropdown-menu dropdown-menu-right">
																<a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edit_bank"><i class="fa-solid fa-pencil text-blue"></i> Edit</a>
																<a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_bank"><i class="fa-regular fa-trash-can text-danger"></i> Delete</a>
															</div>
														</div>
													</div>
												</div>
											</div>	
											<!-- /Bank Account -->

											<!-- Bank Account -->
											<div class="col-xxl-4 col-sm-6">
												<div class="bank-box">
													<div class="mb-4">
														<h5 class="fw-semibold mb-1">SBI</h5>
														<p class="fw-medium">**** **** 2495</p>
													</div>
													<div class="d-flex align-items-center justify-content-between">
														<div>
															<h6 class="fw-medium mb-1">Holder Name</h6>
															<p class="fs-12">Sharon Roy</p>
														</div>
														<div class="dropdown table-action">
															<a href="#" class="action-icon" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
															<div class="dropdown-menu dropdown-menu-right">
																<a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edit_bank"><i class="fa-solid fa-pencil text-blue"></i> Edit</a>
																<a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_bank"><i class="fa-regular fa-trash-can text-danger"></i> Delete</a>
															</div>
														</div>
													</div>
												</div>
											</div>	
											<!-- /Bank Account -->

											<!-- Bank Account -->
											<div class="col-xxl-4 col-sm-6">
												<div class="bank-box">
													<div class="mb-4">
														<h5 class="fw-semibold mb-1">KVB</h5>
														<p class="fw-medium">**** **** 3948</p>
													</div>
													<div class="d-flex align-items-center justify-content-between">
														<div>
															<h6 class="fw-medium mb-1">Holder Name</h6>
															<p class="fs-12">Vaughan</p>
														</div>
														<div class="dropdown table-action">
															<a href="#" class="action-icon" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
															<div class="dropdown-menu dropdown-menu-right">
																<a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edit_bank"><i class="fa-solid fa-pencil text-blue"></i> Edit</a>
																<a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_bank"><i class="fa-regular fa-trash-can text-danger"></i> Delete</a>
															</div>
														</div>
													</div>
												</div>
											</div>	
											<!-- /Bank Account -->

										</div>
									</div>
								</div>
								<!-- /Settings Info -->

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