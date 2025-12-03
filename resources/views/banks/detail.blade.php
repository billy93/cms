<?php $page = 'banks.detail'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content">

            <div class="row">
                <div class="col-md-12">
                    <!-- Bank Info Card -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Bank Information</h5>
                            <div class="d-flex gap-2">
                                <a href="/banks" class="btn btn-outline-secondary">
                                    <i class="ti ti-arrow-left me-1"></i>Back to Banks
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row" id="boq_info">
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Bank Code</label>
                                        <p class="mb-0">{{ $bank->bank_code }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Bank Brand</label>
                                        <p class="mb-0">{{ $bank->bank_brand }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Bank Name</label>
                                        <p class="mb-0">{{ $bank->bank_name }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Address</label>
                                        <p class="mb-0">{{ $bank->bank_address }}</p>
                                    </div>
                                </div>
                                
                                    <div class="row align-items-center" style="row-gap: 1em; padding: 10px 15px;">
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                                                <div class="bank_product_list_datatable_length"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 flex-grow-1">
                                            <div class="bank_product_list_datatable_paginate"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if ($('#bank_product_list').length > 0) {
                $('#bank_product_list').DataTable({
                    "serverSide": true,
                    "bFilter": false,
                    "bInfo": false,
                    "ordering": true,
                    "autoWidth": true,
                    "order": [[0, "desc"]],
                    "language": {
                        search: '',
                        sLengthMenu: '_MENU_',
                        searchPlaceholder: "Search",
                        info: "_START_ - _END_ of _TOTAL_ items",
                        "lengthMenu": "Show _MENU_ entries",
                        paginate: {
                        next: 'Next <i class="fa fa-angle-right"></i>',
                        previous: '<i class="fa fa-angle-left"></i> Prev'
                        },
                    },
                });
            }
        }); 
    </script>
@endpush