<?php $page = 'localization'; ?>
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
										<a href="{{url('localization')}}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Refresh"><i class="ti ti-refresh-dot"></i></a>
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
											<h4 class="fw-semibold mb-3">Website Settings</h4>
											<div class="list-group list-group-flush settings-sidebar">
												<a href="{{url('company-settings')}}" class="fw-medium">Company Settings</a>
												<a href="{{url('localization')}}" class="fw-medium active">Localization</a>
												<a href="{{url('prefixes')}}" class="fw-medium">Prefixes</a>
												<a href="{{url('preference')}}" class="fw-medium">Preference</a>
												<a href="{{url('appearance')}}" class="fw-medium">Appearance</a>
												<a href="{{url('language')}}" class="fw-medium">Language</a>
											</div>
										</div>
									</div>
								</div>
								<!-- /Settings Sidebar -->

							</div>

							<div class="col-xl-9 col-lg-12">

								<!-- Prefixes -->
								<div class="card">
									<div class="card-body">
										<h4 class="fw-semibold mb-3">Localization</h4>
										<form action="localization">	
											<div class="border-bottom mb-3 pb-3">
												<h5 class="fw-semibold mb-1">Basic Information</h5>
												<p>Provide the basic information below</p>
											</div>			
											<div class="border-bottom mb-3">			
												<div class="row">
													<div class="col-md-8">
														<div class="mb-3">
															<h6>Language</h6>
															<p>Select Language of the website</p>
														</div>
													</div>
													<div class="col-md-4">
														<div class="mb-3">
															<select class="select">
																<option selected>English</option>
																<option>Chinese</option>
																<option>Hindi</option>
															</select>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-8">
														<div class="mb-3">
															<h6>Language Switcher</h6>
															<p>To display in all the pages</p>
														</div>
													</div>
													<div class="col-md-4">
														<div class="mb-3">
															<div class="status-toggle">
																<input type="checkbox" id="prefer3" class="check" checked="">
																<label for="prefer3" class="checktoggle">	</label>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-8">
														<div class="mb-3">
															<h6>Timezone</h6>
															<p>Select date format to display in website</p>
														</div>
													</div>
													<div class="col-md-4">
														<div class="mb-3">
															<select class="select">
																<option selected>UTC 4:30</option>
																<option>(UTC+11:00) INR</option>
															</select>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-8">
														<div class="mb-3">
															<h6>Date Format</h6>
															<p>Select Language of the website</p>
														</div>
													</div>
													<div class="col-md-4">
														<div class="mb-3">
															<select class="select">
																<option selected>01 Jan 2023</option>
																<option>01-Jan-2023</option>
															</select>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-8">
														<div class="mb-3">
															<h6>Time Format</h6>
															<p>Select time format to display in website</p>
														</div>
													</div>
													<div class="col-md-4">
														<div class="mb-3">
															<select class="select">
																<option selected>English</option>
																<option>12 Hours</option>
																<option>24 Hours</option>
															</select>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-8">
														<div class="mb-3">
															<h6>Financial Year</h6>
															<p>Select year for finance</p>
														</div>
													</div>
													<div class="col-md-4">
														<div class="mb-3">
															<select class="select">
																<option selected>2023</option>
																<option>2024</option>
																<option>2022</option>
															</select>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-8">
														<div class="mb-3">
															<h6>Starting Month</h6>
															<p>Select starting month to display</p>
														</div>
													</div>
													<div class="col-md-4">
														<div class="mb-3">
															<select class="select">
																<option selected>January</option>
																<option>February</option>
																<option>March</option>
															</select>
														</div>
													</div>
												</div>
											</div>
											<div class="border-bottom mb-3 pb-3">
												<h5 class="fw-semibold mb-1">Currency Settings</h5>
												<p>Provide the currency information below</p>
											</div>			
											<div class="border-bottom mb-3">			
												<div class="row">
													<div class="col-md-8">
														<div class="mb-3">
															<h6>Currency</h6>
															<p>Select currency</p>
														</div>
													</div>
													<div class="col-md-4">
														<div class="mb-3">
															<select class="select">
																<option selected>United States Of America</option>
																<option>India</option>
															</select>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-8">
														<div class="mb-3">
															<h6>Currency Symbol</h6>
															<p>Select currency symbol</p>
														</div>
													</div>
													<div class="col-md-4">
														<div class="mb-3">
															<select class="select">
																<option selected>$</option>
																<option>€</option>
															</select>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-8">
														<div class="mb-3">
															<h6>Currency Position</h6>
															<p>Select currency position</p>
														</div>
													</div>
													<div class="col-md-4">
														<div class="mb-3">
															<select class="select">
																<option selected>$100</option>
																<option>$400</option>
															</select>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-8">
														<div class="mb-3">
															<h6>Decimal Seperator</h6>
															<p>Select decimal seperator</p>
														</div>
													</div>
													<div class="col-md-4">
														<div class="mb-3">
															<select class="select">
																<option selected>,</option>
																<option>,</option>
															</select>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-8">
														<div class="mb-3">
															<h6>Thousand Seperator</h6>
															<p>Select thousand seperator</p>
														</div>
													</div>
													<div class="col-md-4">
														<div class="mb-3">
															<select class="select">
																<option selected>,</option>
																<option>.</option>
															</select>
														</div>
													</div>
												</div>
											</div>
											<div class="border-bottom mb-3 pb-3">
												<h5 class="fw-semibold mb-1">Country Settings</h5>
												<p>Provide the country information below</p>
											</div>			
											<div class="border-bottom mb-3">			
												<div class="row">
													<div class="col-md-8">
														<div class="mb-3">
															<h6>Countries Restriction</h6>
															<p>Select restricted countries</p>
														</div>
													</div>
													<div class="col-md-4">
														<div class="mb-3">
															<select class="select">
																<option selected>Allow All Countries</option>
																<option>Deny All Countries</option>
															</select>
														</div>
													</div>
												</div>
											</div>
											<div class="border-bottom mb-3 pb-3">
												<h5 class="fw-semibold mb-1">File Settings</h5>
												<p>Provide the files information below</p>
											</div>	
											<div class="border-bottom mb-3 border-0 mb-0">		
												<div class="row">
													<div class="col-md-8">
														<div class="mb-3">
															<h6>Allowed Files</h6>
															<p>Select allowed files</p>
														</div>
													</div>
													<div class="col-md-4">
														<div class="mb-3">
															<input class="input-tags form-control" type="text" data-role="tagsinput"  name="Label" value="JPG, PNG, GIF" >	
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-8">
														<div class="mb-3">
															<h6>Max File Size</h6>
															<p>Select size of the files</p>
														</div>
													</div>
													<div class="col-md-4">
														<div class="mb-3">
															<input type="text" class="form-control" value="5000MB">
														</div>
													</div>
												</div>
											</div>
											<div>
												<a href="#" class="btn btn-light me-2">Cancel</a>
												<button type="submit" class="btn btn-primary">Save Changes</button>
											</div>
										</form>
									</div>
								</div>
								<!-- /Prefixes -->

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Page Wrapper -->
@endsection