<?php

if (!function_exists('formatDate')) {
    /**
     * Format tanggal menjadi format Indonesia atau custom.
     *
     * @param  string|\DateTimeInterface|null  $date
     * @param  string  $format
     * @return string
     */
    function formatDate($date, string $format = 'd/m/Y'): string
    {
        if (empty($date)) {
            return '';
        }

        try {
            // Jika sudah instance DateTimeInterface (Carbon, DateTime)
            if ($date instanceof \DateTimeInterface) {
                return $date->format($format);
            }

            // Jika string atau timestamp
            $carbon = \Carbon\Carbon::parse($date);
            return $carbon->format($format);
        } catch (\Exception $e) {
            return '';
        }
    }
}
