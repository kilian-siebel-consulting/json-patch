<?php
namespace Ibrows\JsonPatch\AddressResolver;

use Ibrows\JsonPatch\Address\ObjectAddress;
use Ibrows\JsonPatch\AddressInterface;
use Ibrows\JsonPatch\AddressResolverInterface;
use Ibrows\JsonPatch\PointerInterface;
use Metadata\MetadataFactoryInterface;

class ObjectAddressResolver implements AddressResolverInterface
{
    /**
     * @var MetadataFactoryInterface
     */
    private $classMetadataFactory;

    /**
     * ObjectAddressResolver constructor.
     * @param MetadataFactoryInterface $classMetadataFactory
     */
    public function __construct(
        MetadataFactoryInterface $classMetadataFactory
    ) {
        $this->classMetadataFactory = $classMetadataFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function supports($value, PointerInterface $childPointer)
    {
        return is_object($value)
            ? 10
            : 0;
    }

    /** @noinspection MoreThanThreeArgumentsInspection */
    /**
     * {@inheritdoc}
     */
    public function resolve(& $value, PointerInterface $pointer, AddressInterface $parent = null, array $options = [])
    {
        $context = null;
        if (array_key_exists('jms_context', $options)) {
            $context = $options['jms_context'];
        }

        return new ObjectAddress(
            $pointer,
            $value,
            $this->classMetadataFactory->getMetadataForClass(get_class($value)),
            $context,
            $parent
        );
    }
}
