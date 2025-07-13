<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\Machine;

use App\Enums\Container;
use App\Http\Requests\Api\BaseRequest;
use Override;

class RefillContainerRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'type' => 'required|in:' . implode(',', Container::values()),
            'quantity' => 'required|numeric|min:1',
        ];
    }

    #[Override]
    public function messages(): array
    {
        return [
            'type.required' => 'Select a container to refill.',
            'type.in' => 'Invalid container type.',
            'quantity.required' => 'Quantity is required.',
            'quantity.numeric' => 'Quantity must be a number.',
            'quantity.min' => 'Quantity must be at least :min.',
        ];
    }
}
