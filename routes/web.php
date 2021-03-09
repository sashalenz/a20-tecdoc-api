<?php

use Illuminate\Routing\Router;
use Sashalenz\Tecdoc\Controllers\BrandController;
use Sashalenz\Tecdoc\Controllers\ModelController;
use Sashalenz\Tecdoc\Controllers\VehicleController;

Route::middleware(config('a20-tecdoc-api.middleware'))->group(function (Router $router) {
    $router->resource('brands', BrandController::class)->only('index');
    $router->resource('models', ModelController::class)->only('index', 'show');
    $router->resource('vehicles', VehicleController::class)->only('index', 'show');
});
