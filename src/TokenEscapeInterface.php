<?php
namespace Ibrows\JsonPatch;

interface TokenEscapeInterface
{
    /**
     * @param string $token
     * @return string
     */
    public function unescape($token);

    /**
     * @param string $token
     * @return string
     */
    public function escape($token);
}
