<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\Containers;

use App\Enums\Unit;
use App\Http\Resources\Api\BaseJsonResource;
use Illuminate\Http\Request;
use Override;

/**
 * @property-read int $id
 * @property-read string $type
 * @property-read float $size
 * @property-read string $unit
 */
class ContainerResource extends BaseJsonResource
{
    #[Override]
    public function toArray(Request $request): array
    {
        $unit = Unit::from($this->unit);

        return [
            'id' => $this->id,
            'type' => $this->type,
            'quantity' => $this->size,
            'unit' => [
                'label' => $unit->label(),
                'value' => $unit->value,
            ],
        ];
    }
}
