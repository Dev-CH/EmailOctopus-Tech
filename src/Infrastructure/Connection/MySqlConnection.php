<?php

namespace Infrastructure\Connection;

use Application\Connection\Connection;
use Application\Exception\ConnectionException;
use PDO;
use PDOException;
use PDOStatement;

class MySqlConnection implements Connection
{
    private PDO | null $connection = null;

    public function __construct(
        private readonly string $user,
        private readonly string $password,
        private readonly string $host,
        private readonly string $database,
    ) {
    }

    public function open(): void
    {
        try {
            $this->connection = new \PDO("mysql:host={$this->host};dbname={$this->database}",
                $this->user,
                $this->password);
        } catch (PDOException $e) {
            throw ConnectionException::fromPDO($e);
        }
    }

    public function close(): void
    {
        $this->connection = null;
    }

    public function fetch(string $sql, array $params = []): array
    {
        return $this->execute($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert(string $sql, array $params = []): int
    {
        $this->execute($sql, $params);

        return $this->connection->lastInsertId();
    }

    public function exec(string $sql, array $params = []): int
    {
        return $this->execute($sql, $params)->rowCount();
    }

    protected function execute(string $sql, array $params): PDOStatement
    {
        try {
            if (count($params) > 0) {
                $statement = $this->connection->prepare($sql);

                foreach ($params as $param => $var) {
                    $statement->bindValue($param, $var);
                }

                $statement->execute();

                return $statement;
            }

            return $this->connection->query($sql);
        } catch (PDOException $e) {
            throw ConnectionException::fromPDO($e);
        }
    }
}