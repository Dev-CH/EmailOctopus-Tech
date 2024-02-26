<?php

namespace Domain\Entity;

use DateTimeImmutable;
use Domain\Exception\ContactException;
use Exception;

class Contact
{
    private function __construct(
        public readonly string $email,
        public readonly string $name,
        public readonly DateTimeImmutable $createdAt,
        public int|null $id = null,
    ) {
    }

    public static function new(
        string $email,
        string $name,
    ): Contact {
        return new Contact($email, $name, new DateTimeImmutable());
    }

    /**
     * @throws ContactException
     */
    public static function fromDB(array $array): Contact
    {
        try {
            return new Contact(
                $array['email_address'],
                $array['name'],
                new DateTimeImmutable($array['created_at']),
                $array['id'],
            );
        } catch (Exception $e) {
            throw ContactException::invalid($e->getMessage());
        }
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
}