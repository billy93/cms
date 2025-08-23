<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of products
     */
    public function index(Request $request)
    {
        // If it's an API request, return JSON
        if ($request->expectsJson() || $request->is('api/*')) {
            return $this->apiIndex($request);
        }
        
        // Otherwise return the view
        return view('products');
    }
    
    /**
     * API method to get products
     */
    public function apiIndex(Request $request): JsonResponse
    {
        try {
            $query = Product::with('supplier');

            // Search functionality
            if ($request->filled('search')) {
                $query->where(function($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->search . '%')
                      ->orWhere('description', 'like', '%' . $request->search . '%')
                      ->orWhere('unit', 'like', '%' . $request->search . '%');
                });
            }

            // Filter by category
            if ($request->filled('category') && $request->category !== 'all') {
                $query->where('category', $request->category);
            }

            // Filter by supplier
            if ($request->filled('supplier_id') && $request->supplier_id !== 'all') {
                $query->where('supplier_id', $request->supplier_id);
            }

            // Pagination
            $perPage = $request->get('per_page', 15);
            $products = $query->orderBy('created_at', 'desc')->paginate($perPage);

            return response()->json([
                'success' => true,
                'data' => $products->items(),
                'pagination' => [
                    'current_page' => $products->currentPage(),
                    'last_page' => $products->lastPage(),
                    'per_page' => $products->perPage(),
                    'total' => $products->total(),
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving products: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created product
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'unit' => 'required|string|max:32',
                'base_cost' => 'required|numeric|min:0',
                'category' => 'required|in:RAW_MATERIAL,FINISHED_GOODS,SERVICE',
                'supplier_id' => 'required|exists:suppliers,id'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            DB::beginTransaction();

            $product = Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'unit' => $request->unit,
                'base_cost' => $request->base_cost,
                'category' => $request->category,
                'supplier_id' => $request->supplier_id
            ]);

            DB::commit();

            // Load supplier relationship
            $product->load('supplier');

            return response()->json([
                'success' => true,
                'message' => 'Product created successfully',
                'data' => $product
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error creating product: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified product
     */
    public function show($id): JsonResponse
    {
        try {
            $product = Product::with('supplier')->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $product
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }
    }

    /**
     * Update the specified product
     */
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $product = Product::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'unit' => 'required|string|max:32',
                'base_cost' => 'required|numeric|min:0',
                'category' => 'required|in:RAW_MATERIAL,FINISHED_GOODS,SERVICE',
                'supplier_id' => 'required|exists:suppliers,id'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            DB::beginTransaction();

            $product->update([
                'name' => $request->name,
                'description' => $request->description,
                'unit' => $request->unit,
                'base_cost' => $request->base_cost,
                'category' => $request->category,
                'supplier_id' => $request->supplier_id
            ]);

            DB::commit();

            // Load supplier relationship
            $product->load('supplier');

            return response()->json([
                'success' => true,
                'message' => 'Product updated successfully',
                'data' => $product
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error updating product: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified product
     */
    public function destroy($id): JsonResponse
    {
        try {
            $product = Product::findOrFail($id);

            DB::beginTransaction();
            $product->delete();
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Product deleted successfully'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error deleting product: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get products by category
     */
    public function getByCategory($category): JsonResponse
    {
        try {
            $products = Product::with('supplier')
                ->where('category', $category)
                ->orderBy('name', 'asc')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $products
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving products: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get products by supplier
     */
    public function getBySupplier($supplierId): JsonResponse
    {
        try {
            $products = Product::with('supplier')
                ->where('supplier_id', $supplierId)
                ->orderBy('name', 'asc')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $products
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving products: ' . $e->getMessage()
            ], 500);
        }
    }
}
