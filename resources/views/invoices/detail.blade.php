<?php $page = 'invoices.detail'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content">

            <div class="row">
                <div class="col-md-12">

                    @component('components.breadcrumb')
                        @slot('title')
                            Invoice Detail
                        @endslot
                        @slot('item1')
                            Invoices
                        @endslot
                        @slot('item2')
                            Detail
                        @endslot
                    @endcomponent

                    <!-- Invoice Info Card -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Invoice Information</h5>
                            <div class="d-flex gap-2">
                                <a 
                                    href="/invoices/{{ $invoice->id }}/pdf"
                                    target="_blank"
                                    class="btn btn-outline-danger"
                                    title="Generate PDF"
                                >
                                    <i class="ti ti-file-type-pdf me-1"></i>Generate PDF
                                </a>
                                <a href="/invoices" class="btn btn-outline-secondary">
                                    <i class="ti ti-arrow-left me-1"></i>Back to Invoices
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row" id="boq_info">
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Project Code</label>
                                        <p class="mb-0">{{ $invoice->proposal?->project?->code ?: "-" }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Proposal Code</label>
                                        <p class="mb-0">{{ $invoice->proposal?->code ?: "-" }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Sales Code</label>
                                        <p class="mb-0">{{ $invoice->proposal?->sales_code ?: "-" }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Pricing Model</label>
                                        <p class="mb-0">{{ $invoice->proposal?->pricing_model ? ucfirst($invoice->proposal->pricing_model) : "-" }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Invoice No.</label>
                                        <p class="mb-0">{{ $invoice->code ?: "-" }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Created</label>
                                        <p class="mb-0">{{ $invoice->created_at ? formatDate($invoice->created_at, 'j F Y') : "-" }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Updated</label>
                                        <p class="mb-0">{{ $invoice->updated_at ? formatDate($invoice->updated_at, 'j F Y') : "-" }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Due Date</label>
                                        <p class="mb-0">{{ $invoice->due_date ? formatDate($invoice->due_date, 'j F Y') : "-" }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Type</label>
                                        <p class="mb-0">
                                            @if ($invoice->type === 'Partial')
                                                <span class="badge badge-status bg-secondary">Partial</span>
                                            @elseif ($invoice->type === 'Full')
                                                <span class="badge badge-status bg-success">Full</span>
                                            @else
                                                <span class="badge badge-status bg-secondary">Unknown</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Status</label>
                                        <p class="mb-0">
                                            @if ($invoice->status === 'Unpaid')
                                                <span class="badge badge-status bg-secondary">Unpaid</span>
                                            @elseif ($invoice->status === 'Paid')
                                                <span class="badge badge-status bg-success">Paid</span>
                                            @elseif ($invoice->status === 'Cancelled')
                                                <span class="badge badge-status bg-danger">Cancelled</span>
                                            @else
                                                <span class="badge badge-status bg-secondary">Unknown</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Basic Price</label>
                                        <p class="mb-0">{{ formatRupiah($invoice->total_amount) ?: "-" }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Management Fee</label>
                                        <p class="mb-0">{{ formatRupiah($invoice->management_fee) ?: "-" }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Sales Amount</label>
                                        <p class="mb-0">{{ formatRupiah($invoice->sales_amount) ?: "-" }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Total Amount</label>
                                        <p class="mb-0">{{ formatRupiah($invoice->invoice_amount) ?: "-" }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Payment Method</label>
                                        <p class="mb-0">{{ $invoice->payment_method ?: "-" }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Bill To</label>
                                        <p class="mb-0">{{ $invoice->bill_to ?: "-" }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xxl-4">
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Note</label>
                                        <p class="mb-0">{{ $invoice->note ?: "-" }}</p>
                                    </div>
                                </div>
                                <div class="form-group mb-2">
                                    <label class="fw-semibold">Items</label>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive custom-table" style="border: 1px solid #e8e8e8; border-radius: 6px;">
                                    <style>
                                        #invoice_items_list tfoot td {
                                            color: #6f6f6f;
                                            background-color: #fafafa;
                                            font-size: 14px;
                                        }
                                    </style>
                                        <table class="table" id="invoice_items_list">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Description</th>
                                                    <th>Title 1</th>
                                                    <th>Title 2</th>
                                                    <th>Title 3</th>
                                                    <th>Title 4</th>
                                                    <th class="text-end">Unit Price</th>
                                                    <th class="text-end">Total Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($invoice->items->count() == 0)
                                                    <tr><td colspan="8" class="text-center">No items found</td></tr>
                                                @else
                                                    @php
                                                        $items = $invoice->items->sortBy('id'); 
                                                        $grouped = $items->groupBy('header')->sortKeys();
                                                        $counter = 1;
                                                        $headerIndex = 0;
                                                    @endphp

                                                    @foreach($grouped as $header => $groupItems)
                                                        @php $headerLabel = chr(65 + $headerIndex); @endphp
                                                        
                                                        @if($header)
                                                            <tr style="background-color: #f2f2f2;">
                                                                <td>{{ $headerLabel }}</td>
                                                                <td colspan="7" class="fw-bold text-uppercase">{{ $header }}</td>
                                                            </tr>
                                                        @endif

                                                        @php
                                                            $subGrouped = $groupItems->groupBy('subheader')->sortKeys();
                                                            $subheaderIndex = 1;
                                                        @endphp

                                                        @foreach($subGrouped as $subheader => $subItems)
                                                            @php $subheaderLabel = $header ? "{$headerLabel}.{$subheaderIndex}" : ''; @endphp

                                                            @if($subheader && $header)
                                                                <tr>
                                                                    <td>{{ $subheaderLabel }}</td>
                                                                    <td colspan="7" class="fst-italic" style="padding-left: 20px;">{{ $subheader }}</td>
                                                                </tr>
                                                                @php $subheaderIndex++; @endphp
                                                            @endif

                                                            @foreach($subItems as $item)
                                                                @php
                                                                    $t1 = $item->title1_value ? "{$item->title1_value} <span class='text-xs'>{$item->title1_key}</span>" : '-';
                                                                    $t2 = $item->title2_value ? "{$item->title2_value} <span class='text-xs'>{$item->title2_key}</span>" : '-';
                                                                    $t3 = $item->title3_value ? "{$item->title3_value} <span class='text-xs'>{$item->title3_key}</span>" : '-';
                                                                    $t4 = $item->title4_value ? "{$item->title4_value} <span class='text-xs'>{$item->title4_key}</span>" : '-';
                                                                    
                                                                    $desc = (!$header && $item->subheader) ? 
                                                                            "<strong>{$item->subheader}</strong>" : 
                                                                            ($item->description ?: ($item->product?->name ?: '-'));
                                                                @endphp
                                                                <tr>
                                                                    <td>{{ $counter++ }}</td>
                                                                    <td>{!! $desc !!}</td>
                                                                    <td>{!! $t1 !!}</td>
                                                                    <td>{!! $t2 !!}</td>
                                                                    <td>{!! $t3 !!}</td>
                                                                    <td>{!! $t4 !!}</td>
                                                                    <td class="text-end nowrap">{{ formatRupiah($item->selling_price) }}</td>
                                                                    <td class="text-end nowrap">{{ formatRupiah($item->total_price) }}</td>
                                                                </tr>
                                                            @endforeach
                                                        @endforeach

                                                        @if($header)
                                                            @php $headerIndex++; @endphp
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </tbody>
                                            <tfoot>
                                                <tr class="fw-bold">
                                                    <td colspan="7" class="text-end">Basic Price</td>
                                                    <td class="text-end">{{ formatRupiah($invoice->total_amount) }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="7" class="text-end">Management Fee ({{ (float) number_format($invoice->proposal?->management_fee ?? 0, 2, '.', '') }}%)</td>
                                                    <td class="text-end">{{ formatRupiah($invoice->management_fee) }}</td>
                                                </tr>
                                                <tr class="fw-bold">
                                                    <td colspan="7" class="text-end">Sales Amount</td>
                                                    <td class="text-end">{{ formatRupiah($invoice->sales_amount) }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="7" class="text-end">VAT ({{ (float) number_format($invoice->proposal?->vat_rate ?? 0, 2, '.', '') }}%)</td>
                                                    <td class="text-end">{{ formatRupiah($invoice->vat_amount) }}</td>
                                                </tr>
                                                <tr class="fw-bold text-primary">
                                                    <td colspan="7" class="text-end">Total Amount</td>
                                                    <td class="text-end">{{ formatRupiah($invoice->invoice_amount) }}</td>
                                                </tr>
                                            </tfoot>
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