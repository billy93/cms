<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class BankSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('seeders/BankSeederDB.csv');

        if (!File::exists($path)) {
            $this->command->error("File not found: {$path}");
            return;
        }

        $file = fopen($path, 'r');
        if ($file === false) {
            $this->command->error("Unable to open file: {$path}");
            return;
        }

        // Your CSV uses semicolon as delimiter
        $delimiter = ';';

        // 1) Read raw header
        $header = fgetcsv($file, 0, $delimiter);
        if ($header === false) {
            $this->command->error("CSV header row missing in: {$path}");
            fclose($file);
            return;
        }

        // 2) Remove UTF-8 BOM from first header cell if present
        if (isset($header[0])) {
            $header[0] = preg_replace('/^\xEF\xBB\xBF/', '', $header[0]);
        }

        // 3) Normalize header (trim + lowercase)
        $header = array_map(function ($h) {
            return strtolower(trim($h));
        }, $header);

        // 4) Validate required columns
        $required = ['bank_code', 'bank_name', 'bank_address', 'bank_brand'];

        foreach ($required as $col) {
            if (!in_array($col, $header, true)) {
                $this->command->error("Missing required column '{$col}' in CSV header.");
                $this->command->error("Found columns: " . implode(', ', $header));
                fclose($file);
                return;
            }
        }

        $rowNumber = 1; // header is row 1

        while (($row = fgetcsv($file, 0, $delimiter)) !== false) {
            $rowNumber++;

            // Skip empty rows
            if ($row === null || $row === [null] || (count($row) === 1 && trim($row[0]) === '')) {
                continue;
            }

            // Skip rows with mismatching column count
            if (count($row) !== count($header)) {
                $this->command->warn(
                    "Skipping row {$rowNumber}: Expected " . count($header) . " columns but got " . count($row)
                );
                continue;
            }

            // Combine header + row
            $data = array_combine($header, $row);
            if (!$data) {
                $this->command->warn("Skipping row {$rowNumber}: Failed to map row to header");
                continue;
            }

            // Normalize fields
            $bankCode  = trim($data['bank_code'] ?? '');
            $bankName  = trim($data['bank_name'] ?? '');
            $bankAddr  = trim($data['bank_address'] ?? '');
            $bankBrand = trim($data['bank_brand'] ?? '');

            // Keep only digits for bank_code and pad to 3 chars (CHAR(3))
            $bankCode = preg_replace('/\D/', '', $bankCode);
            if ($bankCode === '') {
                $this->command->warn("Skipping row {$rowNumber}: bank_code is empty after cleaning.");
                continue;
            }
            $bankCode = str_pad($bankCode, 3, '0', STR_PAD_LEFT);

            DB::table('banks')->updateOrInsert(
                ['bank_code' => $bankCode],
                [
                    'bank_name'    => $bankName ?: null,
                    'bank_address' => $bankAddr ?: null,
                    'bank_brand'   => $bankBrand ?: null,
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ]
            );
        }

        fclose($file);

        $this->command->info("BankSeeder completed successfully!");
    }
}