<?php

use Psr\Container\ContainerInterface;
use Teaki\GetTeasRequestHandler;
use Teaki\Persistence\LocationDao;
use Teaki\Persistence\NameDao;
use Teaki\Persistence\TeaAggregateDao;
use Teaki\Persistence\TeaDao;
use Teaki\Persistence\VendorDao;
use Teaki\SaveTeaRequestHandler;
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

    LocationDao::class => function (ContainerInterface $container) {
        $conn = $container->get(PDO::class);
        return new LocationDao($conn);
    },

    NameDao::class => function (ContainerInterface $container) {
        $conn = $container->get(PDO::class);
        return new NameDao($conn);
    },

    TeaDao::class => function (ContainerInterface $container) {
        $conn = $container->get(PDO::class);
        return new TeaDao($conn);
    },

    VendorDao::class => function (ContainerInterface $container) {
        $conn = $container->get(PDO::class);
        return new VendorDao($conn);
    },

    GetTeasRequestHandler::class => function (ContainerInterface $container) {
        $teaAggrDao = $container->get(TeaAggregateDao::class);
        return new GetTeasRequestHandler($teaAggrDao);
    },

    SaveTeaRequestHandler::class => function (ContainerInterface $container) {
        $nameDao = $container->get(NameDao::class);
        $vendorDao = $container->get(VendorDao::class);
        $locationDao = $container->get(LocationDao::class);
        $teaDao = $container->get(TeaDao::class);
        return new SaveTeaRequestHandler($nameDao, $vendorDao, $locationDao, $teaDao);
    },
];
