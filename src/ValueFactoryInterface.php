<?php
namespace Ibrows\JsonPatch;

interface ValueFactoryInterface
{
    /**
     * @param AddressInterface $address
     * @param PointerInterface $pointer
     * @return ValueInterface
     */
    public function getValue(AddressInterface $address, PointerInterface $pointer);
}
