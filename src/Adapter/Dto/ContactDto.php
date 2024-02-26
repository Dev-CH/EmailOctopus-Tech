<?php

namespace Adapter\Dto;

use Domain\Entity\Contact;

class ContactDto
{
    private function __construct(
        public readonly int $id,
        public readonly string $email,
        public readonly string $name,
        public readonly string $createdAt,
    ) {
    }

    public static function fromEntity(Contact $contact): ContactDto
    {
        return new ContactDto(
            $contact->id ?? 0,
            $contact->email,
            $contact->name,
            $contact->createdAt->format(DATE_ATOM),
        );
    }
}