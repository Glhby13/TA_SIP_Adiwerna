<?php

namespace App\Helpers;

class MyHelpers {
    public static function getIndonesianDate($date) {
        $indonesianDate = \Carbon\Carbon::parse($date)->isoFormat('D MMMM Y');
        $englishMonth = \Carbon\Carbon::parse($date)->isoFormat('MMMM');

        // Konversi nama bulan dari Inggris ke Indonesia
        $indonesianMonth = self::getIndonesianMonth($englishMonth);

        // Gantilah nama bulan dalam tanggal Indonesia
        $indonesianDate = str_replace($englishMonth, $indonesianMonth, $indonesianDate);

        return $indonesianDate;
    }

    public static function getIndonesianMonth($englishMonth) {
        $months = [
            'January' => 'Januari',
            'February' => 'Februari',
            'March' => 'Maret',
            'April' => 'April',
            'May' => 'Mei',
            'June' => 'Juni',
            'July' => 'Juli',
            'August' => 'Agustus',
            'September' => 'September',
            'October' => 'Oktober',
            'November' => 'November',
            'December' => 'Desember',
        ];

        return $months[$englishMonth] ?? $englishMonth;
    }
}
