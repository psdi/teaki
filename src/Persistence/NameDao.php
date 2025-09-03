<?php

namespace Teaki\Persistence;

use Teaki\Entity\Name;

class NameDao extends AbstractDao
{
    public function fetchAll()
    {
        $query = 'SELECT * FROM `name`';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
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
