<?php

use League\Route\RouteGroup;
use League\Route\Router;

return function (Router $router) {
    $router->group('/teas', function (RouteGroup $route) {
        $route->get('/', TeaTracker\GetTeasRequestHandler::class);
        $route->get('/{teaId}', TeaTracker\GetTeasRequestHandler::class);
    });

    return $router;
};
