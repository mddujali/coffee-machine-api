<?php

declare(strict_types=1);

namespace Tests\Feature\Api\Machine;

use App\Enums\Container as ContainerEnum;
use Database\Seeders\ContainerSeeder;
use Generator;
use Illuminate\Http\Response;
use Override;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Feature\Api\BaseTestCase;

class UseContainerTest extends BaseTestCase
{
    #[Override]
    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(ContainerSeeder::class);
    }

    public static function validationFailedDataProvider(): Generator
    {
        yield 'Missing Fields' => [
            [],
            [
                'message',
                'error_code',
                'errors' => ['id', 'type'],
            ],
        ];

        yield 'Invalid Type' => [
            [
                'id' => 1,
                'type' => 'invalid-type',
            ],
            [
                'message',
                'error_code',
                'errors' => ['type'],
            ],
        ];
    }

    public static function invalidContainerDataProvider(): Generator
    {
        yield 'Invalid ' . ContainerEnum::COFFEE->label() => [
            [
                'id' => 100,
                'type' => ContainerEnum::COFFEE->value,
            ],
        ];

        yield 'Invalid ' . ContainerEnum::WATER->label() => [
            [
                'id' => 100,
                'type' => ContainerEnum::WATER->value,
            ],
        ];
    }

    #[DataProvider('validationFailedDataProvider')]
    public function test_it_should_return_validation_failed(array $data, array $structure): void
    {
        $response = $this->json(
            method: 'PATCH',
            uri: route('api.machine.container.use'),
            data: $data
        );

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertExactJsonStructure($structure);
    }

    #[DataProvider('invalidContainerDataProvider')]
    public function test_it_should_return_container_not_found($data): void
    {
        $response = $this->json(
            method: 'PATCH',
            uri: route('api.machine.container.use'),
            data: $data
        );

        $response->assertStatus(Response::HTTP_NOT_FOUND);
        $response->assertExactJsonStructure(['message', 'error_code', 'errors']);
    }
}
