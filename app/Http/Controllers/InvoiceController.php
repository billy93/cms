<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Invoice;
use App\Http\Requests\InvoiceRequest;
use App\Http\Services\InvoiceService;

class InvoiceController extends Controller
{
    protected $invoiceService;
    protected $templateService;

    public function __construct(InvoiceService $invoiceService, \App\Http\Services\PdfTemplateService $templateService)
    {
        $this->invoiceService = $invoiceService;
        $this->templateService = $templateService;
    }
    
    /**
     * Retrieve paginated users with ordering, excluding the password field,
     * and pass the data to the manage-users view.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        
        if($request->ajax())
        {
            $searchValue = $request->search;
            $search = strtolower(trim(is_array($searchValue) ? ($searchValue['value'] ?? '') : ($searchValue ?? '')));
            $invoices = Invoice::with(['customer', 'proposal', 'boqs']);

            $result = DataTables::eloquent($invoices)
                ->filter(function ($query) use ($search) {
                    if ($search !== '') {
                        $query->where(function ($q) use ($search) {
                            $q->whereRaw('LOWER(code) LIKE ?', ["%{$search}%"])
                            ->orWhereRaw('LOWER(payment_method) LIKE ?', ["%{$search}%"])
                            ->orWhereRaw('LOWER(bill_to) LIKE ?', ["%{$search}%"])
                            ->orWhereRaw('LOWER(ship_to) LIKE ?', ["%{$search}%"])
                            ->orWhereRaw('LOWER(note) LIKE ?', ["%{$search}%"])
                            ->orWhereHas('customer', fn($p) =>
                                $p->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"])
                            )
                            ->orWhereHas('proposal', fn($p) =>
                                $p->whereRaw('LOWER(code) LIKE ?', ["%{$search}%"])
                            );
                        });
                    }
                })
                ->addColumn('proposal_code', fn($boq) => $boq->proposal?->code ?: '-')
                ->addColumn('sales_code', fn($boq) => $boq->proposal?->sales_code ?: "-")
                ->addColumn('actions', function($invoice) {
                    return '
                        <div class="dropdown table-action">
                            <a href="javascript:void(0)" class="action-icon" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a  
                                    class="dropdown-item" 
                                    href="'.route('invoices.read', ['invoice_id' => $invoice->id]).'"
                                >
                                    <i class="ti ti-eye text-info"></i> View Detail
                                </a>
                                <a 
                                    class="dropdown-item" 
                                    href="'.route('invoices.pdf', ['invoice_id' => $invoice->id]).'" 
                                    target="_blank"
                                >
                                    <i class="ti ti-file-type-pdf text-danger"></i> Generate PDF
                                </a>
                                <a 
                                    class="dropdown-item c_invoice_edit_btn" 
                                    href="javascript:void(0)" 
                                    data-url="'.route('invoices.read', ['invoice_id' => $invoice->id]).'"
                                >
                                    <i class="ti ti-edit text-blue"></i> Edit
                                </a>
                                <a 
                                    class="dropdown-item c_invoice_delete_btn" 
                                    href="javascript:void(0)" 
                                    data-url="'.route('invoices.delete', ['invoice_id' => $invoice->id]).'"
                                >
                                    <i class="ti ti-trash text-danger"></i> Delete
                                </a>
                            </div>
                        </div>
                    ';
                    }
                )
                ->rawColumns(['description', 'notes', 'status', 'ship_to', 'terms_and_conditions', 'actions'])
                ->make(true);
                
            return $result; 
        }

        return view('invoices');
    }

    
    public function create(InvoiceRequest $request): JsonResponse
    {
        try {
            $invoice = $this->invoiceService->createInvoice($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Invoice created successfully',
                'data' => $invoice
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Failed to create Invoice'
            ], 500);
        }
    }

    public function readAll(): JsonResponse
    {
        try {
            $invoices = $this->invoiceService->getAllInvoices();
            return response()->json([
                'status' => 'success',
                'data' => $invoices
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Internal Server Error'
            ], 500);
        }
    }

    public function read(Request $request, $invoice_id)
    {
        if($request->wantsJson() || $request->ajax()) {
            try {
                $invoice = $this->invoiceService->getInvoiceById($invoice_id);
                return response()->json([
                    'success' => true,
                    'data' => $invoice
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage() ?: 'Internal Server Error'
                ], 500);
            }
        }
         
        $invoice = $this->invoiceService->getInvoiceById($invoice_id);
        return view('invoices.detail', compact('invoice'));
    }

    public function update(InvoiceRequest $request): JsonResponse
    {
        try {
            $invoice = $this->invoiceService->updateInvoice($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Invoice updated successfully',
                'data' => $invoice
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Internal Server Error'
            ], 500);
        }
    }

    public function delete($invoice_id): JsonResponse
    {
        try {
            $this->invoiceService->deleteInvoice($invoice_id);
            return response()->json([
                'success' => true,
                'message' => 'Invoice deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Internal Server Error'
            ], 500);
        }
    }

    public function generatePdf($invoice_id)
    {
        try {
            $invoice = Invoice::with(['customer', 'proposal', 'boqs.items'])->findOrFail($invoice_id);
            
            // Get Default Invoice Template
            $template = \App\Models\PdfTemplate::where('type', 'invoice')
                ->where('is_active', true)
                ->where('name', 'Default Invoice')
                ->first();

            if (!$template) {
                // Fallback to any active invoice template
                $template = \App\Models\PdfTemplate::where('type', 'invoice')
                    ->where('is_active', true)
                    ->first();
            }

            if (!$template) {
                return response()->json(['success' => false, 'message' => 'No active invoice template found'], 404);
            }

            // Calculate subtotal and tax (simplified logic based on available fields)
            // Assuming total_amount is final, and we might need to back-calculate or sum items
            // For now, let's use the fields we have.
            // Note: In a real scenario, we'd iterate BOQs to get subtotal/tax details if stored there.
            
            $subtotal = 0;
            $taxAmount = 0;
            $invoiceItemsHtml = '';
            
            foreach($invoice->boqs as $boq) {
                $subtotal += $boq->invoice_amount; 
                
                // Handle Type A (No Items, just Header Total)
                if ($boq->form_type === 'A') {
                    $invoiceItemsHtml .= '<tr>';
                    $invoiceItemsHtml .= '<td>' . $boq->code . '</td>';
                    $invoiceItemsHtml .= '<td class="pdf-text-center"></td>'; // Empty Qty
                    $invoiceItemsHtml .= '<td class="pdf-text-right">' . formatRupiah($boq->total_amount_items) . '</td>';
                    $invoiceItemsHtml .= '<td class="pdf-text-right">' . formatRupiah($boq->total_amount_items) . '</td>';
                    $invoiceItemsHtml .= '</tr>';
                } else {
                    // Type B, C, D (With Items)
                    
                    // BOQ Header (Code)
                    $invoiceItemsHtml .= '<tr style="background-color: #f9f9f9;">';
                    $invoiceItemsHtml .= '<td colspan="4" style="font-weight: bold; color: #4059C6;">' . $boq->code . '</td>';
                    $invoiceItemsHtml .= '</tr>';

                    // BOQ Items
                    foreach($boq->items as $item) {
                        $invoiceItemsHtml .= '<tr>';
                        $invoiceItemsHtml .= '<td style="padding-left: 20px;">' . ($item->subheader ?: $item->header) . '</td>';
                        
                        // Qty logic
                        $qty = 1;
                        if ($item->unit_price > 0) {
                            $qty = round($item->multiplier_total / $item->unit_price, 2);
                        }
                        
                        $invoiceItemsHtml .= '<td class="pdf-text-center">' . ($qty == 1 ? '1' : $qty) . '</td>';
                        $invoiceItemsHtml .= '<td class="pdf-text-right">' . formatRupiah($item->unit_price) . '</td>';
                        $invoiceItemsHtml .= '<td class="pdf-text-right">' . formatRupiah($item->multiplier_total) . '</td>';
                        $invoiceItemsHtml .= '</tr>';
                    }
                }

                // Management Fee
                if ($boq->management_fee > 0) {
                    $invoiceItemsHtml .= '<tr>';
                    $invoiceItemsHtml .= '<td style="padding-left: 20px;">Management Fee</td>';
                    $invoiceItemsHtml .= '<td class="pdf-text-center"></td>'; // Empty Qty
                    $invoiceItemsHtml .= '<td class="pdf-text-right">' . formatRupiah($boq->management_fee) . '</td>';
                    $invoiceItemsHtml .= '<td class="pdf-text-right">' . formatRupiah($boq->management_fee) . '</td>';
                    $invoiceItemsHtml .= '</tr>';
                }

                // VAT
                if ($boq->vat > 0) {
                    $invoiceItemsHtml .= '<tr>';
                    $invoiceItemsHtml .= '<td style="padding-left: 20px;">VAT (' . ($boq->vat_rate ?? 11) . '%)</td>';
                    $invoiceItemsHtml .= '<td class="pdf-text-center"></td>'; // Empty Qty
                    $invoiceItemsHtml .= '<td class="pdf-text-right">' . formatRupiah($boq->vat) . '</td>';
                    $invoiceItemsHtml .= '<td class="pdf-text-right">' . formatRupiah($boq->vat) . '</td>';
                    $invoiceItemsHtml .= '</tr>';
                }
            }
            
            $logoPath = public_path('build/img/ati-logo.png');
            $logoData = '';
            if (file_exists($logoPath)) {
                $logoData = 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath));
            }

            // Map data
            $data = [
                'invoice_code' => $invoice->code,
                'invoice_date' => \Carbon\Carbon::parse($invoice->invoice_date)->format('d F Y'),
                'customer_name' => $invoice->customer->name ?? '-',
                'bill_to' => $invoice->bill_to,
                'due_date' => \Carbon\Carbon::parse($invoice->due_date)->format('d F Y'),
                'payment_method' => $invoice->payment_method,
                'subtotal' => formatRupiah($subtotal),
                'tax_amount' => formatRupiah($taxAmount), // Placeholder if not explicitly stored
                'total_amount' => formatRupiah($invoice->total_amount),
                'notes' => $invoice->notes,
                'invoice_items' => $invoiceItemsHtml,
                'logo_path' => $logoData,
            ];

            // Render
            $html = $this->templateService->renderTemplate($template->id, $data);

            // Inject html2pdf.js for client-side generation
            $filename = 'Invoice-' . $invoice->code . '.pdf';
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
