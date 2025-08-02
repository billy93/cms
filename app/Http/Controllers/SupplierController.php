<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    /**
     * Display a listing of suppliers
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $query = Supplier::query();

            // Search functionality
            if ($request->filled('search')) {
                $query->search($request->search);
            }

            // Status filter
            if ($request->filled('status') && $request->status !== 'all') {
                $query->where('status', $request->status);
            }

            // Pagination
            $perPage = $request->get('per_page', 15);
            $suppliers = $query->orderBy('created_at', 'desc')->paginate($perPage);

            \Log::info('Suppliers found: ' . $suppliers->total());

            return response()->json([
                'success' => true,
                'data' => $suppliers->items(),
                'pagination' => [
                    'current_page' => $suppliers->currentPage(),
                    'last_page' => $suppliers->lastPage(),
                    'per_page' => $suppliers->perPage(),
                    'total' => $suppliers->total(),
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Error in SupplierController@index: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving suppliers: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created supplier
     */
    public function store(Request $request): JsonResponse
    {
        try {
            \Log::info('Supplier store request received', $request->all());
            
            $validator = Validator::make($request->all(), [
                'supplier_code' => 'required|string|max:20|unique:suppliers,supplier_code',
                'supplier_name' => 'required|string|max:255',
                'address' => 'required|string',
                'contact_person' => 'nullable|string|max:255',
                'phone' => 'nullable|string|max:20',
                'email' => 'nullable|email|max:255',
                'tax_number' => 'nullable|string|max:50',
                'bank_name' => 'nullable|string|max:100',
                'bank_account_number' => 'nullable|string|max:50',
                'bank_account_name' => 'nullable|string|max:255',
                'status' => 'nullable|in:active,inactive',
                'notes' => 'nullable|string'
            ]);

            if ($validator->fails()) {
                \Log::error('Validation failed', $validator->errors()->toArray());
                return response()->json([
                    'success' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
            }

            \Log::info('Validation passed, starting transaction');

            DB::beginTransaction();

            $supplier = Supplier::create([
                'supplier_code' => $request->supplier_code,
                'supplier_name' => $request->supplier_name,
                'address' => $request->address,
                'contact_person' => $request->contact_person,
                'phone' => $request->phone,
                'email' => $request->email,
                'tax_number' => $request->tax_number,
                'bank_name' => $request->bank_name,
                'bank_account_number' => $request->bank_account_number,
                'bank_account_name' => $request->bank_account_name,
                'status' => $request->status ?? 'active',
                'notes' => $request->notes
            ]);

            \Log::info('Supplier created successfully', $supplier->toArray());

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Supplier created successfully',
                'data' => $supplier
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error creating supplier: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Error creating supplier: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified supplier
     */
    public function show($id): JsonResponse
    {
        try {
            $supplier = Supplier::findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $supplier
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Supplier not found'
            ], 404);
        }
    }

    /**
     * Update the specified supplier
     */
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $supplier = Supplier::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'supplier_code' => 'required|string|max:20|unique:suppliers,supplier_code,' . $id,
                'supplier_name' => 'required|string|max:255',
                'address' => 'required|string',
                'contact_person' => 'nullable|string|max:255',
                'phone' => 'nullable|string|max:20',
                'email' => 'nullable|email|max:255',
                'tax_number' => 'nullable|string|max:50',
                'bank_name' => 'nullable|string|max:100',
                'bank_account_number' => 'nullable|string|max:50',
                'bank_account_name' => 'nullable|string|max:255',
                'status' => 'nullable|in:active,inactive',
                'notes' => 'nullable|string'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
            }

            DB::beginTransaction();

            $supplier->update([
                'supplier_code' => $request->supplier_code,
                'supplier_name' => $request->supplier_name,
                'address' => $request->address,
                'contact_person' => $request->contact_person,
                'phone' => $request->phone,
                'email' => $request->email,
                'tax_number' => $request->tax_number,
                'bank_name' => $request->bank_name,
                'bank_account_number' => $request->bank_account_number,
                'bank_account_name' => $request->bank_account_name,
                'status' => $request->status ?? 'active',
                'notes' => $request->notes
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Supplier updated successfully',
                'data' => $supplier
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error updating supplier: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified supplier
     */
    public function destroy($id): JsonResponse
    {
        try {
            $supplier = Supplier::findOrFail($id);
            $supplier->delete();

            return response()->json([
                'success' => true,
                'message' => 'Supplier deleted successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting supplier: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get active suppliers for dropdown
     */
    public function getActiveSuppliers(): JsonResponse
    {
        try {
            $suppliers = Supplier::active()
                ->orderBy('supplier_name', 'asc')
                ->get(['id', 'supplier_code', 'supplier_name']);

            return response()->json([
                'success' => true,
                'data' => $suppliers
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving active suppliers: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Bulk update supplier status
     */
    public function bulkUpdateStatus(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'supplier_ids' => 'required|array',
                'supplier_ids.*' => 'integer|exists:suppliers,id',
                'status' => 'required|in:active,inactive'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
            }

            DB::beginTransaction();

            Supplier::whereIn('id', $request->supplier_ids)
                ->update(['status' => $request->status]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Supplier status updated successfully'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error updating supplier status: ' . $e->getMessage()
            ], 500);
        }
    }
}
