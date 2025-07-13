<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Machine;

use App\Enums\Container as ContainerEnum;
use App\Enums\Unit;
use App\Exceptions\Json\HttpJsonException;
use App\Http\Requests\Api\Machine\RefillContainerRequest;
use App\Http\Resources\Api\Containers\ContainerResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class RefillContainerController extends BaseMachineController
{
    /**
     * @param RefillContainerRequest $request
     * @return ContainerResource|JsonResponse
     * @throws HttpJsonException
     */
    public function __invoke(RefillContainerRequest $request)
    {
        $quantityToAdd = (float) $request->validated('quantity');

        $container = match ($request->validated('type')) {
            ContainerEnum::COFFEE->value => $this->coffee->container(),
            ContainerEnum::WATER->value => $this->water->container(),
        };

        $unit = match ($request->validated('type')) {
            ContainerEnum::COFFEE->value => Unit::GRAMS,
            ContainerEnum::WATER->value => Unit::MILLILITERS,
        };

        $totalQuantityWithRefill = $container->size + $quantityToAdd;

        if ($container->limit < $totalQuantityWithRefill) {
            return $this->errorResponse(
                status: Response::HTTP_BAD_REQUEST,
                message: $container->name . ' reached the limit.',
                errors: [
                    'coffee' => [
                        sprintf(
                            'The quantity with refill will %s but the container limit is %s.',
                            $totalQuantityWithRefill . $unit->label(),
                            (float) $container->limit . $unit->label(),
                        )
                    ],
                ]
            );
        }

        match ($request->validated('type')) {
            ContainerEnum::COFFEE->value => $this->coffee->add($quantityToAdd),
            ContainerEnum::WATER->value => $this->water->add($quantityToAdd),
        };

        return (new ContainerResource($container))
            ->setMessage(
                sprintf(
                    '%s container has been refilled.',
                    $container->name
                )
            );
    }
}
