<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\Machine;

use App\Enums\Container;
use App\Http\Requests\Api\BaseRequest;
use Override;

class GetContainersRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'type' => 'sometimes|in:' . implode(',', Container::values()),
        ];
    }

    #[Override]
    public function messages(): array
    {
        return [
            'type.in' => 'Invalid container type.',
        ];
    }
}
