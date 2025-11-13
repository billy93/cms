<?php

namespace App\Http\Services;

use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;
use Exception;

class ProductService
{
    public function createProduct(array $data)
    {
        return DB::transaction(function () use ($data) {
            // cek supplier
            if (!isset($data['supplier_id']) || !Supplier::find($data['supplier_id'])) {
                throw new Exception("Supplier not found");
            }

            // cek category_ids
            $categoryIds = $data['category_ids'] ?? [];
            $validCategoryIds = ProductCategory::whereIn('id', $categoryIds)->pluck('id')->toArray();

            if (count($categoryIds) !== count($validCategoryIds)) {
                throw new Exception("One or more categories are invalid");
            }
            
            $data['code'] = Product::generateCode();
            \Log::info($data);
            $product = Product::create($data);

            // bind categories
            $product->categories()->sync($validCategoryIds);

            return $product->fresh(['supplier', 'categories']);
        });
    }

    public function getAllProducts()
    {
        return Product::all();
        // return Product::with(['supplier', 'categories'])->get();
    }

    public function getProductById($id)
    {
        $product = Product::with(['supplier', 'categories'])->find($id);

        if (!$product) {
            throw new Exception("Product with ID {$id} not found");
        }
        return $product;
    }

    public function updateProduct($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $product = Product::find($id);
            if (!$product) {
                throw new Exception("Product with ID {$id} not found");
            }

            // cek supplier
            if (isset($data['supplier_id']) && !Supplier::find($data['supplier_id'])) {
                throw new Exception("Supplier not found");
            }

            // cek category_ids
            if (isset($data['category_ids'])) {
                $categoryIds = $data['category_ids'];
                $validCategoryIds = ProductCategory::whereIn('id', $categoryIds)->pluck('id')->toArray();

                if (count($categoryIds) !== count($validCategoryIds)) {
                    throw new Exception("One or more categories are invalid");
                }

                // hapus semua relasi lama dan bind ulang
                $product->categories()->sync($validCategoryIds);
            }

            // update product
            $product->update($data);

            return $product->fresh(['supplier', 'categories']);
        });
    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        if (!$product) {
            throw new Exception("Product with ID {$id} not found");
        }
        $product->delete();
    }
}
