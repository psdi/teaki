<?php

namespace Teaki;

use Laminas\Diactoros\Response\JsonResponse;
use League\Route\Http\Exception\NotFoundException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Teaki\Entity\TeaAggregate;
use Teaki\Persistence\TeaAggregateDao;

class GetTeasRequestHandler implements RequestHandlerInterface
{
    /** @var TeaAggregateDao */
    private $teaAggrDao;

    public function __construct(TeaAggregateDao $teaAggrDao)
    {
        $this->teaAggrDao = $teaAggrDao;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $teaId = $request->getAttribute("teaId");
        $data = $teaId !== null
            ? $this->teaAggrDao->fetch($teaId)
            : $this->teaAggrDao->fetchAll();
        if ($data instanceof TeaAggregate && is_null($data->getId())) {
            throw new NotFoundException;
        }
        return new JsonResponse($data);
    }
}
