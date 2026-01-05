<?php

namespace App\Http\Services;

use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\ProductVersion;
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
            
            // Extract version-specific fields
            $versionData = [
                'base_cost' => $data['base_cost'] ?? 0,
                'description' => $data['description'] ?? null,
                'unit' => $data['unit'] ?? 'Pcs',
            ];
            
            // Generate code
            $data['code'] = Product::generateCode();
            
            // Create product (without versioned fields)
            $product = Product::create(collect($data)->except(['base_cost', 'description', 'unit'])->toArray());

            // bind categories
            $product->categories()->sync($validCategoryIds);
            
            // ⭐ Auto-create version 1
            $product->versions()->create([
                'version' => 1,
                'base_cost' => $versionData['base_cost'],
                'description' => $versionData['description'],
                'unit' => $versionData['unit'],
                'is_active' => true,
                'effective_from' => now(),
            ]);

            return $product->fresh(['supplier', 'categories', 'activeVersion']);
        });
    }

    public function getAllProducts()
    {
        return Product::with('activeVersion')->get();
    }

    public function getProductById($id)
    {
        $product = Product::with(['supplier', 'categories', 'activeVersion', 'versions'])->find($id);

        if (!$product) {
            throw new Exception("Product with ID {$id} not found");
        }
        return $product;
    }

    public function updateProduct($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $product = Product::with('activeVersion')->find($id);
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

            // ⭐ Check if base_cost changed → auto-create new version
            $newBaseCost = $data['base_cost'] ?? null;
            $currentVersion = $product->activeVersion;
            
            if ($newBaseCost !== null && $currentVersion) {
                // Clean and compare prices
                $currentCost = (float) str_replace(['.', ','], ['', '.'], $currentVersion->getRawOriginal('base_cost'));
                $newCost = (float) str_replace(['.', ','], ['', '.'], $newBaseCost);
                
                $priceChanged = $newCost !== $currentCost;
                
                if ($priceChanged) {
                    // Deactivate current version
                    $currentVersion->update([
                        'is_active' => false,
                        'effective_until' => now(),
                    ]);
                    
                    // Create new version
                    $newVersion = $currentVersion->version + 1;
                    $product->versions()->create([
                        'version' => $newVersion,
                        'base_cost' => $newCost,
                        'description' => $data['description'] ?? $currentVersion->description,
                        'unit' => $data['unit'] ?? $currentVersion->unit,
                        'is_active' => true,
                        'effective_from' => now(),
                    ]);
                } else {
                    // Update current version if description/unit changed
                    $currentVersion->update([
                        'description' => $data['description'] ?? $currentVersion->description,
                        'unit' => $data['unit'] ?? $currentVersion->unit,
                    ]);
                }
            }

            // Update product metadata (name, supplier, etc.)
            $productData = collect($data)->except(['base_cost', 'description', 'unit', 'category_ids'])->toArray();
            if (!empty($productData)) {
                $product->update($productData);
            }

            return $product->fresh(['supplier', 'categories', 'activeVersion']);
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
