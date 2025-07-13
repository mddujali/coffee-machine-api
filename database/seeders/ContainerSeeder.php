<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\Container as ContainerEnum;
use App\Enums\Status;
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
        $containers = [
            [
                'name' => 'Coffee 500',
                'type' => ContainerEnum::COFFEE,
                'size' => 500,
                'limit' => 500,
                'unit' => Unit::GRAMS,
                'status' => Status::ACTIVE,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Coffee 1000',
                'type' => ContainerEnum::COFFEE,
                'size' => 1000,
                'limit' => 1000,
                'unit' => Unit::GRAMS,
                'status' => Status::INACTIVE,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Coffee 1500',
                'type' => ContainerEnum::COFFEE,
                'size' => 1500,
                'limit' => 1500,
                'unit' => Unit::GRAMS,
                'status' => Status::INACTIVE,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Water 4000',
                'type' => ContainerEnum::WATER,
                'size' => 4000,
                'limit' => 4000,
                'unit' => Unit::MILLILITERS,
                'status' => Status::INACTIVE,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Water 2000',
                'type' => ContainerEnum::WATER,
                'size' => 2000,
                'limit' => 2000,
                'unit' => Unit::MILLILITERS,
                'status' => Status::ACTIVE,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Water 6000',
                'type' => ContainerEnum::WATER,
                'size' => 6000,
                'limit' => 6000,
                'unit' => Unit::MILLILITERS,
                'status' => Status::INACTIVE,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Container::query()->insert($containers);
    }
}
