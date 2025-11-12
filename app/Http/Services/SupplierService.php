<?php

namespace App\Http\Services;

use App\Models\Supplier;
use Illuminate\Support\Facades\DB;
use Exception;

class SupplierService
{
    public function createSupplier(array $data)
    {
        return DB::transaction(function () use ($data) {
            $data['code'] = Supplier::generateCode();
            $supplier = Supplier::create($data);
            return $supplier->fresh();
        });
    }

    public function getAllSuppliers()
    {
        $suppliers = Supplier::with(['products'])->get();
        return $suppliers;
    }

    public function getSupplierById($id)
    {
        $supplier = Supplier::with('products')->find($id);
        if (!$supplier) {
            throw new Exception("Supplier with ID {$id} not found");
        }
        return $supplier;
    }

    public function updateSupplier($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $supplier = Supplier::find($id);
            if (!$supplier) {
                throw new Exception("Supplier with ID {$id} not found");
            }

            $supplier->update($data);
            return $supplier->fresh();
        });
    }

    public function deleteSupplier($id)
    {
        $supplier = Supplier::find($id);
        if (!$supplier) {
            throw new Exception("Supplier with ID {$id} not found");
        }
        $supplier->delete();
    }
}
