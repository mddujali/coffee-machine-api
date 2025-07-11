<?php

declare(strict_types=1);

namespace App\Enums;

use App\Support\Traits\Enums\HasHelpers;

enum Container: string
{
    use HasHelpers;

    case COFFEE = 'coffee';

    case WATER = 'water';

    public function label(): string
    {
        return match ($this) {
            self::COFFEE => 'Coffee',
            self::WATER => 'Water',
        };
    }
}
