<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = [
            [
                'supplier_code' => 'SUPP000001',
                'supplier_name' => 'PT Maju Teknologi',
                'address' => 'Jl. Gatot Subroto No. 123, Jakarta Selatan, DKI Jakarta 12930',
                'contact_person' => 'Budi Santoso',
                'phone' => '021-5550123',
                'email' => 'budi@majuteknologi.com',
                'tax_number' => '01.234.567.8-123.000',
                'bank_name' => 'Bank Central Asia (BCA)',
                'bank_account_number' => '1234567890',
                'bank_account_name' => 'PT Maju Teknologi',
                'status' => 'active',
                'notes' => 'Supplier utama untuk perangkat IT dan software'
            ],
            [
                'supplier_code' => 'SUPP000002',
                'supplier_name' => 'CV Sukses Mandiri',
                'address' => 'Jl. Sudirman No. 456, Jakarta Pusat, DKI Jakarta 12190',
                'contact_person' => 'Siti Aminah',
                'phone' => '021-5550456',
                'email' => 'siti@suksesmandiri.co.id',
                'tax_number' => '02.345.678.9-234.000',
                'bank_name' => 'Bank Mandiri',
                'bank_account_number' => '0987654321',
                'bank_account_name' => 'CV Sukses Mandiri',
                'status' => 'active',
                'notes' => 'Supplier untuk jasa konsultasi dan training'
            ],
            [
                'supplier_code' => 'SUPP000003',
                'supplier_name' => 'PT Global Solutions',
                'address' => 'Jl. Thamrin No. 789, Jakarta Pusat, DKI Jakarta 10350',
                'contact_person' => 'Ahmad Rizki',
                'phone' => '021-5550789',
                'email' => 'ahmad@globalsolutions.com',
                'tax_number' => '03.456.789.0-345.000',
                'bank_name' => 'Bank Negara Indonesia (BNI)',
                'bank_account_number' => '1122334455',
                'bank_account_name' => 'PT Global Solutions',
                'status' => 'active',
                'notes' => 'Supplier untuk solusi enterprise dan cloud services'
            ],
            [
                'supplier_code' => 'SUPP000004',
                'supplier_name' => 'UD Makmur Jaya',
                'address' => 'Jl. Hayam Wuruk No. 321, Jakarta Barat, DKI Jakarta 11160',
                'contact_person' => 'Dewi Sartika',
                'phone' => '021-5550112',
                'email' => 'dewi@makmurjaya.com',
                'tax_number' => '04.567.890.1-456.000',
                'bank_name' => 'Bank Rakyat Indonesia (BRI)',
                'bank_account_number' => '5544332211',
                'bank_account_name' => 'UD Makmur Jaya',
                'status' => 'active',
                'notes' => 'Supplier untuk perangkat keras dan komponen elektronik'
            ],
            [
                'supplier_code' => 'SUPP000005',
                'supplier_name' => 'PT Sejahtera Abadi',
                'address' => 'Jl. Asia Afrika No. 654, Bandung, Jawa Barat 40262',
                'contact_person' => 'Rudi Hermawan',
                'phone' => '022-5550234',
                'email' => 'rudi@sejahteraabadi.co.id',
                'tax_number' => '05.678.901.2-567.000',
                'bank_name' => 'Bank Central Asia (BCA)',
                'bank_account_number' => '6677889900',
                'bank_account_name' => 'PT Sejahtera Abadi',
                'status' => 'active',
                'notes' => 'Supplier untuk furniture dan peralatan kantor'
            ],
            [
                'supplier_code' => 'SUPP000006',
                'supplier_name' => 'CV Berkah Sentosa',
                'address' => 'Jl. Ahmad Yani No. 987, Surabaya, Jawa Timur 60231',
                'contact_person' => 'Nina Kartika',
                'phone' => '031-5550156',
                'email' => 'nina@berkahsentosa.com',
                'tax_number' => '06.789.012.3-678.000',
                'bank_name' => 'Bank Mandiri',
                'bank_account_number' => '7788990011',
                'bank_account_name' => 'CV Berkah Sentosa',
                'status' => 'inactive',
                'notes' => 'Supplier non-aktif - pindah lokasi'
            ],
            [
                'supplier_code' => 'SUPP000007',
                'supplier_name' => 'PT Dinamis Kreatif',
                'address' => 'Jl. Pemuda No. 147, Semarang, Jawa Tengah 50132',
                'contact_person' => 'Eko Prasetyo',
                'phone' => '024-5550178',
                'email' => 'eko@dinamiskreatif.com',
                'tax_number' => '07.890.123.4-789.000',
                'bank_name' => 'Bank Negara Indonesia (BNI)',
                'bank_account_number' => '8899001122',
                'bank_account_name' => 'PT Dinamis Kreatif',
                'status' => 'active',
                'notes' => 'Supplier untuk jasa kreatif dan digital marketing'
            ],
            [
                'supplier_code' => 'SUPP000008',
                'supplier_name' => 'PT Inovasi Digital',
                'address' => 'Jl. Sudirman No. 258, Medan, Sumatera Utara 20112',
                'contact_person' => 'Maya Sari',
                'phone' => '061-5550258',
                'email' => 'maya@inovasidigital.com',
                'tax_number' => '08.901.234.5-890.000',
                'bank_name' => 'Bank Central Asia (BCA)',
                'bank_account_number' => '9900112233',
                'bank_account_name' => 'PT Inovasi Digital',
                'status' => 'active',
                'notes' => 'Supplier untuk layanan digital dan e-commerce'
            ]
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}
