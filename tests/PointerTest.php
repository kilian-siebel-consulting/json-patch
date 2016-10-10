<?php
namespace Ibrows\JsonPatch\Tests;

use Ibrows\JsonPatch\AddressInterface;
use Ibrows\JsonPatch\AddressLookupInterface;
use Ibrows\JsonPatch\Pointer;
use Ibrows\JsonPatch\PointerFactoryInterface;
use Ibrows\JsonPatch\PointerInterface;
use Ibrows\JsonPatch\TokenEscapeInterface;
use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;
use stdClass;

class PointerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var AddressLookupInterface|PHPUnit_Framework_MockObject_MockObject
     */
    private $addressLookup;

    /**
     * @var PointerFactoryInterface|PHPUnit_Framework_MockObject_MockObject
     */
    private $pointerFactory;

    /**
     * @var TokenEscapeInterface|PHPUnit_Framework_MockObject_MockObject
     */
    private $tokenUnescaper;

    public function setUp()
    {
        $this->addressLookup = $this->getMockForAbstractClass(AddressLookupInterface::class);
        $this->pointerFactory = $this->getMockForAbstractClass(PointerFactoryInterface::class);
        $this->tokenUnescaper = $this->getMockForAbstractClass(TokenEscapeInterface::class);
    }

    /**
     * @expectedException \Ibrows\JsonPatch\Exception\InvalidPathException
     */
    public function testSliceErrors()
    {
        $pointer = $this->getInstanceFromPath('no/slash/at/start');
        $pointer->tokens();
    }

    public function testSlice()
    {
        $this->tokenUnescaper
            ->method('unescape')
            ->willReturn('token');

        $pointer = $this->getInstanceFromPath('/some/path');

        $this->assertEquals(
            [
                'token',
                'token'
            ],
            $pointer->tokens()
        );
        $this->assertEquals('/some/path', $pointer->path());
    }

    public function testSliceLast()
    {
        $this->tokenUnescaper
            ->method('unescape')
            ->willReturn('token');

        $pointer = $this->getInstanceFromPath('/some/path');

        $this->assertEquals('token', $pointer->lastToken());
    }

    public function testPath()
    {
        $pointer = $this->getInstanceFromTokens(
            [
                '1',
                '2',
                '3',
            ]
        );

        $this->tokenUnescaper
            ->method('escape')
            ->willReturn('escaped');

        $this->assertEquals('/escaped/escaped/escaped', $pointer->path());
    }

    /**
     * @param string $path
     * @return Pointer
     */
    private function getInstanceFromPath($path)
    {
        return Pointer::fromPath(
            $path,
            $this->tokenUnescaper
        );
    }

    /**
     * @param string[] $tokens
     * @return Pointer
     */
    private function getInstanceFromTokens(array $tokens)
    {
        return Pointer::fromTokens(
            $tokens,
            $this->tokenUnescaper
        );
    }
}
