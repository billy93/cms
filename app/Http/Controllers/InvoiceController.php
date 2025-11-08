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

    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
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
}
