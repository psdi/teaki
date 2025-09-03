<?php

namespace Teaki\Mapper;

use Teaki\Entity\Location;

class LocationMapper
{
    public static function map(array $set): Location
    {
        $location = new Location;
        $location->setId(isset($set['id']) ? (int) $set['id'] : null);
        $location->setValue($set['value']);
        return $location;
    }
}
