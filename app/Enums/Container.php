<?php

declare(strict_types=1);

namespace App\Enums;

enum Container: string
{
    case WATER = 'water';

    case COFFEE = 'coffee';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
