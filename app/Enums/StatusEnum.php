<?php

namespace App\Enums;

enum StatusEnum: string
{
    case AKTIF = 'Aktif';
    case NONAKTIF = 'Non Aktif';

    public static function values()
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
}
