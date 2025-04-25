<?php $page = 'membership-addons'; ?>
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
									<h4 class="page-title">Membership Addons</h4>
								</div>
								<div class="col-4 text-end">
									<div class="head-icons">
										<a href="{{url('membership-addons')}}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Refresh"><i class="ti ti-refresh-dot"></i></a>
										<a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Collapse" id="collapse-header"><i class="ti ti-chevrons-up"></i></a>
									</div>
								</div>
							</div>
						</div>
						<!-- /Page Header -->

						<div class="card">
							<div class="card-body">

								<!-- Membership Addons -->

								<form action="membership-addons">
									<div class="row">
										<div class="col-lg-4 col-md-6">
											<div class="mb-3">
												<label class="col-form-label">Addon Name <span class="text-danger">*</span></label>
												<input type="text" class="form-control">
											</div>
										</div>
										<div class="col-md-12">
											<h5 class="mb-3">Addon Settings</h5>
										</div>	
										<div class="col-lg-4 col-md-6">
											<div class="mb-3">
												<label class="col-form-label">Contacts <span class="text-danger">*</span></label>
												<div class="d-flex align-items-center">
													<input type="text" class="form-control" value="0-100">
													<div class="status-toggle ms-3">
														<input id="mem-tog-1" class="check" type="checkbox">
														<label for="mem-tog-1" class="checktoggle">checkbox</label>
													</div>
												</div>
												<label class="checkboxs mt-2"><input type="checkbox"><span class="checkmarks mem-plane-check"></span>Unlimited</label>
											</div>
										</div>
										<div class="col-lg-4 col-md-6">
											<div class="mb-3">
												<label class="col-form-label">Compaigns <span class="text-danger">*</span></label>
												<div class="d-flex align-items-center">
													<input type="text" class="form-control" value="0-100">
													<div class="status-toggle ms-3">
														<input id="mem-tog-4" class="check" type="checkbox">
														<label for="mem-tog-4" class="checktoggle">checkbox</label>
													</div>
												</div>
												<label class="checkboxs mt-2"><input type="checkbox"><span class="checkmarks mem-plane-check"></span>Unlimited</label>
											</div>
										</div>
										<div class="col-lg-4 col-md-6">
											<div class="mb-3">
												<label class="col-form-label">Leads <span class="text-danger">*</span></label>
												<div class="d-flex align-items-center">
													<input type="text" class="form-control" value="0-100">
													<div class="status-toggle ms-3">
														<input id="mem-tog-2" class="check" type="checkbox">
														<label for="mem-tog-2" class="checktoggle">checkbox</label>
													</div>
												</div>
												<label class="checkboxs mt-2"><input type="checkbox"><span class="checkmarks mem-plane-check"></span>Unlimited</label>
											</div>
										</div>
										<div class="col-lg-4 col-md-6">
											<div class="mb-3">
												<label class="col-form-label">Tasks <span class="text-danger">*</span></label>
												<div class="d-flex align-items-center">
													<input type="text" class="form-control" value="0-100">
													<div class="status-toggle ms-3">
														<input id="mem-tog-7" class="check" type="checkbox">
														<label for="mem-tog-7" class="checktoggle">checkbox</label>
													</div>
												</div>
												<label class="checkboxs mt-2"><input type="checkbox"><span class="checkmarks mem-plane-check"></span>Unlimited</label>
											</div>
										</div>
										<div class="col-lg-4 col-md-6">
											<div class="mb-3">
												<label class="col-form-label">Companies <span class="text-danger">*</span></label>
												<div class="d-flex align-items-center">
													<input type="text" class="form-control" value="0-100">
													<div class="status-toggle ms-3">
														<input id="mem-tog-3" class="check" type="checkbox">
														<label for="mem-tog-3" class="checktoggle">checkbox</label>
													</div>
												</div>
												<label class="checkboxs mt-2"><input type="checkbox"><span class="checkmarks mem-plane-check"></span>Unlimited</label>
											</div>
										</div>
										<div class="col-lg-4 col-md-6">
											<div class="mb-3">
												<label class="col-form-label">Pipelines <span class="text-danger">*</span></label>
												<div class="d-flex align-items-center">
													<input type="text" class="form-control" value="0-100">
													<div class="status-toggle ms-3">
														<input id="mem-tog-8" class="check" type="checkbox">
														<label for="mem-tog-8" class="checktoggle">checkbox</label>
													</div>
												</div>
												<label class="checkboxs mt-2"><input type="checkbox"><span class="checkmarks mem-plane-check"></span>Unlimited</label>
											</div>
										</div>
										<div class="col-lg-4 col-md-6">
											<div class="mb-3">
												<label class="col-form-label">Projects <span class="text-danger">*</span></label>
												<div class="d-flex align-items-center">
													<input type="text" class="form-control" value="0-100">
													<div class="status-toggle ms-3">
														<input id="mem-tog-5" class="check" type="checkbox">
														<label for="mem-tog-5" class="checktoggle">checkbox</label>
													</div>
												</div>
												<label class="checkboxs mt-2"><input type="checkbox"><span class="checkmarks mem-plane-check"></span>Unlimited</label>
											</div>
										</div>
										<div class="col-lg-4 col-md-6">
											<div class="mb-3">
												<label class="col-form-label">Deals <span class="text-danger">*</span></label>
												<div class="d-flex align-items-center">
													<input type="text" class="form-control" value="0-100">
													<div class="status-toggle ms-3">
														<input id="mem-tog-6" class="check" type="checkbox">
														<label for="mem-tog-6" class="checktoggle">checkbox</label>
													</div>
												</div>
												<label class="checkboxs mt-2"><input type="checkbox"><span class="checkmarks mem-plane-check"></span>Unlimited</label>
											</div>
										</div>
										<div class="col-lg-4 col-md-6">
											<div class="mb-3">
												<label class="col-form-label">Activities <span class="text-danger">*</span></label>
												<div class="d-flex align-items-center">
													<input type="text" class="form-control" value="0-100">
													<div class="status-toggle ms-3">
														<input id="mem-tog-9" class="check" type="checkbox">
														<label for="mem-tog-9" class="checktoggle">checkbox</label>
													</div>
												</div>
												<label class="checkboxs mt-2"><input type="checkbox"><span class="checkmarks mem-plane-check"></span>Unlimited</label>
											</div>
										</div>
									</div>
									<div class="submit-button text-end">
										<a href="#" class="btn btn-light sidebar-close">Cancel</a>
										<button type="submit" class="btn btn-primary">Create</button>
									</div>
								</form>
								
								<!-- /Membership Addons -->							

							</div>
						</div>			
					</div>
				</div>

			</div>
		</div>
		<!-- /Page Wrapper -->
@endsection