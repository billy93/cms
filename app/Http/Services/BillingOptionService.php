<?php

namespace App\Http\Services;

use App\Models\BillingOption;
use Illuminate\Support\Facades\DB;
use Exception;

class BillingOptionService
{
    public function createBillingOption(array $data)
    {
        return DB::transaction(function () use ($data) {
            return BillingOption::create($data);
        });
    }

    public function getAllBillingOptions()
    {
        return BillingOption::with('customer')->get();
    }

    public function getBillingOptionsByCustomerId($customerId)
    {
        return BillingOption::where('customer_id', $customerId)->get();
    }

    public function getBillingOptionById($id)
    {
        $billingOption = BillingOption::with('customer')->find($id);
        if (!$billingOption) {
            throw new Exception("Billing Option with ID {$id} not found");
        }
        return $billingOption;
    }

    public function updateBillingOption($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $billingOption = BillingOption::find($id);
            if (!$billingOption) {
                throw new Exception("Billing Option with ID {$id} not found");
            }

            $billingOption->update($data);
            return $billingOption->fresh();
        });
    }

    public function deleteBillingOption($id)
    {
        $billingOption = BillingOption::find($id);
        if (!$billingOption) {
            throw new Exception("Billing Option with ID {$id} not found");
        }
        $billingOption->delete();
    }
}
