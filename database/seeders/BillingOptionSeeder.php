<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\BillingOption;
use Illuminate\Database\Seeder;

class BillingOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $majuBersama = Customer::where('name', 'PT Maju Bersama')->first();
        if ($majuBersama) {
            BillingOption::create([
                'customer_id' => $majuBersama->id,
                'cp_name' => 'Budi Santoso',
                'cp_title_division' => 'Head Office',
                'cp_email' => 'budi@majubersama.com',
                'cp_office_number' => '021-5550123',
                'is_overseas' => false,
                'address' => 'Jl. Sudirman No. 123, Jakarta Pusat, DKI Jakarta 12190',
            ]);
            BillingOption::create([
                'customer_id' => $majuBersama->id,
                'cp_name' => 'Finance Dept',
                'cp_title_division' => 'Finance',
                'cp_email' => 'finance@majubersama.com',
                'cp_mobile_number' => '081122334455',
                'is_overseas' => false,
                'address' => 'Jl. Sudirman No. 123, Tower A Lt. 15, Jakarta Pusat',
            ]);
        }

        $suksesMandiri = Customer::where('name', 'CV Sukses Mandiri')->first();
        if ($suksesMandiri) {
            BillingOption::create([
                'customer_id' => $suksesMandiri->id,
                'cp_name' => 'Siti Aminah',
                'cp_title_division' => 'Operational',
                'cp_email' => 'siti@suksesmandiri.co.id',
                'cp_office_number' => '021-5550456',
                'is_overseas' => false,
                'address' => 'Jl. Thamrin No. 45, Jakarta Pusat, DKI Jakarta 10350',
            ]);
        }

        $globalTekno = Customer::where('name', 'PT Global Teknologi')->first();
        if ($globalTekno) {
            BillingOption::create([
                'customer_id' => $globalTekno->id,
                'cp_name' => 'Ahmad Rizki',
                'cp_title_division' => 'IT Department',
                'cp_email' => 'ahmad@globalteknologi.com',
                'cp_office_number' => '021-5550789',
                'is_overseas' => false,
                'address' => 'Jl. Gatot Subroto No. 67, Jakarta Selatan, DKI Jakarta 12930',
            ]);
        }
    }
}
