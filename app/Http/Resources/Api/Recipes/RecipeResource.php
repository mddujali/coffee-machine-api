<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\Recipes;

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
        return [
            $this->type => [
                'id' => $this->id,
                'coffee' => [
                    'quantity' => $this->ingredients['coffee']['quantity'],
                    'unit' => $this->ingredients['coffee']['unit'],
                ],
                'water' => [
                    'quantity' => $this->ingredients['water']['quantity'],
                    'unit' => $this->ingredients['water']['unit'],
                ],
            ],
        ];
    }
}
