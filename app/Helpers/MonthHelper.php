<?php

namespace App\Helpers;

class MonthHelper
{
    public static function getMonthName($monthNumber)
    {
        $monthNames = [
            1 => 'Tháng 1',
            2 => 'Tháng 2',
            3 => 'Tháng 3',
            4 => 'Tháng 4',
            5 => 'Tháng 5',
            6 => 'Tháng 6',
            7 => 'Tháng 7',
            8 => 'Tháng 8',
            9 => 'Tháng 9',
            10 => 'Tháng 10',
            11 => 'Tháng 11',
            12 => 'Tháng 12',
        ];

        return $monthNames[$monthNumber] ?? '';
    }
}
