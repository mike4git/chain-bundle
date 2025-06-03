<?php declare(strict_types=1);

namespace Mike4Git\ChainBundle\DependencyInjection;

use Mike4Git\ChainBundle\Attribute\AsChainHandler;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ChildDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class ChainExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new YamlFileLoader($container, new FileLocator(\dirname(__DIR__, 2) . '/config'));
        $loader->load('services.yaml');
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
