<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\Boq;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
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
            $proposals = Proposal::with('project', 'boqs', 'invoices');

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
                    if ($p->status !== 'Win') {
                        return '-';
                    }

                    if ($p->boqs->isEmpty()) {
                        return '-';
                    }

                    if($p->boqs->every(fn($boq) => $boq->invoice_id !== null)) {
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
                    if ($p->status === 'Win') {
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
            $boqs = Boq::with(['proposal', 'items'])
                ->where('proposal_id', $proposal_id);
                 
            return DataTables::eloquent($boqs)
                ->addColumn('sales_code', fn($boq) => $boq->proposal?->sales_code ?: '-')
                ->addColumn('header', fn($boq) => '<ul>'.implode('', $boq->items->map(fn($i) => "<li>{$i->header}</li>")->toArray()).'</ul>')
                ->addColumn('subheader', fn($boq) => '<ul>'.implode('', $boq->items->map(fn($i) => "<li>{$i->subheader}</li>")->toArray()).'</ul>')
                // ->addColumn('item_product_name', fn($boq) => '<ul>'.implode('', $boq->items->map(fn($i) => "<li>{$i->snapshot_product_name}</li>")->toArray()).'</ul>')
                ->addColumn('unit_price', fn($boq) => 
                    '<ul>' . implode('', 
                        $boq->items->map(fn($i) => 
                            "<li>" . formatRupiah($i->unit_price) . "</li>"
                        )->toArray()
                    ) . '</ul>'
                )
                ->addColumn('item_title1', fn($boq) => '<ul>'.implode('', $boq->items->map(fn($i) => "<li>{$i->title1_value} {$i->title1_key}</li>")->toArray()).'</ul>')
                ->addColumn('item_title2', fn($boq) => '<ul>'.implode('', $boq->items->map(fn($i) => "<li>{$i->title2_value} {$i->title2_key}</li>")->toArray()).'</ul>')
                ->addColumn('item_title3', fn($boq) => '<ul>'.implode('', $boq->items->map(fn($i) => "<li>{$i->title3_value} {$i->title3_key}</li>")->toArray()).'</ul>')
                ->addColumn('item_title4', fn($boq) => '<ul>'.implode('', $boq->items->map(fn($i) => "<li>{$i->title4_value} {$i->title4_key}</li>")->toArray()).'</ul>')
                ->addColumn('multiplier_total', fn($boq) => 
                    '<ul>' 
                    . implode('', 
                        $boq->items->map(fn($i) => 
                            "<li>" . formatRupiah($i->multiplier_total) . "</li>"
                        )->toArray()
                    ) 
                    . '</ul>'
                )
                ->addColumn('management_fee', fn($boq) => 
                    $boq->management_fee_type === 'percent' 
                        ? ($boq->management_fee / 100) * $boq->total_amount_items 
                        : $boq->management_fee
                )
                ->addColumn('actions', function ($boq) {
                    if ($boq->proposal && $boq->proposal->status === 'Win') {
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
                    'actions', 'header','subheader','item_product_name','unit_price',
                    'item_title1','item_title2','item_title3','item_title4','multiplier_total'
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
            $proposal = Proposal::with(['project.customer', 'boqs.items'])->findOrFail($proposal_id);
            
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

            // Calculate total amount from BOQs and generate HTML
            $totalAmount = 0;
            $boqItemsHtml = '';

            foreach($proposal->boqs as $boq) {
                 $totalAmount += $boq->invoice_amount;

                 // BOQ Header (Code)
                 $boqItemsHtml .= '<tr style="background-color: #f9f9f9;">';
                 $boqItemsHtml .= '<td colspan="4" style="font-weight: bold; color: #4059C6;">' . $boq->code . '</td>';
                 $boqItemsHtml .= '</tr>';

                 // BOQ Items
                 foreach($boq->items as $item) {
                     $boqItemsHtml .= '<tr>';
                     $boqItemsHtml .= '<td style="padding-left: 20px;">' . ($item->subheader ?: $item->header) . '</td>';
                     
                     // Qty logic
                     $qty = 1;
                     if ($item->unit_price > 0) {
                         $qty = round($item->multiplier_total / $item->unit_price, 2);
                     }
                     
                     $boqItemsHtml .= '<td class="pdf-text-center">' . ($qty == 1 ? '1' : $qty) . '</td>';
                     $boqItemsHtml .= '<td class="pdf-text-right">' . formatRupiah($item->unit_price) . '</td>';
                     $boqItemsHtml .= '<td class="pdf-text-right">' . formatRupiah($item->multiplier_total) . '</td>';
                     $boqItemsHtml .= '</tr>';
                 }

                 // Management Fee
                 if ($boq->management_fee > 0) {
                     $boqItemsHtml .= '<tr>';
                     $boqItemsHtml .= '<td style="padding-left: 20px;">Management Fee</td>';
                     $boqItemsHtml .= '<td class="pdf-text-center"></td>'; // Empty Qty
                     $boqItemsHtml .= '<td class="pdf-text-right">' . formatRupiah($boq->management_fee) . '</td>';
                     $boqItemsHtml .= '<td class="pdf-text-right">' . formatRupiah($boq->management_fee) . '</td>';
                     $boqItemsHtml .= '</tr>';
                 }

                 // VAT
                 if ($boq->vat > 0) {
                     $boqItemsHtml .= '<tr>';
                     $boqItemsHtml .= '<td style="padding-left: 20px;">VAT (' . ($boq->vat_rate ?? 11) . '%)</td>';
                     $boqItemsHtml .= '<td class="pdf-text-center"></td>'; // Empty Qty
                     $boqItemsHtml .= '<td class="pdf-text-right">' . formatRupiah($boq->vat) . '</td>';
                     $boqItemsHtml .= '<td class="pdf-text-right">' . formatRupiah($boq->vat) . '</td>';
                     $boqItemsHtml .= '</tr>';
                 }
            }

            $logoPath = public_path('build/img/ati-logo.png');
            $logoData = '';
            if (file_exists($logoPath)) {
                $logoData = 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath));
            }

            // Map data
            $data = [
                'proposal_code' => $proposal->code,
                'project_name' => $proposal->project->name ?? '-',
                'customer_name' => $proposal->project->customer->name ?? '-', // Access via project
                'proposal_date' => \Carbon\Carbon::parse($proposal->created_at)->format('d F Y'),
                'valid_until' => $proposal->valid_until ? \Carbon\Carbon::parse($proposal->valid_until)->format('d F Y') : '-',
                'sales_code' => $proposal->sales_code ?? '-',
                'description' => $proposal->description ?? '-',
                'scope_of_work' => $proposal->scope_of_work ?? '-',
                'terms_and_conditions' => $proposal->terms_and_conditions ?? '-',
                'total_amount' => formatRupiah($totalAmount),
                'boq_items' => $boqItemsHtml,
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
}
