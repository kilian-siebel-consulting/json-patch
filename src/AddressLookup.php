<?php
namespace Ibrows\JsonPatch;

use Ibrows\JsonPatch\Exception\InvalidPathException;
use Ibrows\JsonPatch\Exception\ResolvePathException;
use Ibrows\JsonPatch\Exception\RootResolveException;
use InvalidArgumentException;

class AddressLookup implements AddressLookupInterface
{
    /**
     * @var PointerFactoryInterface
     */
    private $pointerFactory;

    /**
     * @var ValueFactoryInterface
     */
    private $valueFactory;

    /**
     * @var AddressResolverInterface[]
     */
    private $addressResolvers = [];

    /**
     * AddressLookup constructor.
     * @param PointerFactoryInterface $pointerFactory
     * @param ValueFactoryInterface $valueFactory
     */
    public function __construct(
        PointerFactoryInterface $pointerFactory,
        ValueFactoryInterface $valueFactory
    ) {
        $this->pointerFactory = $pointerFactory;
        $this->valueFactory = $valueFactory;
    }


    /** @noinspection MoreThanThreeArgumentsInspection */
    /**
     * {@inheritdoc}
     */
    public function lookup(
        PointerInterface $pointer,
        & $object,
        array $options = []
    ) {
        $tokens = $pointer->tokens();

        $firstPointer = $this->pointerFactory->createFromTokens(
            [reset($tokens)]
        );

        $rootAddress = $this->rootAddress($object, $firstPointer, $options);

        return $this->lookupTokens($tokens, $rootAddress, $options);
    }

    /**
     * @param mixed            $object
     * @param PointerInterface $firstPointer
     * @param mixed[]          $options
     * @return AddressInterface mixed
     * @throws InvalidArgumentException
     * @throws RootResolveException
     * @throws InvalidPathException
     * @throws ResolvePathException
     */
    private function rootAddress(& $object, PointerInterface $firstPointer, array $options = [])
    {
        /** @noinspection ReferenceMismatchInspection */
        $resolver = $this->findResolver($object, $firstPointer, null);
        return $resolver->resolve($object, RootPointer::create(), null, $options);
    }

    /** @noinspection MoreThanThreeArgumentsInspection */
    /**
     * @param string[]                $tokens
     * @param AddressInterface        $address
     * @param mixed[]                 $options
     * @return ValueInterface
     * @throws InvalidPathException
     * @throws ResolvePathException
     * @throws InvalidArgumentException
     * @throws RootResolveException
     */
    private function lookupTokens(
        array $tokens,
        AddressInterface $address,
        array $options = []
    ) {
        $pointer = $this->pointerFactory->createFromTokens(
            array_merge($address->pointer()->tokens(), [array_shift($tokens)])
        );
        $valuePointer = $this->pointerFactory->createFromTokens(
            array_merge($pointer->tokens(), [reset($tokens)])
        );

        if (count($tokens) < 1) {
            return $this->valueFactory->getValue($address, $pointer);
        }

        $value =& $address->resolve($pointer);

        /** @noinspection ReferenceMismatchInspection */
        $resolver = $this->findResolver($value, $valuePointer, $address);
        $resolvedAddress = $resolver->resolve($value, $pointer, $address, $options);

        return $this->lookupTokens($tokens, $resolvedAddress, $options);
    }

    /**
     * @param mixed                 $value
     * @param PointerInterface      $pointer
     * @param AddressInterface|null $parent
     * @return AddressResolverInterface
     * @throws ResolvePathException
     * @throws RootResolveException
     * @throws InvalidPathException
     */
    private function findResolver($value, PointerInterface $pointer, AddressInterface $parent = null)
    {
        $chosenResolver = null;
        $weight = 0;

        array_walk(
            $this->addressResolvers,
            // @codingStandardsIgnoreStart
            function (AddressResolverInterface $resolver) use (& $weight, & $chosenResolver, $value, $pointer) {
                // @codingStandardsIgnoreEnd
                $resolverWeight = $resolver->supports($value, $pointer);
                if ($resolverWeight > $weight) {
                    $chosenResolver = $resolver;
                    $weight = $resolverWeight;
                }
            }
        );

        if ($chosenResolver === null) {
            if ($parent === null) {
                throw new RootResolveException($value);
            }
            throw new ResolvePathException($parent, $pointer);
        }

        return $chosenResolver;
    }

    /**
     * @param AddressResolverInterface $addressResolver
     */
    public function addAddressResolver(
        AddressResolverInterface $addressResolver
    ) {
        $this->addressResolvers[] = $addressResolver;
    }
}
