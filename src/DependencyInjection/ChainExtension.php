<?php declare(strict_types=1);

namespace Mike4Git\ChainBundle\DependencyInjection;

use Mike4Git\ChainBundle\Attribute\AsChainHandler;
use Symfony\Component\DependencyInjection\ChildDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;

class ChainExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $container->registerAttributeForAutoconfiguration(
            AsChainHandler::class,
            static function (ChildDefinition $childDefinition, AsChainHandler $attribute): void {
                $childDefinition->addTag('chain.handler', [
                    'chain' => $attribute->chain,
                    'priority' => $attribute->priority,
                ]);
            }
        );
    }
}
