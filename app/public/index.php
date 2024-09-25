<?php

use App\Controllers\UserController;
use App\Controllers\UserPointController;
use App\Middleware\JsonBodyParserMiddleware;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->addErrorMiddleware(true, false, false); // For development only, display errors

// Normally for an API I would group these routes under /api, but the requirements don't specify that
$app->group('/users', function ($app) {
    $app->get('', [UserController::class, 'index']);
    $app->post('', [UserController::class, 'store']);
    $app->group('/{id}', function ($app) {
        $app->delete('', [UserController::class, 'destroy']);
        $app->post('/earn', [UserPointController::class, 'earn']);
        $app->post('/redeem', [UserPointController::class, 'redeem']);
    });
})->add(JsonBodyParserMiddleware::class);

$app->run();