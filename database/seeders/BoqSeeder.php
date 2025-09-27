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
        $proposals = Proposal::all();

        if ($proposals->isEmpty()) {
            $this->command->info('No proposals found, seeder skipped.');
            return;
        }

        $boq = Boq::create([
            'form_type' => 'type-a',
            'description' => 'Description for BOQ type-a',
            'management_fee_type' => 'percent',
            'management_fee' => 10, // 10%
            'vat_rate' => 1, // 1%
        ]);

        // Buat 1 BOQ item khusus type-a
        $unitPrice = 1000000;
        $titleValue = 1;

        $item = BoqItem::create([
            'boq_id' => $boq->id,
            'header' => $boq->description,
            'unit_price' => $unitPrice, 
            'title1_key' => 'event',
            'title1_value' => $titleValue,
            'multiplier_total' => $unitPrice * $titleValue,
        ]);

        // Hitung total_amount_items
        $totalItems = $boq->items->sum('multiplier_total');

        // Hitung management fee
        $managementFee = $boq->management_fee_type === 'percent'
            ? ($totalItems * ($boq->management_fee / 100))
            : $boq->management_fee;

        // Hitung sales amount
        $salesAmount = $totalItems + $managementFee;

        // Hitung VAT
        $vat = $boq->vat_rate ? $salesAmount * ($boq->vat_rate / 100) : 0;

        // Hitung invoice amount
        $invoiceAmount = $salesAmount + $vat;

        // Update BOQ
        $boq->update([
            'total_amount_items' => $totalItems,
            'sales_amount' => $salesAmount,
            'vat' => $vat,
            'invoice_amount' => $invoiceAmount,
        ]);

        // Buat BOQ type-b
        $boq2 = Boq::create([
            'form_type' => 'type-b',
            'description' => 'BOQ Type B - Paket berdasarkan jumlah orang',
            'management_fee_type' => 'percent',
            'management_fee' => 10, // persen
            'sales_amount' => 0,
            'vat_rate' => 11,
            'vat' => 0,
            'invoice_amount' => 0,
        ]);

        $subheaders = ['Adult', 'Children', 'Infant'];
        $totalItems2 = 0;

        foreach ($subheaders as $sub) {
          $qty = match($sub) {
              'Adult' => 2,
              'Children' => 1,
              'Infant' => 1,
          };
          $unitPrice = match($sub) {
              'Adult' => 500_000,
              'Children' => 300_000,
              'Infant' => 100_000,
          };

          $multiplierTotal = $qty * $unitPrice;

          BoqItem::create([
              'boq_id' => $boq2->id,
              'header' => null,
              'subheader' => $sub,
              'unit_price' => $unitPrice,
              'title1_key' => 'person',
              'title1_value' => $qty,
              'title2_key' => null,
              'title2_value' => null,
              'title3_key' => null,
              'title3_value' => null,
              'title4_key' => null,
              'title4_value' => null,
              'multiplier_total' => $multiplierTotal,
          ]);

          $totalItems2 += $multiplierTotal;
        }

        // Hitung management_fee
        $managementFee2 = $boq2->management_fee_type === 'percent'
          ? $totalItems2 * ($boq2->management_fee / 100)
          : $boq2->management_fee;

        
        // Hitung sales amount
        $salesAmount2 = $totalItems2 + $managementFee2;

        // Hitung VAT
        $vat2 = $boq2->vat_rate ? $salesAmount2 * ($boq2->vat_rate / 100) : 0;

        // Hitung invoice amount
        $invoiceAmount2 = $salesAmount2 + $vat2;

        // Update BOQ2
        $boq2->update([
          'total_amount_items' => $totalItems2,
          'sales_amount' => $salesAmount2,
          'vat' => $vat2,
          'invoice_amount' => $invoiceAmount2,
        ]);

        // Buat BOQ type-c
        $boq3 = Boq::create([
          'form_type' => 'type-c',
          'description' => 'BOQ Type C - Multimedia & Activities',
          'management_fee_type' => 'percent',
          'management_fee' => 10, // persen
          'sales_amount' => 0,
          'vat_rate' => 11,
          'vat' => 0,
          'invoice_amount' => 0,
        ]);

        $itemsData = [
          [
            'header' => 'Multimedia',
            'product_id' => 2,
            'qty' => 2
          ],
          [
            'header' => 'Activities, Outdoor',
            'product_id' => 9,
            'qty' => 3
          ]
        ];

        $totalItems3 = 0;

        foreach ($itemsData as $data) {
          $product = Product::find($data['product_id']);
          if (!$product) {
            continue; // skip kalau produk gak ada
          }

          $unitPrice = $product->base_cost;
          $multiplierTotal = $unitPrice * $data['qty'];

          BoqItem::create([
            'boq_id' => $boq3->id,
            'header' => $data['header'],
            'subheader' => $product->name,
            'product_id' => $product->id,
            'unit_price' => $unitPrice,
            'title1_key' => $product->unit,
            'title1_value' => $data['qty'],
            'title2_key' => null,
            'title2_value' => null,
            'title3_key' => null,
            'title3_value' => null,
            'title4_key' => null,
            'title4_value' => null,
            'multiplier_total' => $multiplierTotal,
          ]);

          $totalItems3 += $multiplierTotal;
        }

        // Hitung management_fee
        $managementFee3 = $boq3->management_fee_type === 'percent'
          ? $totalItems3 * ($boq3->management_fee / 100)
          : $boq3->management_fee;

        
        // Hitung sales amount
        $salesAmount3 = $totalItems3 + $managementFee3;

        // Hitung VAT
        $vat3 = $boq3->vat_rate ? $salesAmount3 * ($boq3->vat_rate / 100) : 0;

        // Hitung invoice amount
        $invoiceAmount2 = $salesAmount3 + $vat3;

        // Update BOQ3
        $boq3->update([
          'total_amount_items' => $totalItems3,
          'sales_amount' => $salesAmount3,
          'vat' => $vat3,
          'invoice_amount' => $invoiceAmount2,
        ]);
    }
}
