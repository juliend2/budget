<?php

namespace Julien\Budget;

class DBConnection implements DBConnectionInterface
{
    private $pdo;

    public function __construct($databaseFile)
    {
        // Initialize the SQLite PDO connection
        $dsn = "sqlite:" . $databaseFile;
        $this->pdo = new \PDO($dsn);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function findObject($query, $params): mixed
    {
        // Example query to find a single object by ID
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);

        return $stmt->fetch(\PDO::FETCH_OBJ);
    }

    public function findObjects($query, $params): array
    {
        // Fetch all objects from a given table
        $stmt = $this->pdo->query($query);

        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    public function query($sql, $params = []): bool
    {
        // Execute a general SQL query with optional parameters
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }
}
