<?php

use Illuminate\Support\Str;

if (!function_exists('formatRupiah')) {
    function formatRupiah($number): string
    {
        if ($number === null || $number === '' || !is_numeric($number)) {
            return '';
        }

        $hasDecimal = (strpos((string)$number, '.') !== false || strpos((string)$number, ',') !== false);

        return number_format((float)$number, $hasDecimal ? 2 : 0, ',', '.');
    }
}
