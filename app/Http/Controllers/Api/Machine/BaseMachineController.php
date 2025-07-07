<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Machine;

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
     * @var array<string, array<string, int>>
     */
    protected array $recipe = [
        'espresso' => ['coffee' => 8, 'water' => 24],
        'double_espresso' => ['coffee' => 16, 'water' => 48],
        'ristretto' => ['coffee' => 8, 'water' => 16],
        'americano' => ['coffee' => 16, 'water' => 148],
    ];

    public function __construct(protected readonly CoffeeContainerService $coffee, protected readonly WaterContainerService $water)
    {

    }
}
