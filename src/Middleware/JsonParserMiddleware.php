<?php

namespace Teaki\Middleware;

use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class JsonParserMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $contentType = $request->getHeaderLine('Content-Type');
        if ($contentType !== 'application/json') {
            return new JsonResponse([
                'message' => 'Content type not supported',
            ], 415);
        }
        $contents = $request->getBody()->getContents();
        if (empty($contents) || !json_validate($contents)) {
            return new JsonResponse([
                'message' => 'Invalid request body',
            ], 400);
        }
        $request = $request->withParsedBody(json_decode($contents, true));
        return $handler->handle($request);
    }
}
