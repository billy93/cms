<?php

namespace App\Http\Controllers;

use App\Models\CustomerPic;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CustomerPicController extends Controller
{
    /**
     * Display a listing of PICs for a customer
     */
    public function index(Request $request, $customerId): JsonResponse
    {
        try {
            $customer = Customer::findOrFail($customerId);
            $pics = $customer->pics()->orderBy('created_at', 'desc')->get();

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
    public function store(Request $request, $customerId): JsonResponse
    {
        try {
            $customer = Customer::findOrFail($customerId);

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

            $pic = CustomerPic::create([
                'customer_id' => $customerId,
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
    public function show($customerId, $picId): JsonResponse
    {
        try {
            $pic = CustomerPic::where('customer_id', $customerId)
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
    public function update(Request $request, $customerId, $picId): JsonResponse
    {
        try {
            $pic = CustomerPic::where('customer_id', $customerId)
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
    public function destroy($customerId, $picId): JsonResponse
    {
        try {
            $pic = CustomerPic::where('customer_id', $customerId)
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
     * Get active PICs for a customer
     */
    public function getActivePics($customerId): JsonResponse
    {
        try {
            $customer = Customer::findOrFail($customerId);
            $pics = $customer->activePics()->orderBy('name', 'asc')->get();

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
