<?php


declare(strict_types=1);

namespace App\Enums;

use App\Support\Traits\Enums\HasHelpers;

enum Unit: string
{
    use HasHelpers;

    case GRAMS = 'grams';

    case MILLILITERS = 'milliliters';

    public function value(): string
    {
        return match ($this) {
            self::GRAMS => self::GRAMS->value,
            self::MILLILITERS => self::MILLILITERS->value,
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::GRAMS => 'g',
            self::MILLILITERS => 'ml',
        };
    }
}
