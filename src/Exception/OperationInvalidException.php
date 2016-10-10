<?php
namespace Ibrows\JsonPatch\Exception;

use InvalidArgumentException;

/**
 * Class OperationInvalidException
 * @package Ibrows\JsonPatch\Exception
 *
 * @codeCoverageIgnore
 *
 * {@inheritdoc}
 */
class OperationInvalidException extends InvalidArgumentException
{
    const
        MISSING_PROPERTY_MESSAGE = 'The property "%s" must be provided for every operation.',
        MISSING_SPECIALISED_PROPERTY_MESSAGE = 'The property "%s" must be provided for the %s operation.',
        INVALID_OPERATION = 'Couldn\'t find an applier for the operation "%s".';
}
