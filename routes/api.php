<?php

declare(strict_types=1);

use App\Http\Controllers\Api\Machine\BrewCoffeeController;
use App\Http\Controllers\Api\Machine\GetStatusController;
use App\Http\Controllers\Api\Machine\RefillContainerController;
use Illuminate\Support\Facades\Route;

Route::prefix('machine')
    ->name('machine.')
    ->group(function (): void {
        Route::post('brew-coffee', BrewCoffeeController::class)
            ->name('brew-coffee');

        Route::get('status', GetStatusController::class)
            ->name('status');

        Route::post('container', RefillContainerController::class)
            ->name('container');
    });
