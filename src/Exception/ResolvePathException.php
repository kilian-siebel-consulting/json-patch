<?php
namespace Ibrows\JsonPatch\Exception;

use Exception;
use Ibrows\JsonPatch\AddressInterface;
use Ibrows\JsonPatch\PointerInterface;

/**
 * Class ResolvePathException
 * @package Ibrows\RestBundle\Patch\Exception
 *
 * @codeCoverageIgnore
 *
 * {@inheritdoc}
 */
class ResolvePathException extends InvalidPathException
{
    const MESSAGE = 'Could not resolve path "%s" on current address.';

    /**
     * @var string
     */
    private $token;

    /**
     * @var AddressInterface
     */
    private $address;

    /** @noinspection MoreThanThreeArgumentsInspection */
    /**
     * {@inheritdoc}
     * @param AddressInterface $address
     * @param string|null      $token
     * @throws InvalidPathException
     */
    public function __construct(
        AddressInterface $address,
        PointerInterface $pointer,
        $token = null,
        $code = 0,
        Exception $previous = null
    ) {
        if (!$token) {
            $token = $pointer->lastToken();
        }

        parent::__construct(
            $pointer,
            sprintf(self::MESSAGE, $token),
            $code,
            $previous
        );
        $this->address = $address;
        $this->token = $token;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @return AddressInterface
     */
    public function getAddress()
    {
        return $this->address;
    }
}
