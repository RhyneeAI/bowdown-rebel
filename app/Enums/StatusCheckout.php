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


    public static function getBadgeColor($status)
    {
        return match ($status) {
            self::MENUNGGU->value => 'warning',
            self::DIPROSES->value => 'info',
            self::DIBATALKAN->value => 'danger',
            self::DIKIRIM->value => 'primary',
            self::SELESAI->value => 'success',
            default => 'warning',
        };
    }
}
