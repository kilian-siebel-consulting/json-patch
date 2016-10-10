<?php
namespace Ibrows\JsonPatch\Transformer\Converter;

use Doctrine\Common\Proxy\Proxy;

interface ConverterInterface
{
    /**
     * This method should return a proxy to the desired object.
     * If there is no proxy mechanism, the converter should return
     * the same as getResource.
     *
     * @param string $className
     * @param mixed  $identifier a scalar identifier
     * @return Proxy
     */
    public function getResourceProxy($className, $identifier);

    /**
     * @param string $className
     * @param mixed  $identifier a scalar identifier
     * @return object
     */
    public function getResource($className, $identifier);
}
