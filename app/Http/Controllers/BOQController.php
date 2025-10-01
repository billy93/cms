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
            $boqs = Boq::with('items');

            return DataTables::eloquent($boqs)
                ->addColumn('created_at', fn($boq) => $boq->created_at->format('d-M-Y'))
                ->addColumn('header', fn($boq) => '<ul>'.implode('', $boq->items->map(fn($i) => "<li>{$i->header}</li>")->toArray()).'</ul>')
                ->addColumn('subheader', fn($boq) => '<ul>'.implode('', $boq->items->map(fn($i) => "<li>{$i->subheader}</li>")->toArray()).'</ul>')
                // ->addColumn('item_product_name', fn($boq) => '<ul>'.implode('', $boq->items->map(fn($i) => "<li>{$i->snapshot_product_name}</li>")->toArray()).'</ul>')
                ->addColumn('unit_price', fn($boq) => '<ul>'.implode('', $boq->items->map(fn($i) => "<li>{$i->unit_price}</li>")->toArray()).'</ul>')
                ->addColumn('item_title1', fn($boq) => '<ul>'.implode('', $boq->items->map(fn($i) => "<li>{$i->title1_value} {$i->title1_key}</li>")->toArray()).'</ul>')
                ->addColumn('item_title2', fn($boq) => '<ul>'.implode('', $boq->items->map(fn($i) => "<li>{$i->title2_value} {$i->title2_key}</li>")->toArray()).'</ul>')
                ->addColumn('item_title3', fn($boq) => '<ul>'.implode('', $boq->items->map(fn($i) => "<li>{$i->title3_value} {$i->title3_key}</li>")->toArray()).'</ul>')
                ->addColumn('item_title4', fn($boq) => '<ul>'.implode('', $boq->items->map(fn($i) => "<li>{$i->title4_value} {$i->title4_key}</li>")->toArray()).'</ul>')
                ->addColumn('multiplier_total', fn($boq) => '<ul>'.implode('', $boq->items->map(fn($i) => "<li>{$i->multiplier_total}</li>")->toArray()).'</ul>')
                ->addColumn('vat_rate', fn($boq) => $boq->vat_rate . "%")
                ->addColumn('management_fee', fn($boq) => $boq->management_fee_type == 'percent' ? $boq->management_fee . "%" : $boq->management_fee)
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

        return view('boq-page');
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
            Log::error('Error creating BOQ: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to create BOQ'
            ], 500);
        }
    }

    public function readAll(): JsonResponse
    {
        $boqs = $this->boqService->getAllBoqs();
        return response()->json([
            'status' => 'success',
            'data' => $boqs
        ], 200);
    }

    public function read($boq_id): JsonResponse
    {
        try {
            $boq = $this->boqService->getBoqById($boq_id);
            return response()->json([
                'success' => true,
                'data' => $boq
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error reading BOQ: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to load BOQ'
            ], 500);
        }
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
            Log::error('Error updating BOQ: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update BOQ'
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
            Log::error('Error deleting BOQ: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete BOQ'
            ], 500);
        }
    }
}
