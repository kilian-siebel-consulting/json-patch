<?php
namespace Ibrows\JsonPatch;

class ValueFactory implements ValueFactoryInterface
{

    /**
     * @param AddressInterface $address
     * @param PointerInterface $pointer
     * @return ValueInterface
     */
    public function getValue(AddressInterface $address, PointerInterface $pointer)
    {
        return new Value($address, $pointer);
    }
}
