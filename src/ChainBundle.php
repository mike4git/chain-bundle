<?php

declare(strict_types=1);

namespace Mike4Git\ChainBundle;

use Mike4Git\ChainBundle\DependencyInjection\Compiler\ChainPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ChainBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new ChainPass());
    }

    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
