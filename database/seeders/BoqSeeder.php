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
      
        // BOQ TYPE - A
        $boq = Boq::create([
            'code' => BOQ::generateCode(),
            'proposal_id' => 1,
            'form_type' => 'A',
            'description' => 'BOQ Type A',
            'management_fee_type' => 'percent',
            'management_fee' => 10, // 10%
            'vat_rate' => 1, // 1%
        ]);

        $unitPrice = 1000000;
        $totalItems = $unitPrice;

        $managementFee = $boq->management_fee_type === 'percent'
            ? ($totalItems * ($boq->management_fee / 100))
            : $boq->management_fee;
        $salesAmount = $totalItems + $managementFee;
        $vat = $boq->vat_rate ? $salesAmount * ($boq->vat_rate / 100) : 0;
        $invoiceAmount = $salesAmount + $vat;

        // Update BOQ
        $boq->update([
            'total_amount_items' => $totalItems,
            'sales_amount' => $salesAmount,
            'vat' => $vat,
            'invoice_amount' => $invoiceAmount,
        ]);

        // BOQ TYPE - B
        $boq2 = Boq::create([
            'code' => BOQ::generateCode(),
            'proposal_id' => 1,
            'form_type' => 'B',
            'description' => 'BOQ Type B',
            'management_fee_type' => 'nominal',
            'management_fee' => 100000, // persen
            'sales_amount' => 0,
            'vat_rate' => 1,
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
              'header' => "BOQ Type B Header",
              'subheader' => $sub,
              'unit_price' => $unitPrice,
              'title1_key' => 'Person',
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

        $managementFee2 = $boq2->management_fee_type === 'percent'
          ? $totalItems2 * ($boq2->management_fee / 100)
          : $boq2->management_fee;

        $salesAmount2 = $totalItems2 + $managementFee2;
        $vat2 = $boq2->vat_rate ? $salesAmount2 * ($boq2->vat_rate / 100) : 0;
        $invoiceAmount2 = $salesAmount2 + $vat2;

        // Update BOQ2
        $boq2->update([
          'total_amount_items' => $totalItems2,
          'sales_amount' => $salesAmount2,
          'vat' => $vat2,
          'invoice_amount' => $invoiceAmount2,
        ]);

        // BBOQ TYPE C 
        $boq3 = Boq::create([
          'code' => BOQ::generateCode(),
          'proposal_id' => 1,
          'form_type' => 'C',
          'description' => 'BOQ Type C',
          'management_fee_type' => 'percent',
          'management_fee' => 6, // persen
          'sales_amount' => 0,
          'vat_rate' => 1,
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

        $managementFee3 = $boq3->management_fee_type === 'percent'
          ? $totalItems3 * ($boq3->management_fee / 100)
          : $boq3->management_fee;
        $salesAmount3 = $totalItems3 + $managementFee3;
        $vat3 = $boq3->vat_rate ? $salesAmount3 * ($boq3->vat_rate / 100) : 0;
        $invoiceAmount3 = $salesAmount3 + $vat3;

        // Update BOQ3
        $boq3->update([
          'total_amount_items' => $totalItems3,
          'sales_amount' => $salesAmount3,
          'vat' => $vat3,
          'invoice_amount' => $invoiceAmount3,
        ]);

        // BBOQ TYPE D 
        $boq4 = Boq::create([
          'code' => BOQ::generateCode(),
          'proposal_id' => 1,
          'form_type' => 'D',
          'description' => 'BOQ Type D',
          'management_fee_type' => 'percent',
          'management_fee' => 12, // persen
          'sales_amount' => 0,
          'vat_rate' => 1,
          'vat' => 0,
          'invoice_amount' => 0,
        ]);

        BoqItem::create([
          'boq_id' => $boq4->id,
          'header' => "Accommodation",
          'subheader' => "Deluxe Hotel Package",
          'product_id' => null,
          'unit_price' => 1_500_000,
          'title1_key' => "Number of rooms",
          'title1_value' => 3,
          'title2_key' => "Number of nights",
          'title2_value' => 2,
          'title3_key' => null,
          'title3_value' => null,
          'title4_key' => null,
          'title4_value' => null,
          'multiplier_total' => 1_500_000 * 3 * 2,
        ]);

        $managementFee4 = $boq4->management_fee_type === 'percent'
          ? 9_000_000 * ($boq4->management_fee / 100)
          : $boq4->management_fee;
        $salesAmount4 = 9_000_000 + $managementFee4;
        $vat4 = $boq4->vat_rate ? $salesAmount4 * ($boq4->vat_rate / 100) : 0;
        $invoiceAmount4 = $salesAmount4 + $vat4;

        // Update BOQ4
        $boq4->update([
          'total_amount_items' => 9_000_000,
          'sales_amount' => $salesAmount4,
          'vat' => $vat4,
          'invoice_amount' => $invoiceAmount4,
        ]);
    }
}
