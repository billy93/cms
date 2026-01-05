<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Proposal;
use App\Models\Boq;
use App\Models\BoqItem;
use App\Models\Product;

class BoqSeeder extends Seeder
{
    public function run(): void
    {
        // Get some products for seeding
        $products = Product::with(['categories', 'activePriceVersion'])->take(5)->get();
        if ($products->isEmpty()) {
            return;
        }

        // Create a BOQ
        $boq = Boq::create([
            'code' => BOQ::generateCode(),
            'proposal_id' => 1,
        ]);

        $totalItems = 0;

        foreach ($products as $product) {
            $qty = rand(1, 10);
            $freq = rand(1, 3);
            
            // Get raw unit price
            $unitPrice = $product->activePriceVersion->price ?? 0;
            $multiplier = $qty * $freq * $unitPrice;

            BoqItem::create([
                'boq_id' => $boq->id,
                'product_id' => $product->id,
                'description' => $product->description ?? $product->name,
                'selling_price' => $unitPrice,
                'qty' => $qty,
                'qty_unit' => $product->unit,
                'freq' => $freq,
                'freq_unit' => 'Event',
                'total_price' => $multiplier,
            ]);

            $totalItems += $multiplier;
        }

        $boq->update([
            'total_amount_items' => $totalItems,
        ]);
    }
}
