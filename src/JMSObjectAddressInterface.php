<?php
namespace Ibrows\JsonPatch;

use Ibrows\JsonPatch\Exception\InvalidPathException;

interface JMSObjectAddressInterface extends AddressInterface
{
    /**
     * @param PointerInterface $pointer
     * @return array|null
     * @throws InvalidPathException
     */
    public function resolveType(PointerInterface $pointer);
}
