<?php

declare(strict_types=1);

namespace Tests\Feature\Api\Machine;

use App\Enums\Container as ContainerEnum;
use Database\Seeders\ContainerSeeder;
use Generator;
use Illuminate\Http\Response;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Feature\Api\BaseTestCase;

class RefillContainerTest extends BaseTestCase
{
    public static function validationFailedDataProvider(): Generator
    {
        yield 'Missing Fields' => [
            [],
        ];

        yield 'Invalid Type' => [
            [
                'type' => 'invalid-type',
                'quantity' => 1,
            ],
        ];

        yield 'Invalid Quantity' => [
            [
                'type' => ContainerEnum::COFFEE->value,
                'quantity' => 'invalid-quantity',
            ],
        ];
    }

    #[DataProvider('validationFailedDataProvider')]
    public function test_it_should_return_validation_failed(array $data): void
    {
        $response = $this->json(
            method: 'PATCH',
            uri: route('api.machine.container.refill'),
            data: $data
        );

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertExactJsonStructure(['message', 'error_code', 'errors']);
    }

    public function test_it_should_refill_container(): void
    {
        $this->artisan('db:seed', ['--class' => ContainerSeeder::class]);

        $data = [
            'type' => ContainerEnum::COFFEE->value,
            'quantity' => 200,
        ];

        $response = $this->json(
            method: 'PATCH',
            uri: route('api.machine.container.refill'),
            data: $data
        );

        $response->assertStatus(Response::HTTP_OK);
        $response->assertExactJsonStructure([
            'message',
            'data' => [
                'id',
                'type',
                'quantity',
                'unit' => ['label', 'value'],
            ],
        ]);
    }
}
