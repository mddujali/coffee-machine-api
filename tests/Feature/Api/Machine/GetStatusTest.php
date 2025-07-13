<?php

declare(strict_types=1);

namespace Api\Machine;

use Database\Seeders\ContainerSeeder;
use Database\Seeders\RecipeSeeder;
use Illuminate\Http\Response;
use Tests\Feature\Api\BaseTestCase;

class GetStatusTest extends BaseTestCase
{
    public function test_it_should_return_machine_status(): void
    {
        $this->seed(ContainerSeeder::class);
        $this->seed(RecipeSeeder::class);

        $response = $this->json(
            method: 'GET',
            uri: route('api.machine.status'),
        );

        $response->assertStatus(Response::HTTP_OK);
        $response->assertExactJsonStructure([
            'message',
            'data' => [
                'recipes' => [
                    '*' => [
                        'id',
                        'type',
                        'coffee' => [
                            'quantity',
                            'unit' => ['label', 'value'],
                        ],
                        'water' => [
                            'quantity',
                            'unit' => ['label', 'value'],
                        ],
                    ]
                ],
                'containers' => [
                    '*' => [
                        'id',
                        'name',
                        'type',
                        'quantity',
                        'unit' => ['label', 'value'],
                    ],
                ],
            ],
        ]);
    }
}
