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
            $proposals = Proposal::with('project');

            return DataTables::eloquent($proposals)
                ->addColumn('project_code', fn($p) => $p->project->code ?? '-')
                ->addColumn('project_name', fn($p) => $p->project->name ?? '-')
                ->addColumn('actions', function ($p) {
                    return '
                        <div class="dropdown table-action">
                            <a href="#" class="action-icon" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a  
                                    class="dropdown-item" 
                                    href="'.route('proposals.show', ['proposal_id' => $p->id]).'"
                                >
                                    <i class="ti ti-eye text-info"></i> View Detail
                                </a>
                                <a  
                                    class="dropdown-item c_proposal_edit" 
                                    href="#" 
                                    data-id="'.$p->id.'" 
                                    data-url="'.route('proposals.read', ['proposal_id' => $p->id]).'"
                                    data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvas_add">
                                    <i class="ti ti-edit text-blue"></i> Edit
                                </a>
                                <a  
                                    class="dropdown-item c_proposal_delete" 
                                    href="javascript:void(0);" 
                                    data-id="'.$p->id.'" 
                                    data-url="'.route('proposals.delete', ['proposal_id' => $p->id]).'"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#delete_proposal_modal">
                                    <i class="ti ti-trash text-danger"></i> Delete
                                </a>
                            </div>
                        </div>
                    ';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('proposals');
    }

    public function show(Request $request, $proposal_id)
    {
         if ($request->ajax()) {
            $boqs = Boq::with('items')
                ->where('proposal_id', $proposal_id);
                 
            return DataTables::eloquent($boqs)
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
                    '<ul>' . implode('', 
                        $boq->items->map(fn($i) => 
                            "<li>" . formatRupiah($i->multiplier_total) . "</li>"
                        )->toArray()
                    ) . '</ul>'
                )
                ->addColumn('management_fee', fn($boq) => 
                    $boq->management_fee_type === 'percent' 
                        ? ($boq->management_fee / 100) * $boq->total_amount_items 
                        : $boq->management_fee
                )
                ->addColumn('actions', function ($boq) {
                    return '
                        <div class="dropdown table-action">
                            <a href="#" class="action-icon" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a  
                                    class="dropdown-item c_boq_edit" 
                                    href="#" 
                                    data-id="'.$boq->id.'" 
                                    data-url="'.route('boqs.read', ['boq_id' => $boq->id]).'"
                                    data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvas_add">
                                    <i class="ti ti-edit text-blue"></i> Edit
                                </a>
                                <a  
                                    class="dropdown-item c_boq_delete" 
                                    href="javascript:void(0);" 
                                    data-id="'.$boq->id.'" 
                                    data-url="'.route('boqs.delete', ['boq_id' => $boq->id]).'"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#delete_boq_modal">
                                    <i class="ti ti-trash text-danger"></i> Delete
                                </a>
                            </div>
                        </div>
                    ';
                })
                ->rawColumns([
                    'actions',
                    'header','subheader','item_product_name','unit_price',
                    'item_title1','item_title2','item_title3','item_title4','multiplier_total'
                ])
                ->make(true);
        }
        
        $proposal = $this->proposalService->getProposalById($proposal_id);
        
        return view('proposals.show', compact('proposal'));
    }

    public function useExistingBoq(Request $request) {
            $boqs = Boq::with('items')
                ->where('proposal_id', $proposal_id);
                 
            return DataTables::eloquent($boqs)
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
                    '<ul>' . implode('', 
                        $boq->items->map(fn($i) => 
                            "<li>" . formatRupiah($i->multiplier_total) . "</li>"
                        )->toArray()
                    ) . '</ul>'
                )
                ->addColumn('management_fee', fn($boq) => 
                    $boq->management_fee_type === 'percent' 
                        ? ($boq->management_fee / 100) * $boq->total_amount_items 
                        : $boq->management_fee
                )
                ->addColumn('actions', function ($boq) {
                    return '
                        <div class="dropdown table-action">
                            <a href="#" class="action-icon" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a  
                                    class="dropdown-item c_boq_edit" 
                                    href="#" 
                                    data-id="'.$boq->id.'" 
                                    data-url="'.route('boqs.read', ['boq_id' => $boq->id]).'"
                                    data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvas_add">
                                    <i class="ti ti-edit text-blue"></i> Edit
                                </a>
                                <a  
                                    class="dropdown-item c_boq_delete" 
                                    href="javascript:void(0);" 
                                    data-id="'.$boq->id.'" 
                                    data-url="'.route('boqs.delete', ['boq_id' => $boq->id]).'"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#delete_boq_modal">
                                    <i class="ti ti-trash text-danger"></i> Delete
                                </a>
                            </div>
                        </div>
                    ';
                })
                ->rawColumns([
                    'actions',
                    'header','subheader','item_product_name','unit_price',
                    'item_title1','item_title2','item_title3','item_title4','multiplier_total'
                ])
                ->make(true);
    }

    public function boq($proposal_id)
    {
        $proposal = $this->proposalService->getProposalById($proposal_id);
        
        return view('proposals.show', compact('proposal'));
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
            Log::error('Error creating Proposal: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to create Proposal'
            ], 500);
        }
    }

    public function readAll(): JsonResponse
    {
        $proposals = $this->proposalService->getAllProposals();
        return response()->json([
            'status' => 'success',
            'data' => $proposals
        ], 200);
    }

    public function read($proposal_id): JsonResponse
    {
        try {
            $proposal = $this->proposalService->getProposalById($proposal_id);
            return response()->json([
                'success' => true,
                'data' => $proposal
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error reading Proposal: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to load Proposal'
            ], 500);
        }
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
            Log::error('Error updating Proposal: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update Proposal'
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
            Log::error('Error deleting Proposal: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete Proposal'
            ], 500);
        }
    }

    
    /**
     * Get proposal by project ID
     */
    public function getByProject($projectId)
    {
        try {
            $proposal = Proposal::with(['project', 'project.customer'])
                ->where('project_id', $projectId)
                ->first();

            if (!$proposal) {
                return response()->json([
                    'success' => false,
                    'message' => 'No proposal found for this project'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $proposal
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching proposal: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get cities based on destination
     */
    public function getCities(Request $request)
    {
        $destination = $request->get('destination');
        
        if ($destination === 'Indonesia') {
            $cities = [
                'Jakarta', 'Surabaya', 'Bandung', 'Medan', 'Semarang', 'Makassar', 'Palembang',
                'Tangerang', 'Depok', 'Bekasi', 'Bogor', 'Batam', 'Pekanbaru', 'Bandar Lampung',
                'Malang', 'Padang', 'Denpasar', 'Samarinda', 'Tasikmalaya', 'Balikpapan',
                'Pontianak', 'Jambi', 'Cimahi', 'Surakarta', 'Manado', 'Yogyakarta'
            ];
        } else {
            $cities = ['Overseas'];
        }

        return response()->json([
            'success' => true,
            'data' => $cities
        ]);
    }

    /**
     * Generate suggested codes
     */
    public function generateCodes()
    {
        try {
            $code = 'BOQ' . date('Y') . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
            $salesCode = 'SALES' . date('Y') . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);

            return response()->json([
                'success' => true,
                'data' => [
                    'code' => $code,
                    'sales_code' => $salesCode
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error generating codes: ' . $e->getMessage()
            ], 500);
        }
    }
}
