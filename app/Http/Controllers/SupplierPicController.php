<?php

namespace App\Http\Controllers;

use App\Models\SupplierPic;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class SupplierPicController extends Controller
{
    /**
     * Display a listing of PICs for a supplier
     */
    public function index(Request $request, $supplierId): JsonResponse
    {
        try {
            $supplier = Supplier::findOrFail($supplierId);
            $pics = $supplier->pics()->orderBy('created_at', 'desc')->get();

            return response()->json([
                'success' => true,
                'data' => $pics
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving PICs: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created PIC
     */
    public function store(Request $request, $supplierId): JsonResponse
    {
        try {
            $supplier = Supplier::findOrFail($supplierId);

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'nullable|email|max:255',
                'phone' => 'nullable|string|max:20',
                'position' => 'nullable|string|max:255',
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

            $pic = SupplierPic::create([
                'supplier_id' => $supplierId,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'position' => $request->position,
                'status' => $request->status ?? 'active',
                'notes' => $request->notes
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'PIC added successfully',
                'data' => $pic
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error adding PIC: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified PIC
     */
    public function show($supplierId, $picId): JsonResponse
    {
        try {
            $pic = SupplierPic::where('supplier_id', $supplierId)
                ->where('id', $picId)
                ->firstOrFail();

            return response()->json([
                'success' => true,
                'data' => $pic
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'PIC not found'
            ], 404);
        }
    }

    /**
     * Update the specified PIC
     */
    public function update(Request $request, $supplierId, $picId): JsonResponse
    {
        try {
            $pic = SupplierPic::where('supplier_id', $supplierId)
                ->where('id', $picId)
                ->firstOrFail();

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'nullable|email|max:255',
                'phone' => 'nullable|string|max:20',
                'position' => 'nullable|string|max:255',
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

            $pic->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'position' => $request->position,
                'status' => $request->status ?? 'active',
                'notes' => $request->notes
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'PIC updated successfully',
                'data' => $pic
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error updating PIC: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified PIC
     */
    public function destroy($supplierId, $picId): JsonResponse
    {
        try {
            $pic = SupplierPic::where('supplier_id', $supplierId)
                ->where('id', $picId)
                ->firstOrFail();

            $pic->delete();

            return response()->json([
                'success' => true,
                'message' => 'PIC deleted successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting PIC: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get active PICs for a supplier
     */
    public function getActivePics($supplierId): JsonResponse
    {
        try {
            $supplier = Supplier::findOrFail($supplierId);
            $pics = $supplier->activePics()->orderBy('name', 'asc')->get();

            return response()->json([
                'success' => true,
                'data' => $pics
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving active PICs: ' . $e->getMessage()
            ], 500);
        }
    }
}
