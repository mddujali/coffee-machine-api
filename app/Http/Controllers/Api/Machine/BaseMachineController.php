<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Machine;

use App\Enums\Unit;
use App\Http\Controllers\Api\BaseController;
use App\Services\CoffeeContainerService;
use App\Services\WaterContainerService;

abstract class BaseMachineController extends BaseController
{
    /**
     *  A single espresso uses 8 grams of coffee and 24 ml of water.
     *  A double espresso uses 16 grams of coffee and 48 ml of water.
     *  A single ristretto used 8 grams of coffee and 16 ml of water.
     *  A single americano uses 16 grams of coffee and 148 ml of water.
     *
     * @var array<string, array<string, array>>
     */
    protected array $recipes = [];

    public function __construct(protected readonly CoffeeContainerService $coffee, protected readonly WaterContainerService $water)
    {
        $this->recipes = [
            'espresso' => [
                'coffee' => [
                    'quantity' => 8,
                    'unit' => $this->unit(Unit::GRAMS),
                ],
                'water' => [
                    'quantity' => 24,
                    'unit' => $this->unit(Unit::MILLILITERS),
                ],
            ],
            'double_espresso' => [
                'coffee' => [
                    'quantity' => 16,
                    'unit' => $this->unit(Unit::GRAMS),
                ],
                'water' => [
                    'quantity' => 48,
                    'unit' => $this->unit(Unit::MILLILITERS),
                ],
            ],
            'ristretto' => [
                'coffee' => [
                    'quantity' => 8,
                    'unit' => $this->unit(Unit::GRAMS),
                ],
                'water' => [
                    'quantity' => 16,
                    'unit' => $this->unit(Unit::MILLILITERS),
                ],
            ],
            'americano' => [
                'coffee' => [
                    'quantity' => 16,
                    'unit' => $this->unit(Unit::GRAMS),
                ],
                'water' => [
                    'quantity' => 148,
                    'unit' => $this->unit(Unit::MILLILITERS),
                ]
            ],
        ];
    }

    protected function unit(Unit $unit): array
    {
        return [
            'label' => $unit->label(),
            'value' => $unit->value,
        ];
    }

    protected function containers(): array
    {
        return [
            'coffee' => [
                'id' => $this->coffee->container()->id,
                'quantity' => $this->coffee->get(),
                'unit' => $this->unit(Unit::GRAMS),
            ],
            'water' => [
                'id' => $this->water->container()->id,
                'quantity' => $this->water->get(),
                'unit' => $this->unit(Unit::MILLILITERS),
            ],
        ];
    }
}
