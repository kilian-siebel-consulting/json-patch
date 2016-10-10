<?php
namespace Ibrows\JsonPatch;

use Ibrows\JsonPatch\Exception\InvalidPathException;

interface PointerInterface
{
    /**
     * @return string[]
     * @throws InvalidPathException
     */
    public function tokens();

    /**
     * @return string
     * @throws InvalidPathException
     */
    public function lastToken();

    /**
     * @return string
     */
    public function path();
}
