<?php

declare(strict_types=1);

use App\Http\Controllers\Api\Machine\BrewCoffeeController;
use Illuminate\Support\Facades\Route;

Route::prefix('machine')
    ->name('machine.')
    ->group(function (): void {
        Route::post('brew-coffee', BrewCoffeeController::class)
            ->name('brew-coffee');
    });
