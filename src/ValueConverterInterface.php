<?php
namespace Ibrows\JsonPatch;

use Ibrows\JsonPatch\Exception\InvalidPathException;

interface ValueConverterInterface
{
    /**
     * @param mixed          $value
     * @param ValueInterface $pathValue
     * @return mixed
     * @throws InvalidPathException
     */
    public function convert($value, ValueInterface $pathValue);
}
