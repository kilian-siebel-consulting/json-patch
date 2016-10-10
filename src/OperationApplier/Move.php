<?php
namespace Ibrows\JsonPatch\OperationApplier;

use Ibrows\JsonPatch\Address\ArrayItemAddress;
use Ibrows\JsonPatch\Exception\OperationInvalidException;
use Ibrows\JsonPatch\OperationApplierInterface;
use Ibrows\JsonPatch\ValueInterface;

class Move implements OperationApplierInterface
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
        if (!$fromValue instanceof ValueInterface) {
            throw new OperationInvalidException(
                sprintf(
                    OperationInvalidException::MISSING_SPECIALISED_PROPERTY_MESSAGE,
                    'from',
                    'move'
                )
            );
        }

        $tempValue = $fromValue->value();
        $fromValue->remove();
        $pathValue->add($tempValue);
    }
}
