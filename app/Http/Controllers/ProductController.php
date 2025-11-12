<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\ProductRequest;
use App\Http\Services\ProductService;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display product listing (for DataTables).
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $searchValue = $request->search;
            $search = strtolower(trim(is_array($searchValue) ? ($searchValue['value'] ?? '') : ($searchValue ?? '')));
            $products = Product::with(['supplier', 'categories']);

            return DataTables::eloquent($products)
                ->filter(function ($query) use ($search) {
                    if ($search !== '') {
                        $query->where(function ($q) use ($search) {
                            $q->whereRaw('LOWER(products.name) LIKE ?', ["%{$search}%"])
                              ->orWhereRaw('LOWER(products.description) LIKE ?', ["%{$search}%"])
                              ->orWhereHas('supplier', fn($p) =>
                                  $p->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"])
                              )
                              ->orWhereHas('categories', fn($p) =>
                                  $p->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"])
                              );
                        });
                    }
                })
                ->addColumn('supplier_name', fn($p) => $p->supplier->name ?? '-')
                ->addColumn('categories', function ($p) {
                    if ($p->categories->isEmpty()) {
                        return '-';
                    }

                    return $p->categories->map(function ($cat) {
                        return '<span class="badge bg-primary me-1">' . e($cat->name) . '</span>';
                    })->implode(' ');
                })
                ->addColumn('actions', function ($p) {
                    return '
                        <div class="dropdown table-action">
                            <a href="#" class="action-icon" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a  
                                    class="dropdown-item" 
                                    href="'.route('products.read', ['product_id' => $p->id]).'"
                                >
                                    <i class="ti ti-eye text-info"></i> View Detail
                                </a>
                                <a  
                                    class="dropdown-item c_product_edit_btn" 
                                    href="#" 
                                    data-url="'.route('products.read', ['product_id' => $p->id]).'"
                                >
                                    <i class="ti ti-edit text-blue"></i> Edit
                                </a>
                                <a  
                                    class="dropdown-item c_product_delete_btn" 
                                    href="javascript:void(0);" 
                                    data-url="'.route('products.delete', ['product_id' => $p->id]).'"
                                >
                                    <i class="ti ti-trash text-danger"></i> Delete
                                </a>
                            </div>
                        </div>
                    ';
                })
                ->rawColumns(['categories', 'actions'])
                ->make(true);
        }

        return view('products');
    }

    /**
     * Create a new Product.
     */
    public function create(ProductRequest $request): JsonResponse
    {
        try {
            $product = $this->productService->createProduct($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Product created successfully',
                'data' => $product
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create Product'
            ], 500);
        }
    }

    /**
     * Read all products (JSON).
     */
    public function readAll(): JsonResponse
    {
        try {
            $products = $this->productService->getAllProducts();
            return response()->json([
                'success' => true,
                'data' => $products
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Failed to fetch Products'
            ], 500);
        }
    }

    /**
     * Read a single product by ID.
     */
    public function read(Request $request, $product_id)
    {
        if ($request->wantsJson() || $request->ajax()) {
            try {
                $product = $this->productService->getProductById($product_id);
                return response()->json([
                    'success' => true,
                    'data' => $product
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to load Product'
                ], 500);
            }
        }

        $product = $this->productService->getProductById($product_id);
        return view('products.detail', compact('product'));
    }

    /**
     * Update product.
     */
    public function update(ProductRequest $request, $product_id): JsonResponse
    {
        try {
            $product = $this->productService->updateProduct($product_id, $request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Product updated successfully',
                'data' => $product
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error updating Product: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update Product'
            ], 500);
        }
    }

    /**
     * Delete product.
     */
    public function delete($product_id): JsonResponse
    {
        try {
            $this->productService->deleteProduct($product_id);
            return response()->json([
                'success' => true,
                'message' => 'Product deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error deleting Product: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete Product'
            ], 500);
        }
    }
}
