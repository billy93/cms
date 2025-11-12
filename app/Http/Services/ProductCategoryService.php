<?php

namespace App\Http\Services;

use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;
use Exception;

class ProductCategoryService
{
    public function createCategory(array $data)
    {
        return DB::transaction(function () use ($data) {
            $category = ProductCategory::create($data);
            return $category->fresh();
        });
    }

    public function getAllCategories()
    {
        return ProductCategory::with('products')->get();
    }

    public function getCategoryById($id)
    {
        $category = ProductCategory::with('products')->find($id);
        if (!$category) {
            throw new Exception("Category with ID {$id} not found");
        }
        return $category;
    }

    public function updateCategory($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $category = ProductCategory::find($id);
            if (!$category) {
                throw new Exception("Category with ID {$id} not found");
            }

            $category->update($data);
            return $category->fresh();
        });
    }

    public function deleteCategory($id)
    {
        $category = ProductCategory::find($id);
        if (!$category) {
            throw new Exception("Category with ID {$id} not found");
        }
        $category->delete();
    }
}
