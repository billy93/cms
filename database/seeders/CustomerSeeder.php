<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            [
                'customer_code' => 'CUST000001',
                'customer_name' => 'PT Maju Bersama',
                'address' => 'Jl. Sudirman No. 123, Jakarta Pusat, DKI Jakarta 12190',
                'contact_person' => 'Budi Santoso',
                'phone' => '021-5550123',
                'email' => 'budi@majubersama.com',
                'status' => 'active',
                'notes' => 'Customer utama untuk proyek IT infrastructure'
            ],
            [
                'customer_code' => 'CUST000002',
                'customer_name' => 'CV Sukses Mandiri',
                'address' => 'Jl. Thamrin No. 45, Jakarta Pusat, DKI Jakarta 10350',
                'contact_person' => 'Siti Aminah',
                'phone' => '021-5550456',
                'email' => 'siti@suksesmandiri.co.id',
                'status' => 'active',
                'notes' => 'Konsultan manajemen dan training'
            ],
            [
                'customer_code' => 'CUST000003',
                'customer_name' => 'PT Global Teknologi',
                'address' => 'Jl. Gatot Subroto No. 67, Jakarta Selatan, DKI Jakarta 12930',
                'contact_person' => 'Ahmad Rizki',
                'phone' => '021-5550789',
                'email' => 'ahmad@globalteknologi.com',
                'status' => 'active',
                'notes' => 'Perusahaan teknologi informasi'
            ],
            [
                'customer_code' => 'CUST000004',
                'customer_name' => 'UD Makmur Jaya',
                'address' => 'Jl. Hayam Wuruk No. 89, Jakarta Barat, DKI Jakarta 11160',
                'contact_person' => 'Dewi Sartika',
                'phone' => '021-5550112',
                'email' => 'dewi@makmurjaya.com',
                'status' => 'active',
                'notes' => 'Distributor produk elektronik'
            ],
            [
                'customer_code' => 'CUST000005',
                'customer_name' => 'PT Sejahtera Abadi',
                'address' => 'Jl. Asia Afrika No. 234, Bandung, Jawa Barat 40262',
                'contact_person' => 'Rudi Hermawan',
                'phone' => '022-5550234',
                'email' => 'rudi@sejahteraabadi.co.id',
                'status' => 'active',
                'notes' => 'Manufaktur tekstil dan garmen'
            ],
            [
                'customer_code' => 'CUST000006',
                'customer_name' => 'CV Berkah Sentosa',
                'address' => 'Jl. Ahmad Yani No. 156, Surabaya, Jawa Timur 60231',
                'contact_person' => 'Nina Kartika',
                'phone' => '031-5550156',
                'email' => 'nina@berkahsentosa.com',
                'status' => 'inactive',
                'notes' => 'Customer non-aktif - pindah lokasi'
            ],
            [
                'customer_code' => 'CUST000007',
                'customer_name' => 'PT Dinamis Kreatif',
                'address' => 'Jl. Pemuda No. 78, Semarang, Jawa Tengah 50132',
                'contact_person' => 'Eko Prasetyo',
                'phone' => '024-5550178',
                'email' => 'eko@dinamiskreatif.com',
                'status' => 'active',
                'notes' => 'Agency kreatif dan digital marketing'
            ],
            [
                'customer_code' => 'CUST000008',
                'customer_name' => 'UD Mitra Usaha',
                'address' => 'Jl. Veteran No. 345, Medan, Sumatera Utara 20112',
                'contact_person' => 'Sri Wahyuni',
                'phone' => '061-5550345',
                'email' => 'sri@mitrausaha.co.id',
                'status' => 'active',
                'notes' => 'Trading dan import-export'
            ]
        ];

        foreach ($customers as $customer) {
            Customer::create($customer);
        }
    }
} 