<?php
namespace Ibrows\JsonPatch\Exception;

use Exception;
use Ibrows\JsonPatch\Exception\OperationInvalidException;

class InvalidValueException extends OperationInvalidException
{
    public function __construct($message, Exception $previous)
    {
        parent::__construct($message, 400, $previous);
    }
}
