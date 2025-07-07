<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Machine;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\Machine\BrewCoffeeRequest;
use App\Services\CoffeeContainerService;
use App\Services\WaterContainerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class BrewCoffeeController extends BaseController
{
    /**
     *  A single espresso uses 8 grams of coffee and 24 ml of water.
     *  A double espresso uses 16 grams of coffee and 48 ml of water.
     *  A single ristretto used 8 grams of coffee and 16 ml of water.
     *  A single americano uses 16 grams of coffee and 148 ml of water.
     *
     * @var array<string, array<string, int>>
     */
    private array $recipe = [
        'espresso' => ['coffee' => 8, 'water' => 24],
        'double_espresso' => ['coffee' => 16, 'water' => 48],
        'ristretto' => ['coffee' => 8, 'water' => 16],
        'americano' => ['coffee' => 16, 'water' => 148],
    ];

    public function __construct(private readonly CoffeeContainerService $coffee, private readonly WaterContainerService $water)
    {

    }

    /**
     * @param BrewCoffeeRequest $request
     * @return JsonResponse
     */
    public function __invoke(BrewCoffeeRequest $request)
    {
        $remainingCoffee = $this->coffee->get();
        $remainingWater = $this->water->get();

        $recipe = $this->recipe[$request->validated('type')];
        $requiredCoffee = $recipe['coffee'];
        $requiredWater = $recipe['water'];

        if ($requiredCoffee > $remainingCoffee) {
            return $this->errorResponse(
                status: Response::HTTP_BAD_REQUEST,
                message: 'Coffee is not enough.',
                errors: [
                    'coffee' => 'The remaining coffee is ' . $remainingCoffee . 'g, the required is ' . $remainingCoffee . 'g.',
                ]
            );
        }

        if ($requiredWater > $remainingWater) {
            return $this->errorResponse(
                status: Response::HTTP_BAD_REQUEST,
                message: 'Water is not enough.',
                errors: [
                    'water' => 'The remaining water is ' . $requiredWater . 'g, the required is ' . $requiredWater . 'g.',
                ]
            );
        }

        $this->coffee->use($requiredCoffee);

        $this->water->use($requiredWater);

        return $this->successResponse(
            message: 'Coffee has been brewed.',
            data: [
                'type' => $request->validated('type'),
                'recipe' => $recipe,
                'containers' => [
                    'coffee' => $this->coffee->get(),
                    'water' => $this->water->get(),
                ],
            ]
        );
    }
}
