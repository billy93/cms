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
            // Generic Items
            [
                'name' => 'Samsung Galaxy S24',
                'description' => 'Latest flagship smartphone',
                'unit' => 'Pcs',
                'price' => '22.000.000,00',
                'supplier_id' => 1,
                'category_ids' => [1, 2],
            ],
            [
                'name' => 'MacBook Pro 14"',
                'description' => 'Professional laptop M3',
                'unit' => 'Pcs',
                'price' => '18.000.000,00',
                'supplier_id' => 1,
                'category_ids' => [1, 2],
            ],
            
            // Event Related Products (for Regular Project)
            [
                'name' => 'Grand Ballroom Rental',
                'description' => 'Full day usage of Grand Ballroom',
                'unit' => 'Day',
                'price' => '75.000.000,00',
                'supplier_id' => 1,
                'category_ids' => [3],
            ],
            [
                'name' => 'Meeting Room Package',
                'description' => 'Half day meeting room usage',
                'unit' => 'Day',
                'price' => '5.000.000,00',
                'supplier_id' => 1,
                'category_ids' => [3],
            ],
            [
                'name' => 'Buffet Catering Package',
                'description' => 'Standard International Buffet',
                'unit' => 'Pax',
                'price' => '350.000,00',
                'supplier_id' => 1,
                'category_ids' => [3],
            ],
            [
                'name' => 'Live Band Performance',
                'description' => 'Acoustic Band 4 Personnel',
                'unit' => 'Show',
                'price' => '15.000.000,00',
                'supplier_id' => 1,
                'category_ids' => [3],
            ],
            [
                'name' => 'Event Photography',
                'description' => 'Professional Photographer 8 Hours',
                'unit' => 'Day',
                'price' => '5.000.000,00',
                'supplier_id' => 1,
                'category_ids' => [3],
            ],

            // Travel Related Products (for FIT Project)
            [
                'name' => 'Flight Ticket DOM',
                'description' => 'Domestic Flight Economy Class',
                'unit' => 'Pax',
                'price' => '1.500.000,00',
                'supplier_id' => 1,
                'category_ids' => [3],
            ],
            [
                'name' => 'Hotel Voucher 5 Star',
                'description' => '5 Star Hotel Room Voucher',
                'unit' => 'Night',
                'price' => '2.500.000,00',
                'supplier_id' => 1,
                'category_ids' => [3],
            ],
            [
                'name' => 'Car Rental Luxury',
                'description' => 'Alphard / Vellfire Rental with Driver',
                'unit' => 'Day',
                'price' => '2.500.000,00',
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
