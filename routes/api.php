<?php

declare(strict_types=1);

use App\Http\Controllers\Api\Machine\BrewCoffeeController;
use App\Http\Controllers\Api\Machine\GetContainersController;
use App\Http\Controllers\Api\Machine\GetStatusController;
use App\Http\Controllers\Api\Machine\RefillContainerController;
use App\Http\Controllers\Api\Machine\UseContainerController;
use Illuminate\Support\Facades\Route;

Route::prefix('machine')
    ->name('machine.')
    ->group(function (): void {
        Route::post('brew-coffee', BrewCoffeeController::class)
            ->name('brew-coffee');

        Route::get('status', GetStatusController::class)
            ->name('status');

        Route::get('containers', GetContainersController::class)
            ->name('containers');

        Route::prefix('container')
            ->name('container.')
            ->group(function (): void {
                Route::patch('use', UseContainerController::class)
                    ->name('use');

                Route::patch('refill', RefillContainerController::class)
                    ->name('refill');
            });
    });
