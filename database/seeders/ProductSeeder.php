<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                'category_id' => 2,
                'supplier_id' => 1, // Assuming supplier with ID 1 exists
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'MacBook Pro 14"',
                'description' => 'Professional laptop with M3 chip for creative professionals',
                'unit' => 'Pcs',
                'base_cost' => 18_000_000.75,
                'category_id' => 2,
                'supplier_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Sony WH-1000XM5 Headphones',
                'description' => 'Premium noise-canceling wireless headphones',
                'unit' => 'Pcs',
                'base_cost' => 10_000_000,
                'category_id' => 2,
                'supplier_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Nike Air Max 270',
                'description' => 'Comfortable running shoes with air cushioning technology',
                'unit' => 'pairs',
                'base_cost' => 2_000_000,
                'category_id' => 2,
                'supplier_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Levi\'s 501 Original Jeans',
                'description' => 'Classic straight-fit jeans made from premium denim',
                'unit' => 'Pcs',
                'base_cost' => 750_000,
                'category_id' => 2,
                'supplier_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Dyson V15 Detect Vacuum',
                'description' => 'Cordless vacuum cleaner with laser dust detection',
                'unit' => 'Pcs',
                'base_cost' => 1_200_000 ,
                'category_id' => 2,
                'supplier_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Philips Hue Smart Bulb Set',
                'description' => 'Color-changing LED smart bulbs with app control',
                'unit' => 'set',
                'base_cost' => 500_000,
                'category_id' => 2,
                'supplier_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Yeti Rambler 30oz Tumbler',
                'description' => 'Insulated stainless steel tumbler for hot and cold drinks',
                'unit' => 'Pcs',
                'base_cost' => 97_500.65,
                'category_id' => 2,
                'supplier_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Coleman 4-Person Tent',
                'description' => 'Waterproof camping tent with easy setup',
                'unit' => 'Pcs',
                'base_cost' => 3_000_000,
                'category_id' => 2,
                'supplier_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Steel Rebar 12mm',
                'description' => 'Construction grade steel reinforcement bar',
                'unit' => 'kg',
                'base_cost' => 50_000,
                'category_id' => 1,
                'supplier_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Cement Portland',
                'description' => 'High quality portland cement for construction',
                'unit' => 'bag',
                'base_cost' => 125_000,
                'category_id' => 1,
                'supplier_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Construction Consultation',
                'description' => 'Professional construction planning and consultation service',
                'unit' => 'hour',
                'base_cost' => 425_000,
                'category_id' => 2,
                'supplier_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Project Management Service',
                'description' => 'Complete project management and oversight service',
                'unit' => 'month',
                'base_cost' => 75_000_000,
                'category_id' => 3,
                'supplier_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}