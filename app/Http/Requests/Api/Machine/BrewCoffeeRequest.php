<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\Machine;

use App\Enums\Coffee;
use App\Http\Requests\Api\BaseRequest;
use Override;

class BrewCoffeeRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'type' => 'required|in:' . implode(',', Coffee::values()),
        ];
    }

    #[Override]
    public function messages(): array
    {
        return [
            'type.required' => 'Coffee type is required.',
            'type.in' => 'Invalid coffee type.',
        ];
    }
}
