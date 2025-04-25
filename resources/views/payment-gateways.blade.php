<?php $page = 'payment-gateways'; ?>
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
										<a href="{{url('payment-gateways')}}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Refresh"><i class="ti ti-refresh-dot"></i></a>
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
												<a href="{{url('payment-gateways')}}" class="fw-medium active">Payment Gateways</a>
												<a href="{{url('bank-accounts')}}" class="fw-medium">Bank Accounts</a>
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
									<div class="card-body">
										<div class="mb-4">
											<h4 class="fs-20">Payment Gateways</h4>
										</div>
										<div class="row">

											<!-- Email Wrap -->
											<div class="col-md-12">
												<!-- Payment -->
												<div class="border rounded p-3 mb-4">
													<div class="row gy-3">
														<div class="col-sm-5">
															<div class="d-flex align-items-center">
																<span class="border rounded d-flex align-items-center justify-content-center payment-img p-2">
																	<img src="{{ URL::asset('/build/img/icons/payment-01.svg')}}" alt="">
																</span>
																<div class="ms-2">
																	<a href="javascript:void(0);" class="badge bg-soft-success">Connected</a>
																</div>
															</div>
														</div>
														<div class="col-sm-7">
															<div class="d-flex align-items-center justify-content-between">
																<div>
																	<a href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#php-mail" class="text-default me-2"><i class="ti ti-info-circle-filled"></i></a>
																	<a href="#" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#add_paypal"><i class="ti ti-tool me-1"></i>View Integration</a>
																</div>
																<div class="status-toggle ms-auto">
																	<input type="checkbox" id="mail1" class="check" checked="">
																	<label for="mail1" class="checktoggle">	</label>
																</div>
															</div>
														</div>
													</div>
													<div class="collapse pt-3 mt-3 border-top" id="php-mail">
														<div>
															<p>PayPal Holdings, Inc. is an American multinational financial technology company operating an online payments system in the majority of countries that support online money transfers, and serves as an electronic alternative to traditional paper methods such as checks and money orders. </p>
														</div>
													</div>
												</div>
												<!-- /Payment -->
												<!-- Payment -->
												<div class="border rounded p-3 mb-4">
													<div class="row  gy-3">
														<div class="col-sm-5">
															<div class="d-flex align-items-center">
																<span class="border rounded d-flex align-items-center justify-content-center payment-img p-2">
																	<img src="{{ URL::asset('/build/img/icons/payment-02.svg')}}" alt="">
																</span>
																<div class="ms-2">
																	<a href="javascript:void(0);" class="badge bg-soft-purple text-purple">Not Connected</a>
																</div>
															</div>
														</div>
														<div class="col-sm-7">
															<div class="d-flex align-items-center justify-content-between">
																<div>
																	<a href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapse1" class="text-default me-2"><i class="ti ti-info-circle-filled"></i></a>
																	<a href="#" class="btn btn-primary"><i class="ti ti-plug-connected me-1"></i>Connect Now</a>
																</div>
																<div class="status-toggle ms-auto">
																	<input type="checkbox" id="mail2" class="check" checked="">
																	<label for="mail2" class="checktoggle">	</label>
																</div>
															</div>
														</div>
													</div>
													<div class="collapse pt-3 mt-3 border-top" id="collapse1">
														<div>
															<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla dapibus magna sit amet risus dictum iaculis. Donec fermentum fermentum tincidunt. Pellentesque mauris elit, viverra non eros in, condimentum vulputate libero. Phasellus eu orci et felis maximus posuere.</p>
														</div>
													</div>
												</div>
												<!-- /Payment -->
												<!-- Payment -->
												<div class="border rounded p-3 mb-4">
													<div class="row  gy-3">
														<div class="col-sm-5">
															<div class="d-flex align-items-center">
																<span class="border rounded d-flex align-items-center justify-content-center payment-img p-2">
																	<img src="{{ URL::asset('/build/img/icons/payment-03.svg')}}" alt="">
																</span>
																<div class="ms-2">
																	<a href="javascript:void(0);" class="badge bg-soft-purple text-purple">Not Connected</a>
																</div>
															</div>
														</div>
														<div class="col-sm-7">
															<div class="d-flex align-items-center justify-content-between">
																<div>
																	<a href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapse2" class="text-default me-2"><i class="ti ti-info-circle-filled"></i></a>
																	<a href="#" class="btn btn-primary"><i class="ti ti-plug-connected me-1"></i>Connect Now</a>
																</div>
																<div class="status-toggle ms-auto">
																	<input type="checkbox" id="mail3" class="check" checked="">
																	<label for="mail3" class="checktoggle">	</label>
																</div>
															</div>
														</div>
													</div>
													<div class="collapse pt-3 mt-3 border-top" id="collapse2">
														<div>
															<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla dapibus magna sit amet risus dictum iaculis. Donec fermentum fermentum tincidunt. Pellentesque mauris elit, viverra non eros in, condimentum vulputate libero. Phasellus eu orci et felis maximus posuere.</p>
														</div>
													</div>
												</div>
												<!-- /Payment -->
												<!-- Payment -->
												<div class="border rounded p-3 mb-4">
													<div class="row  gy-3">
														<div class="col-sm-5">
															<div class="d-flex align-items-center">
																<span class="border rounded d-flex align-items-center justify-content-center payment-img p-2">
																	<img src="{{ URL::asset('/build/img/icons/payment-04.svg')}}" alt="">
																</span>
																<div class="ms-2">
																	<a href="javascript:void(0);" class="badge bg-soft-success">Connected</a>
																</div>
															</div>
														</div>
														<div class="col-sm-7">
															<div class="d-flex align-items-center justify-content-between">
																<div>
																	<a href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapse3" class="text-default me-2"><i class="ti ti-info-circle-filled"></i></a>
																	<a href="#" class="btn btn-light"><i class="ti ti-tool me-1"></i>View Integration</a>
																</div>
																<div class="status-toggle ms-auto">
																	<input type="checkbox" id="mail4" class="check" checked="">
																	<label for="mail4" class="checktoggle">	</label>
																</div>
															</div>
														</div>
													</div>
													<div class="collapse pt-3 mt-3 border-top" id="collapse3">
														<div>
															<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla dapibus magna sit amet risus dictum iaculis. Donec fermentum fermentum tincidunt. Pellentesque mauris elit, viverra non eros in, condimentum vulputate libero. Phasellus eu orci et felis maximus posuere.</p>
														</div>
													</div>
												</div>
												<!-- /Payment -->
												<!-- Payment -->
												<div class="border rounded p-3 mb-4">
													<div class="row  gy-3">
														<div class="col-sm-5">
															<div class="d-flex align-items-center">
																<span class="border rounded d-flex align-items-center justify-content-center payment-img p-2">
																	<img src="{{ URL::asset('/build/img/icons/payment-05.svg')}}" alt="">
																</span>
																<div class="ms-2">
																	<a href="javascript:void(0);" class="badge bg-soft-purple text-purple">Not Connected</a>
																</div>
															</div>
														</div>
														<div class="col-sm-7">
															<div class="d-flex align-items-center justify-content-between">
																<div>
																	<a href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapse4" class="text-default me-2"><i class="ti ti-info-circle-filled"></i></a>
																	<a href="#" class="btn btn-primary"><i class="ti ti-plug-connected me-1"></i>Connect Now</a>
																</div>
																<div class="status-toggle ms-auto">
																	<input type="checkbox" id="mail5" class="check" checked="">
																	<label for="mail5" class="checktoggle">	</label>
																</div>
															</div>
														</div>
													</div>
													<div class="collapse pt-3 mt-3 border-top" id="collapse4">
														<div>
															<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla dapibus magna sit amet risus dictum iaculis. Donec fermentum fermentum tincidunt. Pellentesque mauris elit, viverra non eros in, condimentum vulputate libero. Phasellus eu orci et felis maximus posuere.</p>
														</div>
													</div>
												</div>
												<!-- /Payment -->
												<!-- Payment -->
												<div class="border rounded p-3 mb-4">
													<div class="row  gy-3">
														<div class="col-sm-5">
															<div class="d-flex align-items-center">
																<span class="border rounded d-flex align-items-center justify-content-center payment-img p-2">
																	<img src="{{ URL::asset('/build/img/icons/payment-06.svg')}}" alt="">
																</span>
																<div class="ms-2">
																	<a href="javascript:void(0);" class="badge bg-soft-success">Connected</a>
																</div>
															</div>
														</div>
														<div class="col-sm-7">
															<div class="d-flex align-items-center justify-content-between">
																<div>
																	<a href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapse5" class="text-default me-2"><i class="ti ti-info-circle-filled"></i></a>
																	<a href="#" class="btn btn-light"><i class="ti ti-tool me-1"></i>View Integration</a>
																</div>
																<div class="status-toggle ms-auto">
																	<input type="checkbox" id="mail6" class="check" checked="">
																	<label for="mail6" class="checktoggle">	</label>
																</div>
															</div>
														</div>
													</div>
													<div class="collapse pt-3 mt-3 border-top" id="collapse5">
														<div>
															<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla dapibus magna sit amet risus dictum iaculis. Donec fermentum fermentum tincidunt. Pellentesque mauris elit, viverra non eros in, condimentum vulputate libero. Phasellus eu orci et felis maximus posuere.</p>
														</div>
													</div>
												</div>
												<!-- /Payment -->
												<!-- Payment -->
												<div class="border rounded p-3 mb-4">
													<div class="row  gy-3">
														<div class="col-sm-5">
															<div class="d-flex align-items-center">
																<span class="border rounded d-flex align-items-center justify-content-center payment-img p-2">
																	<img src="{{ URL::asset('/build/img/icons/payment-07.svg')}}" alt="">
																</span>
																<div class="ms-2">
																	<a href="javascript:void(0);" class="badge bg-soft-purple text-purple">Not Connected</a>
																</div>
															</div>
														</div>
														<div class="col-sm-7">
															<div class="d-flex align-items-center justify-content-between">
																<div>
																	<a href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapse6" class="text-default me-2"><i class="ti ti-info-circle-filled"></i></a>
																	<a href="#" class="btn btn-primary"><i class="ti ti-plug-connected me-1"></i>Connect Now</a>
																</div>
																<div class="status-toggle ms-auto">
																	<input type="checkbox" id="mail7" class="check" checked="">
																	<label for="mail7" class="checktoggle">	</label>
																</div>
															</div>
														</div>
													</div>
													<div class="collapse pt-3 mt-3 border-top" id="collapse6">
														<div>
															<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla dapibus magna sit amet risus dictum iaculis. Donec fermentum fermentum tincidunt. Pellentesque mauris elit, viverra non eros in, condimentum vulputate libero. Phasellus eu orci et felis maximus posuere.</p>
														</div>
													</div>
												</div>
												<!-- /Payment -->
												<!-- Payment -->
												<div class="border rounded p-3 mb-4">
													<div class="row  gy-3">
														<div class="col-sm-5">
															<div class="d-flex align-items-center">
																<span class="border rounded d-flex align-items-center justify-content-center payment-img p-2">
																	<img src="{{ URL::asset('/build/img/icons/payment-08.svg')}}" alt="">
																</span>
																<div class="ms-2">
																	<a href="javascript:void(0);" class="badge bg-soft-success">Connected</a>
																</div>
															</div>
														</div>
														<div class="col-sm-7">
															<div class="d-flex align-items-center justify-content-between">
																<div>
																	<a href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapse7" class="text-default me-2"><i class="ti ti-info-circle-filled"></i></a>
																	<a href="#" class="btn btn-light"><i class="ti ti-tool me-1"></i>View Integration</a>
																</div>
																<div class="status-toggle ms-auto">
																	<input type="checkbox" id="mail8" class="check" checked="">
																	<label for="mail8" class="checktoggle">	</label>
																</div>
															</div>
														</div>
													</div>
													<div class="collapse pt-3 mt-3 border-top" id="collapse7">
														<div>
															<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla dapibus magna sit amet risus dictum iaculis. Donec fermentum fermentum tincidunt. Pellentesque mauris elit, viverra non eros in, condimentum vulputate libero. Phasellus eu orci et felis maximus posuere.</p>
														</div>
													</div>
												</div>
												<!-- /Payment -->
												 <!-- Payment -->
												<div class="border rounded p-3 mb-4">
													<div class="row  gy-3">
														<div class="col-sm-5">
															<div class="d-flex align-items-center">
																<span class="border rounded d-flex align-items-center justify-content-center payment-img p-2">
																	<img src="{{ URL::asset('/build/img/icons/payment-09.svg')}}" alt="">
																</span>
																<div class="ms-2">
																	<a href="javascript:void(0);" class="badge bg-soft-success">Connected</a>
																</div>
															</div>
														</div>
														<div class="col-sm-7">
															<div class="d-flex align-items-center justify-content-between">
																<div>
																	<a href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapse8" class="text-default me-2"><i class="ti ti-info-circle-filled"></i></a>
																	<a href="#" class="btn btn-light"><i class="ti ti-tool me-1"></i>View Integration</a>
																</div>
																<div class="status-toggle ms-auto">
																	<input type="checkbox" id="mail9" class="check" checked="">
																	<label for="mail9" class="checktoggle">	</label>
																</div>
															</div>
														</div>
													</div>
													<div class="collapse pt-3 mt-3 border-top" id="collapse8">
														<div>
															<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla dapibus magna sit amet risus dictum iaculis. Donec fermentum fermentum tincidunt. Pellentesque mauris elit, viverra non eros in, condimentum vulputate libero. Phasellus eu orci et felis maximus posuere.</p>
														</div>
													</div>
												</div>
												<!-- /Payment -->
												 <!-- Payment -->
												<div class="border rounded p-3">
													<div class="row  gy-3">
														<div class="col-sm-5">
															<div class="d-flex align-items-center">
																<span class="border rounded d-flex align-items-center justify-content-center payment-img p-2">
																	<img src="{{ URL::asset('/build/img/icons/payment-10.svg')}}" alt="">
																</span>
																<div class="ms-2">
																	<a href="javascript:void(0);" class="badge bg-soft-purple text-purple">Not Connected</a>
																</div>
															</div>
														</div>
														<div class="col-sm-7">
															<div class="d-flex align-items-center justify-content-between">
																<div>
																	<a href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapse9" class="text-default me-2"><i class="ti ti-info-circle-filled"></i></a>
																	<a href="#" class="btn btn-primary"><i class="ti ti-plug-connected me-1"></i>Connect Now</a>
																</div>
																<div class="status-toggle ms-auto">
																	<input type="checkbox" id="mail10" class="check" checked="">
																	<label for="mail10" class="checktoggle">	</label>
																</div>
															</div>
														</div>
													</div>
													<div class="collapse pt-3 mt-3 border-top" id="collapse9">
														<div>
															<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla dapibus magna sit amet risus dictum iaculis. Donec fermentum fermentum tincidunt. Pellentesque mauris elit, viverra non eros in, condimentum vulputate libero. Phasellus eu orci et felis maximus posuere.</p>
														</div>
													</div>
												</div>
												<!-- /Payment -->
											</div>
											<!-- /Email Wrap -->

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