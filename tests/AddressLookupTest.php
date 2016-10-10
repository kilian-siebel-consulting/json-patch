<?php
namespace Ibrows\JsonPatch\Tests;

use Ibrows\JsonPatch\AddressInterface;
use Ibrows\JsonPatch\AddressLookup;
use Ibrows\JsonPatch\AddressResolverInterface;
use Ibrows\JsonPatch\PointerFactoryInterface;
use Ibrows\JsonPatch\PointerInterface;
use Ibrows\JsonPatch\RootPointer;
use Ibrows\JsonPatch\ValueFactory;
use Ibrows\JsonPatch\ValueFactoryInterface;
use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;

class AddressLookupTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var ValueFactoryInterface|PHPUnit_Framework_MockObject_MockObject
     */
    private $valueFactory;

    /**
     * @var PointerFactoryInterface|PHPUnit_Framework_MockObject_MockObject
     */
    private $pointerFactory;

    public function setUp()
    {
        $this->valueFactory = $this->getMockForAbstractClass(ValueFactory::class);
        $this->pointerFactory = $this->getMockForAbstractClass(PointerFactoryInterface::class);
        $this->pointerFactory
            ->method('createFromPath')
            ->willReturn(RootPointer::create());
        $this->pointerFactory
            ->method('createFromTokens')
            ->willReturn(RootPointer::create());
    }

    /**
     * @expectedException \Ibrows\JsonPatch\Exception\RootResolveException
     * @expectedExceptionMessage Could not resolve root.
     */
    public function testMissingRootResolver()
    {
        $lookup = new AddressLookup(
            $this->pointerFactory,
            $this->valueFactory
        );

        $object = [];

        $lookup->lookup(RootPointer::create(), $object);
    }

    /**
     * @expectedException \Ibrows\JsonPatch\Exception\ResolvePathException
     * @expectedExceptionMessageRegExp %Could not resolve path ".*" on current address\.%
     */
    public function testMissingResolver()
    {
        $lookup = new AddressLookup(
            $this->pointerFactory,
            $this->valueFactory
        );

        $address = $this->getMockForAbstractClass(AddressInterface::class);
        $address
            ->method('pointer')
            ->willReturn(RootPointer::create());

        /** @var AddressResolverInterface|PHPUnit_Framework_MockObject_MockObject $arrayResolver */
        $arrayResolver = $this->getMockForAbstractClass(AddressResolverInterface::class);
        $first = true;
        $arrayResolver
            ->method('supports')
            ->will(
                static::returnCallback(
                    function () use (&$first) {
                        if ($first) {
                            $first = false;
                            return 10;
                        }
                        return 0;
                    }
                )
            );
        $arrayResolver
            ->method('resolve')
            ->willReturn($address);

        $lookup->addAddressResolver($arrayResolver);

        $object = [];

        /** @var PointerInterface|PHPUnit_Framework_MockObject_MockObject $childPointer */
        $childPointer = $this->getMockForAbstractClass(PointerInterface::class);
        $childPointer
            ->method('tokens')
            ->willReturn(
                [
                    'some',
                    'tokens',
                ]
            );

        $lookup->lookup($childPointer, $object);
    }
}
