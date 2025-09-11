<?php

namespace Teaki\Persistence;

use Teaki\Entity\Vendor;
use Teaki\Mapper\VendorMapper;

class VendorDao extends AbstractDao
{
    protected const BASE_QUERY = 'SELECT * FROM `vendor`';
    protected const FIELD_MAP = [
        'id' => 'id',
        'value' => '`value`',
    ];

    public function fetchAll(): array
    {
        $query = $this->buildQuery();
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $vendors = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return \array_map([VendorMapper::class, 'map'], $vendors);
    }

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
