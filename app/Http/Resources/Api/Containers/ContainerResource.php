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
        return [
            $this->type => [
                'id' => $this->id,
                'quantity' => $this->size,
                'unit' => [
                    'label' => Unit::from($this->unit)->label(),
                    'value' => $this->unit,
                ],
            ],
        ];
    }
}
