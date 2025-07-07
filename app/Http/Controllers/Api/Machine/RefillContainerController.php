<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Machine;

use App\Enums\Container as ContainerEnum;
use App\Http\Requests\Api\Machine\RefillContainerRequest;
use Illuminate\Http\JsonResponse;

class RefillContainerController extends BaseMachineController
{
    /**
     * @param RefillContainerRequest $request
     * @return JsonResponse
     */
    public function __invoke(RefillContainerRequest $request)
    {
        match ($request->validated('type')) {
            ContainerEnum::COFFEE->value => $this->coffee->add((float) $request->validated('quantity')),
            ContainerEnum::WATER->value => $this->water->add((float) $request->validated('quantity')),
        };

        $container = match ($request->validated('type')) {
            ContainerEnum::COFFEE->value => $this->coffee->get(),
            ContainerEnum::WATER->value => $this->water->get(),
        };

        return $this->successResponse(
            message: 'Container has been refilled.',
            data:[$request->validated('type') => $container]
        );
    }
}
