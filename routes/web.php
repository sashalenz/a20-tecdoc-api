<?php

use Illuminate\Routing\Router;
use Sashalenz\Tecdoc\Controllers\BrandController;
use Sashalenz\Tecdoc\Controllers\ModelController;
use Sashalenz\Tecdoc\Controllers\VehicleController;

Route::middleware(config('a20-tecdoc-api.middleware'))
    ->prefix('tecdoc')
    ->as('a20-tecdoc-api.')
    ->group(function (Router $router) {
        $router->as('brands.')
            ->prefix('brands')
            ->group(function (Router $router) {
                $router->post('/', [BrandController::class, 'index'])->name('index');
            });
        $router->as('models.')
            ->prefix('models')
            ->group(function (Router $router) {
                $router->post('/', [ModelController::class, 'index'])->name('index');
                $router->post('/{id}', [ModelController::class, 'show'])->name('show');
            });
        $router->as('vehicles.')
            ->prefix('vehicles')
            ->group(function (Router $router) {
                $router->post('/', [VehicleController::class, 'index'])->name('index');
                $router->post('/{id}', [VehicleController::class, 'show'])->name('show');
            });
    });
