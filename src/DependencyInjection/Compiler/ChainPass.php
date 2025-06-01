<?php declare(strict_types=1);

namespace Mike4Git\ChainBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ChainPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('mike4git.chain.registry')) {
            return;
        }

        $definition = $container->findDefinition('mike4git.chain.registry');

        foreach ($container->findTaggedServiceIds('chain.handler') as $id => $tags) {
            foreach ($tags as $attributes) {
                $chain = $attributes['chain'] ?? 'default';
                $priority = $attributes['priority'] ?? 0;
                $definition->addMethodCall('addHandler', [$chain, new Reference($id), $priority]);
            }
        }
    }
}
