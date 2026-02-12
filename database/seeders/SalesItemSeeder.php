<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Proposal;
use App\Models\Product;
use App\Models\SalesItem;
use Carbon\Carbon;

class SalesItemSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::with('activePriceVersion')->has('activePriceVersion')->get();

        if ($products->isEmpty()) {
            $this->command->info('No products with active price versions found, seeder skipped.');
            return;
        }

        // Map relevant products for easy access
        $productsData = [
            'ballroom' => $products->where('name', 'Grand Ballroom Rental')->first(),
            'meeting' => $products->where('name', 'Meeting Room Package')->first(),
            'buffet' => $products->where('name', 'Buffet Catering Package')->first(),
            'band' => $products->where('name', 'Live Band Performance')->first(),
            'photo' => $products->where('name', 'Event Photography')->first(),
            'flight' => $products->where('name', 'Flight Ticket DOM')->first(),
            'hotel' => $products->where('name', 'Hotel Voucher 5 Star')->first(),
            'car' => $products->where('name', 'Car Rental Luxury')->first(),
        ];

        // Seed SalesItems for Proposals (Regular Flow)
        $this->seedProposalItems($productsData);

        // Seed SalesItems for FIT Projects (Direct Transaction Flow)
        $this->seedFitProjectItems($productsData);
    }

    /**
     * Seed SalesItems for Regular Project's Proposal
     */
    protected function seedProposalItems($productsData): void
    {
        $proposal = Proposal::with('project')->first();

        if (!$proposal) {
            $this->command->info('No proposal found, skipping proposal items.');
            return;
        }

        // Items for Corporate Event (pricing model C with headers)
        // Linking some items to products, others kept as free text
        $items = [
            [
                'header' => 'Venue',
                'subheader' => 'Main Event',
                'description' => 'Grand Ballroom - Hotel Indonesia Kempinski',
                'selling_price' => 75000000,
                'title1_key' => 'Number of days',
                'title1_value' => 2,
                'product' => $productsData['ballroom'], // Linked
            ],
            [
                'header' => 'Venue',
                'subheader' => 'Main Event',
                'description' => 'Meeting Room A & B (Breakout)',
                'selling_price' => 5000000,
                'title1_key' => 'Number of days',
                'title1_value' => 2,
                'product' => $productsData['meeting'], // Linked
            ],
            [
                'header' => 'F&B Restaurants',
                'subheader' => 'Catering',
                'description' => 'Lunch & Dinner Buffet (500 pax)',
                'selling_price' => 350000,
                'title1_key' => 'Person',
                'title1_value' => 500,
                'product' => $productsData['buffet'], // Linked
            ],
            [
                'header' => 'F&B Restaurants',
                'subheader' => 'Catering',
                'description' => 'Coffee Break (2x per day)',
                'selling_price' => 75000,
                'title1_key' => 'Person',
                'title1_value' => 500,
                'product' => null, // Free text
            ],
            [
                'header' => 'Entertainment',
                'subheader' => 'Performance',
                'description' => 'Band Performance - 5 piece band',
                'selling_price' => 15000000,
                'title1_key' => 'Number of hours',
                'title1_value' => 3,
                'product' => $productsData['band'], // Linked
            ],
            [
                'header' => 'Entertainment',
                'subheader' => 'Performance',
                'description' => 'MC Professional',
                'selling_price' => 15000000,
                'title1_key' => 'Number of days',
                'title1_value' => 2,
                'product' => null, // Free text
            ],
            [
                'header' => 'Documentation',
                'subheader' => 'Photo & Video',
                'description' => 'Photography Team (3 persons)',
                'selling_price' => 5000000,
                'title1_key' => 'Number of days',
                'title1_value' => 2,
                'product' => $productsData['photo'], // Linked
            ],
            [
                'header' => 'Documentation',
                'subheader' => 'Photo & Video',
                'description' => 'Video Production & Editing',
                'selling_price' => 35000000,
                'title1_key' => 'Qty',
                'title1_value' => 1,
                'product' => null, // Free text
            ],
        ];

        $totalAmount = 0;
        $headerOrder = 0;
        $currentHeader = '';

        foreach ($items as $item) {
            if ($currentHeader !== $item['header']) {
                $currentHeader = $item['header'];
                $headerOrder++;
            }

            $totalPrice = $item['selling_price'] * $item['title1_value'];

            SalesItem::create([
                'proposal_id' => $proposal->id,
                'project_id' => $proposal->project_id,
                'product_id' => $item['product']?->id, // Link if exists
                'product_price_version_id' => $item['product']?->activePriceVersion?->id, // Link if exists
                'description' => $item['product'] ? $item['product']->description : $item['description'],
                'selling_price' => $item['selling_price'],
                'total_price' => $totalPrice,
                'title1_key' => $item['title1_key'],
                'title1_value' => $item['title1_value'],
                'header' => $item['header'],
                'subheader' => $item['subheader'],
                'header_order' => $headerOrder,
            ]);

            $totalAmount += $totalPrice;
        }

        $proposal->update(['total_amount_items' => $totalAmount]);

        $this->command->info("Created " . count($items) . " sales items for Regular proposal. Total: Rp " . number_format($totalAmount, 0, ',', '.'));
    }

    /**
     * Seed SalesItems for FIT Project (Direct Transaction - no Proposal)
     */
    protected function seedFitProjectItems($productsData): void
    {
        $fitProject = Project::where('type', 'FIT')->first();

        if (!$fitProject) {
            $this->command->info('No FIT project found, skipping FIT items.');
            return;
        }

        // Typical FIT items (small purchases, no tender needed)
        // Linked to products where applicable
        $items = [
            [
                'description' => 'Tiket Pesawat Jakarta - Surabaya (PP) x 3 orang',
                'selling_price' => 1500000,
                'title1_key' => 'Person',
                'title1_value' => 3,
                'product' => $productsData['flight'], // Linked
            ],
            [
                'description' => 'Hotel Sheraton Surabaya - 2 malam x 2 kamar',
                'selling_price' => 2500000,
                'title1_key' => 'Number of nights',
                'title1_value' => 4, 
                'product' => $productsData['hotel'], // Linked
            ],
            [
                'description' => 'Airport Transfer Surabaya (pickup + return)',
                'selling_price' => 500000,
                'title1_key' => 'Qty',
                'title1_value' => 2,
                'product' => null, // Free text
            ],
            [
                'description' => 'Car Rental with Driver - Full Day',
                'selling_price' => 2500000,
                'title1_key' => 'Number of days',
                'title1_value' => 3,
                'product' => $productsData['car'], // Linked
            ],
        ];

        $totalAmount = 0;

        foreach ($items as $item) {
            $totalPrice = $item['selling_price'] * $item['title1_value'];

            SalesItem::create([
                'project_id' => $fitProject->id,
                'proposal_id' => null, // FIT = no proposal
                'invoice_id' => null,
                'product_id' => $item['product']?->id, // Link if exists
                'product_price_version_id' => $item['product']?->activePriceVersion?->id, // Link if exists
                'description' => $item['product'] ? $item['product']->description : $item['description'],
                'selling_price' => $item['selling_price'],
                'total_price' => $totalPrice,
                'title1_key' => $item['title1_key'],
                'title1_value' => $item['title1_value'],
            ]);

            $totalAmount += $totalPrice;
        }

        // Update project value with total
        $fitProject->update(['value' => $totalAmount]);

        $this->command->info("Created " . count($items) . " sales items for FIT project. Total: Rp " . number_format($totalAmount, 0, ',', '.'));
    }
}
