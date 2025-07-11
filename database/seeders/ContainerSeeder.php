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
                'type' => ContainerEnum::COFFEE,
                'size' => 500,
                'limit' => 500,
                'unit' => Unit::GRAMS,
                'status' => Status::ACTIVE,
            ],
            [
                'type' => ContainerEnum::COFFEE,
                'size' => 1000,
                'limit' => 1000,
                'unit' => Unit::GRAMS,
                'status' => Status::INACTIVE,
            ],
            [
                'type' => ContainerEnum::COFFEE,
                'size' => 1500,
                'limit' => 1500,
                'unit' => Unit::GRAMS,
                'status' => Status::INACTIVE,
            ],
            [
                'type' => ContainerEnum::WATER,
                'size' => 4000,
                'limit' => 4000,
                'unit' => Unit::MILLILITERS,
                'status' => Status::INACTIVE,
            ],
            [
                'type' => ContainerEnum::WATER,
                'size' => 2000,
                'limit' => 2000,
                'unit' => Unit::MILLILITERS,
                'status' => Status::ACTIVE,
            ],
            [
                'type' => ContainerEnum::WATER,
                'size' => 6000,
                'limit' => 6000,
                'unit' => Unit::MILLILITERS,
                'status' => Status::INACTIVE,
            ],
        ];

        Container::query()->insert($containers);
    }
}
