<?php

use League\Route\RouteGroup;
use League\Route\Router;

return function (Router $router) {
    $router->get('/teas[/]', TeaTracker\GetTeasRequestHandler::class);
    $router->get('/teas/{teaId:number}[/]', TeaTracker\GetTeasRequestHandler::class);

    return $router;
};
