<?php $page = 'printers'; ?>
@extends('layout.mainlayout')
@section('content')
		<!-- Page Wrapper -->
		<div class="page-wrapper">
			<div class="content">
				<div class="row">
					<div class="col-md-12">

						
						
						@component('components.breadcrumb')
						@slot('title')
						Settings
						@endslot
						@slot('item2')
						printers
						@endslot
					   @endcomponent

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
											<h4 class="fw-semibold mb-3">App Settings</h4>
											<div class="list-group list-group-flush settings-sidebar">
												<a href="{{url('invoice-settings')}}" class="fw-medium">Invoice Settings</a>
												<a href="{{url('printers')}}" class="fw-medium active">Printer</a>
												<a href="{{url('custom-fields')}}" class="fw-medium">Custom Fields</a>
											</div>
										</div>
									</div>
								</div>
								<!-- /Settings Sidebar -->

							</div>

							<div class="col-xl-9 col-lg-12">

								<!-- Printers -->
								<div class="card">
									<div class="card-body">
										<div class="d-flex align-items-center justify-content-between mb-3">
											<h4>Printer</h4>
											<a href="javascript:void(0)" class="btn btn-icon btn-sm border btn-outline-light" data-bs-toggle="modal" data-bs-target="#add_printer" ><i class="ti ti-plus"></i></a>
										</div>
										<form action="printers.html">
											<!-- Hp -->
											<div class="d-flex align-items-center justify-content-between mb-3 pb-3 border-bottom">
												<div>
													<h5 class="fw-semibold mb-1">Hp</h5>
													<p>Shows the details of Hp printers</p>
												</div>
												<div class="dropdown">
													<a href="#" class="btn btn-icon btn-sm border btn-outline-light d-inline-flex align-items-center justify-content-center" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
													<div class="dropdown-menu dropdown-menu-right">
														<a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edit_printer"><i class="fa-solid fa-pencil text-blue me-1"></i>Edit</a>
														<a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_printer"><i class="fa-regular fa-trash-can text-danger me-1"></i>Delete</a>
													</div>
												</div>
											</div>
											<div class="border-bottom mb-3">
												<div class="row">
													<div class="col-md-3 col-sm-6">
														<div class="mb-3">
															<label class="form-label">Printer Name </label>
															<input type="text" class="form-control" value="Hp printer">
														</div>
													</div>
													<div class="col-md-3 col-sm-6">
														<div class="mb-3">
															<label class="form-label">Connection Type</label>
															<input type="text" class="form-control" value="Network">
														</div>
													</div>
													<div class="col-md-3 col-sm-6">
														<div class="mb-3">
															<label class="form-label">IP Address</label>
															<input type="text" class="form-control" value="192.168.0.1">
														</div>
													</div>
													<div class="col-md-3 col-sm-6">
														<div class="mb-3">
															<label class="form-label">Port</label>
															<input type="text" class="form-control" value="900">
														</div>
													</div>
												</div>
											</div>
											<!-- /Euro -->

											<!-- Epson -->
											<div class="d-flex align-items-center justify-content-between border-bottom mb-3 pb-3">
												<div>
													<h5 class="fw-semibold mb-1">Epson</h5>
													<p>Shows the details of Epson printers</p>
												</div>
												<div class="dropdown">
													<a href="#" class="btn btn-icon btn-sm border btn-outline-light d-inline-flex align-items-center justify-content-center" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
													<div class="dropdown-menu dropdown-menu-right">
														<a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edit_printer"><i class="fa-solid fa-pencil text-blue me-1"></i>Edit</a>
														<a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_printer"><i class="fa-regular fa-trash-can text-danger me-1"></i>Delete</a>
													</div>
												</div>
											</div>
											<div class="mb-0">
												<div class="row">
													<div class="col-md-3 col-sm-6">
														<div class="mb-3">
															<label class="form-label">Printer Name </label>
															<input type="text" class="form-control" value="Epson">
														</div>
													</div>
													<div class="col-md-3 col-sm-6">
														<div class="mb-3">
															<label class="form-label">Connection Type</label>
															<input type="text" class="form-control" value="Network">
														</div>
													</div>
													<div class="col-md-3 col-sm-6">
														<div class="mb-3">
															<label class="form-label">IP Address</label>
															<input type="text" class="form-control" value="192.168.0.1">
														</div>
													</div>
													<div class="col-md-3 col-sm-6">
														<div class="mb-3">
															<label class="form-label">Port</label>
															<input type="text" class="form-control" value="900">
														</div>
													</div>
												</div>
											</div>
											<!-- /Epson -->

											<div>
												<a href="#" class="btn btn-light me-2">Cancel</a>
												<button type="submit" class="btn btn-primary">Save Changes</button>
											</div>
										</form>

									</div>
								</div>
								<!-- /Printers -->

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