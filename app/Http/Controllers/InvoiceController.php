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
            $invoices = Invoice::query();
            $result = DataTables::eloquent($invoices)
            ->addColumn('ship_to', function($invoice) {
                return '<div style="width:300px; white-space:normal; word-wrap:break-word;">'
                    . e($invoice->ship_to) .
                    '</div>';
            })
            ->addColumn("created_at", function($invoice) {
                return Carbon::parse($invoice->created_at)->format('d-M-Y');
            }) 
            ->addColumn('description', function($invoice) {
                return '<div style="width:300px; white-space:normal; word-wrap:break-word;">'
                    . e($invoice->description) .
                    '</div>';
            })
            ->addColumn('terms_and_conditions', function($invoice) {
                return '<div style="width:300px; white-space:normal; word-wrap:break-word;">'
                    . e($invoice->terms_and_conditions) .
                    '</div>';
            })
            ->addColumn('notes', function($invoice) {
                return '<div style="width:300px; white-space:normal; word-wrap:break-word;">'
                    . e($invoice->notes) .
                    '</div>';
            })
            ->addColumn('status', function($invoice) {
                $status = strtolower($invoice->status);
            
                $map = [
                    'paid' => ['label' => 'Paid', 'class' => 'bg-success'],
                    'pending' => ['label' => 'Pending', 'class' => 'bg-warning'],
                    'canceled' => ['label' => 'Canceled', 'class' => 'bg-danger'],
                    'overdue' => ['label' => 'Overdue', 'class' => 'bg-violet'], 
                ];
            
                $statusData = $map[$status] ?? ['label' => ucfirst($status), 'class' => 'bg-secondary'];
            
                return '<span class="badge badge-pill badge-status ' . $statusData['class'] . '">' . $statusData['label'] . '</span>';
            })
            ->addColumn('actions', function($invoice) {
                return '
                    <div class="dropdown table-action">
                        <a href="javascript:void(0)" class="action-icon" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a 
                                id="c_invoice_edit" 
                                class="dropdown-item" 
                                href="javascript:void(0)" 
                                data-id="'.$invoice->id.'" 
                                data-url="'.route('invoices.read', ['invoice_id' => $invoice->id]).'"
                                data-bs-toggle="offcanvas" 
                                data-bs-target="#offcanvas_edit">
                                <i class="ti ti-edit text-blue"></i> Edit
                            </a>
                            <a 
                                id="c_invoice_delete" 
                                class="dropdown-item" 
                                href="javascript:void(0)" 
                                data-id="'.$invoice->id.'" 
                                data-url="'.route('invoices.delete', ['invoice_id' => $invoice->id]).'"
                                data-bs-toggle="modal" 
                                data-bs-target="#delete_invoice_modal">
                                <i class="ti ti-trash text-danger"></i> Delete
                            </a>
                            <a class="dropdown-item" href="javascript:void(0);"><i class="ti ti-clipboard-copy text-green"></i> View Invoices</a>
                            <a class="dropdown-item" href="javascript:void(0);"><i class="ti ti-checks text-success"></i> Mark as Paid</a>
                            <a class="dropdown-item" href="javascript:void(0);"><i class="ti ti-file text-tertiary"></i> Mark as Partially Paid</a>
                            <a class="dropdown-item" href="javascript:void(0);"><i class="ti ti-sticker text-blue"></i> Mark ad Unpaid</a>
                            <a class="dropdown-item" href="javascript:void(0);"><i class="ti ti-printer text-info"></i> Print</a>
                        </div>
                    </div>
                ';
                }
            )
            ->rawColumns(['description', 'notes', 'status', 'ship_to', 'terms_and_conditions', 'actions'])
            ->make(true);
            \Log::info('Response (invoices.index): ' . json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            return $result; 
        }

        return view('invoices');
    }

    public function create(InnvoiceRequest $request): JsonResponse
    {
        $invoice = $this->invoiceService->createInvoice($request->validated());            
        return response()->json([
            'status' => 'success',
            'data' => $invoice
        ], 201);
    }

    public function readAll(): JsonResponse
    {
        $invoices = $this->invoiceService->getAllInvoices();
        return response()->json([
            'status' => 'success',
            'data' => $invoices
        ], 200);
    }

    public function read($invoice_id): JsonResponse
    {
        $invoice = $this->invoiceService->getInvoiceById($invoice_id);
     \Log::info(json_encode($invoice, JSON_PRETTY_PRINT));
        return response()->json([
            'status' => 'success',
            'data' => $invoice
        ], 200);
    }

    public function update(InnvoiceRequest $request, $invoice_id): JsonResponse
    {
        $validatedData = $request->validated();
        $invoice = $this->invoiceService->updateInvoice($invoice_id, $validatedData);
        return response()->json([
            'status' => 'success',
            'data' => $invoice
        ], 200);
    }

    public function delete($invoice_id): JsonResponse
    {
        $this->invoiceService->deletePermission($invoice_id);
        return response()->json([
            'status' => 'success',
            'message' => "Permission with ID {$invoice_id} deleted successfully"
        ], 200);
    }
}
