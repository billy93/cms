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

    public function __construct(ProposalService $proposalService)
    {
        $this->proposalService = $proposalService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $proposals = Proposal::with('project', 'boqs', 'invoices');

            return DataTables::eloquent($proposals)
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
}
