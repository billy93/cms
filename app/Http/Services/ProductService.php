<?php

namespace App\Http\Services;

use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\ProductPriceVersion;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;
use Exception;

class ProductService
{
    public function createProduct(array $data): Product
    {
        return DB::transaction(function () use ($data) {
            // Supplier check
            if (!Supplier::whereKey($data['supplier_id'])->exists()) {
                throw new Exception('Supplier not found');
            }

            // Category validation
            $categoryIds = $data['category_ids'] ?? [];
            $validIds = ProductCategory::whereIn('id', $categoryIds)->pluck('id')->toArray();

            if (count($categoryIds) !== count($validIds)) {
                throw new Exception('Invalid categories');
            }

            // Normalize price
            $price = $this->normalizePrice($data['price']);

            // Generate product
            $data['code'] = Product::generateCode();

            $product = Product::create(
                collect($data)->except(['price', 'category_ids'])->toArray()
            );

            // Bind categories
            $product->categories()->sync($validIds);

            // Create version 1
            $product->priceVersions()->create([
                'version' => 1,
                'price' => $price,
                'is_active' => true,
                'effective_from' => now(),
            ]);

            return $product->fresh(['supplier', 'categories', 'activePriceVersion']);
        });
    }


    public function getAllProducts()
    {
        return Product::with('activePriceVersion')->get();
    }

    public function getProductById(int $id): Product
    {
        $product = Product::with([
            'supplier',
            'categories',
            'activePriceVersion',
            'priceVersions',
        ])->find($id);

        if (!$product) {
            throw new Exception("Product {$id} not found");
        }

        return $product;
    }
    
    public function updateProduct(int $id, array $data): Product
    {
        return DB::transaction(function () use ($id, $data) {
            $product = Product::with('activePriceVersion')->find($id);

            if (!$product) {
                throw new Exception("Product {$id} not found");
            }

            // Supplier check
            if (isset($data['supplier_id']) &&
                !Supplier::whereKey($data['supplier_id'])->exists()) {
                throw new Exception('Supplier not found');
            }

            // Category sync
            if (isset($data['category_ids'])) {
                $ids = $data['category_ids'];
                $valid = ProductCategory::whereIn('id', $ids)->pluck('id')->toArray();

                if (count($ids) !== count($valid)) {
                    throw new Exception('Invalid categories');
                }

                $product->categories()->sync($valid);
            }

            // Price versioning
            if (array_key_exists('price', $data)) {
                $newPrice = $this->normalizePrice($data['price']);
                $current = $product->activePriceVersion;

                if ($current) {
                    $changed = bccomp(
                        (string) $newPrice,
                        (string) $current->price,
                        2
                    ) !== 0;

                    if ($changed) {
                        // Close current version
                        $current->update([
                            'is_active' => false,
                            'effective_until' => now(),
                        ]);

                        // New version
                        $product->priceVersions()->create([
                            'version' => $current->version + 1,
                            'price' => $newPrice,
                            'is_active' => true,
                            'effective_from' => now(),
                        ]);
                    }
                }
            }

            // Update product meta
            $product->update(
                collect($data)->except(['price', 'category_ids'])->toArray()
            );

            return $product->fresh(['supplier', 'categories', 'activePriceVersion']);
        });
    }


    public function deleteProduct(int $id): void
    {
        $product = Product::find($id);

        if (!$product) {
            throw new Exception("Product {$id} not found");
        }

        $product->delete();
    }

    private function normalizePrice(string|int|float|null $value): float
    {
        if ($value === null) {
            return 0.0;
        }

        if (is_int($value) || is_float($value)) {
            return (float) $value;
        }

        // 22.000.000,75 → 22000000.75
        $normalized = str_replace('.', '', $value);
        $normalized = str_replace(',', '.', $normalized);

        return (float) $normalized;
    }
}
