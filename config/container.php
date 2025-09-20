<?php

use Psr\Container\ContainerInterface;
use Teaki\{EditTeaRequestHandler, GetTeasRequestHandler, SaveTeaRequestHandler};
use Teaki\{LocationsController, NamesController, VendorsController};
use Teaki\Persistence\{LocationDao, NameDao, TeaAggregateDao, TeaDao, VendorDao};
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

    EditTeaRequestHandler::class => function (ContainerInterface $container) {
        $teaDao = $container->get(TeaDao::class);
        return new EditTeaRequestHandler($teaDao);
    },

    LocationsController::class => function (ContainerInterface $container) {
        $locationDao = $container->get(LocationDao::class);
        return new LocationsController($locationDao);
    },

    NamesController::class => function (ContainerInterface $container) {
        $nameDao = $container->get(NameDao::class);
        return new NamesController($nameDao);
    },

    VendorsController::class => function (ContainerInterface $container) {
        $vendorDao = $container->get(VendorDao::class);
        return new VendorsController($vendorDao);
    },
];
