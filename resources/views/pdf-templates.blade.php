<?php $page = 'pdf-templates'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
							<!-- Search -->
							<div class="row align-items-center">
								<div class="col-sm-4">
                                    <form class="icon-form mb-3 mb-sm-0" id="c_template_list_search_form">
                                        <span class="form-icon"><i class="ti ti-search"></i></span>
                                        <input type="text" class="form-control" placeholder="Search Templates" id="c_template_list_search_input">
                                    </form>	
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
                                        <a href="javascript:void(0);" id="c_template_create_btn" class="btn btn-primary"><i class="ti ti-square-rounded-plus me-2"></i>Add New Template</a>
									</div>
								</div>
							</div>
							<!-- /Search -->
						</div>
                         
                        <div class="card-body">
                            <!-- Templates List -->
                            <div class="table-responsive custom-table">
                                <table class="table" id="template_list" data-url="{{ route('pdf-templates.index') }}">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="td-break no-sort">
                                                <label class="checkboxs">
                                                    <input type="checkbox" id="select_all_template_list">
                                                    <span class="checkmarks"></span>
                                                </label>
                                            </th>
                                            <th>Template Name</th>
                                            <th>Type</th>
                                            <th>Variables</th>
                                            <th>Status</th>
                                            <th>Created</th>
                                            <th>Updated</th>
                                            <th class="no-sort">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>						
                            </div>
                            <div class="row align-items-center mt-2" style="row-gap: 1em;">
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

    @include('components.pdf-templates.create-modal')
    @include('components.pdf-templates.modal')
    @include('components.pdf-templates.preview-modal')
@endsection

@push('scripts')
    <script src="/build/js/pdf-templates/shared_var.js"></script>
    <script src="/build/js/pdf-templates/datatables.js"></script>
    <script src="/build/js/pdf-templates/events.js"></script>
@endpush
