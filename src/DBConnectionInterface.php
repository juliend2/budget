<?php

namespace Julien\Budget;

interface DBConnectionInterface {
    public function findObject(string $query, array $params): mixed;
    public function findObjects(string $query, array $params): array;
    public function query(string $query, array $params): bool;
}