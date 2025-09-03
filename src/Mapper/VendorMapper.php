<?php

namespace Teaki\Mapper;

use Teaki\Entity\Vendor;

class VendorMapper
{
    public static function map(array $set): Vendor
    {
        $vendor = new Vendor;
        $vendor->setId(isset($set['id']) ? (int) $set['id'] : null);
        $vendor->setValue($set['value']);
        $vendor->setLocationId(
            isset($set['locationId'])
                ? (int) $set['locationId']
                : null
        );
        return $vendor;
    }
}
