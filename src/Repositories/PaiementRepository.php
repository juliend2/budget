<?php

namespace Julien\Budget\Repositories;

use Julien\Budget\DBConnectionInterface;
use Julien\Budget\Paiement;

class PaiementRepository {
    protected $connection;
    public function __construct(DBConnectionInterface $connection) {
        $this->connection = $connection;
    }

    public function createTable() {
        $this->connection->query(
            "CREATE TABLE paiements IF NOT EXISTS (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                montant REAL NULL,
                date DATETIME NOT NULL,
                description TEXT
            )", []
        );
    }

    public function insert(Paiement $paiement) {
        $this->connection->query(
            "INSERT INTO paiements (montant, date, description) VALUES (?, ?, ?)",
            [
                $paiement->montant,
                $paiement->date,
                $paiement->description,
            ]
        );
    }
}