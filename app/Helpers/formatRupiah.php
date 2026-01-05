<?php

use Illuminate\Support\Str;

if (!function_exists('formatRupiah')) {
    function formatRupiah($number): string
    {
        if ($number === null || $number === '' || !is_numeric($number)) {
            return '';
        }

        $number = (float) $number;
        $hasDecimal = floor($number) != $number;

        return number_format($number, $hasDecimal ? 2 : 0, ',', '.');
    }
}
