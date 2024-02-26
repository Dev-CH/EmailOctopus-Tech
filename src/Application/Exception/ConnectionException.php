<?php

namespace Application\Exception;

use Exception;
use PDOException;
use Throwable;

class ConnectionException extends Exception
{
    private function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public static function fromPDO(PDOException $exception): ConnectionException
    {
        return new ConnectionException(
            message: $exception->getMessage(),
            previous: $exception,
        );
    }
}