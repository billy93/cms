<?php

namespace App\Http\Controllers;

use App\Models\Boq;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\BoqRequest;
use App\Http\Services\BoqService;

class BoqController extends Controller
{
    protected $boqService;

    public function __construct(BoqService $boqService)
    {
        $this->boqService = $boqService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $boqs = Boq::with(['proposal', 'items']);

            return DataTables::eloquent($boqs)
                ->addColumn('checkbox', fn($boq) =>
                    '<label class="checkboxs"><input type="checkbox" class="row-check" value="' . $boq->id . '"><span class="checkmarks"></span></label>'
                )
                ->addColumn('proposal_code', fn($boq) => $boq->proposal?->code ?: '-')
                ->addColumn('sales_code', fn($boq) => $boq->proposal?->sales_code ?: "-")
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
                    if ($boq->proposal && $boq->proposal->status === 'Approved') {
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
                                    data-id="'.$boq->id.'" 
                                    data-url="'.route('boqs.read', ['boq_id' => $boq->id]).'"
                                >
                                    <i class="ti ti-edit text-blue"></i> Edit
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
                    'checkbox', 'actions', 'header','subheader','item_product_name','unit_price',
                    'item_title1','item_title2','item_title3','item_title4','multiplier_total'
                ])
                ->make(true);
        }

        return view('boqs');
    }

    public function create(BoqRequest $request): JsonResponse
    {
        try {
            $boq = $this->boqService->createBoq($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'BOQ created successfully',
                'data' => $boq
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Failed to create BOQ'
            ], 500);
        }
    }

    public function readAll(): JsonResponse
    {
        try {
            $boqs = $this->boqService->getAllBoqs();
            return response()->json([
                'status' => 'success',
                'data' => $boqs
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Failed to load BOQ'
            ], 500);
        }
    }

    public function read(Request $request, $boq_id)
     {
        if($request->wantsJson() || $request->ajax()){
            try {
                $boq = $this->boqService->getBoqById($boq_id);
                return response()->json([
                    'success' => true,
                    'data' => $boq
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage() ?: 'Failed to load BOQ'
                ], 500);
            }
        }

        $boq = $this->boqService->getBoqById($boq_id);
        return view('boqs.detail', compact('boq'));
    }

    public function update(BoqRequest $request, $boq_id): JsonResponse
    {
        try {
            $boq = $this->boqService->updateBoq($boq_id, $request->validated());
            return response()->json([
                'success' => true,
                'message' => 'BOQ updated successfully',
                'data' => $boq
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Failed to update BOQ'
            ], 500);
        }
    }

    public function replicate(BoqRequest $request,  $proposal_id = null): JsonResponse
    {
        try {
            $validated = $request->validated();
            $boqs = $this->boqService->replicate(
                $validated['boq_ids'],
                $proposal_id
            );

            return response()->json([
                'success' => true,
                'message' => $proposal_id
                    ? 'BOQs successfully replicated and bound to the proposal.'
                    : 'BOQs successfully replicated without binding to any proposal.',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Failed to replicate BOQs.',
            ], 500);
        }
    }

    public function unbindProposal(BoqRequest $request, ?int $boq_id = null)
    {
        try {
             
            $validated = $request->validated();
            $boqs = $this->boqService->unbindProposal(
                $validated['boq_ids'] ?? [],
                $boq_id
            );
            
            return response()->json([
                'success' => true,
                'message' => count($boqs) > 1
                    ? 'BOQs successfully unbound from their proposals.'
                    : 'BOQ successfully unbound from its proposal.',
                'data' => $boqs,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Failed to unbind BOQs from proposals.',
            ], 500);
        }
    }


    public function delete($boq_id): JsonResponse
    {
        try {
            $this->boqService->deleteBoq($boq_id);
            return response()->json([
                'success' => true,
                'message' => 'BOQ deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Failed to delete BOQ'
            ], 500);
        }
    }

    public function bulkDelete(BoqRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();
            $boqIds = $validated['boq_ids'];
            $deleted = $this->boqService->deleteBoqs($boqIds);

            return response()->json([
                'success' => true,
                'message' => $deleted > 1
                    ? 'BOQs deleted successfully'
                    : 'BOQ deleted successfully',
            ]);
         } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Failed to delete BOQs'
            ], 500);
        }
    }
}
