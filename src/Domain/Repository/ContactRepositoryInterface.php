<?php

namespace Domain\Repository;

use Domain\Entity\Contact;

interface ContactRepositoryInterface
{
    /**
     * @return Contact[]
     */
    public function fetchAll(): array;

    public function add(Contact $contact): Contact;

    public function delete(int $id): void;
}