<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\Container as ContainerEnum;
use App\Exceptions\Json\HttpJsonException;
use App\Models\Container;
use Illuminate\Http\Response;

final class WaterContainerService extends BaseContainerService
{
    public function add(float $quantity): void
    {
        $container = $this->findContainer();
        $container->increment('size', $quantity);
    }

    public function use(float $quantity): float
    {
        $container = $this->findContainer();
        $container->decrement('size', $quantity);
        $container->refresh();

        return $container->size;
    }

    public function get(): float
    {
        return $this->findContainer()->size;
    }

    protected function findContainer(): Container
    {
        $container = Container::query()
            ->where('type', ContainerEnum::WATER)
            ->first();

        if ( ! $container) {
            throw new HttpJsonException(
                status: Response::HTTP_NOT_FOUND,
                message: 'Water container not found.'
            );
        }

        return $container;
    }
}
