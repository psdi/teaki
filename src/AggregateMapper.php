<?php

namespace Teaki;

use Teaki\Entity\TeaAggregate;

class AggregateMapper
{
    public static function map(array $set): TeaAggregate
    {
        $aggregate = new TeaAggregate;
        $aggregate->setId((int) $set['id']);
        $aggregate->setName($set['name']);
        $aggregate->setTypeId((int) $set['type_id']);
        $aggregate->setAlias($set['alias']);
        $aggregate->setHarvestYear(
            is_numeric($set['harvest_year'])
                ? (int) $set['harvest_year']
                : null
        );
        $aggregate->setIsAvailable((bool) $set['is_available']);
        $aggregate->setVendor($set['vendor']);
        $aggregate->setOrigin($set['origin']);
        $aggregate->setAmount((int) $set['amount']);
        $aggregate->setRemarks($set['remarks']);
        return $aggregate;
    }
}
