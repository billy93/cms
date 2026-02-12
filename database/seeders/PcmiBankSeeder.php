<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PcmiBank;
use App\Models\Bank;

class PcmiBankSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure some banks exist first
        $bankBCA = Bank::where('bank_name', 'LIKE', '%BCA%')->first();
        $bankMandiri = Bank::where('bank_name', 'LIKE', '%Mandiri%')->first();

        if (!$bankBCA) {
            $bankBCA = Bank::create([
                'bank_code' => '014',
                'bank_name' => 'Bank Central Asia',
                'bank_address' => 'Jakarta',
                'bank_brand' => 'BCA'
            ]);
        }

        if (!$bankMandiri) {
            $bankMandiri = Bank::create([
                'bank_code' => '008',
                'bank_name' => 'Bank Mandiri',
                'bank_address' => 'Jakarta',
                'bank_brand' => 'Mandiri'
            ]);
        }

        PcmiBank::updateOrInsert(
            ['account_no' => '1234567890'],
            [
                'bank_id' => $bankBCA->id,
                'branch' => 'KCU Sudirman',
                'swift_code' => 'CENAIDJA',
                'holder_name' => 'PT. PRO CHEMCO MANDIRI INDONESIA',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        PcmiBank::updateOrInsert(
            ['account_no' => '0987654321'],
            [
                'bank_id' => $bankMandiri->id,
                'branch' => 'KCP Thamrin',
                'swift_code' => 'BMANDIDJA',
                'holder_name' => 'PT. PRO CHEMCO MANDIRI INDONESIA',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
