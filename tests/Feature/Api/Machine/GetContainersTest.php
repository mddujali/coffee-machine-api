<?php

declare(strict_types=1);

namespace Tests\Feature\Api\Machine;

use Database\Seeders\ContainerSeeder;
use Illuminate\Http\Response;
use Tests\Feature\Api\BaseTestCase;

class GetContainersTest extends BaseTestCase
{
    public function test_it_should_return_machine_containers(): void
    {
        $this->seed(ContainerSeeder::class);

        $response = $this->json(
            method: 'GET',
            uri: route('api.machine.containers'),
        );

        $response->assertStatus(Response::HTTP_OK);
        $response->assertExactJsonStructure([
            'message',
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'type',
                    'quantity',
                    'unit' => ['label', 'value'],
                ],
            ],
        ]);
    }
}
