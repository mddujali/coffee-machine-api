<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\Machine;

use App\Enums\Container;
use App\Http\Requests\Api\BaseRequest;
use Override;

class UseContainerRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required',
            'type' => 'required|in:' . implode(',', Container::values()),
        ];
    }

    #[Override]
    public function messages(): array
    {
        return [
            'id.required' => 'Select a container to use.',
            'type.required' => 'Choose a container type.',
            'type.in' => 'Invalid container type.',
        ];
    }
}
