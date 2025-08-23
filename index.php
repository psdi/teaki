<?php

require_once 'vendor/autoload.php';

(new Symfony\Component\Dotenv\Dotenv)->load(__DIR__ . '/config/.env');

$builder = new \DI\ContainerBuilder;
$builder->useAutowiring(false);
$builder->useAttributes(false);
$builder->addDefinitions('config/container.php');
$container = $builder->build();

$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
);

$router = (require_once 'config/routes.php')(new League\Route\Router);
$strategy = new League\Route\Strategy\ApplicationStrategy;
$strategy->setContainer($container);
$router->setStrategy($strategy);
$response = $router->dispatch($request);

// send the response to the browser
(new Laminas\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);
