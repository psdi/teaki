<?php

namespace Teaki;

use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Teaki\Persistence\LocationDao;

class LocationsController
{
    /** @var LocationDao */
    private $locationDao;

    public function __construct(LocationDao $locationDao)
    {
        $this->locationDao = $locationDao;
    }

    public function get(ServerRequestInterface $request): ResponseInterface
    {
        $locations = $this->locationDao->fetchAll();
        return new JsonResponse($locations);
    }
}
