<?php

namespace App\Http\Controllers;

use App\Models\BillingOption;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\BillingOptionRequest;
use App\Http\Services\BillingOptionService;
use Yajra\DataTables\Facades\DataTables;

class BillingOptionController extends Controller
{
    protected $billingOptionService;

    public function __construct(BillingOptionService $billingOptionService)
    {
        $this->billingOptionService = $billingOptionService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $customerId = $request->query('customer_id');
            $searchValue = $request->search;
            $search = strtolower(trim(is_array($searchValue) ? ($searchValue['value'] ?? '') : ($searchValue ?? '')));
            
            $query = BillingOption::query();
            if ($customerId) {
                $query->where('customer_id', $customerId);
            }

            return DataTables::eloquent($query)
                ->filter(function ($query) use ($search) {
                    if ($search !== '') {
                        $query->where(function ($q) use ($search) {
                            $q->whereRaw('LOWER(cp_name) LIKE ?', ["%{$search}%"])
                                ->orWhereRaw('LOWER(cp_email) LIKE ?', ["%{$search}%"])
                                ->orWhereRaw('LOWER(address) LIKE ?', ["%{$search}%"])
                                ->orWhereRaw('LOWER(cp_title_division) LIKE ?', ["%{$search}%"]);
                        });
                    }
                })
                ->addColumn('actions', function ($bo) {
                    return '
                        <div class="dropdown table-action">
                            <a href="#" class="action-icon" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a  
                                    class="dropdown-item c_bill_addr_edit_btn" 
                                    href="javascript:void(0);" 
                                    data-url="'.route('billing-options.read', ['billing_option_id' => $bo->id]).'"
                                >
                                    <i class="ti ti-edit text-blue"></i> Edit
                                </a>
                                <a  
                                    class="dropdown-item c_bill_addr_delete_btn" 
                                    href="javascript:void(0);" 
                                    data-url="'.route('billing-options.read', ['billing_option_id' => $bo->id]).'"
                                >
                                    <i class="ti ti-trash text-danger"></i> Delete
                                </a>
                            </div>
                        </div>
                    ';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        abort(404);
    }

    public function create(BillingOptionRequest $request): JsonResponse
    {
        try {
            $billingOption = $this->billingOptionService->createBillingOption($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Billing Option created successfully',
                'data' => $billingOption
            ], 201);
        } catch (\Exception $e) {
            Log::error('Error creating Billing Option: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Failed to create Billing Option'
            ], 500);
        }
    }

    public function read(Request $request, $billing_option_id): JsonResponse
    {
        try {
            $billingOption = $this->billingOptionService->getBillingOptionById($billing_option_id);
            return response()->json([
                'success' => true,
                'data' => $billingOption
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Failed to load Billing Option'
            ], 500);
        }
    }

    public function update(BillingOptionRequest $request, $billing_option_id): JsonResponse
    {
        try {
            $billingOption = $this->billingOptionService->updateBillingOption($billing_option_id, $request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Billing Option updated successfully',
                'data' => $billingOption
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Failed to update Billing Option'
            ], 500);
        }
    }

    public function delete($billing_option_id): JsonResponse
    {
        try {
            $this->billingOptionService->deleteBillingOption($billing_option_id);
            return response()->json([
                'success' => true,
                'message' => 'Billing Option deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Failed to delete Billing Option'
            ], 500);
        }
    }
}
