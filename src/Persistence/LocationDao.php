<?php

namespace Teaki\Persistence;

use Teaki\Entity\Location;
use Teaki\Mapper\LocationMapper;

class LocationDao extends AbstractDao
{
    public function fetchAll(): array
    {
        $query = 'SELECT * FROM `location`';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $locations = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return \array_map([LocationMapper::class, 'map'], $locations);
    }

    public function create(Location $location, bool $returnId = false): ?int
    {
        $command = 'INSERT INTO `location` (`value`) VALUES (:value)';
        $stmt = $this->conn->prepare($command);
        $stmt->execute([
            'value' => $location->getValue(),
        ]);
        if ($returnId) {
            return $this->conn->lastInsertId();
        }
        return null;
    }
}
