<?php

namespace App\Enums;

enum MidtransStatus: string
{
    case CAPTURE = 'capture';
    case SETTLEMENT = 'settlement';
    case PENDING = 'pending';
    case DENY = 'deny';
    case CANCEL = 'cancel';
    case EXPIRE = 'expire';
    case FAILURE = 'failure';
    case REFUND = 'refund';
    case PARTIAL_REFUND = 'partial_refund';
    case AUTHORIZE = 'authorize';

    public static function values()
    {
        return array_map(fn($case) => $case->value, self::cases());
    }

    public static function success()
    {
        return [
            self::CAPTURE->value,
            self::SETTLEMENT->value,
        ];
    }

    public static function pending()
    {
        return [
            self::PENDING->value,
            self::AUTHORIZE->value
        ];
    }

    public static function failed()
    {
        return [
            self::DENY->value,
            self::CANCEL->value,
            self::FAILURE->value
        ];
    }

    public static function refund()
    {
        return [
            self::REFUND->value,
            self::PARTIAL_REFUND->value
        ];
    }
}
