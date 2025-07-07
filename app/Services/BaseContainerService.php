<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Container;

abstract class BaseContainerService implements ContainerInterface
{
    abstract protected function findContainer(): Container;
}
