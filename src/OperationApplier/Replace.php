<?php
namespace Ibrows\JsonPatch\OperationApplier;

use Ibrows\JsonPatch\OperationApplierInterface;
use Ibrows\JsonPatch\ValueInterface;

class Replace implements OperationApplierInterface
{
    /** @noinspection MoreThanThreeArgumentsInspection */
    /**
     * {@inheritdoc}
     */
    public function apply(
        ValueInterface $pathValue,
        ValueInterface $fromValue = null,
        $value = null,
        array $parameters = []
    ) {

        $pathValue->modify($value);
    }
}
