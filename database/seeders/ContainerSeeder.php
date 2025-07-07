<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\Container as ContainerEnum;
use App\Enums\Unit;
use App\Models\Container;
use Illuminate\Database\Seeder;

class ContainerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Container::query()
            ->create([
                'type' => ContainerEnum::COFFEE,
                'size' => 500, // 500g
                'unit' => Unit::GRAMS,
            ]);

        Container::query()
            ->create([
                'type' => ContainerEnum::WATER,
                'size' => 2000, // 2ml = 2l
                'unit' => Unit::MILLILITERS,
            ]);
    }
}
