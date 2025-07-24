<?php

namespace App\Exceptions;

use Exception;

class ResponseApiException extends Exception
{
    public function __construct(string $message, protected int $statusCode)
    {
        parent::__construct($message, 0);
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
