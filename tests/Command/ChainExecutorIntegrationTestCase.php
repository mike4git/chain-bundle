<?php

declare(strict_types=1);

namespace Mike4Git\ChainBundle\Tests\Command;

use Mike4Git\ChainBundle\Executor\ChainExecutor;
use Mike4Git\ChainBundle\Tests\Base\BaseKernelTestCase;
use Mike4Git\ChainBundle\Tests\Handler\Context\SampleContext;

class ChainExecutorIntegrationTestCase extends BaseKernelTestCase
{
    public function testChainExecutionThroughSymfonyContainer(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        /** @var ChainExecutor $executor */
        $executor = $container->get(ChainExecutor::class);
        $result = $executor->execute('sample', new SampleContext('handle kernel test'), false);

        $this->assertEquals('HANDLE KERNEL TEST', $result->getValue());
    }
}
