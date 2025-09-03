<?php

namespace Teaki\Persistence;

use Teaki\Entity\Vendor;

class VendorDao extends AbstractDao
{
    public function create(Vendor $vendor, bool $returnId = false): ?int
    {
        $command = 'INSERT INTO `vendor` (`value`, `location_id`) VALUES (:value, :location_id)';
        $stmt = $this->conn->prepare($command);
        $stmt->execute([
            'value' => $vendor->getValue(),
            'location_id' => $vendor->getLocationId(),
        ]);
        if ($returnId) {
            return $this->conn->lastInsertId();
        }
        return null;
    }
}
