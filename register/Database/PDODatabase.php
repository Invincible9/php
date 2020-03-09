<?php

namespace Database;


class PDODatabase implements DatabaseInterface
{
    /**
     * @var \PDO
     */
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function query(string $query): StatementInterface
    {
        $stmt = $this->pdo->prepare($query);
        return new PDOPreparedStatement($stmt);

    }

    public function lastId(): int
    {
        var_dump($this->pdo->lastInsertId());
        return $this->pdo->lastInsertId(null);
    }

    public function getErrorInfo(): array
    {
        // TODO: Implement getErrorInfo() method.
    }
}