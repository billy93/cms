<?php $page = 'deal-reports'; ?>
@extends('layout.mainlayout')
@section('content')

	<!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content">

            <div class="row">
                <div class="col-md-12">

                   
                    @component('components.breadcrumb')
                    @slot('title')
                    Deals
                    @endslot
                    @slot('item1')
                    123
                    @endslot
                    @slot('item2')
                    deal-reports
                    @endslot
                    @endcomponent
    

                    <div class="card">
						<div class="card-header">

							<!-- Search -->
							<div class="row">
								<div class="col-md-5 col-sm-4">
									<div class="icon-form mb-3 mb-sm-0">
										<span class="form-icon"><i class="ti ti-search"></i></span>
										<input type="text" class="form-control" placeholder="Search Deals">
									</div>							
								</div>		
								<div class="col-md-7 col-sm-8">					
									<div class="text-sm-end">
										<a href="download_report" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#download_report"><i class="ti ti-file-download me-2"></i>Download Report</a>
									</div>
								</div>
							</div>

							<!-- Search -->

						</div>

						<div class="card-body">
							<div class="row">
								<div class="col-md-7 d-flex">		
									<div class="card shadow flex-fill">
										<div class="card-header d-flex justify-content-between align-items-center flex-wrap row-gap-2">
											<h4>Deals by Year</h4>
											<div class="icon-form">
												<span class="form-icon"><i class="ti ti-calendar"></i></span>
												<input type="text" class="form-control bookingrange" placeholder="">
											</div>
										</div>
										<div class="card-body">
											<div id="deals-report"></div>
										</div>
									</div>
								</div>
								<div class="col-md-5 d-flex">		
									<div class="card shadow flex-fill">
										<div class="card-header d-flex justify-content-between align-items-center flex-wrap row-gap-2">
											<h4>Deals by Source</h4>
											<div class="icon-form ">
												<span class="form-icon"><i class="ti ti-calendar"></i></span>
												<input type="text" class="form-control bookingrange" placeholder="">
											</div>
										</div>
										<div class="card-body">
											<div id="deals-analysis"></div>
										</div>
									</div>
								</div>
							</div>

							<!-- Filter -->
							<div class="d-flex align-items-center justify-content-between flex-wrap mb-4 row-gap-2">
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
													<p class="mb-0 d-flex align-items-center"><i class="ti ti-grip-vertical me-2"></i>Deal Name</p>
													<div class="status-toggle">
														<input type="checkbox" id="col-name" class="check">
														<label for="col-name" class="checktoggle"></label>
													</div>
												</div>
												<div class="d-flex align-items-center justify-content-between mb-3">
													<p class="mb-0 d-flex align-items-center"><i class="ti ti-grip-vertical me-2"></i>Stage</p>
													<div class="status-toggle">
														<input type="checkbox" id="col-phone" class="check">
														<label for="col-phone" class="checktoggle"></label>
													</div>
												</div>
												<div class="d-flex align-items-center justify-content-between mb-3">
													<p class="mb-0 d-flex align-items-center"><i class="ti ti-grip-vertical me-2"></i>Deal Value</p>
													<div class="status-toggle">
														<input type="checkbox" id="col-email" class="check">
														<label for="col-email" class="checktoggle"></label>
													</div>
												</div>
												<div class="d-flex align-items-center justify-content-between mb-3">
													<p class="mb-0 d-flex align-items-center"><i class="ti ti-grip-vertical me-2"></i>Tags</p>
													<div class="status-toggle">
														<input type="checkbox" id="col-tag" class="check">
														<label for="col-tag" class="checktoggle"></label>
													</div>
												</div>
												<div class="d-flex align-items-center justify-content-between mb-3">
													<p class="mb-0 d-flex align-items-center"><i class="ti ti-grip-vertical me-2"></i>Expected Closed Date</p>
													<div class="status-toggle">
														<input type="checkbox" id="col-loc" class="check">
														<label for="col-loc" class="checktoggle"></label>
													</div>
												</div>
												<div class="d-flex align-items-center justify-content-between mb-3">
													<p class="mb-0 d-flex align-items-center"><i class="ti ti-grip-vertical me-2"></i>Rating</p>
													<div class="status-toggle">
														<input type="checkbox" id="col-rate" class="check">
														<label for="col-rate" class="checktoggle"></label>
													</div>
												</div>
												<div class="d-flex align-items-center justify-content-between mb-3">
													<p class="mb-0 d-flex align-items-center"><i class="ti ti-grip-vertical me-2"></i>Owner</p>
													<div class="status-toggle">
														<input type="checkbox" id="col-owner" class="check">
														<label for="col-owner" class="checktoggle"></label>
													</div>
												</div>
												<div class="d-flex align-items-center justify-content-between mb-3">
													<p class="mb-0 d-flex align-items-center"><i class="ti ti-grip-vertical me-2"></i>Probability</p>
													<div class="status-toggle">
														<input type="checkbox" id="col-status" class="check" checked>
														<label for="col-status" class="checktoggle"></label>
													</div>
												</div>
												<div class="d-flex align-items-center justify-content-between mb-3">
													<p class="mb-0 d-flex align-items-center"><i class="ti ti-grip-vertical me-2"></i>Status</p>
													<div class="status-toggle">
														<input type="checkbox" id="col-owner" class="check">
														<label for="col-owner" class="checktoggle"></label>
													</div>
												</div>
												<div class="d-flex align-items-center justify-content-between mb-3">
													<p class="mb-0 d-flex align-items-center"><i class="ti ti-grip-vertical me-2"></i>Source</p>
													<div class="status-toggle">
														<input type="checkbox" id="col-owner" class="check">
														<label for="col-owner" class="checktoggle"></label>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="form-sorts dropdown">
										<a href="javascript:void(0);" data-bs-toggle="dropdown"
											data-bs-auto-close="outside"><i
												class="ti ti-filter-share"></i>Filter</a>
										<div class="filter-dropdown-menu dropdown-menu  dropdown-menu-md-end p-3">
											<div class="filter-set-view">
												<div class="filter-set-head">
													<h4><i class="ti ti-filter-share"></i>Filter</h4>
												</div>
												<div class="accordion" id="accordionExample">
													<div class="filter-set-content">
														<div class="filter-set-content-head">
															<a href="#" data-bs-toggle="collapse"
																data-bs-target="#collapseTwo" aria-expanded="true"
																aria-controls="collapseTwo">Deals Name</a>
														</div>
														<div class="filter-set-contents accordion-collapse collapse show"
															id="collapseTwo" data-bs-parent="#accordionExample">
															<div class="filter-content-list">
																<div class="mb-2 icon-form">
																	<span class="form-icon"><i
																			class="ti ti-search"></i></span>
																	<input type="text" class="form-control"
																		placeholder="Search Country">
																</div>
																<ul>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox" checked>
																				<span class="checkmarks"></span>
																				Collins
																			</label>
																		</div>
																	</li>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox">
																				<span class="checkmarks"></span>
																				Konopelski
																			</label>
																		</div>
																	</li>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox">
																				<span class="checkmarks"></span>
																				Adams
																			</label>
																		</div>
																	</li>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox">
																				<span class="checkmarks"></span>
																				Gutkowski
																			</label>
																		</div>
																	</li>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox">
																				<span class="checkmarks"></span>
																				Walter
																			</label>
																		</div>
																	</li>
																</ul>
															</div>
														</div>
													</div>
													<div class="filter-set-content">
														<div class="filter-set-content-head">
															<a href="#" class="collapsed" data-bs-toggle="collapse"
																data-bs-target="#owner" aria-expanded="false"
																aria-controls="owner">Owner</a>
														</div>
														<div class="filter-set-contents accordion-collapse collapse"
															id="owner" data-bs-parent="#accordionExample">
															<div class="filter-content-list">
																<div class="mb-2 icon-form">
																	<span class="form-icon"><i
																			class="ti ti-search"></i></span>
																	<input type="text" class="form-control"
																		placeholder="Search Owner">
																</div>
																<ul>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox" checked>
																				<span class="checkmarks"></span>
																				Hendry
																			</label>
																		</div>
																	</li>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox">
																				<span class="checkmarks"></span>
																				Guillory
																			</label>
																		</div>
																	</li>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox">
																				<span class="checkmarks"></span>
																				Jami
																			</label>
																		</div>
																	</li>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox">
																				<span class="checkmarks"></span>
																				Theresa
																			</label>
																		</div>
																	</li>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox">
																				<span class="checkmarks"></span>
																				Espinosa
																			</label>
																		</div>
																	</li>

																</ul>
															</div>
														</div>
													</div>
													<div class="filter-set-content">
														<div class="filter-set-content-head">
															<a href="#" class="collapsed" data-bs-toggle="collapse"
																data-bs-target="#Status" aria-expanded="false"
																aria-controls="Status">Status</a>
														</div>
														<div class="filter-set-contents accordion-collapse collapse"
															id="Status" data-bs-parent="#accordionExample">
															<div class="filter-content-list">
																<ul>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox" checked>
																				<span class="checkmarks"></span>
																				Won
																			</label>
																		</div>
																	</li>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox">
																				<span class="checkmarks"></span>
																				Open
																			</label>
																		</div>
																	</li>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox">
																				<span class="checkmarks"></span>
																				Lost
																			</label>
																		</div>
																	</li>
																</ul>
															</div>
														</div>
													</div>
													<div class="filter-set-content">
														<div class="filter-set-content-head">
															<a href="#" class="collapsed" data-bs-toggle="collapse"
																data-bs-target="#collapseOne" aria-expanded="false"
																aria-controls="collapseOne">Rating</a>
														</div>
														<div class="filter-set-contents accordion-collapse collapse"
															id="collapseOne" data-bs-parent="#accordionExample">
															<div class="filter-content-list">
																<ul>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox" checked>
																				<span class="checkmarks"></span>
																				<span class="rating">
																					<i
																						class="fa fa-star filled"></i>
																					<i
																						class="fa fa-star filled"></i>
																					<i
																						class="fa fa-star filled"></i>
																					<i
																						class="fa fa-star filled"></i>
																					<i
																						class="fa fa-star filled"></i>
																					<span>5.0</span>
																				</span>
																			</label>
																		</div>

																	</li>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox">
																				<span class="checkmarks"></span>
																				<span class="rating">
																					<i
																						class="fa fa-star filled"></i>
																					<i
																						class="fa fa-star filled"></i>
																					<i
																						class="fa fa-star filled"></i>
																					<i
																						class="fa fa-star filled"></i>
																					<i class="fa fa-star"></i>
																					<span>4.0</span>
																				</span>
																			</label>
																		</div>
																	</li>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox">
																				<span class="checkmarks"></span>
																				<span class="rating">
																					<i
																						class="fa fa-star filled"></i>
																					<i
																						class="fa fa-star filled"></i>
																					<i
																						class="fa fa-star filled"></i>
																					<i class="fa fa-star"></i>
																					<i class="fa fa-star"></i>
																					<span>3.0</span>
																				</span>
																			</label>
																		</div>
																	</li>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox">
																				<span class="checkmarks"></span>
																				<span class="rating">
																					<i
																						class="fa fa-star filled"></i>
																					<i
																						class="fa fa-star filled"></i>
																					<i class="fa fa-star"></i>
																					<i class="fa fa-star"></i>
																					<i class="fa fa-star"></i>
																					<span>2.0</span>
																				</span>
																			</label>
																		</div>
																	</li>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox">
																				<span class="checkmarks"></span>
																				<span class="rating">
																					<i
																						class="fa fa-star filled"></i>
																					<i class="fa fa-star"></i>
																					<i class="fa fa-star"></i>
																					<i class="fa fa-star"></i>
																					<i class="fa fa-star"></i>
																					<span>1.0</span>
																				</span>
																			</label>
																		</div>
																	</li>
																</ul>
															</div>
														</div>
													</div>
													<div class="filter-set-content">
														<div class="filter-set-content-head">
															<a href="#" class="collapsed" data-bs-toggle="collapse"
																data-bs-target="#collapseThree"
																aria-expanded="false"
																aria-controls="collapseThree">Tags</a>
														</div>
														<div class="filter-set-contents accordion-collapse collapse"
															id="collapseThree" data-bs-parent="#accordionExample">
															<div class="filter-content-list">
																<ul>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox" checked>
																				<span class="checkmarks"></span>
																				Promotion
																			</label>
																		</div>
																	</li>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox">
																				<span class="checkmarks"></span>
																				Rated
																			</label>
																		</div>
																	</li>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox">
																				<span class="checkmarks"></span>
																				Rejected
																			</label>
																		</div>
																	</li>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox">
																				<span class="checkmarks"></span>
																				Collab
																			</label>
																		</div>
																	</li>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox">
																				<span class="checkmarks"></span>
																				Calls
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
															<a href="{{url('deal-reports')}}" class="btn btn-primary">Filter</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>	
							</div>
							<!-- /Filter -->

							<!-- Report List -->
							<div class="table-responsive custom-table">
								<table class="table" id="deal_reports">
									<thead class="thead-light">
										<tr>
											<th class="no-sort">
												<label class="checkboxs"><input type="checkbox" id="select-all"><span class="checkmarks"></span></label>
											</th>
											<th class="no-sort"></th>
											<th>Deal Name</th>
											<th>Stage</th>
											<th>Deal Value</th>
											<th>Expected  Close Date</th>
											<th>Owner</th>
											<th>Probability </th>
											<th>Status</th>
											<th>Source</th>
											<th>Created Date</th>
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
							<!-- /Report List -->
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