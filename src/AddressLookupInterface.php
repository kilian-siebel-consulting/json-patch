<?php
namespace Ibrows\JsonPatch;

use Ibrows\JsonPatch\Exception\InvalidPathException;
use Ibrows\JsonPatch\Exception\ResolvePathException;
use Ibrows\JsonPatch\Exception\RootResolveException;
use InvalidArgumentException;

interface AddressLookupInterface
{
    /** @noinspection MoreThanThreeArgumentsInspection */
    /**
     * @param PointerInterface        $pointer
     * @param mixed                   $object
     * @param mixed[]                 $options
     * @return ValueInterface
     * @throws InvalidPathException
     * @throws RootResolveException
     * @throws ResolvePathException
     * @throws InvalidArgumentException
     */
    public function lookup(
        PointerInterface $pointer,
        & $object,
        array $options = []
    );
}
