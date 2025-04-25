<?php $page = 'task-reports'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content">

            <div class="row">
                <div class="col-md-12">

                    @component('components.breadcrumb')
                        @slot('title')
                            Task Reports
                        @endslot
                        @slot('item1')
                            123
                        @endslot
                        @slot('item2')
                            task-reports
                        @endslot
                    @endcomponent

                    <div class="card ">
						<div class="card-header">

							<!-- Search -->
							<div class="row">
								<div class="col-md-5 col-sm-4">
									<div class="icon-form mb-3 mb-sm-0">
										<span class="form-icon"><i class="ti ti-search"></i></span>
										<input type="text" class="form-control" placeholder="Search Tasks">
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
											<h4>Tasks by Year</h4>
											<div class="icon-form">
												<span class="form-icon"><i class="ti ti-calendar"></i></span>
												<input type="text" class="form-control bookingrange" placeholder="">
											</div>
										</div>
										<div class="card-body">
											<div id="task-year"></div>
										</div>
									</div>
								</div>
								<div class="col-md-5 d-flex">		
									<div class="card shadow flex-fill">
										<div class="card-header d-flex justify-content-between align-items-center flex-wrap row-gap-2">
											<h4>Tasks by Types</h4>
											<div class="icon-form ">
												<span class="form-icon"><i class="ti ti-calendar"></i></span>
												<input type="text" class="form-control bookingrange" placeholder="">
											</div>
										</div>
										<div class="card-body">
											<div id="leads-analysis"></div>
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
													<p class="mb-0 d-flex align-items-center"><i class="ti ti-grip-vertical me-2"></i>Task Name</p>
													<div class="status-toggle">
														<input type="checkbox" id="col-name" class="check">
														<label for="col-name" class="checktoggle"></label>
													</div>
												</div>
												<div class="d-flex align-items-center justify-content-between mb-3">
													<p class="mb-0 d-flex align-items-center"><i class="ti ti-grip-vertical me-2"></i>Assigned To</p>
													<div class="status-toggle">
														<input type="checkbox" id="col-phone" class="check">
														<label for="col-phone" class="checktoggle"></label>
													</div>
												</div>
												<div class="d-flex align-items-center justify-content-between mb-3">
													<p class="mb-0 d-flex align-items-center"><i class="ti ti-grip-vertical me-2"></i>Priority</p>
													<div class="status-toggle">
														<input type="checkbox" id="col-email" class="check">
														<label for="col-email" class="checktoggle"></label>
													</div>
												</div>
												<div class="d-flex align-items-center justify-content-between mb-3">
													<p class="mb-0 d-flex align-items-center"><i class="ti ti-grip-vertical me-2"></i>Due Date</p>
													<div class="status-toggle">
														<input type="checkbox" id="col-tag" class="check">
														<label for="col-tag" class="checktoggle"></label>
													</div>
												</div>
												<div class="d-flex align-items-center justify-content-between mb-3">
													<p class="mb-0 d-flex align-items-center"><i class="ti ti-grip-vertical me-2"></i>Type</p>
													<div class="status-toggle">
														<input type="checkbox" id="col-loc" class="check">
														<label for="col-loc" class="checktoggle"></label>
													</div>
												</div>
												<div class="d-flex align-items-center justify-content-between mb-3">
													<p class="mb-0 d-flex align-items-center"><i class="ti ti-grip-vertical me-2"></i>Status</p>
													<div class="status-toggle">
														<input type="checkbox" id="col-rate" class="check">
														<label for="col-rate" class="checktoggle"></label>
													</div>
												</div>
												<div class="d-flex align-items-center justify-content-between mb-3">
													<p class="mb-0 d-flex align-items-center"><i class="ti ti-grip-vertical me-2"></i>Created Date</p>
													<div class="status-toggle">
														<input type="checkbox" id="col-owner" class="check">
														<label for="col-owner" class="checktoggle"></label>
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
															<a href="#" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">Subjects</a>
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
																				SEO Proposals
																			</label>
																		</div>
																	</li>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox">
																				<span class="checkmarks"></span>
																				Web Design
																			</label>
																		</div>
																	</li>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox">
																				<span class="checkmarks"></span>
																				Logo & Branding
																			</label>
																		</div>
																	</li>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox">
																				<span class="checkmarks"></span>
																				Development
																			</label>
																		</div>
																	</li>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox">
																				<span class="checkmarks"></span>
																				Logo
																			</label>
																		</div>
																	</li>
																</ul>
															</div>
														</div>
													</div>
													<div class="filter-set-content">
														<div class="filter-set-content-head">
															<a href="#" class="collapsed" data-bs-toggle="collapse" data-bs-target="#owner" aria-expanded="false" aria-controls="owner">Sent to</a>
														</div>
														<div class="filter-set-contents accordion-collapse collapse" id="owner" data-bs-parent="#accordionExample">
															<div class="filter-content-list">
																<div class="mb-2 icon-form">
																	<span class="form-icon"><i class="ti ti-search"></i></span>
																	<input type="text" class="form-control" placeholder="Search Client">
																</div>
																<ul>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox" checked>
																				<span class="checkmarks"></span>
																				NovaWave LLC
																			</label>
																		</div>
																	</li>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox">
																				<span class="checkmarks"></span>
																				Redwood Inc
																			</label>
																		</div>
																	</li>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox">
																				<span class="checkmarks"></span>
																				HarborVie w
																			</label>
																		</div>
																	</li>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox">
																				<span class="checkmarks"></span>
																				CoastalStar Co.
																			</label>
																		</div>
																	</li>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox">
																				<span class="checkmarks"></span>
																				RiverStone Ventur
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
																data-bs-target="#collapseone" aria-expanded="false"
																aria-controls="collapseone">Date of Proposals</a>
														</div>
														<div class="filter-set-contents accordion-collapse collapse"
															id="collapseone" data-bs-parent="#accordionExample">
															<div class="filter-content-list">
																<ul>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox" checked>
																				<span class="checkmarks"></span>
																				15 May 2024
																			</label>
																		</div>
																	</li>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox">
																				<span class="checkmarks"></span>
																				16 Jan 2024
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
																data-bs-target="#collapsetwo" aria-expanded="false"
																aria-controls="collapsetwo">Open till</a>
														</div>
														<div class="filter-set-contents accordion-collapse collapse"
															id="collapsetwo" data-bs-parent="#accordionExample">
															<div class="filter-content-list">
																<div class="mb-2 icon-form">
																	<span class="form-icon"><i class="ti ti-search"></i></span>
																	<input type="text" class="form-control" placeholder="Search Date">
																</div>
																<ul>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox" checked>
																				<span class="checkmarks"></span>
																				15 Aug 2024
																			</label>
																		</div>
																	</li>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox">
																				<span class="checkmarks"></span>
																				15 Sep 2024
																			</label>
																		</div>
																	</li>
																</ul>
															</div>
														</div>
													</div>
													<div class="filter-set-content">
														<div class="filter-set-content-head">
															<a href="#" class="collapsed" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Project</a>
														</div>
														<div class="filter-set-contents accordion-collapse collapse" id="collapseThree" data-bs-parent="#accordionExample">
															<div class="filter-content-list">
																<ul>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox" checked>
																				<span class="checkmarks"></span>
																				Truelysell
																			</label>
																		</div>
																	</li>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox">
																				<span class="checkmarks"></span>
																				Dreamsports	
																			</label>
																		</div>
																	</li>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox">
																				<span class="checkmarks"></span>
																				Best@laundry	
																			</label>
																		</div>
																	</li>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox">
																				<span class="checkmarks"></span>
																				Doccure
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
																data-bs-target="#collapsethree" aria-expanded="false"
																aria-controls="collapsethree">Created Date</a>
														</div>
														<div class="filter-set-contents accordion-collapse collapse"
															id="collapsethree" data-bs-parent="#accordionExample">
															<div class="filter-content-list">
																<ul>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox" checked>
																				<span class="checkmarks"></span>
																				21 May 2024
																			</label>
																		</div>
																	</li>
																	<li>
																		<div class="filter-checks">
																			<label class="checkboxs">
																				<input type="checkbox">
																				<span class="checkmarks"></span>
																				15 Apr 2024
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
															<a href="{{url('task-reports')}}" class="btn btn-primary">Filter</a>
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
								<table class="table" id="task-reports">
									<thead class="thead-light">
										<tr>
											<th class="no-sort">
												<label class="checkboxs">
													<input type="checkbox" id="select-all"><span class="checkmarks"></span>
												</label>
											</th>
											<th class="no-sort"></th>
											<th>Task Name</th>
											<th>Assigned To</th>
											<th>Priority</th>
											<th>Due Date</th>
											<th>Type</th>
											<th>Status</th>
											<th>Created Date </th>
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
