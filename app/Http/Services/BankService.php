<?php

namespace App\Http\Services;

use App\Models\Bank;
use Illuminate\Support\Facades\DB;
use Exception;

class BankService
{
    public function createBank(array $data)
    {
        return DB::transaction(function () use ($data) {
            $bank = Bank::create($data);
            return $bank->fresh();
        });
    }

    public function getAllBanks()
    {
        return Bank::all();
    }

    public function getBankById($id)
    {
        $bank = Bank::find($id);
        if (!$bank) {
            throw new Exception("bank with ID {$id} not found");
        }
        return $bank;
    }

    public function updatebank($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $bank = bank::find($id);
            if (!$bank) {
                throw new Exception("bank with ID {$id} not found");
            }

            $bank->update($data);
            return $bank->fresh();
        });
    }

    public function deletebank($id)
    {
        $bank = bank::find($id);
        if (!$bank) {
            throw new Exception("bank with ID {$id} not found");
        }
        $bank->delete();
    }
}
