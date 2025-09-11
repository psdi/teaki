<?php

namespace Teaki\Persistence;

use Teaki\Entity\Name;
use Teaki\Mapper\NameMapper;

class NameDao extends AbstractDao
{
    protected const BASE_QUERY = 'SELECT * FROM `name`';
    protected const FIELD_MAP = [
        'id' => 'id',
        'value' => '`value`',
    ];
    private $base = 'SELECT {{fields}} from `name`';

    public function select(array $fields): NameDao
    {
        $this->base = str_replace(
            '{{fields}}',
            implode(', ', $fields),
            $this->base
        );
        return $this;
    }

    public function fetchAll(): array
    {
        $query = $this->buildQuery();
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $names = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return array_map([NameMapper::class, 'map'], $names);
    }

    public function create(Name $name, bool $returnId = false): ?int
    {
        $command = 'INSERT INTO `name` (`value`, `alias`) VALUES (:value, :alias)';
        $stmt = $this->conn->prepare($command);
        $stmt->execute([
            'value' => $name->getValue(),
            'alias' => $name->getAlias(),
        ]);
        if ($returnId) {
            return $this->conn->lastInsertId();
        }
        return null;
    }
}
