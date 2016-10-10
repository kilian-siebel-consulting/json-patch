<?php
namespace Ibrows\JsonPatch\AddressResolver;

use Ibrows\JsonPatch\Address\HashSetAddress;
use Ibrows\JsonPatch\AddressInterface;
use Ibrows\JsonPatch\AddressResolverInterface;
use Ibrows\JsonPatch\PointerInterface;

class HashSetAddressResolver implements AddressResolverInterface
{
    /**
     * {@inheritdoc}
     */
    public function supports($value, PointerInterface $childPointer)
    {
        return is_array($value)
            ? 5
            : 0;
    }

    /** @noinspection MoreThanThreeArgumentsInspection */
    /**
     * {@inheritdoc}
     */
    public function resolve(& $value, PointerInterface $pointer, AddressInterface $parent = null, array $options = [])
    {
        return new HashSetAddress(
            $pointer,
            $value,
            $parent
        );
    }
}
