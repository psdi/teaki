<?php

namespace TeaTracker\Persistence;

use TeaTracker\Entity\TeaAggregate;
use TeaTracker\AggregateMapper;

class TeaAggregateDao
{
    /** @var \PDO */
    private $conn;

    private const BASE_QUERY = <<<QUERY
        SELECT t.id AS id, n.`value` AS `name`, ty.id AS type_id, l.value AS origin,
            t.harvest_year, t.is_available, t.amount_in_grams AS amount,
            n.`alias`, v.value AS vendor, t.remarks
        FROM tea t
        INNER JOIN `type` ty ON t.type_id = ty.id
        INNER JOIN `name` n ON t.name_id = n.id
        INNER JOIN `location` l ON t.origin = l.id
        INNER JOIN `vendor` v ON t.vendor_id = v.id
QUERY;

    public function __construct(\PDO $conn)
    {
        $this->conn = $conn;
    }

    public function fetch(int $teaId): TeaAggregate
    {
        $query = self::BASE_QUERY . ' WHERE t.id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $teaId);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        // Return empty object if fetch returns false (empty set)
        return is_array($result)
            ? AggregateMapper::map($result)
            : new TeaAggregate;
    }

    public function fetchAll(): array
    {
        $stmt = $this->conn->prepare(self::BASE_QUERY);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return array_map([AggregateMapper::class, 'map'], $result);
    }
}
