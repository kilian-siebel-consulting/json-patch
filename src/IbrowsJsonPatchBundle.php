<?php
namespace Ibrows\JsonPatch;

use Ibrows\JsonPatch\DependencyInjection\Compiler\PatchAddressResolverCompilerPass;
use Ibrows\JsonPatch\DependencyInjection\Compiler\PatchOperationAppliersCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @codeCoverageIgnore
 */
class IbrowsJsonPatchBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new PatchAddressResolverCompilerPass());
        $container->addCompilerPass(new PatchOperationAppliersCompilerPass());
    }
}
