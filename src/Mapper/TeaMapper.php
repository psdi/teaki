<?php

namespace Teaki\Mapper;

use Teaki\Entity\Tea;
use Teaki\Persistence\TeaDao;

class TeaMapper
{
    public static function map(array $set): Tea
    {
        $tea = new Tea;
        $tea->setTypeId((int) $set['typeId']);
        $tea->setNameId((int) $set['nameId']);
        $tea->setAlias($set['alias']);
        $tea->setOriginId((int) $set['originId']);
        $tea->setVendorId((int) $set['vendorId']);
        $tea->setAmount((int) $set['amount']);
        $tea->setIsAvailable((bool) $set['isAvailable']);

        $remarks = $set['remarks'] ?? null;
        if (is_string($remarks) && strlen($remarks) > TeaDao::REMARKS_MAX_LENGTH) {
            $remarks = substr($remarks, 0, TeaDao::REMARKS_MAX_LENGTH);
        }
        $tea->setRemarks($remarks);

        $tea->setHarvestYear(
            !empty($set['harvestYear'])
                ? (int) $set['harvestYear']
                : null
        );
        return $tea;
    }
}
