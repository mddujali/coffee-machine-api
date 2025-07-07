<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\Machine;

use App\Enums\Container;
use App\Http\Requests\Api\BaseRequest;

class RefillContainerRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'type' => 'required|in:' . implode(',', Container::values()),
            'quantity' => 'required|numeric|min:1',
        ];
    }
}
