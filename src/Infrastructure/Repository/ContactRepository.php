<?php

namespace Infrastructure\Repository;

use Application\Connection\Connection;
use Application\Connection\ConnectionProviderInterface;
use Domain\Entity\Contact;
use Domain\Repository\ContactRepositoryInterface;

class ContactRepository implements ContactRepositoryInterface
{
    private Connection $connection;

    public function __construct(ConnectionProviderInterface $connectionProvider)
    {
        $this->connection = $connectionProvider->connect();
    }

    /**
     * @return Contact[]
     */
    public function fetchAll(): array
    {
        $result = $this->connection->fetch('
            SELECT * FROM list_contact AS lc 
            ORDER BY lc.created_at DESC
        ');

        return array_map(fn ($contact) => Contact::fromDB($contact), $result);
    }

    public function add(Contact $contact): Contact
    {
        $id = $this->connection->insert('
            INSERT INTO list_contact (email_address, name, created_at)
            VALUES (:email, :name, :createdAt)
        ', [
            'email' => $contact->email,
            'name' => $contact->name,
            'createdAt' => $contact->createdAt->format('Y-m-d H:i:s'),
        ]);

        $contact->setId($id);

        return $contact;
    }

    public function delete(int $id): void
    {
        $this->connection->exec('DELETE FROM list_contact WHERE id = :id', ['id' => $id]);
    }
}