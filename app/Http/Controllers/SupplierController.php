<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\SupplierRequest;
use App\Http\Services\SupplierService;

class SupplierController extends Controller
{
    protected $supplierService;

    public function __construct(SupplierService $supplierService)
    {
        $this->supplierService = $supplierService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $searchValue = $request->search;
            $search = strtolower(trim(is_array($searchValue) ? ($searchValue['value'] ?? '') : ($searchValue ?? '')));
            $suppliers = Supplier::query();

            return DataTables::eloquent($suppliers)
                ->filter(function ($query) use ($search) {
                    if ($search !== '') {
                        $query->where(function ($q) use ($search) {
                            $q->whereRaw('LOWER(code) LIKE ?', ["%{$search}%"])
                              ->orWhereRaw('LOWER(name) LIKE ?', ["%{$search}%"])
                              ->orWhereRaw('LOWER(address) LIKE ?', ["%{$search}%"])
                              ->orWhereRaw('LOWER(contact_person) LIKE ?', ["%{$search}%"])
                              ->orWhereRaw('LOWER(email) LIKE ?', ["%{$search}%"]);
                        });
                    }
                })
                ->addColumn('actions', function ($s) {
                    return '
                        <div class="dropdown table-action">
                            <a href="#" class="action-icon" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a  
                                    class="dropdown-item" 
                                    href="'.route('suppliers.read', ['supplier_id' => $s->id]).'">
                                    <i class="ti ti-eye text-info"></i> View Detail
                                </a>
                                <a  
                                    class="dropdown-item c_supplier_edit_btn" 
                                    href="#" 
                                    data-url="'.route('suppliers.read', ['supplier_id' => $s->id]).'">
                                    <i class="ti ti-edit text-blue"></i> Edit
                                </a>
                                <a  
                                    class="dropdown-item c_supplier_delete_btn" 
                                    href="javascript:void(0);" 
                                    data-url="'.route('suppliers.delete', ['supplier_id' => $s->id]).'">
                                    <i class="ti ti-trash text-danger"></i> Delete
                                </a>
                            </div>
                        </div>
                    ';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('suppliers');
    }

    public function create(SupplierRequest $request): JsonResponse
    {
        try {
            $supplier = $this->supplierService->createSupplier($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Supplier created successfully',
                'data' => $supplier
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create Supplier'
            ], 500);
        }
    }

    public function readAll(Request $request): JsonResponse
    {
        if($request->wantsJson() || $request->ajax()) {
            try {
                $suppliers = $this->supplierService->getAllSuppliers();
                return response()->json([
                    'success' => true,
                    'data' => $suppliers
                ], 201);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage() ?: 'Failed to fetch Suppliers'
                ], 500);
            }
        }
        abort(404);    
    }

    public function read(Request $request, $supplier_id)
    {
        if ($request->wantsJson() || $request->ajax()) {
            try {
                $supplier = $this->supplierService->getSupplierById($supplier_id);
                return response()->json([
                    'success' => true,
                    'data' => $supplier
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to load Supplier'
                ], 500);
            }
        }

        $supplier = $this->supplierService->getSupplierById($supplier_id);
        return view('suppliers.detail', compact('supplier'));
    }

    public function update(SupplierRequest $request, $supplier_id): JsonResponse
    {
        try {
            $supplier = $this->supplierService->updateSupplier($supplier_id, $request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Supplier updated successfully',
                'data' => $supplier
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update Supplier'
            ], 500);
        }
    }

    public function delete($supplier_id): JsonResponse
    {
        try {
            $this->supplierService->deleteSupplier($supplier_id);
            return response()->json([
                'success' => true,
                'message' => 'Supplier deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete Supplier'
            ], 500);
        }
    }
}
