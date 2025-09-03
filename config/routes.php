<?php

use League\Route\RouteGroup;
use League\Route\Router;

return function (Router $router) {
    $router->get('/teas[/]', Teaki\GetTeasRequestHandler::class);
    $router->get('/teas/{teaId:number}[/]', Teaki\GetTeasRequestHandler::class);
    $router->post('/teas[/]', Teaki\SaveTeaRequestHandler::class);

    return $router;
};
