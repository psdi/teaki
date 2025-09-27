<?php

namespace Teaki;

use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Diactoros\Stream;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Teaki\Entity\Tea;
use Teaki\Mapper\{LocationMapper, NameMapper, TeaMapper, VendorMapper};
use Teaki\Persistence\{LocationDao, NameDao, TeaDao, VendorDao};

class SaveTeaRequestHandler implements RequestHandlerInterface
{
    public function __construct(
        private NameDao $nameDao,
        private VendorDao $vendorDao,
        private LocationDao $locationDao,
        private TeaDao $teaDao,
    ) {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $body = $request->getParsedBody();
        $body = array_map(
            function (mixed $val) {
                return $val === '' ? null : $val;
            },
            $body
        );
        $teaId = $request->getAttribute('teaId');

        $nameId = $body['nameId'] ?? false;
        if (empty($nameId) && array_key_exists('name', $body)) {
            $name = NameMapper::map([
                'value' => $body['name'],
                'alias' => $body['alias'],
            ]);
            $nameId = $this->nameDao->create($name, true);
        }

        $vendorId = $body['vendorId'] ?? false;
        if (empty($vendorId) && array_key_exists('vendor', $body)) {
            $vendor = VendorMapper::map([
                'value' => $body['vendor'],
            ]);
            $vendorId = $this->vendorDao->create($vendor, true);
        }

        $originId = $body['originId'] ?? false;
        if (empty($originId) && array_key_exists('origin', $body)) {
            $origin = LocationMapper::map([
                'value' => $body['origin'],
            ]);
            $originId = $this->locationDao->create($origin, true);
        }

        if (!$nameId || !$vendorId || !$originId) {
            return new JsonResponse([
                'message' => 'Invalid request body'
            ], 400);
        }

        $body = \array_merge(
            $body,
            [
                'nameId' => $nameId,
                'vendorId' => $vendorId,
                'originId' => $originId,
            ]
        );
        $tea = TeaMapper::map($body);

        if ($teaId) {
            $tea->setId($teaId);
            $response = $this->handleUpdate($tea);
        } else {
            $response = $this->handleInsert($tea);
        }
        return $response;
    }

    private function handleUpdate(Tea $tea)
    {
        try {
            $isSuccess = $this->teaDao->update($tea);
            $statusCode = $isSuccess ? 200 : 404;
        } catch (\PDOException $e) {
            $statusCode = 500;
        }

        $response = new JsonResponse([]);
        $response = $response->withStatus($statusCode);
        return $response;
    }

    private function handleInsert(Tea $tea)
    {
        $teaId = null;
        try {
            $teaId = $this->teaDao->create($tea, true);
            $statusCode = 201;
        } catch (\PDOException $e) {
            $statusCode = 500;
        }

        $response = new JsonResponse([], $statusCode);
        if ($teaId) {
            $response = $response->withPayload([
                'teaId' => $teaId,
            ]);
        }
        return $response;
    }
}
