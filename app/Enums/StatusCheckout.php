<?php

namespace App\Enums;

enum StatusCheckout: string
{
    case MENUNGGU = 'Menunggu';
    case DIPROSES = 'Diproses';
    case DIBATALKAN = 'Dibatalkan';
    case DIKIRIM = 'Dikirim';
    case SELESAI = 'Selesai';

    public static function values()
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
}
