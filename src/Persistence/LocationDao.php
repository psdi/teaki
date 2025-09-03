<?php

namespace Teaki\Persistence;

use Teaki\Entity\Location;

class LocationDao extends AbstractDao
{
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
