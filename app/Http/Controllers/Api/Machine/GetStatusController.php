<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Machine;

use App\Exceptions\Json\HttpJsonException;
use App\Http\Resources\Api\Recipes\RecipeCollection;
use App\Models\Recipe;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetStatusController extends BaseMachineController
{
    /**
     * @param Request $request
     * @return JsonResponse
     * @throws HttpJsonException
     */
    public function __invoke(Request $request)
    {
        $recipes = Recipe::query()->get();

        return $this->successResponse(
            message: 'Coffee machine is ready to brew.',
            data: [
                'recipes' => new RecipeCollection($recipes),
                'containers' => $this->containers(),
            ]
        );
    }
}
