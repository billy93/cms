<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Samsung Galaxy S24',
                'description' => 'Latest flagship smartphone with advanced camera and AI features',
                'unit' => 'Pcs',
                'base_cost' => 22_000_000,
                'supplier_id' => 1,
                'category_ids' => [1, 2], // bisa masuk ke beberapa kategori
            ],
            [
                'name' => 'MacBook Pro 14"',
                'description' => 'Professional laptop with M3 chip for creative professionals',
                'unit' => 'Pcs',
                'base_cost' => 18_000_000.75,
                'supplier_id' => 1,
                'category_ids' => [1, 2],
            ],
            [
                'name' => 'Nike Air Max 270',
                'description' => 'Comfortable running shoes with air cushioning technology',
                'unit' => 'pairs',
                'base_cost' => 2_000_000,
                'supplier_id' => 1,
                'category_ids' => [2, 3],
            ],
            [
                'name' => 'Steel Rebar 12mm',
                'description' => 'Construction grade steel reinforcement bar',
                'unit' => 'kg',
                'base_cost' => 50_000,
                'supplier_id' => 1,
                'category_ids' => [1],
            ],
            [
                'name' => 'Cement Portland',
                'description' => 'High quality portland cement for construction',
                'unit' => 'bag',
                'base_cost' => 125_000,
                'supplier_id' => 1,
                'category_ids' => [1],
            ],
            [
                'name' => 'Project Management Service',
                'description' => 'Complete project management and oversight service',
                'unit' => 'month',
                'base_cost' => 75_000_000,
                'supplier_id' => 1,
                'category_ids' => [3],
            ],
        ];

        foreach ($products as $item) {
            $product = Product::create([
                'code' => Product::generateCode(),
                'name' => $item['name'],
                'description' => $item['description'],
                'unit' => $item['unit'],
                'base_cost' => $item['base_cost'],
                'supplier_id' => $item['supplier_id'],
            ]);

            // attach categories ke pivot table
            $product->categories()->attach($item['category_ids']);
        }
    }
}
