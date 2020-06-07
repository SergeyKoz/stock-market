<?php

namespace App\Exception;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class FormErrorException extends HttpException
{
    private array $errorFields;

    public function __construct(int $statusCode, string $message, array $errorFields, \Throwable $previous = null, array $headers = [], ?int $code = 0)
    {
        $this->errorFields = $errorFields;
        parent::__construct($statusCode, $message, $previous, $headers, $code);
    }

    public function getErrorFields()
    {
        return $this->errorFields;
    }
}