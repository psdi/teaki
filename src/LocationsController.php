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
        $sort = explode(',', $request->getQueryParams()['sort'] ?? '');
        $locations = $this->locationDao->orderBy(...$sort)->fetchAll();
        return new JsonResponse($locations);
    }
}
