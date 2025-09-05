<?php

namespace Teaki;

use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Teaki\Persistence\NameDao;

class NamesController
{
    /** @var NameDao */
    private $nameDao;
    private const QUERY_PARAMS = [
        'full',
    ];

    public function __construct(NameDao $nameDao)
    {
        $this->nameDao = $nameDao;
    }

    public function get(ServerRequestInterface $request): ResponseInterface
    {
        $names = $this->nameDao->fetchAll();
        return new JsonResponse($names);
    }
}
