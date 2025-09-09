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
        $params = json_decode($request->getBody()->getContents(), true);
        $params = \array_map(
            function (mixed $val) {
                return $val === '' ? null : $val;
            },
            $params
        );

        $nameId = $params['nameId'] ?? false;
        if (empty($nameId) && array_key_exists('name', $params)) {
            $name = NameMapper::map([
                'value' => $params['name'],
                'alias' => $params['alias'],
            ]);
            $nameId = $this->nameDao->create($name, true);
        }

        $vendorId = $params['vendorId'] ?? false;
        if (empty($vendorId) && array_key_exists('vendor', $params)) {
            $vendor = VendorMapper::map([
                'value' => $params['vendor'],
            ]);
            $vendorId = $this->vendorDao->create($vendor, true);
        }

        $originId = $params['originId'] ?? false;
        if (empty($originId) && array_key_exists('origin', $params)) {
            $origin = LocationMapper::map([
                'value' => $params['origin'],
            ]);
            $originId = $this->locationDao->create($origin, true);
        }

        $params = \array_merge(
            $params,
            [
                'nameId' => $nameId,
                'vendorId' => $vendorId,
                'originId' => $originId,
            ]
        );
        $tea = TeaMapper::map($params);
        $teaId = $this->teaDao->create($tea, true);
        return new JsonResponse(['teaId' => $teaId], 201);
    }
}
