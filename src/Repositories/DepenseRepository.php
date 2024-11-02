<?php

namespace Julien\Budget\Repositories;

use Julien\Budget\DBConnectionInterface;

class DepenseRepository {
    protected $connection;
    public function __construct(DBConnectionInterface $connection) {
        $this->connection = $connection;
    }

    public function createTable() {
        $this->connection->query(
            "CREATE TABLE depenses IF NOT EXISTS (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                montant REAL NULL,
                date DATETIME NOT NULL,
                description TEXT
            )", []
        );
    }
}