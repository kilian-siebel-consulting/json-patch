<?php
namespace Ibrows\JsonPatch;

use Ibrows\JsonPatch\Exception\OperationInvalidException;

interface PatchConverterInterface
{
    /**
     * @param array $rawDiff
     * @return OperationInterface[]
     * @throws OperationInvalidException
     */
    public function convert(array $rawDiff);
}
