<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Machine;

use App\Http\Requests\Api\Machine\BrewCoffeeRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class BrewCoffeeController extends BaseMachineController
{
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
