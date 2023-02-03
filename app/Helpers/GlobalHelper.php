<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class GlobalHelper
{
    public static function days()
    {
        $days = [
            'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu',
            'Minggu',
        ];

        return $days;
    }

    public static function types()
    {
        $types = [
            'Offline',
            'Online'
        ];

        return $types;
    }

    public static function getDayName($id)
    {
        $days = self::days();
        return $days[$id];
    }
}
