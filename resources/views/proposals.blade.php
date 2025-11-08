<?php $page = 'proposals'; ?>
@extends('layout.mainlayout')
@section('content')

    <!-- BoQ Datatable url -->
    <div id="boq-route" data-url="{{ route('boqs.index') }}" style="display: none;"></div>
    
    <div class="page-wrapper">
        <div class="content">

            <div class="row">
                <div class="col-md-12">

                    @component('components.breadcrumb')
                        @slot('title')
                            Proposals
                        @endslot
                        @slot('item1')
                            123
                        @endslot
                        @slot('item2')
                            proposals
                        @endslot
                    @endcomponent

                    <div class="card ">
                        <div class="card-header">
                            <!-- Search -->
                            <div class="row align-items-center">
                                <div class="col-sm-4">
                                    <form class="icon-form mb-3 mb-sm-0" id="c_proposal_list_search_form">
                                        <span class="form-icon"><i class="ti ti-search"></i></span>
                                        <input type="text" class="form-control" placeholder="Search Proposal" id="c_proposal_list_search_input">
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
                                        <a href="javascript:void(0);" id="c_proposal_create_btn" class="btn btn-primary"><i class="ti ti-square-rounded-plus me-2"></i>Add New Proposals</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /Search -->
                        </div>
                        <div class="card-body">
                            <!-- Projects List -->
                            <div class="table-responsive custom-table">
								<table class="table" id="proposal_list" data-url="{{ route('proposals.index') }}">
                                    <style>
                                        #proposal_list th, 
                                        #proposal_list td {
                                            padding: 12px 20px;
                                        }
										#proposal_list tbody tr td {
											vertical-align: baseline;
										} 
                                        #proposal_list .td-break {
											text-align: left !important;
											word-break: auto-phrase;
											white-space: unset !important;
										}
                                    </style>
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="td-break no-sort" rowspan="2">
												<label class="checkboxs">
													<input type="checkbox" id="select_all_proposal_list">
													<span class="checkmarks"></span>
												</label>
											</th>
                                            <th rowspan="2">Proposal Code</th>
                                            <th rowspan="2">Created</th>
                                            <th rowspan="2">Updated</th>
                                            <th rowspan="2">Project Code</th>
                                           
                                            <th rowspan="2">Status</th>
                                            <th class="td-break" rowspan="2">Sales Code</th>
                                            <th class="text-center" colspan="2">Invoices</th>
                                            <th class="no-sort fit" rowspan="2">Action</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Generate</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
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

    @include('components.proposals.create-modal')
    @include('components.proposals.modal')
    @include('components.invoices.create-modal')
@endsection

@push('scripts')
    <script>
        const HIDE_PROPOSAL_DATATABLE_CHECKBOX = true;
    </script>
  <script src="/build/js/proposals/shared_var.js"></script>
  <script src="/build/js/proposals/datatables.js"></script>
  <script src="/build/js/proposals/events.js"></script>
  <script src="/build/js/invoices/events.js"></script>
@endpush
