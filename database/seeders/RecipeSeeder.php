<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\Coffee;
use App\Enums\Unit;
use App\Models\Recipe;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $recipes = [
            [
                'type' => Coffee::ESPRESSO->value,
                'ingredients' => json_encode([
                    'coffee' => [
                        'quantity' => 8,
                        'unit' => Unit::GRAMS->value,
                    ],
                    'water' => [
                        'quantity' => 24,
                        'unit' => Unit::MILLILITERS->value,
                    ],
                ], JSON_THROW_ON_ERROR),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => Coffee::DOUBLE_ESPRESSO->value,
                'ingredients' => json_encode([
                    'coffee' => [
                        'quantity' => 16,
                        'unit' => Unit::GRAMS->value,
                    ],
                    'water' => [
                        'quantity' => 48,
                        'unit' => Unit::MILLILITERS->value,
                    ],
                ], JSON_THROW_ON_ERROR),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => Coffee::RISTRETTO->value,
                'ingredients' => json_encode([
                    'coffee' => [
                        'quantity' => 8,
                        'unit' => Unit::GRAMS->value,
                    ],
                    'water' => [
                        'quantity' => 16,
                        'unit' => Unit::MILLILITERS->value,
                    ],
                ], JSON_THROW_ON_ERROR),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => Coffee::AMERICANO->value,
                'ingredients' =>  json_encode([
                    'coffee' => [
                        'quantity' => 16,
                        'unit' => Unit::GRAMS->value,
                    ],
                    'water' => [
                        'quantity' => 148,
                        'unit' => Unit::MILLILITERS->value,
                    ]
                ], JSON_THROW_ON_ERROR),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Recipe::query()->insert($recipes);
    }
}
