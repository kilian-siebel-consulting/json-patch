<?php
namespace Ibrows\JsonPatch;

interface PointerFactoryInterface
{
    /**
     * @param string $path
     * @return PointerInterface
     */
    public function createFromPath($path);

    /**
     * @param string[] $tokens
     * @return PointerInterface
     */
    public function createFromTokens(array $tokens);
}
