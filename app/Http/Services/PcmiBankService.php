<?php

namespace App\Http\Services;

use App\Models\PcmiBank;

class PcmiBankService
{
    /**
     * Get all PCMI Banks with their associated bank data.
     */
    public function getAllPcmiBanks()
    {
        return PcmiBank::with('bank')->get();
    }

    /**
     * Get a single PCMI Bank by ID.
     */
    public function getPcmiBankById($id)
    {
        return PcmiBank::with('bank')->findOrFail($id);
    }
}
