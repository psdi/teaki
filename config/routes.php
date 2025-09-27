<?php

use League\Route\RouteGroup;
use League\Route\Router;
use Teaki\Middleware\JsonParserMiddleware;

return function (Router $router) {
    $router->get('/teas[/]', Teaki\GetTeasRequestHandler::class);
    $router->get('/teas/{teaId:number}[/]', Teaki\GetTeasRequestHandler::class);
    $router
        ->post('/teas[/]', Teaki\SaveTeaRequestHandler::class)
        ->middleware(new JsonParserMiddleware);
    $router
        ->put('/teas/{teaId:number}[/]', Teaki\SaveTeaRequestHandler::class)
        ->middleware(new JsonParserMiddleware);

    $router->get('/names[/]', [Teaki\NamesController::class, 'get']);

    $router->get('/locations[/]', [Teaki\LocationsController::class, 'get']);

    $router->get('/vendors[/]', [Teaki\VendorsController::class, 'get']);
    return $router;
};
