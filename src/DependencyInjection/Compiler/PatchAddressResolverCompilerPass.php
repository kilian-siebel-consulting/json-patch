<?php

namespace Ibrows\JsonPatch\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class PatchOperationAppliersCompilerPass
 * @package Ibrows\RestBundle\DependencyInjection\Compiler
 *
 * @codeCoverageIgnore
 */
class PatchAddressResolverCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $taggedServices = $container->findTaggedServiceIds(
            'ibrows_json_patch.address_resolver'
        );

        if (!$container->has('ibrows_json_patch.address_lookup')) {
            return;
        }
        $definition = $container->getDefinition('ibrows_json_patch.address_lookup');

        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall(
                'addAddressResolver',
                [
                    new Reference($id),
                ]
            );
        }
    }
}
