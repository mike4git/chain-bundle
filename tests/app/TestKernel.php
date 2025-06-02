<?php

declare(strict_types=1);

namespace Mike4Git\ChainBundle\Tests\app;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

final class TestKernel extends BaseKernel
{
    use MicroKernelTrait;

    public function registerBundles(): iterable
    {
        return [
            new \Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new \Mike4Git\ChainBundle\ChainBundle(),
        ];
    }

    protected function configureContainer(ContainerConfigurator $container): void
    {
        $container->import(__DIR__ . '/config/packages/*.yaml');
        $container->import(__DIR__ . '/config/packages/{env}/*.yaml'); // falls du env-spezifisch arbeitest
        $container->import(__DIR__ . '/config/services.yaml');
    }
}
