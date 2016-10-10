<?php
namespace Ibrows\JsonPatch\OperationApplier;

use Ibrows\JsonPatch\Exception\OperationInvalidException;
use Ibrows\JsonPatch\OperationApplierInterface;
use Ibrows\JsonPatch\ValueInterface;

class Test implements OperationApplierInterface
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
        if ((string)$pathValue->value() !== $value) {
            throw new OperationInvalidException(
                sprintf(
                    'Operation test failed. Expected: "%s", Actual: "%s"',
                    (string)$pathValue->value(),
                    (string)$value
                )
            );
        }
    }
}
