<?php

use League\Route\RouteGroup;
use League\Route\Router;

return function (Router $router) {
    $router->get('/teas[/]', Teaki\GetTeasRequestHandler::class);
    $router->get('/teas/{teaId:number}[/]', Teaki\GetTeasRequestHandler::class);
    $router->post('/teas[/]', Teaki\SaveTeaRequestHandler::class);

    $router->get('/names[/]', [Teaki\NamesController::class, 'get']);

    $router->get('/locations[/]', [Teaki\LocationsController::class, 'get']);

    $router->get('/vendors[/]', [Teaki\VendorsController::class, 'get']);
    return $router;
};
