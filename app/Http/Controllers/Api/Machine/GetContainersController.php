<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Machine;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\Machine\GetContainersRequest;
use App\Http\Resources\Api\Containers\ContainerCollection;
use App\Models\Container;

class GetContainersController extends BaseController
{
    public function __invoke(GetContainersRequest $request)
    {
        $containers = Container::query()
            ->when($request->validated('type'), function ($query) use ($request): void {
                $query->where('type', $request->validated('type'));
            })
            ->get();

        return $this->successResponse(
            data: ['containers' => new ContainerCollection($containers)]
        );
    }
}
