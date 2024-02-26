<?php

namespace Domain\Exception;

use Exception;

class ContactException extends Exception
{
    private function __construct(string $message)
    {
        parent::__construct($message);
    }

    public static function invalid(string $message): ContactException
    {
        return new ContactException(sprintf('Invalid contact object creation: %s', $message));
    }
}