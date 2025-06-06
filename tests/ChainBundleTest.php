<?php

namespace Mike4Git\ChainBundle\Tests;

use Mike4Git\ChainBundle\ChainBundle;
use Mike4Git\ChainBundle\DependencyInjection\Compiler\ChainPass;
use Mike4Git\ChainBundle\Tests\Base\BaseKernelTestCase;
use Prophecy\Argument;
use Prophecy\PhpUnit\ProphecyTrait;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ChainBundleTest extends BaseKernelTestCase
{
    use ProphecyTrait;

    public function testThatBundlePathIsCurrentDir(): void
    {
        self::assertStringEndsNotWith('src', (new ChainBundle())->getPath());
    }

    public function testThatBundleusesCompilerPass(): void
    {
        $containerBuilder = $this->prophesize(ContainerBuilder::class);
        $containerBuilder->addCompilerPass(Argument::type(ChainPass::class))
            ->willReturn($containerBuilder->reveal())
            ->shouldBeCalled();

        (new ChainBundle())->build($containerBuilder->reveal());

    }
}
