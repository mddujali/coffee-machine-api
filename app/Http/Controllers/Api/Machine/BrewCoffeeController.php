<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Machine;

use App\Enums\Unit;
use App\Http\Requests\Api\Machine\BrewCoffeeRequest;
use App\Http\Resources\Api\Recipes\RecipeResource;
use App\Models\Recipe;
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

        $recipe = Recipe::query()
            ->where('type', $request->validated('type'))
            ->first();

        if ( ! $recipe) {
            return $this->errorResponse(
                status: Response::HTTP_BAD_REQUEST,
                message: 'Invalid recipe type.',
                errors: [
                    'type' => 'The selected recipe type is not valid.',
                ]
            );
        }

        $requiredCoffee = $recipe->ingredients['coffee']['quantity'];
        $requiredWater = $recipe->ingredients['water']['quantity'];

        if ($requiredCoffee > $remainingCoffee) {
            return $this->errorResponse(
                status: Response::HTTP_BAD_REQUEST,
                message: 'Coffee is not enough.',
                errors: [
                    'coffee' => sprintf(
                        'The remaining coffee is %s but the required is %s.',
                        $remainingCoffee . Unit::GRAMS->label(),
                        $requiredCoffee . Unit::GRAMS->label(),
                    ),
                ]
            );
        }

        if ($requiredWater > $remainingWater) {
            return $this->errorResponse(
                status: Response::HTTP_BAD_REQUEST,
                message: 'Water is not enough.',
                errors: [
                    'water' => sprintf(
                        'The remaining water is %s but the required is %s.',
                        $remainingWater . Unit::MILLILITERS->label(),
                        $requiredWater . Unit::MILLILITERS->label()
                    ),
                ]
            );
        }

        $this->coffee->use($requiredCoffee);

        $this->water->use($requiredWater);

        return $this->successResponse(
            message: 'Coffee has been brewed.',
            data: [
                'recipe' => new RecipeResource($recipe),
                'containers' => $this->containers(),
            ]
        );
    }
}
