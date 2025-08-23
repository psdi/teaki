<?php

use Psr\Container\ContainerInterface;
use TeaTracker\GetTeasRequestHandler;
use TeaTracker\Persistence\TeaAggregateDao;
use function DI\factory;

return [
    PDO::class => function (ContainerInterface $container) {
        $dsn = sprintf(
            '%s:host=%s;dbname=%s;charset=UTF8',
            $_ENV['DB_DRIVER'],
            $_ENV['DB_HOST'],
            $_ENV['DB_NAME'],
        );
        $conn = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS']);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    },

    TeaAggregateDao::class => function (ContainerInterface $container) {
        $conn = $container->get(PDO::class);
        return new TeaAggregateDao($conn);
    },

    GetTeasRequestHandler::class => function (ContainerInterface $container) {
        $teaAggrDao = $container->get(TeaAggregateDao::class);
        return new GetTeasRequestHandler($teaAggrDao);
    }
];
