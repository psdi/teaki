<?php

namespace Teaki;

use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Teaki\Mapper\{LocationMapper, NameMapper, TeaMapper, VendorMapper};
use Teaki\Persistence\{LocationDao, NameDao, TeaDao, VendorDao};

class SaveTeaRequestHandler implements RequestHandlerInterface
{
    /** @var NameDao */
    private $nameDao;
    /** @var VendorDao */
    private $vendorDao;
    /** @var LocationDao */
    private $locationDao;
    /** @var TeaDao */
    private $teaDao;

    public function __construct(NameDao $nameDao, VendorDao $vendorDao, LocationDao $locationDao, TeaDao $teaDao)
    {
        $this->nameDao = $nameDao;
        $this->vendorDao = $vendorDao;
        $this->locationDao = $locationDao;
        $this->teaDao = $teaDao;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $body = $request->getParsedBody();
        $body = array_map(
            function (mixed $val) {
                return $val === '' ? null : $val;
            },
            $body
        );

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

        $body = \array_merge(
            $body,
            [
                'nameId' => $nameId,
                'vendorId' => $vendorId,
                'originId' => $originId,
            ]
        );
        $tea = TeaMapper::map($body);
        $teaId = $this->teaDao->create($tea, true);
        return new JsonResponse(['teaId' => $teaId], 201);
    }
}
