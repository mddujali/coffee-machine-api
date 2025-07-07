<?php

declare(strict_types=1);

namespace App\Enums;

enum Coffee: string
{
    case ESPRESSO = 'espresso';

    case DOUBLE_ESPRESSO = 'double_espresso';

    case RISTRETTO = 'ristretto';

    case AMERICANO = 'americano';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
