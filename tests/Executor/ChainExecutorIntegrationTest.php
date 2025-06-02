<?php

declare(strict_types=1);

namespace Mike4Git\ChainBundle\Tests\Executor;

use Mike4Git\ChainBundle\Executor\ChainExecutor;
use Mike4Git\ChainBundle\Tests\app\TestKernel;
use Mike4Git\ChainBundle\Tests\Handler\Context\SampleContext;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ChainExecutorIntegrationTest extends KernelTestCase
{
    public function testChainExecutionThroughSymfonyContainer(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        /** @var ChainExecutor $executor */
        $executor = $container->get(ChainExecutor::class);
        $result = $executor->process('example', new SampleContext('handle kernel test'));

        $this->assertEquals('HANDLE KERNEL TEST', $result->getValue());
    }

    protected static function getKernelClass(): string
    {
        return TestKernel::class;
    }
}
