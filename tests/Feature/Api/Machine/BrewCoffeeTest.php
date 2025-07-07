<?php

declare(strict_types=1);

namespace Tests\Feature\Api\Machine;

use App\Enums\Coffee;
use App\Enums\Container as ContainerEnum;
use App\Models\Container;
use Database\Seeders\ContainerSeeder;
use Generator;
use Illuminate\Http\Response;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Feature\Api\BaseTestCase;

class BrewCoffeeTest extends BaseTestCase
{
    public static function validationFailedDataProvider(): Generator
    {
        yield 'Missing Type Field' => [
            [],
        ];

        yield 'Invalid Type' => [
            ['type' => 'invalid-type'],
        ];
    }

    public static function containerNotFoundDataProvider(): Generator
    {
        yield ContainerEnum::COFFEE->value . ' container not found' => [
            ['type' => Coffee::ESPRESSO->value],
            ['type' => ContainerEnum::COFFEE->value]
        ];

        yield ContainerEnum::WATER->value . ' container not found' => [
            ['type' => Coffee::ESPRESSO->value],
            ['type' => ContainerEnum::WATER->value]
        ];
    }

    public static function containerNotEnoughDataProvider(): Generator
    {
        yield 'Not enough ' . ContainerEnum::COFFEE->value => [
            [
                [
                    'type' => ContainerEnum::COFFEE->value,
                    'size' => 2,
                ],
                [
                    'type' => ContainerEnum::WATER->value,
                    'size' => 500,
                ],
            ],
            ['type' => Coffee::ESPRESSO->value],
        ];

        yield 'Not enough ' . ContainerEnum::WATER->value => [
            [
                [
                    'type' => ContainerEnum::COFFEE->value,
                    'size' => 2000,
                ],
                [
                    'type' => ContainerEnum::WATER->value,
                    'size' => 2,
                ],
            ],
            ['type' => Coffee::ESPRESSO->value],
        ];
    }

    public static function coffeeBrewedDataProvider(): Generator
    {
        yield 'Brew ' . Coffee::ESPRESSO->label() => [
            ['type' => Coffee::ESPRESSO->value],
            [
                [
                    'type' => ContainerEnum::COFFEE->value,
                    'size' => 492,
                ],
                [
                    'type' => ContainerEnum::WATER->value,
                    'size' => 1976,
                ],
            ],
        ];

        yield 'Brew ' . Coffee::DOUBLE_ESPRESSO->label() => [
            ['type' => Coffee::DOUBLE_ESPRESSO->value],
            [
                [
                    'type' => ContainerEnum::COFFEE->value,
                    'size' => 484,
                ],
                [
                    'type' => ContainerEnum::WATER->value,
                    'size' => 1952,
                ],
            ],
        ];

        yield 'Brew ' . Coffee::RISTRETTO->label() => [
            ['type' => Coffee::RISTRETTO->value],
            [
                [
                    'type' => ContainerEnum::COFFEE->value,
                    'size' => 492,
                ],
                [
                    'type' => ContainerEnum::WATER->value,
                    'size' => 1984,
                ],
            ],
        ];

        yield 'Brew ' . Coffee::AMERICANO->label() => [
            ['type' => Coffee::AMERICANO->value],
            [
                [
                    'type' => ContainerEnum::COFFEE->value,
                    'size' => 484,
                ],
                [
                    'type' => ContainerEnum::WATER->value,
                    'size' => 1852,
                ],
            ],
        ];
    }

    #[DataProvider('validationFailedDataProvider')]
    public function test_it_should_return_validation_failed(array $data): void
    {
        $response = $this->json(
            method: 'POST',
            uri: route('api.machine.brew-coffee'),
            data: $data
        );

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertExactJsonStructure(['message', 'error_code', 'errors']);
    }

    #[DataProvider('containerNotFoundDataProvider')]
    public function test_it_should_return_not_found_container(array $data, array $unexpect): void
    {
        $response = $this->json(
            method: 'POST',
            uri: route('api.machine.brew-coffee'),
            data: $data
        );

        $response->assertStatus(Response::HTTP_NOT_FOUND);
        $response->assertExactJsonStructure(['message', 'error_code', 'errors']);

        $this->assertDatabaseMissing('containers', $unexpect);
    }

    #[DataProvider('containerNotEnoughDataProvider')]
    public function test_it_should_return_not_enough_container(array $containers, array $data): void
    {
        foreach ($containers as $container) {
            Container::factory($container)->create();
        }

        $response = $this->json(
            method: 'POST',
            uri: route('api.machine.brew-coffee'),
            data: $data
        );

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $response->assertExactJsonStructure(['message', 'error_code', 'errors']);
    }

    #[DataProvider('coffeeBrewedDataProvider')]
    public function test_it_should_brew_coffee(array $data, array $expects): void
    {
        $this->artisan('db:seed', ['--class' => ContainerSeeder::class]);

        $response = $this->json(
            method: 'POST',
            uri: route('api.machine.brew-coffee'),
            data: $data
        );

        $response->assertStatus(Response::HTTP_OK);
        $response->assertExactJsonStructure([
            'message',
            'data' => [
                'type',
                'recipe' => ['coffee', 'water'],
                'containers' => ['coffee', 'water'],
            ],
        ]);

        foreach ($expects as $expect) {
            $this->assertDatabaseHas('containers', $expect);
        }
    }
}
