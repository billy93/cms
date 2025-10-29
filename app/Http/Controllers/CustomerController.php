<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\CustomerRequest;
use App\Http\Services\CustomerService;

class CustomerController extends Controller
{
    protected $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $customers = Customer::withCount('projects');

            return DataTables::eloquent($customers)
                ->addColumn('projects_count', fn($c) => $c->projects_count)
                ->addColumn('actions', function ($c) {
                    return '
                        <div class="dropdown table-action">
                            <a href="#" class="action-icon" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a  
                                    class="dropdown-item c_customer_edit" 
                                    href="#" 
                                    data-id="'.$c->id.'" 
                                    data-url="'.route('customers.read', ['customer_id' => $c->id]).'"
                                    data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvas_add">
                                    <i class="ti ti-edit text-blue"></i> Edit
                                </a>
                                <a  
                                    class="dropdown-item c_customer_delete" 
                                    href="javascript:void(0);" 
                                    data-id="'.$c->id.'" 
                                    data-url="'.route('customers.delete', ['customer_id' => $c->id]).'"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#delete_customer_modal">
                                    <i class="ti ti-trash text-danger"></i> Delete
                                </a>
                            </div>
                        </div>
                    ';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('customers');
    }

    public function create(CustomerRequest $request): JsonResponse
    {
        try {
            $customer = $this->customerService->createCustomer($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Customer created successfully',
                'data' => $customer
            ], 201);
        } catch (\Exception $e) {
            Log::error('Error creating Customer: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to create Customer'
            ], 500);
        }
    }

    public function readAll(): JsonResponse
    {
        $customers = $this->customerService->getAllCustomers();
        return response()->json([
            'status' => 'success',
            'data' => $customers
        ], 200);
    }

    public function read($customer_id): JsonResponse
    {
        try {
            $customer = $this->customerService->getCustomerById($customer_id);
            return response()->json([
                'success' => true,
                'data' => $customer
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error reading Customer: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to load Customer'
            ], 500);
        }
    }

    public function update(CustomerRequest $request, $customer_id): JsonResponse
    {
        try {
            $customer = $this->customerService->updateCustomer($customer_id, $request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Customer updated successfully',
                'data' => $customer
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error updating Customer: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update Customer'
            ], 500);
        }
    }

    public function delete($customer_id): JsonResponse
    {
        try {
            $this->customerService->deleteCustomer($customer_id);
            return response()->json([
                'success' => true,
                'message' => 'Customer deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error deleting Customer: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete Customer'
            ], 500);
        }
    }

    /**
     * Generate suggested customer code
     */
    public function generateCodes()
    {
        try {
            $code = Customer::generateCode();
            return response()->json([
                'success' => true,
                'data' => ['code' => $code]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error generating customer code: ' . $e->getMessage()
            ], 500);
        }
    }
}
