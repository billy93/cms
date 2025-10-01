<?php

namespace App\Http\Services;

use App\Models\Boq;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class BoqService
{

    public function createBoq(array $data)
    {
        return DB::transaction(function () use ($data) {
            $items = $data['items'] ?? [];
            unset($data['items']); // hapus items dari main data

            // 🔹 Buat BOQ dulu (tanpa summary fields)
            $boq = Boq::create($data);

            $totalAmountItems = 0;

            if ($data['form_type'] === 'type-a') {
                // Type A → total_amount_items langsung dari request
                $totalAmountItems = $data['total_amount_items'];
            } else {
                // Type B/C/D → hitung dari items
                foreach ($items as $itemData) {
                    switch ($data['form_type']) {
                        case 'type-b':
                            $itemData['unit_price'] = $itemData['amount'];
                            $itemData['title1_key'] = 'Person';
                            $itemData['title1_value'] = $itemData['qty'];
                            $multiplier = $itemData['qty'] * $itemData['amount'];
                            break;

                        
                        case 'type-c':
                        case 'type-d':
                            // Ambil amount sementara
                            $amount = $itemData['amount'] ;

                            // Assign unit_price
                            $itemData['unit_price'] = $amount;

                            // Jika product_id ada, ambil product name jadi subheader
                            if (!empty($itemData['product_id'])) {
                                $product = Product::find($itemData['product_id']);
                                $itemData['subheader'] = $product?->name ?? $itemData['subheader'];
                            }

                            // Hitung multiplier = amount * semua titleX_value yang ada
                            $multiplier = $amount;

                            for ($i = 1; $i <= 4; $i++) {
                                $valKey = "title{$i}_value";
                                if (!empty($itemData[$valKey])) {
                                    $multiplier *= $itemData[$valKey];
                                }
                            }

                            // Hapus amount biar gak error di create
                            unset($itemData['amount']);

                            break;

                        default:
                            $multiplier = 0;
                    }

                    // Hitung multiplier_total
                    $itemData['multiplier_total'] = $multiplier;

                    // Simpan item
                    $boq->items()->create($itemData);

                    $totalAmountItems += $itemData['multiplier_total'];
                }
            }

            // 🔹 Hitung management_fee
            $managementFee = 0;
            if (!empty($data['management_fee'])) {
                if (($data['management_fee_type'] ?? 'percent') === 'percent') {
                    $managementFee = ($totalAmountItems * $data['management_fee']) / 100;
                } else {
                    $managementFee = $data['management_fee'];
                }
            }

            // 🔹 Hitung sales_amount
            $salesAmount = $totalAmountItems + $managementFee;

            // 🔹 Hitung VAT & invoice_amount
            $vatRate = $data['vat_rate']; // langsung pakai number
            $vat = ($salesAmount * $vatRate / 100);
            $invoiceAmount = $salesAmount + $vat;

            // 🔹 Update BOQ dengan summary
            $boq->update([
                'total_amount_items' => $totalAmountItems,
                'management_fee' => $data['management_fee'] ?? null,
                'sales_amount' => $salesAmount,
                'vat' => $vat,
                'invoice_amount' => $invoiceAmount
            ]);

            return $boq->fresh('items');
        });
    }


    public function getAllBoqs()
    {
        return Boq::with('items')->get();
    }

    public function getBoqById($id)
    {
        $boq = Boq::with('items')->find($id);
        if (!$boq) {
            throw new Exception("BOQ with ID {$id} not found");
        }
        return $boq;
    }

    public function updateBoq($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $boq = Boq::with('items')->find($id);
            if (!$boq) {
                throw new Exception("BOQ with ID {$id} not found");
            }

            $items = $data['items'] ?? [];
            unset($data['items']);

            // Update main fields dulu
            $boq->update($data);

            // Hapus items lama → replace total
            $boq->items()->delete();

            $totalAmountItems = 0;

            if ($data['form_type'] === 'type-a') {
                $totalAmountItems = $data['total_amount_items'];
            } else {
                foreach ($items as $itemData) {
                    switch ($data['form_type']) {
                        case 'type-b':
                            $itemData['unit_price'] = $itemData['amount'];
                            $itemData['title1_key'] = 'Person';
                            $itemData['title1_value'] = $itemData['qty'];
                            $multiplier = $itemData['qty'] * $itemData['amount'];
                            break;

                        case 'type-c':
                        case 'type-d':
                            $amount = $itemData['amount'];
                            $itemData['unit_price'] = $amount;

                            if (!empty($itemData['product_id'])) {
                                $product = Product::find($itemData['product_id']);
                                $itemData['subheader'] = $product?->name ?? $itemData['subheader'];
                            }

                            $multiplier = $amount;
                            for ($i = 1; $i <= 4; $i++) {
                                $valKey = "title{$i}_value";
                                if (!empty($itemData[$valKey])) {
                                    $multiplier *= $itemData[$valKey];
                                }
                            }

                            unset($itemData['amount']);
                            break;

                        default:
                            $multiplier = 0;
                    }

                    $itemData['multiplier_total'] = $multiplier;
                    $boq->items()->create($itemData);
                    $totalAmountItems += $itemData['multiplier_total'];
                }
            }

            // Hitung management fee
            $managementFee = 0;
            if (!empty($data['management_fee'])) {
                if (($data['management_fee_type'] ?? 'percent') === 'percent') {
                    $managementFee = ($totalAmountItems * $data['management_fee']) / 100;
                } else {
                    $managementFee = $data['management_fee'];
                }
            }

            // Hitung sales_amount
            $salesAmount = $totalAmountItems + $managementFee;

            // Hitung VAT & invoice_amount
            $vatRate = $data['vat_rate'];
            $vat = ($salesAmount * $vatRate / 100);
            $invoiceAmount = $salesAmount + $vat;

            // Update summary
            $boq->update([
                'total_amount_items' => $totalAmountItems,
                'management_fee' => $data['management_fee'] ?? null,
                'sales_amount' => $salesAmount,
                'vat' => $vat,
                'invoice_amount' => $invoiceAmount
            ]);

            return $boq->fresh('items');
        });
    }


    public function deleteBoq($id)
    {
        $boq = Boq::find($id);
        if (!$boq) {
            throw new Exception("BOQ with ID {$id} not found");
        }
        $boq->delete();
    }
}
