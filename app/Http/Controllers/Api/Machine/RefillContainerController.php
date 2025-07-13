<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Machine;

use App\Enums\Container as ContainerEnum;
use App\Exceptions\Json\HttpJsonException;
use App\Http\Requests\Api\Machine\RefillContainerRequest;
use App\Http\Resources\Api\Containers\ContainerResource;

class RefillContainerController extends BaseMachineController
{
    /**
     * @param RefillContainerRequest $request
     * @return ContainerResource
     * @throws HttpJsonException
     */
    public function __invoke(RefillContainerRequest $request)
    {
        match ($request->validated('type')) {
            ContainerEnum::COFFEE->value => $this->coffee->add((float) $request->validated('quantity')),
            ContainerEnum::WATER->value => $this->water->add((float) $request->validated('quantity')),
        };

        $container = match ($request->validated('type')) {
            ContainerEnum::COFFEE->value => $this->coffee->container(),
            ContainerEnum::WATER->value => $this->water->container(),
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
