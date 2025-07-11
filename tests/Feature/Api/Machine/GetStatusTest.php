<?php

declare(strict_types=1);

namespace Api\Machine;

use Database\Seeders\ContainerSeeder;
use Illuminate\Http\Response;
use Tests\Feature\Api\BaseTestCase;

class GetStatusTest extends BaseTestCase
{
    public function test_it_return_machine_status(): void
    {
        $this->artisan('db:seed', ['--class' => ContainerSeeder::class]);

        $response = $this->json(
            method: 'GET',
            uri: route('api.machine.status'),
        );

        $response->assertStatus(Response::HTTP_OK);
        $response->assertExactJsonStructure([
            'message',
            'data' => [
                'recipes' => [
                    'espresso' => [
                        'coffee' => ['quantity', 'unit'],
                        'water' => ['quantity', 'unit'],
                    ],
                    'double_espresso' => [
                        'coffee' => ['quantity', 'unit'],
                        'water' => ['quantity', 'unit'],
                    ],
                    'ristretto' => [
                        'coffee' => ['quantity', 'unit'],
                        'water' => ['quantity', 'unit'],
                    ],
                    'americano' => [
                        'coffee' => ['quantity', 'unit'],
                        'water' => ['quantity', 'unit'],
                    ],
                ],
                'containers' => [
                    'coffee' => ['id', 'quantity', 'unit'],
                    'water' => ['id', 'quantity', 'unit'],
                ],
            ],
        ]);
    }
}
