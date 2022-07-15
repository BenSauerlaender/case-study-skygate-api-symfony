<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidationError extends Exception
{
    private ConstraintViolationListInterface $errors;

    public function __construct(ConstraintViolationListInterface $errors, $code = 0, $previous = null)
    {
        $this->errors = $errors;
        parent::__construct("Validation error detected", $code, $previous);
    }

    public function getErrors(): ConstraintViolationListInterface
    {
        return $this->errors;
    }
}
