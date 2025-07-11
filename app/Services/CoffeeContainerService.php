<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\Container as ContainerEnum;
use App\Enums\Status;
use App\Exceptions\Json\HttpJsonException;
use App\Models\Container;
use Illuminate\Http\Response;

final class CoffeeContainerService extends BaseContainerService
{
    public function add(float $quantity): void
    {
        $container = $this->container();
        $container->increment('size', $quantity);
    }

    public function use(float $quantity): float
    {
        $container = $this->container();
        $container->decrement('size', $quantity);
        $container->refresh();

        return $container->size;
    }

    public function get(): float
    {
        return $this->container()->size;
    }

    public function container(): Container
    {
        $container = Container::query()
            ->where('type', ContainerEnum::COFFEE)
            ->where('status', Status::ACTIVE)
            ->first();

        if ( ! $container) {
            throw new HttpJsonException(
                status: Response::HTTP_NOT_FOUND,
                message: 'Coffee container not found.'
            );
        }

        return $container;
    }
}
