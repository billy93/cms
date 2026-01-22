<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Proposal;
use App\Models\Product;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ProposalSeeder extends Seeder
{
    public function run(): void
    {
        $projects = Project::all();
        $products = Product::with('activePriceVersion')->has('activePriceVersion')->get();

        if ($projects->isEmpty()) {
            $this->command->info('No projects found, seeder skipped.');
            return;
        }

        $pricingModels = ['A', 'B', 'C'];
        $statuses = ['Draft', 'Submitted', 'Win', 'Lose', 'Cancelled'];

        foreach ($projects as $index => $project) {
            // Rotate Pricing Model and Status
            $pricingModel = $pricingModels[$index % count($pricingModels)];
            $status = $statuses[$index % count($statuses)];
            
            // For testing PDF, force at least one 'Win' for each type if possible, or just rotate.
            // Let's stick to simple rotation but ensure the first few have useful statuses.
            if ($index < 3) $status = 'Win'; // Ensure first A, B, C are Win for easy PDF testing

            $proposal = Proposal::create([
                'project_id' => $project->id,
                'code' => Proposal::generateCode(),
                'status' => $status,
                'pricing_model' => $pricingModel,
                'management_fee_type' => 'percent',
                'management_fee' => 10,
                'vat_rate' => rand(0, 1) ? 11 : 1,
                'pricing_model_description' => match ($pricingModel) {
                    'A' => 'Project Implementation & Consulting',
                    'B' => 'Package per Person',
                    'C' => 'Incentive Trip Package',
                    default => null,
                },
                'note' => $status === 'Lose' ? 'Seeded Proposal ' . ($index + 1) : null,
            ]);

            if ($status === 'Win') {
                $proposal->update([
                    'sales_code' => $proposal->generateSalesCode()
                ]);
            }

            // Create Items based on Pricing Model
            if ($products->isNotEmpty()) {
                $totalItemsAmount = 0;

                // Type A: No items needed for calculation (usually manual), but we can add dummy items that are ignored by PDF
                // or just skip adding items if Logic A relies solely on manual input? 
                // Wait, ProposalRequest says: total_amount_items required_if pricing_model A.
                // So we must set total_amount_items explicitly for A.
                
                if ($pricingModel === 'A') {
                    $totalItemsAmount = 50000000;
                    
                    // Create dummy item for Type A
                    $proposal->items()->create([
                        'proposal_id' => $proposal->id,
                        'description' => $proposal->pricing_model_description,
                        'selling_price' => $totalItemsAmount,
                        'total_price' => $totalItemsAmount,
                        'title1_key' => 'Qty',
                        'title1_value' => 1,
                    ]);
                } 
                elseif ($pricingModel === 'B') {
                    // Type B: Strict Adult, Child, Infant categories
                    $categories = ['Adult', 'Child', 'Infant'];
                    foreach ($categories as $index => $catName) {
                        // Pick a product to borrow pricing from, or arbitrary
                        $product = $products->get($index % $products->count());
                        $priceVersion = $product->activePriceVersion;
                        
                        $qty = rand(10, 50);
                        $sellingPrice = $priceVersion->price * 1.1;
                        $totalPrice = $qty * $sellingPrice;

                        $proposal->items()->create([
                            'product_id' => $product->id,
                            'product_price_version_id' => $priceVersion->id,
                            'description' => $catName, // Strict Description
                            'selling_price' => $sellingPrice,
                            'total_price' => $totalPrice,

                            'title1_key' => 'Qty', 
                            'title1_value' => $qty,

                            'header' => null,
                            'subheader' => null,
                        ]);
                        $totalItemsAmount += $totalPrice;
                    }
                }
                elseif ($pricingModel === 'C') {
                    // Type C: Random Items with Headers
                    $itemCount = rand(2, 4);
                    $randomProducts = $products->random(min($itemCount, $products->count()));
                    
                    $headers = [
                        'Accommodation', 'Activities, Outdoor', 'Airport Assistance', 'Air tickets', 'Documentation',
                        'Entrance ticket - Shows and Entertainment', 'Entrance ticket - Places of interest', 'Excursion',
                        'F&B Restaurants', 'Front of House', 'Goodie Bags', 'Gratitudes', 'Insurance', 'Land transportation',
                        'Lighting', 'Manpower', 'MC', 'Media Relation', 'Meeting and Conference Kits', 'Meeting Package',
                        'Merchandise', 'Multimedia', 'Paramedic and First Aids', 'Rail tickets', 'Sales and Promotion Materials',
                        'Security Service & Fire', 'Software', 'Sound System', 'Speaker', 'Stationery', 'Streaming', 'Survey',
                        'Talents', 'Team Building', 'Travel Documents', 'Traveling kits', 'Venue'
                    ];

                    $titles = [
                        'Qty', 'Number of nights', 'Number of rooms', 'Number of hours', 'Number of days',
                        'Number of items', 'Number of participants', 'Number of unit', 'Number of package', 'Pcs', 'Person'
                    ];

                    foreach ($randomProducts->values() as $pIndex => $product) {
                        $priceVersion = $product->activePriceVersion;
                        $qty = rand(1, 10);
                        $sellingPrice = $priceVersion->price * 1.2;
                        $totalPrice = $qty * $sellingPrice;

                        $header = $headers[$pIndex % count($headers)];
                        $headerOrder = array_search($header, $headers);
                        $subheader = 'Phase ' . (($pIndex % 2) + 1);
                        $titleKey = $titles[$pIndex % count($titles)];

                         $proposal->items()->create([
                            'product_id' => $product->id,
                            'product_price_version_id' => $priceVersion->id,
                            'description' => $product->name,
                            'selling_price' => $sellingPrice,
                            'total_price' => $totalPrice,
                            
                            'title1_key' => $titleKey,
                            'title1_value' => $qty,

                            'header' => $header,
                            'subheader' => $subheader,
                            'header_order' => $headerOrder,
                        ]);
                        $totalItemsAmount += $totalPrice;
                    }
                }

                $proposal->update(['total_amount_items' => $totalItemsAmount]);
            }
        }
    }
}

