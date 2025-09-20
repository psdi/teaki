<?php

namespace Teaki;

use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Teaki\Persistence\TeaDao;

class EditTeaRequestHandler implements RequestHandlerInterface
{
    public function __construct(
        private TeaDao $teaDao,
    ) {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $body = $request->getParsedBody();
        return new JsonResponse([]);
    }
}
