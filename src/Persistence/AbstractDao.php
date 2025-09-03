<?php

namespace Teaki\Persistence;

abstract class AbstractDao
{
    /** @var \PDO */
    protected $conn;

    public function __construct(\PDO $conn)
    {
        $this->conn = $conn;
    }
}
