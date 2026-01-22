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
                                    href="{{ route('invoices.pdf', $invoice->id) }}"
                                    target="_blank"
                                    class="btn btn-outline-danger"
                                    title="Generate PDF"
                                >
                                    <i class="ti ti-file-type-pdf me-1"></i>Generate PDF
                                </a>
                                <a href="{{ route('invoices.index') }}" class="btn btn-outline-secondary">
                                    <i class="ti ti-arrow-left me-1"></i>Back
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <style>
                                #invoice_table tfoot td {
                                    color: #6f6f6f;
                                    background-color: #fafafa;
                                    font-size: 14px;
                                }
                            </style>

                            <!-- Helper Variables -->
                            @php
                                $isRegular = $invoice->project == null && $invoice->proposal != null;
                                $isFit = $invoice->project != null && $invoice->proposal == null;
                            @endphp

                            <!-- Top Info Grid -->
                            <div class="row mb-4">
                                <!-- Col 1: References -->
                                <div class="col-md-4">
                                    <h5 class="card-title mb-3">References</h5>
                                    
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Invoice Code</label>
                                        <p class="mb-0">{{ $invoice->code ?: "-" }}</p>
                                    </div>
                                    
                                    @if($isRegular)
                                        <div class="form-group mb-2">
                                            <label class="fw-semibold">Proposal Code</label>
                                            <p class="mb-0">{{ $invoice->proposal?->code ?: "-" }}</p>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="fw-semibold">Sales Code</label>
                                            <p class="mb-0">{{ $invoice->proposal?->sales_code ?: "-" }}</p>
                                        </div>
                                    @elseif($isFit)
                                        <div class="form-group mb-2">
                                            <label class="fw-semibold">Project Code</label>
                                            <p class="mb-0">{{ $invoice->project?->code ?: "-" }}</p>
                                        </div>
                                    @endif

                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Customer</label>
                                        <p class="mb-0">{{ $invoice->customer?->name ?: "-" }}</p>
                                    </div>
                                </div>

                                <!-- Col 2: Dates & Status -->
                                <div class="col-md-4">
                                    <h5 class="card-title mb-3">Dates & Status</h5>
                                    
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Invoice Date</label>
                                        <p class="mb-0">{{ $invoice->invoice_date ? \Carbon\Carbon::parse($invoice->invoice_date)->format('d F Y') : "-" }}</p>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Due Date</label>
                                        <p class="mb-0">{{ $invoice->due_date ? \Carbon\Carbon::parse($invoice->due_date)->format('d F Y') : "-" }}</p>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Type</label>
                                        <p class="mb-0">
                                            @if ($invoice->type === 'Partial')
                                                <span class="badge bg-secondary">Partial</span>
                                            @elseif ($invoice->type === 'Full')
                                                <span class="badge bg-success">Full</span>
                                            @else
                                                <span class="badge bg-light text-dark">-</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Status</label>
                                        <p class="mb-0">
                                            @php
                                                $statusClass = match($invoice->status) {
                                                    'Paid' => 'bg-success',
                                                    'Unpaid' => 'bg-warning',
                                                    'Cancelled' => 'bg-danger',
                                                    default => 'bg-secondary'
                                                };
                                            @endphp
                                            <span class="badge {{ $statusClass }}">{{ $invoice->status }}</span>
                                        </p>
                                    </div>
                                </div>

                                <!-- Col 3: Payment & Notes -->
                                <div class="col-md-4">
                                    <h5 class="card-title mb-3">Payment Details</h5>
                                    
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Bill To</label>
                                        <p class="mb-0">{{ $invoice->bill_to ?: "-" }}</p>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Payment Method</label>
                                        <p class="mb-0">{{ $invoice->payment_method ?: "-" }}</p>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label class="fw-semibold">Note</label>
                                        <p class="fst-italic mb-0">{{ $invoice->note ?: "No notes" }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <h5 class="card-title mb-3">Items</h5>

                            <!-- Items Table -->
                            <div class="table-responsive">
                                <table class="table table-bordered custom-table" id="invoice_table">
                                    <thead class="thead-light">
                                        <tr>
                                            @if($isFit)
                                                <th class="text-center" width="5%">No</th>
                                                <th width="55%">Description</th>
                                                <th class="text-end" width="20%">Unit Price</th>
                                                <th class="text-end" width="20%">Total</th>
                                            @else
                                                <th class="text-center" width="5%">No</th>
                                                <th width="35%">Description</th>
                                                <th width="10%" class="text-center">QTY</th>
                                                <th width="10%" class="text-center">Freq</th>
                                                <th class="text-end" width="20%">Unit Price</th>
                                                <th class="text-end" width="20%">Total</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($isFit)
                                            <!-- FIT FLOW: Simple Single Item -->
                                            <tr>
                                                <td class="text-center">1</td>
                                                <td>{{ $invoice->description ?: 'Project Implementation' }}</td>
                                                <td class="text-end">{{ formatRupiah($invoice->total_amount) }}</td>
                                                <td class="text-end">{{ formatRupiah($invoice->total_amount) }}</td>
                                            </tr>

                                        @elseif ($isRegular)
                                            <!-- REGULAR FLOW: BOQ Items -->
                                            @php
                                                $pricingModel = $invoice->proposal->pricing_model;
                                            @endphp

                                            @if ($pricingModel === 'XXX')
                                                <!-- Type A / Summary Only -->
                                                <tr>
                                                    <td class="text-center">1</td>
                                                    <td>{{ $invoice->proposal->pricing_model_description ?? 'Project Implementation' }}</td>
                                                    <td class="text-center">-</td>
                                                    <td class="text-center">-</td>
                                                    <td class="text-end">{{ formatRupiah($invoice->items->sum('total_price')) }}</td>
                                                    <td class="text-end">{{ formatRupiah($invoice->items->sum('total_price')) }}</td>
                                                </tr>
                                            @else
                                                <!-- Type B / Detailed Grouping -->
                                                @php
                                                    $groupedByHeader = $invoice->items->groupBy('header');
                                                    // Sort keys: Empty key first
                                                    $sortedHeaders = $groupedByHeader->sortBy(fn($items, $key) => empty($key) ? 0 : 1, SORT_NUMERIC);
                                                    $headerIndex = 0;
                                                @endphp

                                                @foreach($sortedHeaders as $header => $itemsWithSameHeader)
                                                    @if(!empty($header))
                                                        @php
                                                            $headerLabel = chr(65 + $headerIndex);
                                                            $headerTotal = $itemsWithSameHeader->sum('total_price');
                                                        @endphp
                                                        <!-- Header Row -->
                                                        <tr style="background-color: #f2f2f2;">
                                                            <td class="text-center fw-bold">{{ $headerLabel }}</td>
                                                            <td colspan="4" class="fw-bold text-uppercase">{{ $header }}</td>
                                                            <td class="text-end fw-bold">{{ formatRupiah($headerTotal) }}</td>
                                                        </tr>

                                                        <!-- Subheaders -->
                                                        @php
                                                            $groupedBySubheader = $itemsWithSameHeader->groupBy('subheader');
                                                            $sortedSubheaders = $groupedBySubheader->sortBy(fn($items, $key) => empty($key) ? 0 : 1, SORT_NUMERIC);
                                                            $subheaderIndex = 1;
                                                        @endphp

                                                        @foreach($sortedSubheaders as $subheader => $itemsWithSameSubheader)
                                                            @if(!empty($subheader))
                                                                <tr>
                                                                    <td class="text-center text-muted">{{ $headerLabel }}.{{ $subheaderIndex }}</td>
                                                                    <td colspan="5" class="fst-italic" style="padding-left: 20px;">{{ $subheader }}</td>
                                                                </tr>
                                                                @php $subheaderIndex++; @endphp
                                                            @endif

                                                            @php $itemIndex = 1; @endphp
                                                            @foreach($itemsWithSameSubheader as $item)
                                                                <tr>
                                                                    <td class="text-center">{{ $itemIndex++ }}</td>
                                                                    <td>
                                                                        {{ $item->description ?: '-' }}
                                                                    </td>
                                                                    <td class="text-center text-nowrap">
                                                                        {{ $item->title1_value }} {{ $item->title1_key }}
                                                                    </td>
                                                                    <td class="text-center text-nowrap">
                                                                        {{ $item->title2_value }} {{ $item->title2_key }}
                                                                    </td>
                                                                    <td class="text-end">{{ formatRupiah($item->selling_price) }}</td>
                                                                    <td class="text-end">{{ formatRupiah($item->total_price) }}</td>
                                                                </tr>
                                                            @endforeach
                                                        @endforeach
                                                        
                                                        @php $headerIndex++; @endphp

                                                    @else
                                                        <!-- No Header Items (Flattened) -->
                                                        @php $itemIndex = 1; @endphp
                                                        @foreach($itemsWithSameHeader as $item)
                                                            <tr>
                                                                <td class="text-center">{{ $itemIndex++ }}</td>
                                                                <td>{{ $item->description ?: '-' }}</td>
                                                                <td class="text-center text-nowrap">{{ $item->title1_value }} {{ $item->title1_key }}</td>
                                                                <td class="text-center text-nowrap">{{ $item->title2_value }} {{ $item->title2_key }}</td>
                                                                <td class="text-end">{{ formatRupiah($item->selling_price) }}</td>
                                                                <td class="text-end">{{ formatRupiah($item->total_price) }}</td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                @endforeach

                                                @if($groupedByHeader->isEmpty())
                                                    <tr><td colspan="6" class="text-center text-muted py-3">No items found</td></tr>
                                                @endif
                                            @endif
                                        @else
                                            <tr><td colspan="6" class="text-center text-danger">Invalid Invoice Type</td></tr>
                                        @endif
                                    </tbody>

                                    <!-- FOOTER TOTALS -->
                                    @php
                                        // Determine values based on type
                                        if ($isRegular) {
                                            $colSpan = 5;
                                            $basicSum = $invoice->items->sum('total_price');
                                            
                                            $feeRate = $invoice->proposal->management_fee;
                                            $vatRate = $invoice->proposal->vat_rate;
                                            $feeType = $invoice->proposal->management_fee_type;


                                            if ($feeType != 'nominal') { // Default to percent
                                                $feeAmount = round($basicSum * ($feeRate / 100), 2);
                                            } else {
                                                // Proportional Fee Calculation for Nominal
                                                $proposalTotal = $invoice->proposal->total_amount_items ?: 1; 
                                                $feeAmount = round(($basicSum / $proposalTotal) * $feeRate, 2);
                                            }
                                            
                                            // Recalculate dependent values
                                            $salesAmount = $basicSum + $feeAmount;
                                            $vatAmount = round($salesAmount * ($vatRate / 100), 2);
                                            $invoiceAmount = $salesAmount + $vatAmount;

                                        } else {
                                            $colSpan = 3;
                                            $basicSum = $invoice->total_amount;
                                            $feeRate = $invoice->management_fee;
                                            $vatRate = $invoice->vat_rate;
                                            $feeType = $invoice->management_fee_type;
                                            
                                            $feeAmount = $invoice->management_fee_amount;
                                            $salesAmount = $invoice->sales_amount;
                                            $vatAmount = $invoice->vat_amount;
                                            $invoiceAmount = $invoice->invoice_amount;
                                        }
                                        
                                        $feeLabel = "Management Fee";
                                        if ($feeType === 'percent') {
                                            $feeLabel .= " (" . formatRupiah($feeRate) . "%)";
                                        }
                                    @endphp

                                    <tfoot>
                                        <tr class="fw-bold">
                                            <td colspan="{{ $colSpan }}" class="text-end">Basic Price</td>
                                            <td class="text-end">{{ formatRupiah($basicSum) }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="{{ $colSpan }}" class="text-end">{{ $feeLabel }}</td>
                                            <td class="text-end">{{ formatRupiah($feeAmount) }}</td>
                                        </tr>
                                        <tr class="fw-bold">
                                            <td colspan="{{ $colSpan }}" class="text-end">Sales Amount</td>
                                            <td class="text-end">{{ formatRupiah($salesAmount) }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="{{ $colSpan }}" class="text-end">VAT ({{ formatRupiah($vatRate) }}%)</td>
                                            <td class="text-end">{{ formatRupiah($vatAmount) }}</td>
                                        </tr>
                                        <tr class="fw-bold text-primary">
                                            <td colspan="{{ $colSpan }}" class="text-end">Total Amount</td>
                                            <td class="text-end">{{ formatRupiah($invoiceAmount) }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /Items Table -->

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->
@endsection