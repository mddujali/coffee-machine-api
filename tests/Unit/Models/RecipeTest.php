<?php

declare(strict_types=1);

namespace Models;

use App\Models\Recipe;
use Override;
use Tests\Unit\Models\BaseModelTestCase;

class RecipeTest extends BaseModelTestCase
{
    #[Override]
    protected function setUp(): void
    {
        parent::setUp();

        $this->model = app(Recipe::class);

        $this->table = 'recipes';

        $this->columns = [
            'id',
            'type',
            'ingredients',
            'created_at',
            'updated_at',
        ];

        $this->fillable = [
            'type',
            'ingredients',
        ];
    }
}
