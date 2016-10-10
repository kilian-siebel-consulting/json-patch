<?php
namespace Ibrows\JsonPatch\Exception;

use Exception;
use RuntimeException;

/**
 * Class RootResolveException
 * @package Ibrows\JsonPatch\Exception
 *
 * @codeCoverageIgnore
 *
 * {@inheritdoc}
 */
class RootResolveException extends RuntimeException
{
    const MESSAGE = 'Could not resolve root.';

    /**
     * @var mixed
     */
    private $object;

    /**
     * @param mixed $object
     * {@inheritdoc}
     */
    public function __construct(
        $object,
        $code = 0,
        Exception $previous = null
    ) {
        parent::__construct(self::MESSAGE, $code, $previous);
        $this->object = $object;
    }

    /**
     * @return mixed
     */
    public function getObject()
    {
        return $this->object;
    }
}
