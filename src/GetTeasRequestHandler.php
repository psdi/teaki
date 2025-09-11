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
        if ($teaId !== null) {
            $data = $this->teaAggrDao->fetch($teaId);
        } else {
            $sort = explode(',', $request->getQueryParams()['sort'] ?? '');
            $data = $this->teaAggrDao->orderBy(...$sort)->fetchAll();
        }

        if ($data === null) {
            throw new NotFoundException;
        }
        return new JsonResponse($data);
    }
}
