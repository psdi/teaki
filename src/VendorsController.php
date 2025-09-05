<?php

namespace Teaki;

use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Teaki\Persistence\VendorDao;

class VendorsController
{
    /** @var VendorDao */
    private $vendorDao;

    public function __construct(VendorDao $vendorDao)
    {
        $this->vendorDao = $vendorDao;
    }

    public function get(ServerRequestInterface $request): ResponseInterface
    {
        $vendors = $this->vendorDao->fetchAll();
        return new JsonResponse($vendors);
    }
}
