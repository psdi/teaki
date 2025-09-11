<?php

namespace Teaki\Persistence;

abstract class AbstractDao
{
    /** @var \PDO */
    protected $conn;
    protected array $orderBy = [];

    public function __construct(\PDO $conn)
    {
        $this->conn = $conn;
    }

    public function orderBy(string ...$orderBy): AbstractDao
    {
        foreach ($orderBy as $item) {
            $dir = $item[0] ?? '';
            $col = substr($item, 1);
            if (in_array($dir, ['+', '-']) && array_key_exists($col, static::FIELD_MAP)) {
                $this->orderBy[] = sprintf(
                    '%s %s',
                    static::FIELD_MAP[$col],
                    $dir === '+' ? 'ASC' : 'DESC'
                );
            }
        }
        return $this;
    }

    protected function buildQuery(): string
    {
        $query = static::BASE_QUERY;
        if (count($this->orderBy)) {
            $query .= ' ORDER BY ' . implode(', ', $this->orderBy);
        }
        return $query;
    }
}
