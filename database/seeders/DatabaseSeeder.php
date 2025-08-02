<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Boq;
use App\Models\BoqItem;
use App\Models\BoqTitle;
use App\Models\BoqItemPrice;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $boq = Boq::create([
            'boq_type' => 'C',
            'customer_name' => 'PT Contoh Sukses',
            'sales_code' => null, // masih null
        ]);

        // Buat titles
        $titles = [];
        foreach (['Title 1', 'Title 2', 'Title 3'] as $index => $titleName) {
            $titles[] = BoqTitle::create([
                'boq_id' => $boq->id,
                'title_name' => $titleName,
                'position' => $index + 1,
            ]);
        }

        // Buat item
        $item = BoqItem::create([
            'boq_id' => $boq->id,
            'product_name' => 'Maintenance Service',
            'description' => 'Service maintenance tahunan',
            'pricing_model' => 'Manual Entry',
            'sales_amount' => 1000000,
        ]);

        // Buat item_prices
        foreach ($titles as $title) {
            BoqItemPrice::create([
                'boq_item_id' => $item->id,
                'boq_title_id' => $title->id,
                'amount' => 1000000,
            ]);
        }
    }
}
