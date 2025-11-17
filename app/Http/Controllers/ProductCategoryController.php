<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\ProductCategoryRequest;
use App\Http\Services\ProductCategoryService;

class ProductCategoryController extends Controller
{
    protected $categoryService;

    public function __construct(ProductCategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $searchValue = $request->search;
            $search = strtolower(trim(is_array($searchValue) ? ($searchValue['value'] ?? '') : ($searchValue ?? '')));
            $categories = ProductCategory::query();

            return DataTables::eloquent($categories)
                ->filter(function ($query) use ($search) {
                    if ($search !== '') {
                        $query->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"])
                              ->orWhereRaw('LOWER(description) LIKE ?', ["%{$search}%"]);
                    }
                })
                ->addColumn('actions', function ($c) {
                    return '
                        <div class="dropdown table-action">
                            <a href="#" class="action-icon" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a  
                                    class="dropdown-item" 
                                    href="'.route('categories.read', ['category_id' => $c->id]).'">
                                    <i class="ti ti-eye text-info"></i> View
                                </a>
                                <a  
                                    class="dropdown-item c_category_edit_btn" 
                                    href="#" 
                                    data-url="'.route('categories.read', ['category_id' => $c->id]).'">
                                    <i class="ti ti-edit text-blue"></i> Edit
                                </a>
                                <a  
                                    class="dropdown-item c_category_delete_btn" 
                                    href="javascript:void(0);" 
                                    data-url="'.route('categories.delete', ['category_id' => $c->id]).'">
                                    <i class="ti ti-trash text-danger"></i> Delete
                                </a>
                            </div>
                        </div>
                    ';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('categories');
    }

    public function create(ProductCategoryRequest $request): JsonResponse
    {
        try {
            $category = $this->categoryService->createCategory($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Category created successfully',
                'data' => $category
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Failed to create category'
            ], 500);
        }
    }

    public function readAll(Request $request): JsonResponse
    {
        if ($request->wantsJson() || $request->ajax()) {
            try {
                $categories = $this->categoryService->getAllCategories();
                return response()->json([
                    'success' => true,
                    'data' => $categories
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage() ?: 'Failed to fetch categories'
                ], 500);
            }
        }
        abort(404);
    }

    public function read(Request $request, $category_id)
    {
        if ($request->wantsJson() || $request->ajax()) {
            try {
                return response()->json([
                    'success' => true,
                    'data' => $category
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage() ?: 'Failed to load category'
                ], 500);
            }
        }
        
        $category = $this->categoryService->getCategoryById($category_id);
        return view('categories.detail', compact('category'));
    }

    public function update(ProductCategoryRequest $request, $category_id): JsonResponse
    {
        try {
            $category = $this->categoryService->updateCategory($category_id, $request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Category updated successfully',
                'data' => $category
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Failed to update category'
            ], 500);
        }
    }

    public function delete($category_id): JsonResponse
    {
        try {
            $this->categoryService->deleteCategory($category_id);
            return response()->json([
                'success' => true,
                'message' => 'Category deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Failed to delete category'
            ], 500);
        }
    }
}
