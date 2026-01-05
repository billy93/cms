<?php $page = 'boqs.detail'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- <div id="boq-container" data-url="{{ route('boqs.index') }}" style="display: none;"></div> -->
        <div class="content">

            <div class="row">
                <div class="col-md-12">

                    @component('components.breadcrumb')
                    @slot('title')
                    BOQ Detail
                    @endslot
                    @slot('item1')
                    BOQs
                    @endslot
                    @slot('item2')
                    boq-detail
                    @endslot
                    @endcomponent

                    <!-- Proposal Info Card -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">BoQ Information</h5>
                            <div class="d-flex gap-2">
                                <a href="/boqs" class="btn btn-outline-secondary">
                                    <i class="ti ti-arrow-left me-1"></i>Back to BoQs
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row" id="boq_info">
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Proposal Code</label>
                                        <p class="mb-0">{{ $boq->proposal->code }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Sales Code</label>
                                        <p class="mb-0">{{ $boq->proposal->sales_code ?: "-" }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Proposal Status</label>
                                        <p class="mb-0">
                                            @if ($boq->proposal->status === 'Draft')
                                                <span class="badge badge-status bg-secondary">Draft</span>
                                            @elseif ($boq->proposal->status === 'Submitted')
                                                <span class="badge badge-status bg-info">Submitted</span>
                                            @elseif ($boq->proposal->status === 'Win')
                                                <span class="badge badge-status bg-success">Win</span>
                                            @elseif ($boq->proposal->status === 'Lose')
                                                <span class="badge badge-status bg-danger">Lose</span>
                                            @elseif ($boq->proposal->status === 'Cancelled')
                                                <span class="badge badge-status bg-dark">Cancelled</span>
                                            @else
                                                <span class="badge badge-status bg-secondary">Unknown</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">BoQ Type</label>
                                        <p class="mb-0">{{ $boq->form_type }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Description</label>
                                        <p class="mb-0">{{ $boq->description }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Total Amount Items</label>
                                        <p class="mb-0">{{ formatRupiah($boq->total_amount_items) }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Management Fee Type</label>
                                        <p class="mb-0 text-capitalize">{{ $boq->management_fee_type }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Management Fee</label>
                                        <p class="mb-0">{{ $boq->management_fee_type == "nominal" ? formatRupiah($boq->management_fee) : $boq->management_fee}}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">VAT Rate</label>
                                        <p class="mb-0">{{ $boq->vat_rate . '%' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">VAT</label>
                                        <p class="mb-0">{{ formatRupiah($boq->vat) }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Sales Amount</label>
                                        <p class="mb-0">{{ formatRupiah($boq->sales_amount) }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Invoice Amount</label>
                                        <p class="mb-0">{{ formatRupiah($boq->invoice_amount) }}</p>
                                    </div>
                                </div>
                                <div class="form-group mb-2">
                                    <label class="fw-semibold">Items</label>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive custom-table" style="border: 1px solid #e8e8e8; border-radius: 6px;">
                                        <table class="table">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th class="td-break" rowspan="2">Header</th>
                                                    <th class="td-break" rowspan="2">Subheader</th>
                                                    <th class="td-break" rowspan="2">Unit Price</th>
                                                    <th class="text-center" colspan="2">Title1</th>
                                                    <th class="text-center" colspan="2">Title2</th>
                                                    <th class="text-center" colspan="2">Title3</th>
                                                    <th class="text-center" colspan="2">Title4</th>
                                                    <th class="td-break" rowspan="2">Total</th>
                                                </tr>
                                                <tr>
                                                    <th>Value</th>
                                                    <th>Key</th>
                                                    <th>Value</th>
                                                    <th>Key</th>
                                                    <th>Value</th>
                                                    <th>Key</th>
                                                    <th>Value</th>
                                                    <th>Key</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($boq->items->count()) 
                                                    @foreach ($boq->items as $item)
                                                        <tr>
                                                            <td>
                                                                <span>{{ $item['header'] }}</span>
                                                            </td>
                                                            <td>
                                                                <span>{{ $item['subheader'] }}</span>
                                                            </td>
                                                            <td>
                                                                <span>{{ $item['unit_price'] ? formatRupiah($item['unit_price']) : "-" }}</span>
                                                            </td>
                                                            <td>
                                                                <span>{{ $item['title1_value'] }}</span>
                                                            </td>
                                                            <td>
                                                                <span>{{ $item['title1_key'] }}</span>
                                                            </td>
                                                            <td>
                                                                <span>{{ $item['title2_value'] }}</span>
                                                            </td>
                                                            <td>
                                                                <span>{{ $item['title2_key'] }}</span>
                                                            </td>
                                                            <td>
                                                                <span>{{ $item['title3_value'] }}</span>
                                                            </td>
                                                            <td>
                                                                <span>{{ $item['title3_key'] }}</span>
                                                            </td>
                                                            <td>
                                                                <span>{{ $item['title4_value'] }}</span>
                                                            </td>
                                                            <td>
                                                                <span>{{ $item['title4_key'] }}</span>
                                                            </td>
                                                            <td>
                                                                <span>{{ $item['multiplier_total'] ? formatRupiah($item['multiplier_total']) : "-" }}</span>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                <tr><td class="text-center" colspan="12">No Item found!</td></tr>
                                                @endif
                                            </tbody> 
                                        </table>
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




