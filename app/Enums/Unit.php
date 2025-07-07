<?php


declare(strict_types=1);

namespace App\Enums;

enum Unit: string
{
    case MILLILITERS = 'milliliters';

    case GRAMS = 'grams';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function value(): string
    {
        return match ($this) {
            self::MILLILITERS => self::MILLILITERS->value,
            self::GRAMS => self::GRAMS->value,
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::MILLILITERS => 'ml',
            self::GRAMS => 'g',
        };
    }
}
