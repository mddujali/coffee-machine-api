<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Machine;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\Api\Containers\ContainerResource;
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

    }

    protected function containers(): array
    {
        return [
            new ContainerResource($this->coffee->container()),
            new ContainerResource($this->water->container()),
        ];
    }
}
