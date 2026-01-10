<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\Boq;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\ProposalRequest;
use App\Http\Services\ProposalService;

class ProposalController extends Controller
{
    protected $proposalService;
    protected $templateService;

    public function __construct(ProposalService $proposalService, \App\Http\Services\PdfTemplateService $templateService)
    {
        $this->proposalService = $proposalService;
        $this->templateService = $templateService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
                $searchValue = $request->search;
            $search = strtolower(trim(is_array($searchValue) ? ($searchValue['value'] ?? '') : ($searchValue ?? '')));
            $proposals = Proposal::with('project', 'boqs', 'invoices')->orderBy('id', 'desc');

            return DataTables::eloquent($proposals)
                ->filter(function ($query) use ($search) {
                    if ($search !== '') {
                        $query->where(function ($q) use ($search) {
                            $q->whereRaw('LOWER(code) LIKE ?', ["%{$search}%"])
                            ->orWhereRaw('LOWER(sales_code) LIKE ?', ["%{$search}%"])
                            ->orWhereHas('project', fn($p) =>
                                $p->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"])
                                  ->orWhereRaw('LOWER(code) LIKE ?', ["%{$search}%"])
                            );
                        });
                    }
                })
                ->addColumn('project_code', fn($p) => $p->project->code ?? '-')
                ->addColumn('project_name', fn($p) => $p->project->name ?? '-')
                ->addColumn('invoice_codes', function ($p) {
                    if ($p->invoices->isEmpty()) {
                        return '-';
                    }

                    $items = $p->invoices
                        ->filter(fn($i) => !empty($i->code))
                        ->map(fn($i) => "<li>{$i->code}</li>")
                        ->implode('');

                    return $items ? "<ul>{$items}</ul>" : '-';
                })
                ->addColumn('generate_invoice', function($p) {
                    if (strtolower($p->status) !== 'win') {
                        return '-';
                    }

                    // if ($p->items->isEmpty()) {
                    //     return '-';
                    // }

                    if($p->items->every(fn($item) => $item->invoice_id !== null)) {
                        return '-';
                    }

                    return '
                        <a 
                            href="javascript:void(0);" 
                            id="c_invoice_create_btn" 
                            class="btn btn-sm btn-outline-primary" 
                            data-url="'.route('proposals.read', ['proposal_id' => $p->id]).'"
                        >
                            Generate Invoice
                        </a>
                    ';
                })
                ->addColumn('actions', function ($p) {
                    if (strtolower($p->status) === 'win') {
                        return '
                            <div class="dropdown table-action">
                                <a href="#" class="action-icon" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a  
                                        class="dropdown-item" 
                                        href="'.route('proposals.read', ['proposal_id' => $p->id]).'"
                                    >
                                        <i class="ti ti-eye text-info"></i> View Detail
                                    </a>
                                </div>
                            </div>
                        ';
                    }

                    return '
                        <div class="dropdown table-action">
                            <a href="#" class="action-icon" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a  
                                    class="dropdown-item" 
                                    href="'.route('proposals.read', ['proposal_id' => $p->id]).'"
                                >
                                    <i class="ti ti-eye text-info"></i> View Detail
                                </a>
                                <a  
                                    class="dropdown-item c_proposal_edit_btn" 
                                    href="#" 
                                    data-id="'.$p->id.'" 
                                    data-url="'.route('proposals.read', ['proposal_id' => $p->id]).'"
                                >
                                    <i class="ti ti-edit text-blue"></i> Edit
                                </a>
                                <a  
                                    class="dropdown-item c_proposal_delete_btn" 
                                    href="javascript:void(0);" 
                                    data-id="'.$p->id.'" 
                                    data-url="'.route('proposals.delete', ['proposal_id' => $p->id]).'"
                                >
                                    <i class="ti ti-trash text-danger"></i> Delete
                                </a>
                            </div>
                        </div>
                    ';
                })
                ->rawColumns(['invoice_codes', 'generate_invoice', 'actions'])
                ->make(true);
        }

        return view('proposals');
    }

    public function boqs(Request $request, $proposal_id)
    {
        if($request->wantsJson() || $request->ajax()) {
            $boqs = Boq::with(['proposal', 'items.product.activePriceVersion'])
                ->where('proposal_id', $proposal_id)
                ->orderBy('id', 'desc');
                 
            return DataTables::eloquent($boqs)
                ->addColumn('sales_code', fn($boq) => $boq->proposal?->sales_code ?: '-')
                ->addColumn('description', fn($boq) => '<ul style="margin-bottom: 0;">'.implode('', $boq->items->map(fn($i) => 
                     "<li style='white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 350px;' title='".e($i->description)."'>{$i->description}</li>"
                )->toArray()).'</ul>')
                ->addColumn('qty', fn($boq) => '<ul>'.implode('', $boq->items->map(fn($i) => "<li>{$i->qty} {$i->qty_unit}</li>")->toArray()).'</ul>')
                ->addColumn('freq', fn($boq) => '<ul>'.implode('', $boq->items->map(fn($i) => "<li>{$i->freq} {$i->freq_unit}</li>")->toArray()).'</ul>')
                ->addColumn('unit_price', fn($boq) => 
                    '<ul>' . implode('', 
                        $boq->items->map(fn($i) => 
                            "<li>" . formatRupiah($i->product_active_price) . "</li>"
                        )->toArray()
                    ) . '</ul>'
                )
                ->addColumn('selling_price', fn($boq) => 
                    '<ul>' . implode('', 
                        $boq->items->map(fn($i) => 
                            "<li>" . formatRupiah($i->selling_price) . "</li>"
                        )->toArray()
                    ) . '</ul>'
                )
                ->addColumn('total_price', fn($boq) => 
                    '<ul>' . implode('', 
                        $boq->items->map(fn($i) => 
                            "<li>" . formatRupiah($i->total_price) . "</li>"
                        )->toArray()
                    ) . '</ul>'
                )
                ->addColumn('grand_total', fn($boq) => formatRupiah($boq->total_amount_items))
                ->addColumn('actions', function ($boq) {
                    if ($boq->proposal && strtolower($boq->proposal->status) === 'win') {
                        return '
                            <div class="dropdown table-action">
                                <a href="#" class="action-icon" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a  
                                        class="dropdown-item" 
                                        href="'.route('boqs.read', ['boq_id' => $boq->id]).'"
                                    >
                                        <i class="ti ti-eye text-info"></i> View Detail
                                    </a>
                                </div>
                            </div>
                        ';
                    }

                    return '
                        <div class="dropdown table-action">
                            <a href="#" class="action-icon" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a  
                                    class="dropdown-item" 
                                    href="'.route('boqs.read', ['boq_id' => $boq->id]).'"
                                >
                                    <i class="ti ti-eye text-info"></i> View Detail
                                </a>
                                <a  
                                    class="dropdown-item c_boq_edit_btn" 
                                    href="#" 
                                    data-url="'.route('boqs.read', ['boq_id' => $boq->id]).'"
                                >
                                    <i class="ti ti-edit text-blue"></i> Edit
                                </a>
                                <a  
                                    class="dropdown-item c_boq_unbind_btn" 
                                    href="javascript:void(0);" 
                                    data-id="'.$boq->id.'" 
                                    data-url="'.route('boqs.unbindProposal', ['boq_id' => $boq->id]).'"
                                >
                                    <i class="ti ti-unlink text-danger"></i> Unbind
                                </a>
                                <a  
                                    class="dropdown-item c_boq_delete_btn" 
                                    href="javascript:void(0);" 
                                    data-id="'.$boq->id.'" 
                                    data-url="'.route('boqs.delete', ['boq_id' => $boq->id]).'"
                                >
                                    <i class="ti ti-trash text-danger"></i> Delete
                                </a>
                            </div>
                        </div>
                    ';
                })
                ->rawColumns([
                    'actions', 'description', 'qty', 'freq', 'unit_price', 'selling_price', 'total_price'
                ])
                ->make(true);
        }
        abort(404);    
    }

    public function create(ProposalRequest $request): JsonResponse
    {
        try {
            $proposal = $this->proposalService->createProposal($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Proposal created successfully',
                'data' => $proposal
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Failed to create Proposal'
            ], 500);
        }
    }

    public function readAll(Request $request): JsonResponse
    {
        if($request->wantsJson() || $request->ajax()) {
            try {
                $proposals = $this->proposalService->getAllProposals();
                return response()->json([
                    'status' => 'success',
                    'data' => $proposals
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage() ?: 'Internal Server Error'
                ], 500);
            }
        }            
        abort(404);    
    }

    public function read(Request $request, $proposal_id)
    {
        if($request->wantsJson() || $request->ajax()) {
            try {
                $proposal = $this->proposalService->getProposalById($proposal_id);
                return response()->json([
                    'success' => true,
                    'data' => $proposal
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage() ?: 'Failed to load Proposal'
                ], 500);
            }
        }

        $proposal = $this->proposalService->getProposalById($proposal_id);
        return view('proposals.detail', compact('proposal'));
    }

    public function update(ProposalRequest $request, $proposal_id): JsonResponse
    {
        try {
            $proposal = $this->proposalService->updateProposal($proposal_id, $request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Proposal updated successfully',
                'data' => $proposal
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Failed to update Proposal'
            ], 500);
        }
    }

    public function delete($proposal_id): JsonResponse
    {
        try {
            $this->proposalService->deleteProposal($proposal_id);
            return response()->json([
                'success' => true,
                'message' => 'Proposal deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Failed to delete Proposal'
            ], 500);
        }
    }

    public function generatePdf($proposal_id)
    {
        try {
            // Eager load project.customer instead of customer
            $proposal = Proposal::with(['project.customer', 'items.product', 'items.productPriceVersion'])->findOrFail($proposal_id);

            // Get Default Proposal Template
            $template = \App\Models\PdfTemplate::where('type', 'proposal')
                ->where('is_active', true)
                ->where('name', 'Default Proposal')
                ->first();

            if (!$template) {
                // Fallback to any active proposal template
                $template = \App\Models\PdfTemplate::where('type', 'proposal')
                    ->where('is_active', true)
                    ->first();
            }
            if (!$template) {
                return response()->json(['success' => false, 'message' => 'No active proposal template found'], 404);
            }

            // Start PDF Generation Logic
            $proposalItemsHtml = '';
            $totalsRowsHtml = '';
            
            // Calculate basic totals
            $sortedItems = $proposal->items->sortBy('id');
            $totalAmountItems = $sortedItems->sum('total_price');
            $pricingModel = $proposal->pricing_model; // A, B, C, D

            // Logic for Item Listing
            if ($pricingModel === 'XXX') {
                // Type A: Summary Only
                $description = $proposal->pricing_model_description ?? 'Project Implementation';

                $proposalItemsHtml .= '<tr>';
                $proposalItemsHtml .= '<td class="pdf-text-center">1</td>';
                $proposalItemsHtml .= '<td>' . $description . '</td>';
                $proposalItemsHtml .= '<td class="nowrap">-</td>';
                $proposalItemsHtml .= '<td class="nowrap">-</td>';
                $proposalItemsHtml .= '<td class="nowrap">-</td>';
                $proposalItemsHtml .= '<td class="nowrap">-</td>';
                $proposalItemsHtml .= '<td class="pdf-text-right nowrap">' . formatRupiah($totalAmountItems) . '</td>';
                $proposalItemsHtml .= '<td class="pdf-text-right nowrap">' . formatRupiah($totalAmountItems) . '</td>';
                $proposalItemsHtml .= '</tr>';

            } else {
                // Type B/C/D: Detailed Listing with Grouping from Proposal Items
                $groupedByHeader = $sortedItems->groupBy('header');
                
                // Sort headers: Empty header comes first
                $sortedHeaders = $groupedByHeader->sortBy(function ($items, $key) {
                    return empty($key) ? 0 : 1;
                }, SORT_NUMERIC);

                $headerIndex = 0;
                foreach ($sortedHeaders as $header => $itemsWithSameHeader) {
                    
                    // IF Header exists
                    if (!empty($header)) {
                        $headerLabel = chr(65 + $headerIndex); // A, B, C...
                        $headerTotal = $itemsWithSameHeader->sum('total_price');
                        $headerName = $header;

                        $proposalItemsHtml .= '<tr class="boq-header">';
                        $proposalItemsHtml .= '<td class="pdf-text-center">' . $headerLabel . '</td>';
                        $proposalItemsHtml .= '<td colspan="6">' . strtoupper($headerName) . '</td>';
                        $proposalItemsHtml .= '<td class="pdf-text-right">' . formatRupiah($headerTotal) . '</td>';
                        $proposalItemsHtml .= '</tr>';

                        // Group by Subheader
                        $groupedBySubheader = $itemsWithSameHeader->groupBy('subheader');
                        
                        // Sort subheaders
                        $sortedSubheaders = $groupedBySubheader->sortBy(function ($items, $key) {
                            return empty($key) ? 0 : 1; 
                        }, SORT_NUMERIC);
                        
                        $subheaderIndex = 1;
                        foreach ($sortedSubheaders as $subheader => $itemsWithSameSubheader) {
                            
                            // Show Subheader Row if $subheader is not empty
                            if (!empty($subheader)) {
                                 $proposalItemsHtml .= '<tr class="boq-subheader">';
                                 $proposalItemsHtml .= '<td class="pdf-text-center">'. $headerLabel . '.' . $subheaderIndex .'</td>';
                                 $proposalItemsHtml .= '<td colspan="7">' . $subheader . '</td>'; // Colspan 8-1 = 7
                                 $proposalItemsHtml .= '</tr>';
                                 $subheaderIndex++;
                            }

                            $itemIndex = 1; 
                            foreach ($itemsWithSameSubheader as $item) {
                                $proposalItemsHtml .= '<tr>';
                                $proposalItemsHtml .= '<td class="pdf-text-center">' . $itemIndex . '</td>';
                                $proposalItemsHtml .= '<td>' . ($item->description ?: ($item->product->name ?? '-')) . '</td>'; 
                                
                                // Map Title 1 - 4
                                $t1 = $item->title1_value ? ($item->title1_value . ' ' . ($item->title1_key ?? '')) : '-';
                                $t2 = $item->title2_value ? ($item->title2_value . ' ' . ($item->title2_key ?? '')) : '-';
                                $t3 = $item->title3_value ? ($item->title3_value . ' ' . ($item->title3_key ?? '')) : '-';
                                $t4 = $item->title4_value ? ($item->title4_value . ' ' . ($item->title4_key ?? '')) : '-';

                                $proposalItemsHtml .= '<td class="pdf-text-center nowrap">' . $t1 . '</td>';
                                $proposalItemsHtml .= '<td class="pdf-text-center nowrap">' . $t2 . '</td>';
                                $proposalItemsHtml .= '<td class="pdf-text-center nowrap">' . $t3 . '</td>';
                                $proposalItemsHtml .= '<td class="pdf-text-center nowrap">' . $t4 . '</td>';
                                
                                $proposalItemsHtml .= '<td class="pdf-text-right nowrap">' . formatRupiah($item->selling_price) . '</td>';
                                $proposalItemsHtml .= '<td class="pdf-text-right nowrap">' . formatRupiah($item->total_price) . '</td>';
                                $proposalItemsHtml .= '</tr>';
                                $itemIndex++;
                            }
                        }
                        $headerIndex++;
                    
                    } else {
                        // NO Header (Empty) -> List Items Directly at TOP
                        $itemIndex = 1;
                        foreach ($itemsWithSameHeader as $item) {
                            $proposalItemsHtml .= '<tr>';
                            $proposalItemsHtml .= '<td class="pdf-text-center">' . $itemIndex . '</td>';
                            $proposalItemsHtml .= '<td>' . ($item->description ?: ($item->product->name ?? '-')) . '</td>';
                            
                            $t1 = $item->title1_value ? ($item->title1_value . ' ' . ($item->title1_key ?? '')) : '-';
                            $t2 = $item->title2_value ? ($item->title2_value . ' ' . ($item->title2_key ?? '')) : '-';
                            $t3 = $item->title3_value ? ($item->title3_value . ' ' . ($item->title3_key ?? '')) : '-';
                            $t4 = $item->title4_value ? ($item->title4_value . ' ' . ($item->title4_key ?? '')) : '-';

                            $proposalItemsHtml .= '<td class="pdf-text-center nowrap">' . $t1 . '</td>';
                            $proposalItemsHtml .= '<td class="pdf-text-center nowrap">' . $t2 . '</td>';
                            $proposalItemsHtml .= '<td class="pdf-text-center nowrap">' . $t3 . '</td>';
                            $proposalItemsHtml .= '<td class="pdf-text-center nowrap">' . $t4 . '</td>';
                            
                            $proposalItemsHtml .= '<td class="pdf-text-right nowrap">' . formatRupiah($item->selling_price) . '</td>';
                            $proposalItemsHtml .= '<td class="pdf-text-right nowrap">' . formatRupiah($item->total_price) . '</td>';
                            $proposalItemsHtml .= '</tr>';
                            $itemIndex++;
                        }
                    }
                }

                if ($groupedByHeader->isEmpty()) {
                   $proposalItemsHtml .= '<tr><td colspan="8" class="pdf-text-center">No Items Found</td></tr>';
                }
            }


            // --- TOTALS CALCULATION ---
            
            // Management Fee
            $managementFeeAmount = 0;
            if ($proposal->management_fee_type === 'percent') {
                $managementFeeAmount = ($totalAmountItems * $proposal->management_fee) / 100;
            } else {
                // Should correspond to nominal fee logic if proposal stores total nominal fee. 
                // Proposal model has 'management_fee' which is either percent or amount.
                $managementFeeAmount = $proposal->management_fee;
            }
            // If total items is 0, avoid weirdness? Usually proposal fee is fixed or percent.
            $managementFeeAmount = $managementFeeAmount;

            // Sales Amount
            $salesAmount = $totalAmountItems + $managementFeeAmount;

            // VAT
            $vatAmount = ($salesAmount * $proposal->vat_rate) / 100;

            // Grand Total
            $grandTotal = round($salesAmount + $vatAmount, 2);



            // --- TOTALS HTML GENERATION ---
            
            // 1. Basic Price Sum
            $totalsRowsHtml .= '<tr>';
            $totalsRowsHtml .= '<td colspan="7" class="pdf-totals-label pdf-text-right pr-80">Basic Price Sum</td>';
            $totalsRowsHtml .= '<td class="pdf-totals-value">' . formatRupiah($totalAmountItems) . '</td>';
            $totalsRowsHtml .= '</tr>';
            
            // 2. Management Fee
            $feeLabel = "Management Fee";
            if ($proposal->management_fee_type === 'percent') {
                $feeLabel .= " ({$proposal->management_fee}%)";
            }
            $totalsRowsHtml .= '<tr>';
            $totalsRowsHtml .= '<td colspan="7" class="pdf-totals-label pdf-text-right pr-80">' . $feeLabel . '</td>';
            $totalsRowsHtml .= '<td class="pdf-totals-value">' . formatRupiah($managementFeeAmount) . '</td>';
            $totalsRowsHtml .= '</tr>';
            
            // 3. Sales Amount
            $totalsRowsHtml .= '<tr>';
            $totalsRowsHtml .= '<td colspan="7" class="pdf-totals-label pdf-text-right pr-80">Sales Amount</td>';
            $totalsRowsHtml .= '<td class="pdf-totals-value">' . formatRupiah($salesAmount) . '</td>';
            $totalsRowsHtml .= '</tr>';
            
            // 4. VAT
            $totalsRowsHtml .= '<tr>';
            $totalsRowsHtml .= '<td colspan="7" class="pdf-totals-label pdf-text-right pr-80">VAT (' . $proposal->vat_rate . '%)</td>';
            $totalsRowsHtml .= '<td class="pdf-totals-value">' . formatRupiah($vatAmount) . '</td>';
            $totalsRowsHtml .= '</tr>';
            
            // 5. Grand Total
            $totalsRowsHtml .= '<tr>';
            $totalsRowsHtml .= '<td colspan="7" class="pdf-totals-label pdf-text-right pdf-grand-total pr-80">Total Amount</td>';
            $totalsRowsHtml .= '<td class="pdf-totals-value pdf-grand-total">' . formatRupiah($grandTotal) . '</td>';
            $totalsRowsHtml .= '</tr>';


            $logoPath = public_path('build/img/your-logo.png'); 
            $logoData = '';
            if (file_exists($logoPath)) {
                $logoData = 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath));
            }

            // Format Date Range
            $startDate = $proposal->project->start_date ? \Carbon\Carbon::parse($proposal->project->start_date)->format('d F Y') : null;
            $endDate = $proposal->project->end_date ? \Carbon\Carbon::parse($proposal->project->end_date)->format('d F Y') : null;
            
            $dateRange = '-';
            if ($startDate && $endDate) {
                $dateRange = "{$startDate} - {$endDate}";
            } elseif ($startDate) {
                $dateRange = $startDate;
            }

            // Map data
            $data = [
                'proposal_code' => $proposal->code,
                'project_name' => $proposal->project->name ?? '-',
                'customer_name' => $proposal->project->customer->name ?? '-', // Access via project
                'proposal_date' => $dateRange,
                'valid_until' => $proposal->valid_until ? \Carbon\Carbon::parse($proposal->valid_until)->format('d F Y') : '-',
                'sales_code' => $proposal->sales_code ?? '-',
                'terms_and_conditions' => $proposal->terms_and_conditions ?? '-',
                'proposal_items' => $proposalItemsHtml,
                'totals_rows' => $totalsRowsHtml,
                'logo_path' => $logoData,
            ];

            // Render
            $html = $this->templateService->renderTemplate($template->id, $data);

            // Inject html2pdf.js for client-side generation
            $filename = 'Proposal-' . $proposal->code . '.pdf';
            $script = '
                <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
                <style>
                    #pdf-loading-overlay {
                        position: fixed;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        background: white;
                        z-index: 9999;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        flex-direction: column;
                        font-family: sans-serif;
                    }
                    .spinner {
                        border: 4px solid #f3f3f3;
                        border-top: 4px solid #4059C6;
                        border-radius: 50%;
                        width: 40px;
                        height: 40px;
                        animation: spin 1s linear infinite;
                        margin-bottom: 15px;
                    }
                    @keyframes spin {
                        0% { transform: rotate(0deg); }
                        100% { transform: rotate(360deg); }
                    }
                </style>
                <div id="pdf-loading-overlay">
                    <div class="spinner"></div>
                    <div>Generating PDF...</div>
                </div>
                <script>
                    window.onload = function () {
                        // Select the specific content wrapper (excluding header)
                        const pageElement = document.querySelector(".pdf-page-wrapper");
                        const headerElement = document.querySelector(".pdf-header");
                        const overlay = document.getElementById("pdf-loading-overlay");

                        const marginX = 15; // mm
                        const headerY = 10; // mm (Header vertical position)
                        const pdfMarginBottom = 20; // mm

                        // Step 1: Capture header as PNG
                        html2pdf()
                            .from(headerElement)
                            .set({
                                html2canvas: { scale: 2, useCORS: true }
                            })
                            .toCanvas()
                            .get("canvas")
                            .then(function (canvas) {

                                const imgData = canvas.toDataURL("image/png");

                                // Width content = 210mm - 20mm margin = 190mm
                                const imgWidth = 210; 
                                const imgHeight = (canvas.height * imgWidth) / canvas.width;
                                
                                // Step 2: Generate PDF
                                const opt = {
                                display:"flex",
                                flexDirection:"column",
                                margin: [imgHeight, 0, 20, 0],
                                    // Top margin must account for the header image position and height
                                    filename: "' . $filename . '",
                                    image: { type: "jpeg", quality: 0.98 },
                                    html2canvas: { scale: 2, useCORS: true, scrollY: 0 },
                                    jsPDF: { unit: "mm", format: "a4", orientation: "portrait" },
                                    pagebreak: { mode: ["css", "legacy"] }
                                };

                                // Force font family before generation
                                pageElement.style.fontFamily = "Arial, sans-serif";

                                html2pdf()
                                    .set(opt)
                                    .from(pageElement) // Generate from .pdf-page only
                                    .toPdf()
                                    .get("pdf")
                                    .then(function (pdf) {

                                        const totalPages = pdf.internal.getNumberOfPages();

                                        for (let i = 1; i <= totalPages; i++) {
                                            pdf.setPage(i);

                                            // Insert header on every page at fixed position
                                            pdf.addImage(imgData, "PNG", 0, 0, imgWidth, imgHeight);

                                            // Footer page number
                                            pdf.setFont("helvetica", "normal");
                                            pdf.setFontSize(8);
                                            pdf.setTextColor(150);
                                            pdf.text(
                                                "Page " + i + " of " + totalPages,
                                                105,
                                                290,
                                                null,
                                                null,
                                                "center"
                                            );
                                        }
                                    })
                                    .save()
                                    .then(function() {
                                        // Hide loading overlay
                                        headerElement.style.padding = "padding: 0 15mm 0 15mm";
                                        pageElement.style.padding = "0 15mm 20mm 15mm";
                                        overlay.style.display = "none";
                                    });
                            });
                    };
                </script>
            ';
            
            // Append script to body end
            $html = str_replace('</body>', $script . '</body>', $html);

            return response($html);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Failed to generate PDF'
            ], 500);
        }
    }

    /**
     * Get pricing model configuration for a proposal
     */
    public function getPricingModel($proposal_id): JsonResponse
    {
        try {
            $proposal = Proposal::with(['boqs.items'])->findOrFail($proposal_id);

            // Group BOQs by header for Type C/D
            $groupedBoqs = $proposal->boqs
                ->sortBy('header_order')
                ->groupBy('header')
                ->map(function ($boqs, $header) {
                    return [
                        'header' => $header ?: 'Ungrouped',
                        'header_order' => $boqs->first()->header_order ?? 0,
                        'boqs' => $boqs->map(function ($boq) {
                            return [
                                'id' => $boq->id,
                                'code' => $boq->code,
                                'header' => $boq->header,
                                'total_amount' => $boq->total_amount_items,
                            ];
                        })->values(),
                        'subtotal' => $boqs->sum('total_amount_items'),
                    ];
                })->values();

            return response()->json([
                'success' => true,
                'data' => [
                    'pricing_model' => $proposal->pricing_model,
                    'management_fee_type' => $proposal->management_fee_type,
                    'management_fee' => $proposal->management_fee,
                    'vat_rate' => $proposal->vat_rate,
                    'grouped_boqs' => $groupedBoqs,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Failed to get pricing model'
            ], 500);
        }
    }

    /**
     * Save pricing model configuration (pricing_model, fees, vat)
     */
    public function savePricingModel(ProposalRequest $request): JsonResponse
    {
        try {
            $proposal = $this->proposalService->savePricingModel($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Pricing model saved successfully',
                'data' => $proposal
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Failed to save pricing model'
            ], 500);
        }
    }

    /**
     * Update BOQ header assignment
     */
    public function updateBoqHeader(Request $request, $boq_id): JsonResponse
    {
        $request->validate([
            'header' => 'nullable|string|max:255',
            'header_order' => 'nullable|integer|min:0',
        ]);

        try {
            $boq = Boq::findOrFail($boq_id);

            $boq->update([
                'header' => $request->header,
                'header_order' => $request->header_order ?? 0,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'BOQ header updated successfully',
                'data' => $boq->fresh()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Failed to update BOQ header'
            ], 500);
        }
    }

    /**
     * Get available BOQs for pricing model (BOQs belonging to this proposal)
     */
    public function getAvailableBoqs($proposal_id): JsonResponse
    {
        try {
            $proposal = Proposal::findOrFail($proposal_id);

            $boqs = Boq::with('items')
                ->where('proposal_id', $proposal_id)
                ->orderBy('header_order')
                ->get()
                ->map(function ($boq) {
                    return [
                        'id' => $boq->id,
                        'code' => $boq->code,
                        'header' => $boq->header,
                        'header_order' => $boq->header_order,
                        'total_amount' => $boq->total_amount_items,
                        'items_count' => $boq->items->count(),
                    ];
                });

            return response()->json([
                'success' => true,
                'data' => $boqs
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Failed to get available BOQs'
            ], 500);
        }
    }

    /**
     * Get all BOQs for a proposal
     */
    // public function getBoqs($proposal_id): JsonResponse
    // {
    //     try {
    //         $boqs = $this->proposalService->getBoqsByProposalId($proposal_id);

    //         return response()->json([
    //             'success' => true,
    //             'data' => $boqs
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => $e->getMessage() ?: 'Failed to get BOQs'
    //         ], 500);
    //     }
    // }
}
