<?php

namespace Application\Connection;

use Application\Exception\ConnectionException;

interface Connection
{
    /**
     * @throws ConnectionException
     */
    public function open(): void;

    public function close(): void;

    /**
     * @throws ConnectionException
     */
    public function fetch(string $sql, array $params): array;

    /**
     * @throws ConnectionException
     */
    public function insert(string $sql, array $params): int;

    /**
     * @throws ConnectionException
     */
    public function exec(string $sql, array $params): int;
}