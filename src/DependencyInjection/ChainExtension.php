<?php declare(strict_types=1);

namespace Mike4Git\ChainBundle\DependencyInjection;

use Mike4Git\ChainBundle\DependencyInjection\Compiler\ChainPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;

class ChainExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $container->addCompilerPass(new ChainPass());
    }
}
