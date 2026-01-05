<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Http\Services\ProductService;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $productService = new ProductService();
        
        $products = [
            [
                'name' => 'Samsung Galaxy S24',
                'description' => 'Latest flagship smartphone with advanced camera and AI features',
                'unit' => 'Pcs',
                'price' => '22.000.000,00',
                'supplier_id' => 1,
                'category_ids' => [1, 2],
            ],
            [
                'name' => 'MacBook Pro 14"',
                'description' => 'Professional laptop with M3 chip for creative professionals',
                'unit' => 'Pcs',
                'price' => '18.000.000,75',
                'supplier_id' => 1,
                'category_ids' => [1, 2],
            ],
            [
                'name' => 'Nike Air Max 270',
                'description' => 'Comfortable running shoes with air cushioning technology',
                'unit' => 'Pairs',
                'price' => '2.000.000,00',
                'supplier_id' => 1,
                'category_ids' => [2, 3],
            ],
            [
                'name' => 'Steel Rebar 12mm',
                'description' => 'Construction grade steel reinforcement bar',
                'unit' => 'Kg',
                'price' => '50.000,00',
                'supplier_id' => 1,
                'category_ids' => [1],
            ],
            [
                'name' => 'Cement Portland',
                'description' => 'High quality portland cement for construction',
                'unit' => 'Bag',
                'price' => '125.000,00',
                'supplier_id' => 1,
                'category_ids' => [1],
            ],
            [
                'name' => 'Project Management Service',
                'description' => 'Complete project management and oversight service',
                'unit' => 'Month',
                'price' => '75.000.000,00',
                'supplier_id' => 1,
                'category_ids' => [3],
            ],
        ];

        foreach ($products as $item) {
            // Use ProductService to auto-create price version 1
            $productService->createProduct($item);
        }
    }
}
