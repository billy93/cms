<?php

use Illuminate\Support\Str;

if (!function_exists('formatRupiah')) {
    function formatRupiah($angka): string
    {
        if ($angka === null || $angka === '' || !is_numeric($angka)) {
            return '';
        }

        $hasDecimal = (strpos((string)$angka, '.') !== false || strpos((string)$angka, ',') !== false);

        return number_format((float)$angka, $hasDecimal ? 2 : 0, ',', '.');
    }
}
