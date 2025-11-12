<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductCategory;
use Carbon\Carbon;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Electronics',
                'description' => 'Devices and gadgets including phones, computers, and accessories.',
            ],
            [
                'name' => 'Clothing & Apparel',
                'description' => 'Fashion items such as shirts, pants, shoes, and accessories.',
            ],
            [
                'name' => 'Home & Garden',
                'description' => 'Furniture, décor, tools, and other household essentials.',
            ],
            [
                'name' => 'Sports & Outdoors',
                'description' => 'Equipment and gear for sports, fitness, and outdoor activities.',
            ],
            [
                'name' => 'Books & Media',
                'description' => 'Printed and digital books, magazines, and entertainment media.',
            ],
            [
                'name' => 'Health & Beauty',
                'description' => 'Cosmetics, personal care, and wellness-related products.',
            ],
            [
                'name' => 'Automotive',
                'description' => 'Car parts, accessories, and maintenance tools.',
            ],
            [
                'name' => 'Food & Beverages',
                'description' => 'Groceries, snacks, and drinks including specialty foods.',
            ],
            [
                'name' => 'Toys & Games',
                'description' => 'Products for kids and adults including puzzles, toys, and board games.',
            ],
            [
                'name' => 'Office Supplies',
                'description' => 'Stationery, paper, and general office equipment.',
            ],
        ];

        foreach ($categories as $category) {
            ProductCategory::create(array_merge($category, [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]));
        }
    }
}
