<?php

declare(strict_types=1);

namespace App\Enums;

enum Container: string
{
    case COFFEE = 'coffee';

    case WATER = 'water';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
