<?php

namespace Infrastructure\Connection;

use Application\Connection\Connection;
use Application\Connection\ConnectionProviderInterface;

class ConnectionProvider implements ConnectionProviderInterface
{
    private Connection|null $connection = null;

    public function __construct() {
    }

    public function connect(): Connection
    {
        $this->connection = new MySqlConnection(
            'user',
            'password',
            'db',
            'contacts',
        );

        $this->connection->open();

        return $this->connection;
    }

    public function exit(): void
    {
        if ($this->connection) {
            $this->connection->close();
        }

        $this->connection = null;
    }

    public function __destruct()
    {
        $this->exit();
    }
}