<?php declare(strict_types=1);

namespace Mike4Git\ChainBundle\DependencyInjection\Compiler;

use Mike4Git\ChainBundle\Registry\ChainHandlerRegistry;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ChainPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        if (!$container->has(ChainHandlerRegistry::class)) {
            return;
        }

        $registryDefinition = $container->findDefinition(ChainHandlerRegistry::class);

        foreach ($container->findTaggedServiceIds('chain.handler') as $id => $tags) {
            foreach ($tags as $attributes) {
                $chain = $attributes['chain'] ?? null;
                $priority = $attributes['priority'] ?? 0;
                $description = $attributes['description'] ?? null;

                if (!$chain) {
                    throw new \InvalidArgumentException("Handler $id must define a 'chain' attribute.");
                }

                $registryDefinition->addMethodCall(
                    'addHandler',
                    [
                        $chain,
                        new Reference($id),
                        $priority,
                        $id,
                        $description,
                    ]
                );
            }
        }
    }
}
