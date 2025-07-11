<?php

declare(strict_types=1);

namespace App\Enums;

use App\Support\Traits\Enums\HasHelpers;

enum Status: string
{
    use HasHelpers;

    case ACTIVE = 'active';

    case INACTIVE = 'inactive';
}
