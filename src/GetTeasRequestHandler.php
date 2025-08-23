<?php

namespace TeaTracker;

use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use TeaTracker\AggregateMapper;
use TeaTracker\Entity\TeaAggregate;
use TeaTracker\Persistence\TeaAggregateDao;

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
            $data = new \stdClass;
        }
        return new JsonResponse($data);
    }
}
