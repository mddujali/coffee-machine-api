<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\Container as ContainerEnum;
use App\Models\Container;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final class WaterContainerService extends BaseContainerService
{
    public function add(float $quantity): void
    {
        $container = $this->findContainer();
        $container->increment('quantity', $quantity);
    }

    public function use(float $quantity): float
    {
        $container = $this->findContainer();
        $container->decrement('quantity', $quantity);
        $container->refresh();

        return (float) $container->quantity;
    }

    public function get(): float
    {
        $container = $this->findContainer();

        return (float) $container->quantity;
    }

    protected function findContainer(): Container
    {
        $container = Container::query()
            ->where('type', ContainerEnum::WATER)
            ->first();

        if ( ! $container) {
            throw new ModelNotFoundException('Water container not found.');
        }

        return $container;
    }
}
