<?php

namespace Teaki\Mapper;

use Teaki\Entity\Name;

class NameMapper
{
    public static function map($set): Name
    {
        $name = new Name;
        $name->setId($set['id'] ?? null);
        $name->setValue($set['value']);
        $name->setAlias($set['alias']);
        return $name;
    }
}
