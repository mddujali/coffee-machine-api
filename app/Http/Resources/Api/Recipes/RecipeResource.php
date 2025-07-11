<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\Recipes;

use App\Enums\Unit;
use App\Http\Resources\Api\BaseJsonResource;
use Illuminate\Http\Request;
use Override;

/**
 * @property-read int $id
 * @property-read string $type
 * @property-read array $ingredients
 */
class RecipeResource extends BaseJsonResource
{
    #[Override]
    public function toArray(Request $request): array
    {
        $coffeeUnit = Unit::from($this->ingredients['coffee']['unit']);
        $waterUnit = Unit::from($this->ingredients['water']['unit']);

        return [
            'id' => $this->id,
            'type' => $this->type,
            'coffee' => [
                'quantity' => $this->ingredients['coffee']['quantity'],
                'unit' => [
                    'label' => $coffeeUnit->label(),
                    'value' => $coffeeUnit->value,
                ],
            ],
            'water' => [
                'quantity' => $this->ingredients['water']['quantity'],
                'unit' => [
                    'label' => $waterUnit->label(),
                    'value' => $waterUnit->value,
                ],
            ],
        ];
    }
}
