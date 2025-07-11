<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Machine;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetStatusController extends BaseMachineController
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request)
    {
        return $this->successResponse(
            message: 'Coffee machine is ready to brew.',
            data: [
                'recipes' => $this->recipes,
                'containers' => $this->containers(),
            ]
        );
    }
}
