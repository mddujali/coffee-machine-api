<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Models\Container;
use Override;

class ContainerTest extends BaseModelTestCase
{
    #[Override]
    protected function setUp(): void
    {
        parent::setUp();

        $this->model = app(Container::class);

        $this->table = 'containers';

        $this->columns = [
            'id',
            'name',
            'type',
            'size',
            'limit',
            'unit',
            'status',
            'created_at',
            'updated_at',
        ];

        $this->fillable = [
            'name',
            'type',
            'size',
            'unit',
        ];
    }
}
