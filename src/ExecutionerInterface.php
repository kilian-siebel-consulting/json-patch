<?php
namespace Ibrows\JsonPatch;

use Ibrows\JsonPatch\Exception\InvalidPathException;
use Ibrows\JsonPatch\Exception\OperationInvalidException;
use Ibrows\JsonPatch\Exception\ResolvePathException;
use Ibrows\JsonPatch\Exception\RootResolveException;
use InvalidArgumentException;

interface ExecutionerInterface
{
    /**
     * @param OperationInterface[] $operations
     * @param mixed                $object
     * @param mixed[]              $options
     * @return mixed
     * @throws OperationInvalidException
     * @throws InvalidPathException
     * @throws RootResolveException
     * @throws ResolvePathException
     * @throws InvalidArgumentException
     */
    public function execute(array $operations, $object, array $options = []);
}
